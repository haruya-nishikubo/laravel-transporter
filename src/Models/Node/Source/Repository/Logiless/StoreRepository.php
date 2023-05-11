<?php

namespace HaruyaNishikubo\Transporter\Models\Node\Source\Repository\Logiless;

use HaruyaNishikubo\Transporter\Models\Node\Collection\Logiless\StoreCollection;

class StoreRepository extends Repository
{
    public function listUrl(): string
    {
        return sprintf(config('transporter.logiless.uri.store.list'), $this->client->merchantId());
    }

    public function prepare(): static
    {
        // collection
        $this->collection = new StoreCollection();

        return $this;
    }
}
