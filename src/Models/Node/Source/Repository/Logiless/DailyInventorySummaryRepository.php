<?php

namespace HaruyaNishikubo\Transporter\Models\Node\Source\Repository\Logiless;

use Carbon\Carbon;
use HaruyaNishikubo\Transporter\Models\Node\Collection\Logiless\DailyInventorySummaryCollection;

class DailyInventorySummaryRepository extends Repository
{
    public function listUrl(): string
    {
        return sprintf(config('transporter.logiless.uri.daily_inventory_summary.list'), $this->client->merchantId());
    }

    public function prepare(): static
    {
        // collection
        $this->collection = new DailyInventorySummaryCollection();

        // query
        if (! empty($this->start_cursor)) {
            $this->query['date'] = Carbon::parse($this->start_cursor)
                ->toDateString();
        }

        return $this;
    }
}
