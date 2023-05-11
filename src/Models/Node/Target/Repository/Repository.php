<?php

namespace HaruyaNishikubo\Transporter\Models\Node\Target\Repository;

use HaruyaNishikubo\Transporter\Models\Connector;
use HaruyaNishikubo\Transporter\Models\Node;
use HaruyaNishikubo\Transporter\Models\Node\Collection\Collection;
use HaruyaNishikubo\Transporter\Models\Node\Target\Client\Client;

abstract class Repository
{
    protected Connector $connector;
    protected Node $node;
    protected Client $client;
    protected Collection $collection;

    abstract public function __construct(Connector $connector, Node $node, Collection $collection);

    abstract public function load(): self;
}
