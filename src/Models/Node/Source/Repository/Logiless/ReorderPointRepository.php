<?php

namespace HaruyaNishikubo\Transporter\Models\Node\Source\Repository\Logiless;

use HaruyaNishikubo\Transporter\Models\Node\Collection\Logiless\ReorderPointCollection;

class ReorderPointRepository extends Repository
{
    public function listUrl(): string
    {
        return sprintf(config('transporter.logiless.uri.reorder_point.list'), $this->client->merchantId());
    }

    public function prepare(): static
    {
        // collection
        $this->collection = new ReorderPointCollection();

        return $this;
    }
}
