<?php

namespace HaruyaNishikubo\Transporter\Models\Node\Entity\Logiless;

use HaruyaNishikubo\Transporter\Models\Node\Entity\Entity;

class TransactionLogEntity extends Entity
{
    protected string $table_name = 'transaction_log';

    protected array $fields = [
        'id' => self::FIELD_TYPE_INT64,
        'transaction_type' => self::FIELD_TYPE_STRING,
        'ordered' => self::FIELD_TYPE_INT64,
        'in_transit' => self::FIELD_TYPE_INT64,
        'transferring' => self::FIELD_TYPE_INT64,
        'received' => self::FIELD_TYPE_INT64,
        'allocated' => self::FIELD_TYPE_INT64,
        'available' => self::FIELD_TYPE_INT64,
        'moving' => self::FIELD_TYPE_INT64,
        'blocked' => self::FIELD_TYPE_INT64,
        'issued' => self::FIELD_TYPE_INT64,
        'shipped' => self::FIELD_TYPE_INT64,
        'article_type' => self::FIELD_TYPE_STRING,
        'multiplier' => self::FIELD_TYPE_INT64,
        'deadline' => self::FIELD_TYPE_DATE,
        'lot_number' => self::FIELD_TYPE_STRING,
        'is_force' => self::FIELD_TYPE_BOOLEAN,
        'source' => self::FIELD_TYPE_JSON,
        'remarks' => self::FIELD_TYPE_STRING,
        'logical_available' => self::FIELD_TYPE_INT64,
        'created_at' => self::FIELD_TYPE_TIMESTAMP,
        'updated_at' => self::FIELD_TYPE_TIMESTAMP,
        'article' => self::FIELD_TYPE_JSON,
        'location_from' => self::FIELD_TYPE_JSON,
        'location_to' => self::FIELD_TYPE_JSON,
        'logical_article' => self::FIELD_TYPE_JSON,
        'outbound_delivery' => self::FIELD_TYPE_JSON,
        'warehouse' => self::FIELD_TYPE_JSON,
    ];

    protected bool $has_updated_at = false;
}
