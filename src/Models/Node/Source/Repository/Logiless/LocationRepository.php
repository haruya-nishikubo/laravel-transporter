<?php

namespace HaruyaNishikubo\Transporter\Models\Node\Source\Repository\Logiless;

class LocationRepository extends Repository
{
    protected int $warehouse_id;

    public function listUrl(): string
    {
        return sprintf(config('transporter.logiless.uri.location.list'), $this->client->merchantId(), $this->warehouse_id);
    }

    public function setWarehouseId(int $warehouse_id): self
    {
        $this->warehouse_id = $warehouse_id;

        return $this;
    }
}
