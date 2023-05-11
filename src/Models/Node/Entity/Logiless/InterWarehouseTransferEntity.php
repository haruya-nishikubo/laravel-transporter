<?php

namespace HaruyaNishikubo\Transporter\Models\Node\Entity\Logiless;

use HaruyaNishikubo\Transporter\Models\Node\Entity\Entity;

class InterWarehouseTransferEntity extends Entity
{
    protected string $table_name = 'inter_warehouse_transfer';

    protected array $fields = [
        'id' => self::FIELD_TYPE_INT64,
        'code' => self::FIELD_TYPE_STRING,
        'status' => self::FIELD_TYPE_STRING,
        'delivery_status' => self::FIELD_TYPE_STRING,
        'delivery_method' => self::FIELD_TYPE_STRING,
        'delivery_preferred_date' => self::FIELD_TYPE_DATE,
        'delivery_preferred_time_zone' => self::FIELD_TYPE_STRING,
        'attr1' => self::FIELD_TYPE_STRING,
        'attr2' => self::FIELD_TYPE_STRING,
        'attr3' => self::FIELD_TYPE_STRING,
        'attr4' => self::FIELD_TYPE_STRING,
        'attr5' => self::FIELD_TYPE_STRING,
        'attr6' => self::FIELD_TYPE_STRING,
        'attr7' => self::FIELD_TYPE_STRING,
        'attr8' => self::FIELD_TYPE_STRING,
        'attr9' => self::FIELD_TYPE_STRING,
        'attr10' => self::FIELD_TYPE_STRING,
        'ordered_at' => self::FIELD_TYPE_TIMESTAMP,
        'finished_at' => self::FIELD_TYPE_TIMESTAMP,
        'created_at' => self::FIELD_TYPE_TIMESTAMP,
        'updated_at' => self::FIELD_TYPE_TIMESTAMP,
        'lines' => self::FIELD_TYPE_JSON,
        'warehouse' => self::FIELD_TYPE_JSON,
        'destination' => self::FIELD_TYPE_JSON,
    ];
}
