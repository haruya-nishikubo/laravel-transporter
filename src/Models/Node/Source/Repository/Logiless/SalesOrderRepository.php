<?php

namespace HaruyaNishikubo\Transporter\Models\Node\Source\Repository\Logiless;

use Carbon\Carbon;
use HaruyaNishikubo\Transporter\Models\Node\Collection\Logiless\SalesOrderCollection;

class SalesOrderRepository extends Repository
{
    public function listUrl(): string
    {
        return sprintf(config('transporter.logiless.uri.sales_order.list'), $this->client->merchantId());
    }

    public function prepare(): static
    {
        // collection
        $this->collection = new SalesOrderCollection();

        // query
        if (! empty($this->start_cursor)) {
            $this->query['updated_at_from'] = Carbon::parse($this->start_cursor)
                ->toDateTimeString();
        }

        if (! empty($this->end_cursor)) {
            $this->query['updated_at_to'] = Carbon::parse($this->end_cursor)
                ->toDateTimeString();
        }

        return $this;
    }
}
