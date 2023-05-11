<?php

namespace HaruyaNishikubo\Transporter\Models\Node\Source\Repository\Logiless;

use Carbon\Carbon;
use HaruyaNishikubo\Transporter\Models\Node\Collection\Logiless\ActualInventorySummaryCollection;

class ActualInventorySummaryRepository extends Repository
{
    public function listUrl(): string
    {
        return sprintf(config('transporter.logiless.uri.actual_inventory_summary.list'), $this->client->merchantId());
    }

    public function prepare(): static
    {
        // collection
        $this->collection = new ActualInventorySummaryCollection();

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
