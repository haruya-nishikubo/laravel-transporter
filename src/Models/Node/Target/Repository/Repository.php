<?php

namespace HaruyaNishikubo\Transporter\Models\Node\Target\Repository;

use HaruyaNishikubo\Transporter\Models\Node;
use HaruyaNishikubo\Transporter\Models\Node\Collection\Collection;
use HaruyaNishikubo\Transporter\Models\Node\Target\Client\Client;

abstract class Repository
{
    protected Node $node;
    protected Client $client;
    protected Collection $collection;
    protected array $logs = [];

    abstract public function __construct(Node $node, Collection $collection);

    abstract public function load(): self;

    protected function appendLogs(array $logs): static
    {
        $this->logs[] = $logs;

        return $this;
    }

    public function logs(): array
    {
        return $this->logs;
    }
}
