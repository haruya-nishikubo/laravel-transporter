<?php

namespace HaruyaNishikubo\Transporter\Models\Node\Entity\Shopify\Rest;

use HaruyaNishikubo\Transporter\Models\Node\Entity\Entity;

class FulfillmentOrderEntity extends Entity
{
    protected string $table_name = 'products';

    protected array $fields = [
        'id' => self::FIELD_TYPE_INT64,
        'shop_id' => self::FIELD_TYPE_INT64,
        'order_id' => self::FIELD_TYPE_INT64,
        'assigned_location_id' => self::FIELD_TYPE_INT64,
        'request_status' => self::FIELD_TYPE_STRING,
        'status' => self::FIELD_TYPE_STRING,
        'supported_actions' => self::FIELD_TYPE_JSON,
        'destination' => self::FIELD_TYPE_JSON,
        'line_items' => self::FIELD_TYPE_JSON,
        'fulfillment_service_handle' => self::FIELD_TYPE_STRING,
        'assigned_location' => self::FIELD_TYPE_JSON,
        'merchant_requests' => self::FIELD_TYPE_JSON,
    ];
}
