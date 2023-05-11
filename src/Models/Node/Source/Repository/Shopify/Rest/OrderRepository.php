<?php

namespace HaruyaNishikubo\Transporter\Models\Node\Source\Repository\Shopify\Rest;

use Carbon\Carbon;
use HaruyaNishikubo\Transporter\Models\Node\Collection\Shopify\Rest\OrderCollection;

class OrderRepository extends Repository
{
    public function listUrl(): string
    {
        return '/orders.json';
    }

    public function prepare(): static
    {
        // collection
        $this->collection = new OrderCollection();

        // query
        if (! empty($this->start_cursor)) {
            $this->query['updated_at_min'] = Carbon::parse($this->start_cursor)
                ->toDateTimeString();
        }

        if (! empty($this->end_cursor)) {
            $this->query['updated_at_max'] = Carbon::parse($this->end_cursor)
                ->toDateTimeString();
        }

        return $this;
    }

    protected function rootKey(): string
    {
        return 'orders';
    }
}
