<?php

namespace HaruyaNishikubo\Transporter\Models\Node\Source\Client;

abstract class Client
{
    protected array $next_page_query = [];

    abstract public function get(string $uri, array $query = []): array;

    public function hasNextPage(): bool
    {
        return ! empty($this->next_page_query);
    }

    public function nextPageQuery(): array
    {
        return $this->next_page_query;
    }
}
