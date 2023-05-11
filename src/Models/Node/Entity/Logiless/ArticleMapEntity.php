<?php

namespace HaruyaNishikubo\Transporter\Models\Node\Entity\Logiless;

use HaruyaNishikubo\Transporter\Models\Node\Entity\Entity;

class ArticleMapEntity extends Entity
{
    protected string $table_name = 'article_map';

    protected array $fields = [
        'id' => self::FIELD_TYPE_INT64,
        'mapped_code' => self::FIELD_TYPE_STRING,
        'mapped_choice1' => self::FIELD_TYPE_STRING,
        'mapped_choice2' => self::FIELD_TYPE_STRING,
        'mapped_choice3' => self::FIELD_TYPE_STRING,
        'attr1' => self::FIELD_TYPE_STRING,
        'article_option' => self::FIELD_TYPE_STRING,
        'cached_stock_quantity' => self::FIELD_TYPE_INT64,
        'standby_stock_quantity' => self::FIELD_TYPE_INT64,
        'stock_allocation_rate' => self::FIELD_TYPE_INT64,
        'max_stock_quantity' => self::FIELD_TYPE_INT64,
        'min_stock_quantity' => self::FIELD_TYPE_INT64,
        'available_stock_quantity' => self::FIELD_TYPE_INT64,
        'is_inventory_synced' => self::FIELD_TYPE_BOOLEAN,
        'is_automatic_inventory_sync_enables' => self::FIELD_TYPE_BOOLEAN,
        'created_at' => self::FIELD_TYPE_TIMESTAMP,
        'updated_at' => self::FIELD_TYPE_TIMESTAMP,
        'article' => self::FIELD_TYPE_JSON,
        'store' => self::FIELD_TYPE_JSON,
    ];
}
