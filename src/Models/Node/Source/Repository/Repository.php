<?php

namespace HaruyaNishikubo\Transporter\Models\Node\Source\Repository;

use HaruyaNishikubo\Transporter\Models\Connector;
use HaruyaNishikubo\Transporter\Models\Node;
use HaruyaNishikubo\Transporter\Models\Node\Collection\Collection;
use HaruyaNishikubo\Transporter\Models\Node\Source\Client\Client;

abstract class Repository
{
    protected Connector $connector;
    protected Node $node;
    protected Client $client;
    protected Collection $collection;
    protected string $start_cursor;
    protected string $end_cursor;

    abstract public function __construct(Connector $connector, Node $node);

    abstract public function listUrl(): string;

    abstract public function prepare(): static;

    abstract public function extract(): static;

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
}
