<?php

namespace HaruyaNishikubo\Transporter\Models\Node\Source\Client\Shopify\Rest;

use HaruyaNishikubo\Transporter\Models\Node\Source\Client\Client as BaseClient;
use Shopify\Auth\FileSessionStorage;
use Shopify\Clients\PageInfo;
use Shopify\Clients\Rest;
use Shopify\Context;

class Client extends BaseClient
{
    protected string $api_key;
    protected string $api_secret_key;
    protected string $scope;
    protected string $host_name;
    protected string $api_version;
    protected string $api_access_token;

    protected Rest $client;

    public function __construct(array $attributes = [])
    {
        $this->fill($attributes)
            ->initializeClient();
    }

    public function fill(array $attributes): static
    {
        if (isset($attributes['api_key'])) {
            $this->api_key = $attributes['api_key'];
        }

        if (isset($attributes['api_secret_key'])) {
            $this->api_secret_key = $attributes['api_secret_key'];
        }

        if (isset($attributes['scope'])) {
            $this->scope = $attributes['scope'];
        }

        if (isset($attributes['host_name'])) {
            $this->host_name = $attributes['host_name'];
        }

        if (isset($attributes['api_version'])) {
            $this->api_version = $attributes['api_version'];
        }

        if (isset($attributes['api_access_token'])) {
            $this->api_access_token = $attributes['api_access_token'];
        }

        return $this;
    }

    protected function initializeClient(): static
    {
        Context::initialize(
            $this->api_key,
            $this->api_secret_key,
            $this->scope,
            $this->host_name,
            new FileSessionStorage(),
            $this->api_version,
            false
        );

        $this->client = new Rest($this->host_name, $this->api_access_token);

        return $this;
    }

    public function get(string $uri, array $query = []): array
    {
        $response = $this->client
            ->get($uri, [], $query);

        $this->setNextPageQuery($response->getPageInfo());

        return $response->getDecodedBody();
    }

    protected function setNextPageQuery(?PageInfo $page_info): static
    {
        if (! empty($page_info)) {
            $this->next_page_query = $page_info->getNextPageQuery();
        }

        return $this;
    }
}
