<?php

return [
    // bigquery
    \HaruyaNishikubo\Transporter\Models\Node\Target\Repository\Bigquery\Repository::class => 'bigquery',

    // logiless
    \HaruyaNishikubo\Transporter\Models\Node\Source\Repository\Logiless\SalesOrderRepository::class => 'logiless.sales_order',
    \HaruyaNishikubo\Transporter\Models\Node\Source\Repository\Logiless\OutboundDeliveryRepository::class => 'logiless.outbound_delivery',
    \HaruyaNishikubo\Transporter\Models\Node\Source\Repository\Logiless\InboundDeliveryRepository::class => 'logiless.inbound_delivery',
    \HaruyaNishikubo\Transporter\Models\Node\Source\Repository\Logiless\InterWarehouseTransferRepository::class => 'logiless.inter_warehouse_transfer',
    \HaruyaNishikubo\Transporter\Models\Node\Source\Repository\Logiless\ArticleRepository::class => 'logiless.article',
    \HaruyaNishikubo\Transporter\Models\Node\Source\Repository\Logiless\ArticleMapRepository::class => 'logiless.article_map',
    \HaruyaNishikubo\Transporter\Models\Node\Source\Repository\Logiless\SupplierRepository::class => 'logiless.supplier',
    \HaruyaNishikubo\Transporter\Models\Node\Source\Repository\Logiless\LogicalInventorySummaryRepository::class => 'logiless.logical_inventory_summary',
    \HaruyaNishikubo\Transporter\Models\Node\Source\Repository\Logiless\ActualInventorySummaryRepository::class => 'logiless.actual_inventory_summary',
    \HaruyaNishikubo\Transporter\Models\Node\Source\Repository\Logiless\DailyInventorySummaryRepository::class => 'logiless.daily_inventory_summary',
    \HaruyaNishikubo\Transporter\Models\Node\Source\Repository\Logiless\TransactionLogRepository::class => 'logiless.transaction_log',
    \HaruyaNishikubo\Transporter\Models\Node\Source\Repository\Logiless\ReorderPointRepository::class => 'logiless.reorder_point',
    \HaruyaNishikubo\Transporter\Models\Node\Source\Repository\Logiless\StoreRepository::class => 'logiless.store',
    \HaruyaNishikubo\Transporter\Models\Node\Source\Repository\Logiless\WarehouseRepository::class => 'logiless.warehouse',

    // shopify
    \HaruyaNishikubo\Transporter\Models\Node\Source\Repository\Shopify\Rest\ProductRepository::class => 'shopify.product',
    \HaruyaNishikubo\Transporter\Models\Node\Source\Repository\Shopify\Rest\OrderRepository::class => 'shopify.order',
    \HaruyaNishikubo\Transporter\Models\Node\Source\Repository\Shopify\Rest\CustomerRepository::class => 'shopify.customer',
    \HaruyaNishikubo\Transporter\Models\Node\Source\Repository\Shopify\Rest\MetafieldRepository::class => 'shopify.metafield',
];
