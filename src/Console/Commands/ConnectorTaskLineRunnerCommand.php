<?php

namespace HaruyaNishikubo\Transporter\Console\Commands;

use HaruyaNishikubo\Transporter\Models\ConnectorTask;
use HaruyaNishikubo\Transporter\Models\ConnectorTaskLine;
use HaruyaNishikubo\Transporter\Models\Node\Source\Repository\Repository as SourceRepository;
use HaruyaNishikubo\Transporter\Models\Node\Target\Repository\Repository as TargetRepository;
use HaruyaNishikubo\Transporter\Models\Node\Source\Repository\Shopify\Rest\MetafieldRepository as ShopifyRestMetafieldRepository;
use HaruyaNishikubo\Transporter\Models\Node\Source\Repository\Shopify\Rest\CustomerRepository as ShopifyRestCustomerRepository;
use HaruyaNishikubo\Transporter\Models\Node\Source\Repository\Shopify\Rest\FulfillmentRepository as ShopifyRestFulfillmentRepository;
use HaruyaNishikubo\Transporter\Models\Node\Source\Repository\Shopify\Rest\OrderRepository as ShopifyRestOrderRepository;
use HaruyaNishikubo\Transporter\Models\Node\Source\Repository\Shopify\Rest\ProductRepository as ShopifyRestProductRepository;
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
                ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
            }

            if ($this->hasSubset()) {
                foreach ($this->source_repository->collection() as $entity) {
                    $this->registerConnectorTaskLineOfSubset($entity);
                }
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

        $this->source_repository
            ->setAttributes($this->connector_task_line->source_repository_attributes ?? []);

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

    protected function registerConnectorTaskLineOfSubset(array $entity): self
    {
        switch ($this->connector_task_line->source_repository) {
            case ShopifyRestCustomerRepository::class:
                $this->createConnectorTaskLineOfShopifyMetafield($entity['id'], 'customers');

                break;

            case ShopifyRestOrderRepository::class:
                $this->createConnectorTaskLineOfShopifyMetafield($entity['id'], 'orders');
                $this->createConnectorTaskLineOfShopifyFulfillment($entity['id']);

                break;

            case ShopifyRestProductRepository::class:
                $this->createConnectorTaskLineOfShopifyMetafield($entity['id'], 'products');

                break;
        }

        return $this;
    }

    protected function hasSubset(): bool
    {
        return in_array($this->connector_task_line->source_repository, [
            ShopifyRestCustomerRepository::class,
            ShopifyRestOrderRepository::class,
            ShopifyRestProductRepository::class,
        ]);
    }

    protected function createConnectorTaskLineOfShopifyMetafield(int $owner_id, string $owner_resource): ConnectorTaskLine
    {
        $connector_task = $this->connector_task_line
            ->connectorTask;

        $connector_task_line = $connector_task
            ->connectorTaskLines()
            ->make([
                'status' => ConnectorTaskLine::STATUS_READY,
                'source_repository' => ShopifyRestMetafieldRepository::class,
                'source_repository_attributes' => [
                    'owner_id' => $owner_id,
                    'owner_resource' => $owner_resource,
                ],
                'target_repository' => $this->connector_task_line
                    ->target_repository,
                'connector_task_id' => $connector_task->id,
            ]);

        if ($this->is_debug) {
            $this->info(json_encode([
                'message' => sprintf(
                    'connector_task_line: %s',
                    json_encode($connector_task_line->toArray(), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT),
                ),
            ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
        }

        if (! $this->is_run) {
            return $connector_task_line;
        }

        $connector_task_line
            ->save();

        return $connector_task_line;
    }

    protected function createConnectorTaskLineOfShopifyFulfillment(int $order_id): ConnectorTaskLine
    {
        $connector_task = $this->connector_task_line
            ->connectorTask;

        $connector_task_line = $connector_task
            ->connectorTaskLines()
            ->make([
                'status' => ConnectorTaskLine::STATUS_READY,
                'source_repository' => ShopifyRestFulfillmentRepository::class,
                'source_repository_attributes' => [
                    'order_id' => $order_id,
                ],
                'target_repository' => $this->connector_task_line
                    ->target_repository,
                'connector_task_id' => $connector_task->id,
            ]);

        if ($this->is_debug) {
            $this->info(json_encode([
                'message' => sprintf(
                    'connector_task_line: %s',
                    json_encode($connector_task_line->toArray(), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT),
                ),
            ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
        }

        if (! $this->is_run) {
            return $connector_task_line;
        }

        $connector_task_line
            ->save();

        return $connector_task_line;
    }
}
