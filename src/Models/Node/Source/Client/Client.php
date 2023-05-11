<?php

namespace HaruyaNishikubo\Transporter\Models\Node\Source\Client;

abstract class Client
{
    abstract public function get(string $uri, array $query = []): array;
}
