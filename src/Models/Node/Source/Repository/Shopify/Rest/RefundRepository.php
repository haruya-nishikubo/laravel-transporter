<?php

namespace HaruyaNishikubo\Transporter\Models\Node\Source\Repository\Shopify\Rest;

use HaruyaNishikubo\Transporter\Models\Node\Collection\Shopify\Rest\RefundCollection;
use HaruyaNishikubo\Transporter\Models\Node\Collection\Shopify\Rest\VariantCollection;

class RefundRepository extends Repository
{
    protected int $order_id;

    public function listUrl(): string
    {
        return sprintf('/orders/%d/refunds.json', $this->order_id);
    }

    public function prepare(): static
    {
        // collection
        $this->collection = new RefundCollection();

        return $this;
    }

    protected function rootKey(): string
    {
        return 'refunds';
    }

    public function setAttributes(array $attributes): static
    {
        $this->order_id = $attributes['order_id'];

        return $this;
    }
}
