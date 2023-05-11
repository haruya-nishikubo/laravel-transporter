<?php

namespace HaruyaNishikubo\Transporter\Models\Node\Entity\Logiless;

use HaruyaNishikubo\Transporter\Models\Node\Entity\Entity;

class OutboundDeliveryEntity extends Entity
{
    protected string $table_name = 'outbound_delivery';

    protected array $fields = [
        'id' => self::FIELD_TYPE_INT64,
        'code' => self::FIELD_TYPE_STRING,
        'document_status' => self::FIELD_TYPE_STRING,
        'allocation_status' => self::FIELD_TYPE_STRING,
        'delivery_status' => self::FIELD_TYPE_STRING,
        'shipper_name1' => self::FIELD_TYPE_STRING,
        'shipper_name2' => self::FIELD_TYPE_STRING,
        'shipper_name_kana1' => self::FIELD_TYPE_STRING,
        'shipper_name_kana2' => self::FIELD_TYPE_STRING,
        'shipper_country' => self::FIELD_TYPE_STRING,
        'shipper_post_code' => self::FIELD_TYPE_STRING,
        'shipper_prefecture' => self::FIELD_TYPE_STRING,
        'shipper_address1' => self::FIELD_TYPE_STRING,
        'shipper_address2' => self::FIELD_TYPE_STRING,
        'shipper_address3' => self::FIELD_TYPE_STRING,
        'shipper_phone' => self::FIELD_TYPE_STRING,
        'recipient_name1' => self::FIELD_TYPE_STRING,
        'recipient_name2' => self::FIELD_TYPE_STRING,
        'recipient_name_kana1' => self::FIELD_TYPE_STRING,
        'recipient_name_kana2' => self::FIELD_TYPE_STRING,
        'recipient_country' => self::FIELD_TYPE_STRING,
        'recipient_post_code' => self::FIELD_TYPE_STRING,
        'recipient_prefecture' => self::FIELD_TYPE_STRING,
        'recipient_address1' => self::FIELD_TYPE_STRING,
        'recipient_address2' => self::FIELD_TYPE_STRING,
        'recipient_address3' => self::FIELD_TYPE_STRING,
        'recipient_phone' => self::FIELD_TYPE_STRING,
        'cod_total' => self::FIELD_TYPE_INT64,
        'delivery_method' => self::FIELD_TYPE_STRING,
        'delivery_package_quantity' => self::FIELD_TYPE_STRING,
        'delivery_temperature_control' => self::FIELD_TYPE_STRING,
        'scheduled_shipping_date' => self::FIELD_TYPE_DATE,
        'delivery_preferred_date' => self::FIELD_TYPE_DATE,
        'delivery_preferred_time_zone' => self::FIELD_TYPE_STRING,
        'delivery_tracking_numbers' => self::FIELD_TYPE_JSON,
        'picking_notes' => self::FIELD_TYPE_STRING,
        'way_bill_notes' => self::FIELD_TYPE_STRING,
        'gift' => self::FIELD_TYPE_BOOLEAN,
        'wrapping' => self::FIELD_TYPE_BOOLEAN,
        'attr1' => self::FIELD_TYPE_STRING,
        'attr2' => self::FIELD_TYPE_STRING,
        'attr3' => self::FIELD_TYPE_STRING,
        'total_quantity' => self::FIELD_TYPE_INT64,
        'total_weight' => self::FIELD_TYPE_INT64,
        'total_size_coefficient' => self::FIELD_TYPE_INT64,
        'waiting_for_confirmation' => self::FIELD_TYPE_BOOLEAN,
        'lines' => self::FIELD_TYPE_JSON,
        'shipped_actual_stocks' => self::FIELD_TYPE_JSON,
        'warehouse' => self::FIELD_TYPE_INT64,
        'store' => self::FIELD_TYPE_INT64,
        'sales_order' => self::FIELD_TYPE_JSON,
        'document_date' => self::FIELD_TYPE_TIMESTAMP,
        'posting_date' => self::FIELD_TYPE_TIMESTAMP,
        'ordered_at' => self::FIELD_TYPE_TIMESTAMP,
        'created_at' => self::FIELD_TYPE_TIMESTAMP,
        'updated_at' => self::FIELD_TYPE_TIMESTAMP,
    ];
}
