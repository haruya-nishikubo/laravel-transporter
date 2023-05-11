<?php

namespace HaruyaNishikubo\Transporter\Models\Node\Entity\Shopify\Rest;

use HaruyaNishikubo\Transporter\Models\Node\Entity\Entity;

class CustomerEntity extends Entity
{
    protected string $table_name = 'customers';

    protected array $fields = [
        'id' => self::FIELD_TYPE_INT64,
        'email' => self::FIELD_TYPE_STRING,
        'accepts_marketing' => self::FIELD_TYPE_BOOLEAN,
        'created_at' => self::FIELD_TYPE_TIMESTAMP,
        'updated_at' => self::FIELD_TYPE_TIMESTAMP,
        'first_name' => self::FIELD_TYPE_STRING,
        'last_name' => self::FIELD_TYPE_STRING,
        'orders_count' => self::FIELD_TYPE_INT64,
        'state' => self::FIELD_TYPE_STRING,
        'total_spent' => self::FIELD_TYPE_FLOAT64,
        'last_order_id' => self::FIELD_TYPE_INT64,
        'note' => self::FIELD_TYPE_STRING,
        'verified_email' => self::FIELD_TYPE_BOOLEAN,
        'multipass_identifier' => self::FIELD_TYPE_STRING,
        'tax_exempt' => self::FIELD_TYPE_BOOLEAN,
        'tags' => self::FIELD_TYPE_STRING,
        'last_order_name' => self::FIELD_TYPE_STRING,
        'currency' => self::FIELD_TYPE_STRING,
        'phone' => self::FIELD_TYPE_STRING,
        'addresses' => self::FIELD_TYPE_JSON,
        'accepts_marketing_updated_at' => self::FIELD_TYPE_TIMESTAMP,
        'marketing_opt_in_level' => self::FIELD_TYPE_STRING,
        'tax_exemptions' => self::FIELD_TYPE_JSON,
        'admin_graphql_api_id' => self::FIELD_TYPE_STRING,
        'default_address' => self::FIELD_TYPE_JSON,
    ];
}
