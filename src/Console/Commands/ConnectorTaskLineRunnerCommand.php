<?php

namespace HaruyaNishikubo\Transporter\Console\Commands;

use HaruyaNishikubo\Transporter\Models\ConnectorTask;
use HaruyaNishikubo\Transporter\Models\ConnectorTaskLine;
use HaruyaNishikubo\Transporter\Models\Node\Source\Repository\Repository as SourceRepository;
use HaruyaNishikubo\Transporter\Models\Node\Target\Repository\Repository as TargetRepository;
use Illuminate\Console\Command;
use InvalidArgumentException;
use Throwable;

class ConnectorTaskLineRunnerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transporter:connector-task-line-runner {--connector-task-line-id=} {--memory-limit=} {--debug} {--run}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Transport From Source To Target.';

    protected ConnectorTaskLine $connector_task_line;
    protected bool $is_debug;
    protected bool $is_run;

    protected SourceRepository $source_repository;
    protected TargetRepository $target_repository;

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            $this->setConnectorTaskLine()
                ->setMemoryLimit()
                ->setIsDebug()
                ->setIsRun();
        } catch (Throwable $e) {
            $this->error($e->getMessage());

            return self::FAILURE;
        }

        try {
            if ($this->is_run) {
                $this->connector_task_line
                    ->fill([
                        'status' => ConnectorTaskLine::STATUS_RUNNING,
                    ])->save();
            }

            // extract
            $this->setSourceRepository()
                ->extract();

            if ($this->is_debug) {
                $this->info(json_encode([
                    'message' => sprintf(
                        'collection count: %d',
                        $this->source_repository
                            ->collection()
                            ->count()
                    ),
                ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
            }

            if (! $this->is_run) {
                return self::SUCCESS;
            }

            // load
            $this->setTargetRepository()
                ->load();

            // connector_task_line
            $this->connector_task_line
                ->fill([
                    'status' => ConnectorTaskLine::STATUS_COMPLETED,
                ])->save();

            // connector_task
            $connector_task = $this->connector_task_line
                ->connectorTask;

            $statuses = $connector_task->connectorTaskLines
                ->pluck('status')
                ->unique();

            $status = ConnectorTask::STATUS_COMPLETED;
            if ($statuses->contains(ConnectorTaskLine::STATUS_ERROR)) {
                $status = ConnectorTask::STATUS_ERROR;
            } elseif ($statuses->contains(ConnectorTaskLine::STATUS_READY) || $statuses->contains(ConnectorTaskLine::STATUS_RUNNING)) {
                $status = ConnectorTask::STATUS_RUNNING;
            }

            $connector_task->fill([
                'status' => $status,
            ])->save();
        } catch (Throwable $e) {
            $this->error($e->getMessage());

            $this->connector_task_line
                ->fill([
                    'status' => ConnectorTaskLine::STATUS_ERROR,
                ])->save();

            return self::FAILURE;
        }

        return self::SUCCESS;
    }

    protected function setConnectorTaskLine(): self
    {
        $id = $this->option('connector-task-line-id');
        if (empty($id)) {
            throw new InvalidArgumentException('connector-task-line-id is empty.');
        }

        $this->connector_task_line = ConnectorTaskLine::findOrFail($id);
        if ($this->connector_task_line->status != ConnectorTaskLine::STATUS_READY) {
            throw new InvalidArgumentException(sprintf('connector_task_line(%d) is not ready.', $id));
        }

        return $this;
    }

    protected function setMemoryLimit(): self
    {
        $memory_limit = $this->option('memory-limit');
        if (empty($memory_limit)) {
            return $this;
        }

        ini_set('memory_limit', $memory_limit);

        return $this;
    }

    protected function setIsDebug(): self
    {
        $this->is_debug = $this->option('debug');

        return $this;
    }

    protected function setIsRun(): self
    {
        $this->is_run = $this->option('run');

        return $this;
    }

    protected function setSourceRepository(): self
    {
        $connector = $this->connector_task_line
            ->connectorTask
            ->connector;

        $this->source_repository = new $this->connector_task_line
            ->source_repository(
                $connector,
                $connector->sourceNode
            );

        return $this;
    }

    protected function setTargetRepository(): self
    {
        $connector = $this->connector_task_line
            ->connectorTask
            ->connector;

        $this->target_repository = new $this->connector_task_line
            ->target_repository(
                $connector,
                $connector->targetNode,
                $this->source_repository
                    ->collection()
            );

        return $this;
    }

    protected function extract(): self
    {
        $this->source_repository
            ->setStartCursor($this->connector_task_line
                ->connectorTask
                ->start_cursor_at)
            ->setEndCursor($this->connector_task_line
                ->connectorTask
                ->end_cursor_at)
            ->prepare()
            ->extract();

        return $this;
    }

    protected function load(): self
    {
        $this->target_repository
            ->load();

        return $this;
    }
}
