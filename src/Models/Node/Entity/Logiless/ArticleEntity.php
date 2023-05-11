<?php

namespace HaruyaNishikubo\Transporter\Models\Node\Entity\Logiless;

use HaruyaNishikubo\Transporter\Models\Node\Entity\Entity;

class ArticleEntity extends Entity
{
    protected string $table_name = 'article';

    protected array $fields = [
        'id' => self::FIELD_TYPE_INT64,
        'code' => self::FIELD_TYPE_STRING,
        'identification_code' => self::FIELD_TYPE_STRING,
        'object_code' => self::FIELD_TYPE_STRING,
        'model_number' => self::FIELD_TYPE_STRING,
        'name' => self::FIELD_TYPE_STRING,
        'name_kana' => self::FIELD_TYPE_STRING,
        'article_type' => self::FIELD_TYPE_STRING,
        'price' => self::FIELD_TYPE_INT64,
        'tax_indicator' => self::FIELD_TYPE_STRING,
        'tax_rate' => self::FIELD_TYPE_INT64,
        'list_price' => self::FIELD_TYPE_INT64,
        'cost' => self::FIELD_TYPE_INT64,
        'color' => self::FIELD_TYPE_STRING,
        'color_code' => self::FIELD_TYPE_STRING,
        'size' => self::FIELD_TYPE_STRING,
        'size_code' => self::FIELD_TYPE_STRING,
        'temperature_control' => self::FIELD_TYPE_STRING,
        'width' => self::FIELD_TYPE_STRING,
        'height' => self::FIELD_TYPE_STRING,
        'depth' => self::FIELD_TYPE_STRING,
        'weight' => self::FIELD_TYPE_STRING,
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
        'attr11' => self::FIELD_TYPE_STRING,
        'attr12' => self::FIELD_TYPE_STRING,
        'attr13' => self::FIELD_TYPE_STRING,
        'attr14' => self::FIELD_TYPE_STRING,
        'attr15' => self::FIELD_TYPE_STRING,
        'attr16' => self::FIELD_TYPE_STRING,
        'attr17' => self::FIELD_TYPE_STRING,
        'attr18' => self::FIELD_TYPE_STRING,
        'attr19' => self::FIELD_TYPE_STRING,
        'attr20' => self::FIELD_TYPE_STRING,
        'comment' => self::FIELD_TYPE_STRING,
        'unit' => self::FIELD_TYPE_STRING,
        'delivery_category' => self::FIELD_TYPE_STRING,
        'default_delivery_method' => self::FIELD_TYPE_STRING,
        'size_coefficient' => self::FIELD_TYPE_STRING,
        'contents_description' => self::FIELD_TYPE_STRING,
        'label_text' => self::FIELD_TYPE_STRING,
        'limiting_sales' => self::FIELD_TYPE_INT64,
        'reorder_point' => self::FIELD_TYPE_STRING,
        'created_at' => self::FIELD_TYPE_TIMESTAMP,
        'updated_at' => self::FIELD_TYPE_TIMESTAMP,
        'supplier' => self::FIELD_TYPE_JSON,
        'components' => self::FIELD_TYPE_JSON,
    ];
}
