<?php

namespace HaruyaNishikubo\Transporter\Models\Node\Source\Repository\Logiless;

use HaruyaNishikubo\Transporter\Models\Node\Collection\Logiless\WarehouseCollection;

class WarehouseRepository extends Repository
{
    public function listUrl(): string
    {
        return sprintf(config('transporter.logiless.uri.warehouse.list'), $this->client->merchantId());
    }

    public function prepare(): static
    {
        // collection
        $this->collection = new WarehouseCollection();

        return $this;
    }
}
