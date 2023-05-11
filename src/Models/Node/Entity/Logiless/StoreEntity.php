<?php

namespace HaruyaNishikubo\Transporter\Models\Node\Entity\Logiless;

use HaruyaNishikubo\Transporter\Models\Node\Entity\Entity;

class StoreEntity extends Entity
{
    protected string $table_name = 'store';

    protected array $fields = [
        'id' => self::FIELD_TYPE_INT64,
        'name' => self::FIELD_TYPE_STRING,
    ];

    protected bool $has_updated_at = false;
}
