<?php

namespace HaruyaNishikubo\Transporter\Models\Node\Source\Repository\Shopify\Rest;

use HaruyaNishikubo\Transporter\Models\Node;
use HaruyaNishikubo\Transporter\Models\Node\Source\Client\Shopify\Rest\Client;
use HaruyaNishikubo\Transporter\Models\Node\Source\Repository\Repository as BaseRepository;

abstract class Repository extends BaseRepository
{
    protected const LIMIT = 250;

    protected array $query = [
        'limit' => self::LIMIT,
    ];

    abstract protected function rootKey(): string;

    public function __construct(Node $node)
    {
        $this->node = $node;

        $this->client = new Client([
            'api_key' => $this->node->secret['api_key'],
            'api_secret_key' => $this->node->secret['api_secret_key'],
            'scope' => $this->node->secret['scope'],
            'host_name' => $this->node->secret['host_name'],
            'api_version' => $this->node->secret['api_version'],
            'api_access_token' => $this->node->secret['api_access_token'],
        ]);
    }

    public function extract(): static
    {
        $response = $this->getList();

        $this->collection = $this->collection
            ->merge($response);

        return $this;
    }

    protected function getList(): array
    {
        $this->appendLogs([
            'label' => __FUNCTION__,
            'message' => [
                'uri' => $this->listUrl(),
                'query' => $this->query,
            ],
        ]);

        $response = $this->client
            ->get($this->listUrl(), $this->query);

        $this->setNextPageQuery();

        return $response[$this->rootKey()];
    }

    protected function setNextPageQuery(): static
    {
        if ($this->client->hasNextPage()) {
            $this->next_page_query = $this->client->nextPageQuery();
        }

        return $this;
    }

    public function setAttributes(array $attributes): static
    {
        parent::setAttributes($attributes);

        if (isset($attributes['query'])) {
            $this->query = array_merge($this->query, $attributes['query']);
        }

        return $this;
    }
}
