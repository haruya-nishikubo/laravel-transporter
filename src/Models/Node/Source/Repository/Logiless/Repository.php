<?php

namespace HaruyaNishikubo\Transporter\Models\Node\Source\Repository\Logiless;

use HaruyaNishikubo\Transporter\Models\Node;
use HaruyaNishikubo\Transporter\Models\Node\Source\Client\Logiless\Client;
use HaruyaNishikubo\Transporter\Models\Node\Source\Repository\Repository as BaseRepository;

abstract class Repository extends BaseRepository
{
    protected const LIMIT = 100;

    protected array $query = [
        'page' => 1,
        'limit' => self::LIMIT,
    ];

    public function __construct(Node $node)
    {
        $this->node = $node;

        $this->client = new Client([
            'client_id' => $node->secret['client_id'],
            'client_secret' => $node->secret['client_secret'],
            'redirect_uri' => $node->secret['redirect_uri'],
            'access_token' => $node->secret['oauth']['access_token'],
            'refresh_token' => $node->secret['oauth']['refresh_token'],
            'merchant_id' => $node->secret['merchant_id'],
        ]);
    }

    public function extract(): static
    {
        $response = $this->getList();

        $this->collection = $this->collection
            ->merge($response['data']);

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

        $this->setNextPageQuery();

        return $this->client
            ->get($this->listUrl(), $this->query);
    }

    protected function setNextPageQuery(): static
    {
        if ($this->client->hasNextPage()) {
            $this->next_page_query = array_merge($this->query, $this->client->nextPageQuery());
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
