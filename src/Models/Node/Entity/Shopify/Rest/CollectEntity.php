<?php

namespace HaruyaNishikubo\Transporter\Models\Node\Entity\Shopify\Rest;

use HaruyaNishikubo\Transporter\Models\Node\Entity\Entity;

class CollectEntity extends Entity
{
    protected string $table_name = 'collects';

    protected array $fields = [
        'id' => self::FIELD_TYPE_INT64,
        'collection_id' => self::FIELD_TYPE_INT64,
        'product_id' => self::FIELD_TYPE_INT64,
        'created_at' => self::FIELD_TYPE_TIMESTAMP,
        'updated_at' => self::FIELD_TYPE_TIMESTAMP,
        'position' => self::FIELD_TYPE_INT64,
        'sort_value' => self::FIELD_TYPE_STRING,
    ];
}
