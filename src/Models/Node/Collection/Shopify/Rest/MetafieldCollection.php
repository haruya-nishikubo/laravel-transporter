<?php

namespace HaruyaNishikubo\Transporter\Models\Node\Collection\Shopify\Rest;

use HaruyaNishikubo\Transporter\Models\Node\Collection\Collection;
use HaruyaNishikubo\Transporter\Models\Node\Entity\Entity;
use HaruyaNishikubo\Transporter\Models\Node\Entity\Shopify\Rest\MetafieldEntity;
use HaruyaNishikubo\Transporter\Models\Node\Entity\Shopify\Rest\ProductEntity;

class MetafieldCollection extends Collection
{
    public function newEntity(array $attributes): Entity
    {
        return new MetafieldEntity($attributes);
    }
}
