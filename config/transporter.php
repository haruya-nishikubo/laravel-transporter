<?php

return [
    // bigquery
    \HaruyaNishikubo\Transporter\Models\Node::TYPE_BIGQUERY => [
        'target_repository' => \HaruyaNishikubo\Transporter\Models\Node\Target\Repository\Bigquery\Repository::class,
    ],

    // logiless
    \HaruyaNishikubo\Transporter\Models\Node::TYPE_LOGILESS => [
        'uri' => [
            'oauth' => [
                'auth' => 'https://app2.logiless.com/oauth/v2/auth',
                'token' => 'https://app2.logiless.com/oauth2/token',
            ],
            'sales_order' => [
                'list' => 'https://app2.logiless.com/api/v1/merchant/%d/sales_orders',
            ],
            'outbound_delivery' => [
                'list' => 'https://app2.logiless.com/api/v1/merchant/%d/outbound_deliveries',
            ],
            'inbound_delivery' => [
                'list' => 'https://app2.logiless.com/api/v1/merchant/%d/inbound_deliveries',
            ],
            'inter_warehouse_transfer' => [
                'list' => 'https://app2.logiless.com/api/v1/merchant/%d/inter_warehouse_transfers',
            ],
            'article' => [
                'list' => 'https://app2.logiless.com/api/v1/merchant/%d/articles',
            ],
            'article_map' => [
                'list' => 'https://app2.logiless.com/api/v1/merchant/%d/article_maps',
            ],
            'supplier' => [
                'list' => 'https://app2.logiless.com/api/v1/merchant/%d/suppliers',
            ],
            'logical_inventory_summary' => [
                'list' => 'https://app2.logiless.com/api/v1/merchant/%d/logical_inventory_summaries',
            ],
            'actual_inventory_summary' => [
                'list' => 'https://app2.logiless.com/api/v1/merchant/%d/actual_inventory_summaries',
            ],
            'daily_inventory_summary' => [
                'list' => 'https://app2.logiless.com/api/v1/merchant/%d/daily_inventory_summaries',
            ],
            'transaction_log' => [
                'list' => 'https://app2.logiless.com/api/v1/merchant/%d/transaction_logs',
            ],
            'reorder_point' => [
                'list' => 'https://app2.logiless.com/api/v1/merchant/%d/reorder_points',
            ],
            'store' => [
                'list' => 'https://app2.logiless.com/api/v1/merchant/%d/stores',
            ],
            'warehouse' => [
                'list' => 'https://app2.logiless.com/api/v1/merchant/%d/warehouses',
            ],
            'location' => [
                'list' => 'https://app2.logiless.com/api/v1/merchant/%d/warehouses/%d/locations',
            ],
        ],
        'source_repositories' => [
            \HaruyaNishikubo\Transporter\Models\Node\Source\Repository\Logiless\SalesOrderRepository::class,
            \HaruyaNishikubo\Transporter\Models\Node\Source\Repository\Logiless\OutboundDeliveryRepository::class,
            \HaruyaNishikubo\Transporter\Models\Node\Source\Repository\Logiless\InboundDeliveryRepository::class,
            \HaruyaNishikubo\Transporter\Models\Node\Source\Repository\Logiless\InterWarehouseTransferRepository::class,
            \HaruyaNishikubo\Transporter\Models\Node\Source\Repository\Logiless\ArticleRepository::class,
            \HaruyaNishikubo\Transporter\Models\Node\Source\Repository\Logiless\ArticleMapRepository::class,
            \HaruyaNishikubo\Transporter\Models\Node\Source\Repository\Logiless\SupplierRepository::class,
            \HaruyaNishikubo\Transporter\Models\Node\Source\Repository\Logiless\LogicalInventorySummaryRepository::class,
            \HaruyaNishikubo\Transporter\Models\Node\Source\Repository\Logiless\ActualInventorySummaryRepository::class,
            \HaruyaNishikubo\Transporter\Models\Node\Source\Repository\Logiless\DailyInventorySummaryRepository::class,
            \HaruyaNishikubo\Transporter\Models\Node\Source\Repository\Logiless\TransactionLogRepository::class,
            \HaruyaNishikubo\Transporter\Models\Node\Source\Repository\Logiless\ReorderPointRepository::class,
            \HaruyaNishikubo\Transporter\Models\Node\Source\Repository\Logiless\StoreRepository::class,
            \HaruyaNishikubo\Transporter\Models\Node\Source\Repository\Logiless\WarehouseRepository::class,
            // \HaruyaNishikubo\Transporter\Models\Node\Source\Repository\Logiless\LocationRepository::class,
        ],
    ],

    // shopify
    \HaruyaNishikubo\Transporter\Models\Node::TYPE_SHOPIFY => [
        'source_repositories' => [
            \HaruyaNishikubo\Transporter\Models\Node\Source\Repository\Shopify\Rest\CollectRepository::class,
            \HaruyaNishikubo\Transporter\Models\Node\Source\Repository\Shopify\Rest\ProductRepository::class,
            \HaruyaNishikubo\Transporter\Models\Node\Source\Repository\Shopify\Rest\CustomerRepository::class,
            \HaruyaNishikubo\Transporter\Models\Node\Source\Repository\Shopify\Rest\OrderRepository::class,
        ],
    ],
];
