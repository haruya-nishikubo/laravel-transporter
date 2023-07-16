<?php

namespace HaruyaNishikubo\Transporter\Models\Node\Entity;

use Carbon\Carbon;

abstract class Entity
{
    protected string $table_name;
    protected array $fields = [];
    protected array $attributes = [];
    protected string $updated_at_name = 'updated_at';

    public const FIELD_TYPE_BOOLEAN = 'BOOLEAN';
    public const FIELD_TYPE_DATE = 'DATE';
    public const FIELD_TYPE_FLOAT64 = 'FLOAT64';
    public const FIELD_TYPE_INT64 = 'INT64';
    public const FIELD_TYPE_JSON = 'JSON';
    public const FIELD_TYPE_STRING = 'STRING';
    public const FIELD_TYPE_TIMESTAMP = 'TIMESTAMP';

    public function __construct(array $attributes)
    {
        $this->fill($attributes);
    }

    public function fill(array $attributes): static
    {
        $now = now()->toIso8601String();

        foreach ($this->fields() as $name => $type) {
            if (isset($attributes[$name])) {
                $attributes[$name] = match ($type) {
                    self::FIELD_TYPE_TIMESTAMP => Carbon::parse($attributes[$name])->toIso8601String(),
                    self::FIELD_TYPE_DATE => Carbon::parse($attributes[$name])->toDateString(),
                    default => $attributes[$name],
                };
            }

            $this->attributes[$name] = match ($name) {
                '_sync_created_at', '_sync_updated_at' => $now,
                default => $attributes[$name] ?? null,
            };
        }

        return $this;
    }

    public function tableName(): string
    {
        return $this->table_name;
    }

    public function fields(): array
    {
        return array_merge($this->fields, [
            '_sync_created_at' => self::FIELD_TYPE_TIMESTAMP,
            '_sync_updated_at' => self::FIELD_TYPE_TIMESTAMP,
            '_sync_deleted_at' => self::FIELD_TYPE_TIMESTAMP,
        ]);
    }

    public function toJson(): string
    {
        return json_encode($this->attributes);
    }

    public function hasUpdatedAt(): bool
    {
        return isset($this->fields[$this->updated_at_name]);
    }

    public function updatedAtName(): string
    {
        return $this->updated_at_name;
    }
}
