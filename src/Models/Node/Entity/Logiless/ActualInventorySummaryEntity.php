<?php

namespace HaruyaNishikubo\Transporter\Models\Node\Entity\Logiless;

use HaruyaNishikubo\Transporter\Models\Node\Entity\Entity;

class ActualInventorySummaryEntity extends Entity
{
    protected string $table_name = 'actual_inventory_summary';

    protected array $fields = [
        'id' => self::FIELD_TYPE_INT64,
        'layer' => self::FIELD_TYPE_STRING,
        'deadline' => self::FIELD_TYPE_DATE,
        'lot_number' => self::FIELD_TYPE_STRING,
        'received' => self::FIELD_TYPE_INT64,
        'available' => self::FIELD_TYPE_INT64,
        'blocked' => self::FIELD_TYPE_INT64,
        'allocated' => self::FIELD_TYPE_INT64,
        'shipped' => self::FIELD_TYPE_INT64,
        'issued' => self::FIELD_TYPE_INT64,
        'actual_unit' => self::FIELD_TYPE_STRING,
        'logical_unit' => self::FIELD_TYPE_STRING,
        'created_at' => self::FIELD_TYPE_TIMESTAMP,
        'updated_at' => self::FIELD_TYPE_TIMESTAMP,
        'logical_article_id' => self::FIELD_TYPE_INT64,
        'article' => self::FIELD_TYPE_JSON,
        'location' => self::FIELD_TYPE_JSON,
        'warehouse' => self::FIELD_TYPE_JSON,
    ];
}
