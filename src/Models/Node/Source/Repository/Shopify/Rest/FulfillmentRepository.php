<?php

namespace HaruyaNishikubo\Transporter\Models\Node\Source\Repository\Shopify\Rest;

use Carbon\Carbon;
use HaruyaNishikubo\Transporter\Models\Node\Collection\Shopify\Rest\FulfillmentCollection;
use HaruyaNishikubo\Transporter\Models\Node\Collection\Shopify\Rest\MetafieldCollection;

class FulfillmentRepository extends Repository
{
    protected int $order_id;

    public function listUrl(): string
    {
        return sprintf('/orders/%d/fulfillments.json', $this->order_id);
    }

    public function prepare(): static
    {
        // collection
        $this->collection = new FulfillmentCollection();

        return $this;
    }

    protected function rootKey(): string
    {
        return 'fulfillments';
    }

    public function setAttributes(array $attributes): static
    {
        $this->order_id = $attributes['order_id'];

        return $this;
    }
}
