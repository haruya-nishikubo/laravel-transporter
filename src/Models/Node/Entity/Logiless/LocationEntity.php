<?php

namespace HaruyaNishikubo\Transporter\Models\Node\Entity\Logiless;

use HaruyaNishikubo\Transporter\Models\Node\Entity\Entity;

class LocationEntity extends Entity
{
    protected string $table_name = 'location';

    protected array $fields = [
        'id' => self::FIELD_TYPE_INT64,
        'code' => self::FIELD_TYPE_STRING,
        'name' => self::FIELD_TYPE_STRING,
    ];
}
