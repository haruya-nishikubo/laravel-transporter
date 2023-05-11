<?php

namespace HaruyaNishikubo\Transporter\Models\Node\Collection\Logiless;

use HaruyaNishikubo\Transporter\Models\Node\Collection\Collection;
use HaruyaNishikubo\Transporter\Models\Node\Entity\Entity;
use HaruyaNishikubo\Transporter\Models\Node\Entity\Logiless\TransactionLogEntity;

class TransactionLogCollection extends Collection
{
    public function newEntity(array $attributes): Entity
    {
        return new TransactionLogEntity($attributes);
    }
}
