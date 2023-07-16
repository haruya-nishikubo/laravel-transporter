<?php

namespace HaruyaNishikubo\Transporter\Models\Node\Entity\Shopify\Rest;

use HaruyaNishikubo\Transporter\Models\Node\Entity\Entity;

class RefundEntity extends Entity
{
    protected string $table_name = 'refunds';

    protected array $fields = [
        'id' => self::FIELD_TYPE_INT64,
        'order_id' => self::FIELD_TYPE_INT64,
        'created_at' => self::FIELD_TYPE_TIMESTAMP,
        'note' => self::FIELD_TYPE_STRING,
        'user_id' => self::FIELD_TYPE_INT64,
        'processed_at' => self::FIELD_TYPE_TIMESTAMP,
        'restock' => self::FIELD_TYPE_BOOLEAN,
        'admin_graphql_api_id' => self::FIELD_TYPE_STRING,
        'refund_line_items' => self::FIELD_TYPE_JSON,
        'transactions' => self::FIELD_TYPE_JSON,
        'order_adjustments' => self::FIELD_TYPE_JSON,
    ];
}
