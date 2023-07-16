<?php

namespace HaruyaNishikubo\Transporter\Models\Node\Entity\Shopify\Rest;

use HaruyaNishikubo\Transporter\Models\Node\Entity\Entity;

class VariantEntity extends Entity
{
    protected string $table_name = 'variants';

    protected array $fields = [
        'id' => self::FIELD_TYPE_INT64,
        'product_id' => self::FIELD_TYPE_INT64,
        'title' => self::FIELD_TYPE_STRING,
        'price' => self::FIELD_TYPE_FLOAT64,
        'sku' => self::FIELD_TYPE_STRING,
        'position' => self::FIELD_TYPE_INT64,
        'inventory_policy' => self::FIELD_TYPE_STRING,
        'compare_at_price' => self::FIELD_TYPE_FLOAT64,
        'fulfillment_service' => self::FIELD_TYPE_STRING,
        'inventory_management' => self::FIELD_TYPE_STRING,
        'option1' => self::FIELD_TYPE_STRING,
        'option2' => self::FIELD_TYPE_STRING,
        'option3' => self::FIELD_TYPE_STRING,
        'created_at' => self::FIELD_TYPE_TIMESTAMP,
        'updated_at' => self::FIELD_TYPE_TIMESTAMP,
        'taxable' => self::FIELD_TYPE_BOOLEAN,
        'barcode' => self::FIELD_TYPE_STRING,
        'grams' => self::FIELD_TYPE_INT64,
        'image_id' => self::FIELD_TYPE_INT64,
        'weight' => self::FIELD_TYPE_FLOAT64,
        'weight_unit' => self::FIELD_TYPE_STRING,
        'inventory_item_id' => self::FIELD_TYPE_INT64,
        'inventory_quantity' => self::FIELD_TYPE_INT64,
        'old_inventory_quantity' => self::FIELD_TYPE_INT64,
        'presentment_prices' => self::FIELD_TYPE_JSON,
        'requires_shipping' => self::FIELD_TYPE_BOOLEAN,
        'admin_graphql_api_id' => self::FIELD_TYPE_STRING,
    ];
}
