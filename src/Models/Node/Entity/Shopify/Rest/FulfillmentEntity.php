<?php

namespace HaruyaNishikubo\Transporter\Models\Node\Entity\Shopify\Rest;

use HaruyaNishikubo\Transporter\Models\Node\Entity\Entity;

class FulfillmentEntity extends Entity
{
    protected string $table_name = 'products';

    protected array $fields = [
        'id' => self::FIELD_TYPE_INT64,
        'order_id' => self::FIELD_TYPE_INT64,
        'status' => self::FIELD_TYPE_STRING,
        'created_at' => self::FIELD_TYPE_TIMESTAMP,
        'service' => self::FIELD_TYPE_STRING,
        'updated_at' => self::FIELD_TYPE_TIMESTAMP,
        'tracking_company' => self::FIELD_TYPE_STRING,
        'shipment_status' => self::FIELD_TYPE_STRING,
        'location_id' => self::FIELD_TYPE_INT64,
        'line_items' => self::FIELD_TYPE_JSON,
        'tracking_number' => self::FIELD_TYPE_STRING,
        'tracking_numbers' => self::FIELD_TYPE_JSON,
        'tracking_url' => self::FIELD_TYPE_STRING,
        'tracking_urls' => self::FIELD_TYPE_JSON,
        'receipt' => self::FIELD_TYPE_JSON,
        'name' => self::FIELD_TYPE_STRING,
        'admin_graphql_api_id' => self::FIELD_TYPE_STRING,
    ];
}
