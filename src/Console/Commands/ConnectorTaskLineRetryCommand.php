<?php

namespace HaruyaNishikubo\Transporter\Console\Commands;

use HaruyaNishikubo\Transporter\Models\ConnectorTaskLine;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Artisan;
use Throwable;

class ConnectorTaskLineRetryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transporter:connector-task-line-retry {--connector-task-line-ids=} {--debug} {--run}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Connector Task Line Retry.';

    protected Collection $connector_task_lines;
    protected bool $is_debug;
    protected bool $is_run;

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            $this->setConnectorTaskLines()
                ->setIsDebug()
                ->setIsRun();
        } catch (Throwable $e) {
            $this->error($e->getMessage());

            return self::FAILURE;
        }

        if ($this->is_debug) {
            $this->info(json_encode([
                'count' => $this->connector_task_lines
                    ->count(),
            ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        }

        if ($this->connector_task_lines->isEmpty()) {
            if ($this->is_debug) {
                $this->info(json_encode([
                    'message' => 'connector_task_lines is not exists.',
                ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            }

            return self::SUCCESS;
        }

        foreach ($this->connector_task_lines as $connector_task_line) {
            if ($this->is_debug) {
                $this->info(json_encode($connector_task_line->toArray(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            }

            if (! $this->is_run) {
                return self::SUCCESS;
            }

            $connector_task_line->fill([
                'status' => ConnectorTaskLine::STATUS_READY,
            ]);

            if ($connector_task_line->save()) {
                Artisan::queue('transporter:connector-task-line-runner', [
                    '--connector-task-line-id' => $connector_task_line->id,
                    '--memory-limit' => -1,
                    '--run' => true,
                ])->onQueue(sprintf('transporter:connector-%d', $connector_task_line->connectorTask->connector_id));
            }
        }

        return self::SUCCESS;
    }

    protected function setConnectorTaskLines(): self
    {
        $ids = collect(explode(',', $this->option('connector-task-line-ids')))
            ->filter(function ($value) {
                return ! empty($value);
            });

        $query = ConnectorTaskLine::with(['connectorTask'])
            ->where('status', ConnectorTaskLine::STATUS_ERROR);
        if ($ids->isNotEmpty()) {
            $query->whereIn('id', $ids->toArray());
        }

        $this->connector_task_lines = $query->get();

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
}
