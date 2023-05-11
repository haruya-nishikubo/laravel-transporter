<?php

namespace HaruyaNishikubo\Transporter\Models\Node\Entity\Logiless;

use HaruyaNishikubo\Transporter\Models\Node\Entity\Entity;

class SupplierEntity extends Entity
{
    protected string $table_name = 'supplier';

    protected array $fields = [
        'id' => self::FIELD_TYPE_INT64,
        'code' => self::FIELD_TYPE_STRING,
        'name' => self::FIELD_TYPE_STRING,
        'name_kana' => self::FIELD_TYPE_STRING,
        'post_code' => self::FIELD_TYPE_STRING,
        'prefecture' => self::FIELD_TYPE_STRING,
        'address1' => self::FIELD_TYPE_STRING,
        'address2' => self::FIELD_TYPE_STRING,
        'address3' => self::FIELD_TYPE_STRING,
        'phone' => self::FIELD_TYPE_STRING,
        'fax' => self::FIELD_TYPE_STRING,
        'email' => self::FIELD_TYPE_STRING,
        'representative' => self::FIELD_TYPE_STRING,
        'representative_kana' => self::FIELD_TYPE_STRING,
        'comment' => self::FIELD_TYPE_STRING,
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
        'keyword' => self::FIELD_TYPE_STRING,
        'created_at' => self::FIELD_TYPE_TIMESTAMP,
        'updated_at' => self::FIELD_TYPE_TIMESTAMP,
    ];
}
