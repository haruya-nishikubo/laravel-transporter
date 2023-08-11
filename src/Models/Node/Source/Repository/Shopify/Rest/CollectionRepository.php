<?php

namespace HaruyaNishikubo\Transporter\Models\Node\Source\Repository\Shopify\Rest;

use HaruyaNishikubo\Transporter\Models\Node\Collection\Shopify\Rest\CollectionCollection;

class CollectionRepository extends Repository
{
    protected int $collection_id;

    public function listUrl(): string
    {
        return sprintf('/collections/%d.json', $this->collection_id);
    }

    public function prepare(): static
    {
        // collection
        $this->collection = new CollectionCollection();

        return $this;
    }

    protected function rootKey(): string
    {
        return 'collection';
    }

    public function setAttributes(array $attributes): static
    {
        parent::setAttributes($attributes);

        $this->collection_id = $attributes['collection_id'];

        return $this;
    }

    public function extract(): static
    {
        $response = $this->getList();

        $this->collection = $this->collection
            ->merge([
                $response,
            ]);

        return $this;
    }
}
