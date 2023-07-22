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
- Logiless

## Target
- BigQuery

