<?php

namespace HaruyaNishikubo\Transporter\Models\Node\Source\Client\Logiless;

use HaruyaNishikubo\Transporter\Models\Node\Source\Client\Client as BaseClient;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class Client extends BaseClient
{
    protected string $client_id;

    protected string $client_secret;

    protected string $redirect_uri;

    protected string $access_token;

    protected string $refresh_token;

    protected int $merchant_id;

    public function __construct(array $attributes = [])
    {
        $this->fill($attributes);
    }

    public function fill(array $attributes): self
    {
        if (isset($attributes['client_id'])) {
            $this->client_id = $attributes['client_id'];
        }

        if (isset($attributes['client_secret'])) {
            $this->client_secret = $attributes['client_secret'];
        }

        if (isset($attributes['redirect_uri'])) {
            $this->redirect_uri = $attributes['redirect_uri'];
        }

        if (isset($attributes['access_token'])) {
            $this->access_token = $attributes['access_token'];
        }

        if (isset($attributes['refresh_token'])) {
            $this->refresh_token = $attributes['refresh_token'];
        }

        if (isset($attributes['merchant_id'])) {
            $this->merchant_id = $attributes['merchant_id'];
        }

        return $this;
    }

    public function merchantId(): int
    {
        return $this->merchant_id;
    }

    public function authUrl(): string
    {
        return config('transporter.logiless.uri.oauth.auth') . '?' . http_build_query([
            'client_id' => $this->client_id,
            'response_type' => 'code',
            'redirect_uri' => $this->redirect_uri,
        ]);
    }

    public function tokenUrl(string $code): string
    {
        return config('transporter.logiless.uri.oauth.token') . '?' . http_build_query([
            'client_id' => $this->client_id,
            'client_secret' => $this->client_secret,
            'code' => $code,
            'grant_type' => 'authorization_code',
            'redirect_uri' => $this->redirect_uri,
        ]);
    }

    public function get(string $uri, array $query = []): array
    {
        $response = Http::withToken($this->access_token)
            ->retry(3, 100, function ($exception, $request) {
                return $exception instanceof ConnectionException;
            })->get($uri, $query);

        $body = $response->json();

        $this->setNextPageQuery($body);

        return $body;
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

    protected function setNextPageQuery(array $response): static
    {
        $next_page = $this->nextPage($response);
        if (! empty($next_page)) {
            $this->next_page_query = [
                'page' => $next_page,
            ];
        }

        return $this;
    }
}
