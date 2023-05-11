<?php

namespace HaruyaNishikubo\Transporter\Models\Node\Entity\Logiless;

use HaruyaNishikubo\Transporter\Models\Node\Entity\Entity;

class InboundDeliveryEntity extends Entity
{
    protected string $table_name = 'inbound_delivery';

    protected array $fields = [
        'id' => self::FIELD_TYPE_INT64,
        'code' => self::FIELD_TYPE_STRING,
        'document_date' => self::FIELD_TYPE_DATE,
        'posting_date' => self::FIELD_TYPE_DATE,
        'inbound_delivery_category' => self::FIELD_TYPE_STRING,
        'status' => self::FIELD_TYPE_STRING,
        'supplier_name' => self::FIELD_TYPE_STRING,
        'supplier_name_kana' => self::FIELD_TYPE_STRING,
        'supplier_country' => self::FIELD_TYPE_STRING,
        'supplier_post_code' => self::FIELD_TYPE_STRING,
        'supplier_prefecture' => self::FIELD_TYPE_STRING,
        'supplier_address1' => self::FIELD_TYPE_STRING,
        'supplier_address2' => self::FIELD_TYPE_STRING,
        'supplier_address3' => self::FIELD_TYPE_STRING,
        'supplier_phone' => self::FIELD_TYPE_STRING,
        'supplier_fax' => self::FIELD_TYPE_STRING,
        'supplier_email' => self::FIELD_TYPE_STRING,
        'recipient_name' => self::FIELD_TYPE_STRING,
        'recipient_name_kana' => self::FIELD_TYPE_STRING,
        'recipient_country' => self::FIELD_TYPE_STRING,
        'recipient_post_code' => self::FIELD_TYPE_STRING,
        'recipient_prefecture' => self::FIELD_TYPE_STRING,
        'recipient_address1' => self::FIELD_TYPE_STRING,
        'recipient_address2' => self::FIELD_TYPE_STRING,
        'recipient_address3' => self::FIELD_TYPE_STRING,
        'recipient_phone' => self::FIELD_TYPE_STRING,
        'recipient_fax' => self::FIELD_TYPE_STRING,
        'subtotal' => self::FIELD_TYPE_INT64,
        'tax_processing_method' => self::FIELD_TYPE_STRING,
        'tax_rounding_method' => self::FIELD_TYPE_STRING,
        'document_tax_rate' => self::FIELD_TYPE_INT64,
        'tax_total' => self::FIELD_TYPE_INT64,
        'total' => self::FIELD_TYPE_INT64,
        'delivery_preferred_date' => self::FIELD_TYPE_DATE,
        'delivery_preferred_time_zone' => self::FIELD_TYPE_STRING,
        'purchase_order_notes' => self::FIELD_TYPE_STRING,
        'scheduled_delivery_date' => self::FIELD_TYPE_DATE,
        'delivery_career_name' => self::FIELD_TYPE_STRING,
        'delivery_tracking_numbers' => self::FIELD_TYPE_JSON,
        'is_printed' => self::FIELD_TYPE_BOOLEAN,
        'receiving_notes' => self::FIELD_TYPE_STRING,
        'remarks_on_received' => self::FIELD_TYPE_STRING,
        'attr1' => self::FIELD_TYPE_STRING,
        'attr2' => self::FIELD_TYPE_STRING,
        'attr3' => self::FIELD_TYPE_STRING,
        'ordered_at' => self::FIELD_TYPE_TIMESTAMP,
        'finished_at' => self::FIELD_TYPE_TIMESTAMP,
        'created_at' => self::FIELD_TYPE_TIMESTAMP,
        'updated_at' => self::FIELD_TYPE_TIMESTAMP,
        'lines' => self::FIELD_TYPE_JSON,
        'supplier' => self::FIELD_TYPE_JSON,
        'warehouse' => self::FIELD_TYPE_JSON,
    ];
}
