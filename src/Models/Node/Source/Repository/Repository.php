<?php

namespace HaruyaNishikubo\Transporter\Models\Node\Source\Repository;

use HaruyaNishikubo\Transporter\Models\Node;
use HaruyaNishikubo\Transporter\Models\Node\Collection\Collection;
use HaruyaNishikubo\Transporter\Models\Node\Source\Client\Client;

abstract class Repository
{
    protected Node $node;
    protected Client $client;
    protected Collection $collection;
    protected string $start_cursor;
    protected string $end_cursor;
    protected array $query = [];
    protected array $logs = [];
    protected array $next_page_query = [];

    abstract public function __construct(Node $node);

    abstract public function listUrl(): string;

    abstract public function prepare(): static;

    abstract public function extract(): static;

    abstract protected function setNextPageQuery(): static;

    public function collection(): Collection
    {
        return $this->collection;
    }

    public function setStartCursor(string $start_cursor): static
    {
        $this->start_cursor = $start_cursor;

        return $this;
    }

    public function setEndCursor(string $end_cursor): static
    {
        $this->end_cursor = $end_cursor;

        return $this;
    }

    public function setAttributes(array $attributes): static
    {
        return $this;
    }

    public function query(): array
    {
        return $this->query;
    }

    protected function appendLogs(array $logs): static
    {
        $this->logs[] = $logs;

        return $this;
    }

    public function logs(): array
    {
        return $this->logs;
    }

    public function nextPageQuery(): array
    {
        return $this->next_page_query;
    }

    public function hasNextPage(): bool
    {
        return ! empty($this->next_page_query);
    }

    public function hasSubset(): bool
    {
        return false;
    }
}
