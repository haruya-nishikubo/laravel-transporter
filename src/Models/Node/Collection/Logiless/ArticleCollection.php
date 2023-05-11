<?php

namespace HaruyaNishikubo\Transporter\Models\Node\Collection\Logiless;

use HaruyaNishikubo\Transporter\Models\Node\Collection\Collection;
use HaruyaNishikubo\Transporter\Models\Node\Entity\Entity;
use HaruyaNishikubo\Transporter\Models\Node\Entity\Logiless\ArticleEntity;

class ArticleCollection extends Collection
{
    public function newEntity(array $attributes): Entity
    {
        return new ArticleEntity($attributes);
    }
}
