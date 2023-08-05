<?php

namespace HaruyaNishikubo\Transporter\Models\Node\Source\Repository\Shopify\Rest;

use HaruyaNishikubo\Transporter\Models\Node\Collection\Shopify\Rest\InventoryItemCollection;

class InventoryItemRepository extends Repository
{
    protected int $inventory_item_id;

    public function listUrl(): string
    {
        return sprintf('/inventory_items.json?ids=%d', $this->inventory_item_id);
    }

    public function prepare(): static
    {
        // collection
        $this->collection = new InventoryItemCollection();

        return $this;
    }

    protected function rootKey(): string
    {
        return 'inventory_items';
    }

    public function setAttributes(array $attributes): static
    {
        $this->inventory_item_id = $attributes['inventory_item_id'];

        return $this;
    }
}
