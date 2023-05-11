<?php

namespace HaruyaNishikubo\Transporter\Models\Node\Entity\Shopify\Rest;

use HaruyaNishikubo\Transporter\Models\Node\Entity\Entity;

class ProductEntity extends Entity
{
    protected string $table_name = 'products';

    protected array $fields = [
        'id' => self::FIELD_TYPE_INT64,
        'title' => self::FIELD_TYPE_STRING,
        'body_html' => self::FIELD_TYPE_STRING,
        'vendor' => self::FIELD_TYPE_STRING,
        'product_type' => self::FIELD_TYPE_STRING,
        'created_at' => self::FIELD_TYPE_TIMESTAMP,
        'handle' => self::FIELD_TYPE_STRING,
        'updated_at' => self::FIELD_TYPE_TIMESTAMP,
        'published_at' => self::FIELD_TYPE_TIMESTAMP,
        'template_suffix' => self::FIELD_TYPE_STRING,
        'published_scope' => self::FIELD_TYPE_STRING,
        'tags' => self::FIELD_TYPE_STRING,
        'admin_graphql_api_id' => self::FIELD_TYPE_STRING,
        'variants' => self::FIELD_TYPE_JSON,
        'options' => self::FIELD_TYPE_JSON,
        'images' => self::FIELD_TYPE_JSON,
        'image' => self::FIELD_TYPE_JSON,
    ];
}
