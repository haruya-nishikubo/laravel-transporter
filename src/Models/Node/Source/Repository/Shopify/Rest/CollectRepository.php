<?php

namespace HaruyaNishikubo\Transporter\Models\Node\Source\Repository\Shopify\Rest;

use HaruyaNishikubo\Transporter\Models\Node\Collection\Shopify\Rest\CollectCollection;

class CollectRepository extends Repository
{
    public function listUrl(): string
    {
        return '/collects.json';
    }

    public function prepare(): static
    {
        // collection
        $this->collection = new CollectCollection();

        return $this;
    }

    protected function rootKey(): string
    {
        return 'collects';
    }

    public function hasSubset(): bool
    {
        return true;
    }
}
