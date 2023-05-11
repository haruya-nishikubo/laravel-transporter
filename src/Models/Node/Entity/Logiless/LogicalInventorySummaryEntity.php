<?php

namespace HaruyaNishikubo\Transporter\Models\Node\Entity\Logiless;

use HaruyaNishikubo\Transporter\Models\Node\Entity\Entity;

class LogicalInventorySummaryEntity extends Entity
{
    protected string $table_name = 'logical_inventory_summary';

    protected array $fields = [
        'id' => self::FIELD_TYPE_INT64,
        'layer' => self::FIELD_TYPE_STRING,
        'ordered' => self::FIELD_TYPE_INT64,
        'in_transit' => self::FIELD_TYPE_INT64,
        'received' => self::FIELD_TYPE_INT64,
        'available' => self::FIELD_TYPE_INT64,
        'blocked' => self::FIELD_TYPE_INT64,
        'allocated' => self::FIELD_TYPE_INT64,
        'stock_out' => self::FIELD_TYPE_INT64,
        'free' => self::FIELD_TYPE_INT64,
        'shipped' => self::FIELD_TYPE_INT64,
        'issued' => self::FIELD_TYPE_INT64,
        'is_reorder_level' => self::FIELD_TYPE_BOOLEAN,
        'reached_reorder_level_at' => self::FIELD_TYPE_TIMESTAMP,
        'created_at' => self::FIELD_TYPE_TIMESTAMP,
        'updated_at' => self::FIELD_TYPE_TIMESTAMP,
        'article' => self::FIELD_TYPE_JSON,
        'warehouse' => self::FIELD_TYPE_JSON,
    ];
}
