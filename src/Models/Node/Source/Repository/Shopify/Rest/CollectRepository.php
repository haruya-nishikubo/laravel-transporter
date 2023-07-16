<?php

namespace HaruyaNishikubo\Transporter\Models\Node\Source\Repository\Shopify\Rest;

use HaruyaNishikubo\Transporter\Models\Node\Collection\Shopify\Rest\CollectCollection;

class CollectRepository extends Repository
{
    protected int $product_id;

    public function listUrl(): string
    {
        return sprintf('/collects.json?product_id=%d', $this->product_id);
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

    public function setAttributes(array $attributes): static
    {
        $this->product_id = $attributes['product_id'];

        return $this;
    }
}
