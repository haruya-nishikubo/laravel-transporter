<?php

namespace HaruyaNishikubo\Transporter\Models\Node\Source\Repository\Shopify\Rest;

use HaruyaNishikubo\Transporter\Models\Node\Collection\Shopify\Rest\MetafieldCollection;

class MetafieldRepository extends Repository
{
    protected string $owner_resource;
    protected int $owner_id;

    public function listUrl(): string
    {
        return sprintf('/%s/%d/metafields.json', $this->owner_resource, $this->owner_id);
    }

    public function prepare(): static
    {
        // collection
        $this->collection = new MetafieldCollection();

        return $this;
    }

    protected function rootKey(): string
    {
        return 'metafields';
    }

    public function setAttributes(array $attributes): static
    {
        $this->owner_resource = $attributes['owner_resource'];
        $this->owner_id = $attributes['owner_id'];

        return $this;
    }
}
