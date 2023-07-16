<?php

namespace HaruyaNishikubo\Transporter\Models\Node\Entity\Shopify\Rest;

use HaruyaNishikubo\Transporter\Models\Node\Entity\Entity;

class TransactionEntity extends Entity
{
    protected string $table_name = 'refunds';

    protected array $fields = [
        'id' => self::FIELD_TYPE_INT64,
        'order_id' => self::FIELD_TYPE_INT64,
        'kind' => self::FIELD_TYPE_STRING,
        'gateway' => self::FIELD_TYPE_STRING,
        'status' => self::FIELD_TYPE_STRING,
        'message' => self::FIELD_TYPE_STRING,
        'created_at' => self::FIELD_TYPE_TIMESTAMP,
        'test' => self::FIELD_TYPE_BOOLEAN,
        'authorization' => self::FIELD_TYPE_STRING,
        'location_id' => self::FIELD_TYPE_INT64,
        'user_id' => self::FIELD_TYPE_INT64,
        'parent_id' => self::FIELD_TYPE_INT64,
        'processed_at' => self::FIELD_TYPE_TIMESTAMP,
        'device_id' => self::FIELD_TYPE_INT64,
        'error_code' => self::FIELD_TYPE_STRING,
        'source_name' => self::FIELD_TYPE_STRING,
        'receipt' => self::FIELD_TYPE_JSON,
        'currency_exchange_adjustment' => self::FIELD_TYPE_JSON,
        'amount' => self::FIELD_TYPE_FLOAT64,
        'currency' => self::FIELD_TYPE_STRING,
        'payment_id' => self::FIELD_TYPE_INT64,
        'total_unsettled_set' => self::FIELD_TYPE_JSON,
        'admin_graphql_api_id' => self::FIELD_TYPE_STRING,
    ];
}
