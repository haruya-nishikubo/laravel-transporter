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

        $this->setNextQueries($response);

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

        return $response[$this->rootKey()];
    }

    protected function nextSinceId(array $response): ?int
    {
        if (count($response) < self::LIMIT) {
            return null;
        }

        return array_reduce($response, fn($carry, $item) => max($item['id'], $carry), 0);
    }

    protected function setNextQueries(array $response): static
    {
        $since_id = $this->nextSinceId($response);
        if (empty($since_id)) {
            return $this;
        }

        $this->next_queries = array_merge($this->query, [
            'since_id' => $since_id,
        ]);

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
