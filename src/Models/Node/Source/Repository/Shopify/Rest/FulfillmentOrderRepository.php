<?php

namespace HaruyaNishikubo\Transporter\Models\Node\Source\Repository\Shopify\Rest;

use HaruyaNishikubo\Transporter\Models\Node\Collection\Shopify\Rest\FulfillmentOrderCollection;

class FulfillmentOrderRepository extends Repository
{
    protected int $order_id;

    public function listUrl(): string
    {
        return sprintf('/orders/%d/fulfillment_orders.json', $this->order_id);
    }

    public function prepare(): static
    {
        // collection
        $this->collection = new FulfillmentOrderCollection();

        return $this;
    }

    protected function rootKey(): string
    {
        return 'fulfillment_orders';
    }

    public function setAttributes(array $attributes): static
    {
        $this->order_id = $attributes['order_id'];

        return $this;
    }
}
