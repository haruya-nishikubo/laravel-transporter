<?php

namespace HaruyaNishikubo\Transporter\Models\Node\Entity\Logiless;

use HaruyaNishikubo\Transporter\Models\Node\Entity\Entity;

class WarehouseEntity extends Entity
{
    protected string $table_name = 'warehouse';

    protected array $fields = [
        'id' => self::FIELD_TYPE_INT64,
        'name' => self::FIELD_TYPE_STRING,
    ];
}
