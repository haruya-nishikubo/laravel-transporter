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

        return $this->client
            ->get($this->listUrl(), $this->query);
    }

    protected function nextPage(array $response): ?int
    {
        if ($response['total_count'] <= $response['limit']) {
            return null;
        }

        $last_page = (int) ceil($response['total_count'] / $response['limit']);
        if ($last_page == $response['current_page']) {
            return null;
        }

        return $response['current_page'] + 1;
    }

    protected function setNextQueries(array $response): static
    {
        $next_page = $this->nextPage($response);
        if (empty($next_page)) {
            return $this;
        }

        $this->next_queries = array_merge($this->query, [
            'page' => $next_page,
        ]);

        return $this;
    }
}
