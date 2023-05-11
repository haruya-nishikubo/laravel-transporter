<?php

namespace HaruyaNishikubo\Transporter\Models\Node\Entity\Logiless;

use HaruyaNishikubo\Transporter\Models\Node\Entity\Entity;

class DailyInventorySummaryEntity extends Entity
{
    protected string $table_name = 'daily_inventory_summary';

    protected array $fields = [
        'id' => self::FIELD_TYPE_INT64,
        'date' => self::FIELD_TYPE_DATE,
        'layer' => self::FIELD_TYPE_STRING,
        'received' => self::FIELD_TYPE_INT64,
        'available' => self::FIELD_TYPE_INT64,
        'blocked' => self::FIELD_TYPE_INT64,
        'allocated' => self::FIELD_TYPE_INT64,
        'created_at' => self::FIELD_TYPE_TIMESTAMP,
        'updated_at' => self::FIELD_TYPE_TIMESTAMP,
        'article' => self::FIELD_TYPE_JSON,
        'warehouse' => self::FIELD_TYPE_JSON,
    ];

    protected bool $has_updated_at = false;
}
