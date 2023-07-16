<?php

namespace HaruyaNishikubo\Transporter\Models\Node\Entity\Shopify\Rest;

use HaruyaNishikubo\Transporter\Models\Node\Entity\Entity;

class InventoryItemEntity extends Entity
{
    protected string $table_name = 'variants';

    protected array $fields = [
        'id' => self::FIELD_TYPE_INT64,
        'sku' => self::FIELD_TYPE_STRING,
        'created_at' => self::FIELD_TYPE_TIMESTAMP,
        'updated_at' => self::FIELD_TYPE_TIMESTAMP,
        'requires_shipping' => self::FIELD_TYPE_BOOLEAN,
        'cost' => self::FIELD_TYPE_FLOAT64,
        'country_code_of_origin' => self::FIELD_TYPE_STRING,
        'province_code_of_origin' => self::FIELD_TYPE_STRING,
        'harmonized_system_code' => self::FIELD_TYPE_STRING,
        'tracked' => self::FIELD_TYPE_BOOLEAN,
        'country_harmonized_system_codes' => self::FIELD_TYPE_JSON,
        'admin_graphql_api_id' => self::FIELD_TYPE_STRING,
    ];
}
