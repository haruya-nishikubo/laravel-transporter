<?php

namespace HaruyaNishikubo\Transporter\Models\Node\Collection;

use HaruyaNishikubo\Transporter\Models\Node\Entity\Entity;
use Illuminate\Support\Collection as BaseCollection;

abstract class Collection extends BaseCollection
{
    abstract public function newEntity(array $attributes): Entity;

    public function toJsonl(): string
    {
        return $this->map(function ($item) {
            return $this->newEntity($item)->toJson();
        })->implode("\n");
    }
}
