<?php

namespace HaruyaNishikubo\Transporter\Console\Commands;

use Carbon\CarbonPeriod;
use HaruyaNishikubo\Transporter\Models\Connector;
use HaruyaNishikubo\Transporter\Models\ConnectorTask;
use HaruyaNishikubo\Transporter\Models\ConnectorTaskLine;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Throwable;

class ConnectorTaskRegisterCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transporter:connector-task-register {--debug} {--run}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Connector Task Register.';

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
            $this->setIsDebug()
                ->setIsRun();
        } catch (Throwable $e) {
            $this->error($e->getMessage());

            return self::FAILURE;
        }

        try {
            foreach (Connector::where('is_enabled', true)->cursor() as $connector) {
                if ($this->is_debug) {
                    $this->info(json_encode($connector->toArray(), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
                }

                $period = CarbonPeriod::create($connector->next_start_cursor_at, $connector->next_end_cursor_at);

                DB::beginTransaction();

                foreach ($period as $start_cursor_at) {
                    $end_cursor_at = $start_cursor_at->copy()->addDay();
                    if ($end_cursor_at > $connector->next_end_cursor_at) {
                        $end_cursor_at = $connector->next_end_cursor_at;
                    }

                    if ($this->is_debug) {
                        $this->info(json_encode([
                            'connector_id' => $connector->id,
                            'start_cursor_at' => $start_cursor_at,
                            'end_cursor_at' => $end_cursor_at,
                        ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
                    }

                    if (! $this->is_run) {
                        continue;
                    }

                    // connector_task
                    $connector_task = $connector->connectorTasks()
                        ->create([
                            'start_cursor_at' => $start_cursor_at,
                            'end_cursor_at' => $end_cursor_at,
                            'status' => ConnectorTask::STATUS_READY,
                        ]);

                    if ($this->is_debug) {
                        $this->info(json_encode($connector_task->toArray(), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
                    }

                    // connector_task_line
                    foreach ($connector->sourceRepositories() as $source_repository) {
                        $connector_task_line = $connector_task->connectorTaskLines()
                            ->create([
                                'source_repository' => $source_repository,
                                'target_repository' => $connector->targetRepository(),
                                'status' => ConnectorTaskLine::STATUS_READY,
                            ]);

                        // queue
                        Artisan::queue('transporter:connector-task-line-runner', [
                            '--connector-task-line-id' => $connector_task_line->id,
                            '--memory-limit' => -1,
                            '--run' => true,
                        ])->afterCommit()
                            ->onQueue(sprintf('transporter:connector-%d', $connector->id));

                        if ($this->is_debug) {
                            $this->info(json_encode($connector_task_line->toArray(), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
                        }
                    }
                }

                if (! $this->is_run) {
                    continue;
                }

                // connector
                $connector->fill([
                    'next_start_cursor_at' => $connector->next_end_cursor_at,
                    'next_end_cursor_at' => $connector->next_end_cursor_at->addHour($connector->interval),
                ])->save();

                if ($this->is_debug) {
                    $this->info(json_encode($connector->toArray(), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
                }

                DB::commit();
            }
        } catch (Throwable $e) {
            $this->error($e->getMessage());

            DB::rollBack();

            return self::FAILURE;
        }

        return self::SUCCESS;
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
