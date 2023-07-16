<?php

namespace HaruyaNishikubo\Transporter\Models\Node\Collection\Shopify\Rest;

use HaruyaNishikubo\Transporter\Models\Node\Collection\Collection;
use HaruyaNishikubo\Transporter\Models\Node\Entity\Entity;
use HaruyaNishikubo\Transporter\Models\Node\Entity\Shopify\Rest\CollectionEntity;

class CollectionCollection extends Collection
{
    public function newEntity(array $attributes): Entity
    {
        return new CollectionEntity($attributes);
    }
}
