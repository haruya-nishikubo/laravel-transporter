<?php

namespace HaruyaNishikubo\Transporter\Models\Node\Target\Repository\Bigquery;

use HaruyaNishikubo\Transporter\Models\Connector;
use HaruyaNishikubo\Transporter\Models\Node;
use HaruyaNishikubo\Transporter\Models\Node\Collection\Collection;
use HaruyaNishikubo\Transporter\Models\Node\Target\Client\Bigquery\Client;
use HaruyaNishikubo\Transporter\Models\Node\Target\Repository\Repository as BaseRepository;

class Repository extends BaseRepository
{
    protected string $dataset;

    public function __construct(Connector $connector, Node $node, Collection $collection)
    {
        $this->connector = $connector;
        $this->node = $node;

        $this->client = new Client([
            'project_id' => $node->secret['project_id'],
            'key_file' => $node->secret['key_file'],
        ]);

        $this->collection = $collection;

        $this->dataset = $node->secret['dataset'];
    }

    public function load(): self
    {
        return $this->createWorkingTable()
            ->insertWorkingTable()
            ->createTable()
            ->mergeTable()
            ->dropWorkingTable();
    }

    protected function createTable(): self
    {
        $sql = $this->createTableIfNotExistsSql();

        $this->connector
            ->connectorLogs()
            ->create([
                'label' => __FUNCTION__,
                'message' => [
                    'sql' => $sql,
                ],
            ]);

        $this->client
            ->query($sql);

        return $this;
    }

    protected function createWorkingTable(): self
    {
        $sql = $this->createOrReplaceWorkingTableSql();

        $this->connector
            ->connectorLogs()
            ->create([
                'label' => __FUNCTION__,
                'message' => [
                    'sql' => $sql,
                ],
            ]);

        $this->client
            ->query($sql);

        return $this;
    }

    protected function insertWorkingTable(): self
    {
        $this->connector
            ->connectorLogs()
            ->create([
                'label' => __FUNCTION__,
                'message' => [
                    'dataset' => $this->dataset,
                    'working_table' => $this->workingTableName(),
                    'count' => $this->collection
                        ->count(),
                ],
            ]);

        $this->client
            ->load($this->dataset, $this->workingTableName(), $this->collection);

        return $this;
    }

    protected function mergeTable(): self
    {
        $sql = $this->mergeSql();

        $this->connector
            ->connectorLogs()
            ->create([
                'label' => __FUNCTION__,
                'message' => [
                    'sql' => $sql,
                ],
            ]);

        $this->client
            ->query($sql);

        return $this;
    }

    protected function dropWorkingTable(): self
    {
        $sql = $this->dropWorkingTableSql();

        $this->connector
            ->connectorLogs()
            ->create([
                'label' => __FUNCTION__,
                'message' => [
                    'sql' => $sql,
                ],
            ]);

        $this->client
            ->query($sql);

        return $this;
    }

    protected function createTableIfNotExistsSql(): string
    {
        $entity = $this->collection
            ->newEntity([]);

        $table_name = sprintf('%s.%s', $this->dataset, $entity->tableName());
        $fields = collect($entity->fields());

        return sprintf('CREATE TABLE IF NOT EXISTS %s (%s)',
            $table_name,
            $fields->map(function ($type, $name) {
                return "`{$name}` {$type}";
            })->implode(",\n")
        );
    }

    protected function createOrReplaceWorkingTableSql(): string
    {
        $table_name = sprintf('%s.%s', $this->dataset, $this->workingTableName());

        $entity = $this->collection
            ->newEntity([]);
        $fields = collect($entity->fields());

        return sprintf('CREATE OR REPLACE TABLE %s (%s)',
            $table_name,
            $fields->map(function ($type, $name) {
                return "`{$name}` {$type}";
            })->implode(",\n")
        );
    }

    protected function mergeSql(): string
    {
        $now = now()->toIso8601String();

        $sql = <<< 'SQL'
            MERGE %s target
            USING %s source
            ON target.id = source.id
            WHEN NOT MATCHED THEN
                INSERT ROW
            WHEN MATCHED %s THEN
                UPDATE SET %s
        SQL;

        $entity = $this->collection->newEntity([]);

        return sprintf(
            $sql,
            sprintf('%s.%s', $this->dataset, $this->tableName()),
            sprintf('%s.%s', $this->dataset, $this->workingTableName()),
            ($entity->hasUpdatedAt()) ? sprintf('AND source.%s > target.%s', $entity->updatedAtName(), $entity->updatedAtName()) : '',
            collect($entity->fields())->map(function ($type, $name) use ($now) {
                return match ($name) {
                    '_sync_created_at' => null,
                    '_sync_updated_at' => sprintf("target._sync_updated_at = '%s'", $now),
                    '_sync_deleted_at' => 'target._sync_deleted_at = NULL',
                    default => sprintf('target.%s = source.%s', $name, $name),
                };
            })->filter(function ($value) {
                return ! empty($value);
            })->implode(",\n")
        );
    }

    protected function dropWorkingTableSql(): string
    {
        $table_name = sprintf('%s.%s', $this->dataset, $this->workingTableName());

        return sprintf('DROP TABLE IF EXISTS %s', $table_name);
    }

    protected function workingTableName(): string
    {
        $entity = $this->collection->newEntity([]);

        return sprintf('%s_working', $entity->tableName());
    }

    protected function tableName(): string
    {
        $entity = $this->collection->newEntity([]);

        return $entity->tableName();
    }
}
