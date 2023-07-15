<?php

namespace HaruyaNishikubo\Transporter\Models\Node\Entity\Shopify\Rest;

use HaruyaNishikubo\Transporter\Models\Node\Entity\Entity;

class MetafieldEntity extends Entity
{
    protected string $table_name = 'metafields';

    protected array $fields = [
        'id' => self::FIELD_TYPE_INT64,
        'namespace' => self::FIELD_TYPE_STRING,
        'key' => self::FIELD_TYPE_STRING,
        'value' => self::FIELD_TYPE_STRING,
        'description' => self::FIELD_TYPE_STRING,
        'owner_id' => self::FIELD_TYPE_INT64,
        'created_at' => self::FIELD_TYPE_TIMESTAMP,
        'updated_at' => self::FIELD_TYPE_TIMESTAMP,
        'owner_resource' => self::FIELD_TYPE_STRING,
        'type' => self::FIELD_TYPE_STRING,
        'admin_graphql_api_id' => self::FIELD_TYPE_STRING,
    ];
}
