<?php

namespace HaruyaNishikubo\Transporter\Models\Node\Source\Repository\Shopify\Rest;

use HaruyaNishikubo\Transporter\Models\Node\Collection\Shopify\Rest\VariantCollection;

class VariantRepository extends Repository
{
    protected int $product_id;

    public function listUrl(): string
    {
        return sprintf('/products/%d/variants.json', $this->product_id);
    }

    public function prepare(): static
    {
        // collection
        $this->collection = new VariantCollection();

        return $this;
    }

    protected function rootKey(): string
    {
        return 'variants';
    }

    public function setAttributes(array $attributes): static
    {
        parent::setAttributes($attributes);

        $this->product_id = $attributes['product_id'];

        return $this;
    }
}
