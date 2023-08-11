<?php

namespace HaruyaNishikubo\Transporter\Console\Commands;

use HaruyaNishikubo\Transporter\Models\ConnectorTask;
use HaruyaNishikubo\Transporter\Models\ConnectorTaskLine;
use HaruyaNishikubo\Transporter\Models\Node\Source\Repository\Repository as SourceRepository;
use HaruyaNishikubo\Transporter\Models\Node\Source\Repository\Shopify\Rest\CollectionRepository as ShopifyRestCollectionRepository;
use HaruyaNishikubo\Transporter\Models\Node\Source\Repository\Shopify\Rest\CollectRepository as ShopifyRestCollectRepository;
use HaruyaNishikubo\Transporter\Models\Node\Source\Repository\Shopify\Rest\CustomerRepository as ShopifyRestCustomerRepository;
use HaruyaNishikubo\Transporter\Models\Node\Source\Repository\Shopify\Rest\FulfillmentOrderRepository as ShopifyRestFulfillmentOrderRepository;
use HaruyaNishikubo\Transporter\Models\Node\Source\Repository\Shopify\Rest\FulfillmentRepository as ShopifyRestFulfillmentRepository;
use HaruyaNishikubo\Transporter\Models\Node\Source\Repository\Shopify\Rest\InventoryItemRepository as ShopifyRestInventoryItemRepository;
use HaruyaNishikubo\Transporter\Models\Node\Source\Repository\Shopify\Rest\MetafieldRepository as ShopifyRestMetafieldRepository;
use HaruyaNishikubo\Transporter\Models\Node\Source\Repository\Shopify\Rest\OrderRepository as ShopifyRestOrderRepository;
use HaruyaNishikubo\Transporter\Models\Node\Source\Repository\Shopify\Rest\ProductRepository as ShopifyRestProductRepository;
use HaruyaNishikubo\Transporter\Models\Node\Source\Repository\Shopify\Rest\RefundRepository as ShopifyRestRefundRepository;
use HaruyaNishikubo\Transporter\Models\Node\Source\Repository\Shopify\Rest\TransactionRepository as ShopifyRestTransactionRepository;
use HaruyaNishikubo\Transporter\Models\Node\Source\Repository\Shopify\Rest\VariantRepository as ShopifyRestVariantRepository;
use HaruyaNishikubo\Transporter\Models\Node\Target\Repository\Repository as TargetRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
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

    protected array $registered_connector_task_lines = [];

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

            Log::error($e->getMessage());

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

            if ($this->source_repository->hasNextQueries()) {
                $this->registerConnectorTaskLineOfNext($this->source_repository->nextQueries());
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

            Log::error($e->getMessage());

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
        $this->source_repository = $this->connector_task_line
            ->buildSourceRepository();

        return $this;
    }

    protected function setTargetRepository(): self
    {
        $this->target_repository = $this->connector_task_line
            ->buildTargetRepository($this->source_repository->collection());

        return $this;
    }

    protected function extract(): self
    {
        $this->source_repository
            ->prepare()
            ->extract();

        $this->connector_task_line
            ->connectorTaskLineLogs()
            ->createMany($this->source_repository->logs());

        return $this;
    }

    protected function load(): self
    {
        $this->target_repository
            ->load();

        $this->connector_task_line
            ->connectorTaskLineLogs()
            ->createMany($this->target_repository->logs());

        return $this;
    }

    protected function registerConnectorTaskLineOfNext(array $next_queries): self
    {
        $this->createConnectorTaskLine($this->connector_task_line->source_repository, [
            'query' => $next_queries,
        ]);

        return $this;
    }

    protected function registerConnectorTaskLineOfSubset(array $entity): self
    {
        switch ($this->connector_task_line->source_repository) {
            case ShopifyRestCustomerRepository::class:
                $this->createConnectorTaskLine(ShopifyRestMetafieldRepository::class, [
                    'owner_id' => $entity['id'],
                    'owner_resource' => 'customers',
                ]);

                break;

            case ShopifyRestOrderRepository::class:
                $this->createConnectorTaskLine(ShopifyRestMetafieldRepository::class, [
                    'owner_id' => $entity['id'],
                    'owner_resource' => 'orders',
                ]);
                $this->createConnectorTaskLine(ShopifyRestFulfillmentRepository::class, [
                    'order_id' => $entity['id'],
                ]);
                $this->createConnectorTaskLine(ShopifyRestFulfillmentOrderRepository::class, [
                    'order_id' => $entity['id'],
                ]);
                $this->createConnectorTaskLine(ShopifyRestRefundRepository::class, [
                    'order_id' => $entity['id'],
                ]);
                $this->createConnectorTaskLine(ShopifyRestTransactionRepository::class, [
                    'order_id' => $entity['id'],
                ]);

                break;

            case ShopifyRestProductRepository::class:
                $this->createConnectorTaskLine(ShopifyRestMetafieldRepository::class, [
                    'owner_id' => $entity['id'],
                    'owner_resource' => 'products',
                ]);
                $this->createConnectorTaskLine(ShopifyRestVariantRepository::class, [
                    'product_id' => $entity['id'],
                ]);
                $this->createConnectorTaskLine(ShopifyRestCollectRepository::class, [
                    'product_id' => $entity['id'],
                ]);

                break;

            case ShopifyRestVariantRepository::class:
                $this->createConnectorTaskLine(ShopifyRestInventoryItemRepository::class, [
                    'inventory_item_id' => $entity['inventory_item_id'],
                ]);

                break;

            case ShopifyRestCollectRepository::class:
                if (isset($this->registered_connector_task_lines[ShopifyRestCollectionRepository::class][$entity['collection_id']])) {
                    break;
                }

                $this->registered_connector_task_lines[ShopifyRestCollectionRepository::class][$entity['collection_id']] = true;

                $this->createConnectorTaskLine(ShopifyRestCollectionRepository::class, [
                    'collection_id' => $entity['collection_id'],
                ]);

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
            ShopifyRestVariantRepository::class,
            ShopifyRestCollectRepository::class,
        ]);
    }

    protected function createConnectorTaskLine(string $source_repository, array $source_repository_attributes): ConnectorTaskLine
    {
        $connector_task = $this->connector_task_line
            ->connectorTask;

        $connector_task_line = $connector_task
            ->connectorTaskLines()
            ->make([
                'status' => ConnectorTaskLine::STATUS_READY,
                'source_repository' => $source_repository,
                'source_repository_attributes' => $source_repository_attributes,
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

        // queue
        $this->enqueueConnectorTaskLine($connector_task_line, $connector_task);

        return $connector_task_line;
    }

    protected function enqueueConnectorTaskLine(ConnectorTaskLine $connector_task_line, ConnectorTask $connector_task): self
    {
        Artisan::queue('transporter:connector-task-line-runner', [
            '--connector-task-line-id' => $connector_task_line->id,
            '--memory-limit' => -1,
            '--run' => true,
        ])->afterCommit()
            ->onQueue(sprintf('transporter:connector-%d', $connector_task->connector_id));

        return $this;
    }
}
