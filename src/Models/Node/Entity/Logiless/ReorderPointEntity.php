<?php

namespace HaruyaNishikubo\Transporter\Models\Node\Entity\Logiless;

use HaruyaNishikubo\Transporter\Models\Node\Entity\Entity;

class ReorderPointEntity extends Entity
{
    protected string $table_name = 'reorder_point';

    protected array $fields = [
        'id' => self::FIELD_TYPE_INT64,
        'reorder_point' => self::FIELD_TYPE_INT64,
        'inventory_constant' => self::FIELD_TYPE_INT64,
        'inventory_summary_by_warehouse' => self::FIELD_TYPE_JSON,
        'created_at' => self::FIELD_TYPE_TIMESTAMP,
        'updated_at' => self::FIELD_TYPE_TIMESTAMP,
        'article' => self::FIELD_TYPE_JSON,
        'warehouse' => self::FIELD_TYPE_JSON,
    ];

    protected bool $has_updated_at = false;
}
