<?php

namespace HaruyaNishikubo\Transporter\Models\Node\Entity\Shopify\Rest;

use HaruyaNishikubo\Transporter\Models\Node\Entity\Entity;

class CollectionEntity extends Entity
{
    protected string $table_name = 'collections';

    protected array $fields = [
        'id' => self::FIELD_TYPE_INT64,
        'body_html' => self::FIELD_TYPE_STRING,
        'handle' => self::FIELD_TYPE_STRING,
        'image' => self::FIELD_TYPE_JSON,
        'published_at' => self::FIELD_TYPE_TIMESTAMP,
        'published_scope' => self::FIELD_TYPE_STRING,
        'sort_order' => self::FIELD_TYPE_STRING,
        'template_suffix' => self::FIELD_TYPE_STRING,
        'title' => self::FIELD_TYPE_STRING,
        'updated_at' => self::FIELD_TYPE_TIMESTAMP,
    ];
}
