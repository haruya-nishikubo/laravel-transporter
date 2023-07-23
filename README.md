# Installation
## Composer
```composer.json
"repositories": [
    {
        "type": "vcs",
        "url": "https://github.com/haruya-nishikubo/laravel-transporter"
    }
],
```

```shell
composer require "haruya-nishikubo/transporter"
```

# Usage
## Commands
### transporter:connector-task
```shell
php artisan transporter:connector-task-register --run
```

### queue:work
```shell
php artisan queue:work --queue=transporter:connector-<connector-id> --stop-when-empty
```

# Note
## Source
- Shopify
  - [Collection](https://shopify.dev/docs/api/admin-rest/2023-07/resources/collection)
  - [Collect](https://shopify.dev/docs/api/admin-rest/2023-07/resources/collect)
  - [Customer](https://shopify.dev/docs/api/admin-rest/2023-07/resources/customer)
  - [FulfillmentOrder](https://shopify.dev/docs/api/admin-rest/2023-07/resources/fulfillmentorder)
  - [Fulfillment](https://shopify.dev/docs/api/admin-rest/2023-07/resources/fulfillment)
  - [InventoryItem](https://shopify.dev/docs/api/admin-rest/2023-07/resources/inventoryitem)
  - [Metafield](https://shopify.dev/docs/api/admin-rest/2023-07/resources/metafield)
  - [Order](https://shopify.dev/docs/api/admin-rest/2023-07/resources/order)
  - [Product](https://shopify.dev/docs/api/admin-rest/2023-07/resources/product)
  - [Product Variant](https://shopify.dev/docs/api/admin-rest/2023-07/resources/product-variant)
  - [Refund](https://shopify.dev/docs/api/admin-rest/2023-07/resources/refund)
  - [Transaction](https://shopify.dev/docs/api/admin-rest/2023-07/resources/transaction)
- Logiless
  - [保管状況 (Actual Inventory Summary)](https://app2.logiless.com/developer/documents/interface/actual_inventory_summary)
  - [商品対応表 (Article Map)](https://app2.logiless.com/developer/documents/interface/article_map)
  - [商品マスタ (Article)](https://app2.logiless.com/developer/documents/interface/article)
  - [日時在庫 (Daily Inventory Summary)](https://app2.logiless.com/developer/documents/interface/daily_inventory_summary)
  - [入荷予定伝票 (Inbound Delivery)](https://app2.logiless.com/developer/documents/interface/inbound_delivery)
  - [倉庫間移動伝票 (Inter Warehouse Transfer)](https://app2.logiless.com/developer/documents/interface/inter_warehouse_transfer)
  - [ロケーション (Location)](https://app2.logiless.com/developer/documents/interface/location)
  - [在庫 (Logical Inventory Summary)](https://app2.logiless.com/developer/documents/interface/logical_inventory_summary)
  - [出荷伝票 (Outbound Delivery)](https://app2.logiless.com/developer/documents/interface/outbound_delivery)
  - [倉庫別発注点 (Reorder Point)](https://app2.logiless.com/developer/documents/interface/reorder_point)
  - [受注伝票 (Sales Order)](https://app2.logiless.com/developer/documents/interface/sales_order)
  - [店舗 (Store)](https://app2.logiless.com/developer/documents/interface/store)
  - [仕入先マスタ (Supplier)](https://app2.logiless.com/developer/documents/interface/supplier)
  - [在庫操作ログ (Transaction Log)](https://app2.logiless.com/developer/documents/interface/transaction_log)
  - [倉庫 (Warehouse)](https://app2.logiless.com/developer/documents/interface/warehouse)

## Target
- BigQuery

