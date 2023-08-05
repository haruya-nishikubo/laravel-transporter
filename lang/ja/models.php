<?php

return [
    'node' => [
        'table_name' => 'ノード',
        'field' => [
            'name' => 'ノード名',
            'type' => 'タイプ',
            'secret' => 'シークレット',
        ],
        'json' => [
            \HaruyaNishikubo\Transporter\Models\Node::TYPE_LOGILESS => [
                'secret' => [
                    'merchant_id' => 'merchant_id',
                    'client_id' => 'client_id',
                    'client_secret' => 'client_secret',
                    'redirect_uri' => 'redirect_uri',
                    'oauth' => 'oauth',
                    'expired_at' => 'expired_at',
                ],
            ],
            \HaruyaNishikubo\Transporter\Models\Node::TYPE_BIGQUERY => [
                'secret' => [
                    'project_id' => 'project_id',
                    'dataset' => 'dataset',
                    'key_file' => 'key_file',
                ],
            ],
            \HaruyaNishikubo\Transporter\Models\Node::TYPE_SHOPIFY => [
                'secret' => [
                    'api_key' => 'api_key',
                    'api_secret_key' => 'api_secret_key',
                    'scope' => 'scope',
                    'host_name' => 'host_name',
                    'api_version' => 'api_version',
                    'api_access_token' => 'api_access_token',
                ],
            ],
        ],
        'const' => [
            'type' => [
                \HaruyaNishikubo\Transporter\Models\Node::TYPE_LOGILESS => 'logiless',
                \HaruyaNishikubo\Transporter\Models\Node::TYPE_BIGQUERY => 'bigquery',
                \HaruyaNishikubo\Transporter\Models\Node::TYPE_SHOPIFY => 'shopify',
            ],
        ],
    ],
    'connector' => [
        'table_name' => 'コネクタ',
        'field' => [
            'name' => 'コネクタ名',
            'source_node_id' => 'ソース',
            'target_node_id' => 'ターゲット',
            'interval' => '同期間隔[h]',
            'next_start_cursor_at' => '次のデータ取得範囲:開始日時',
            'next_end_cursor_at' => '次のデータ取得範囲:終了日時',
            'is_enabled' => '無効 / 有効',
        ],
    ],

    'connector_task' => [
        'table_name' => 'タスク',
        'field' => [
            'id' => 'ID',
            'start_cursor_at' => '取得データの開始日時',
            'end_cursor_at' => '取得データの終了日時',
            'status' => 'ステータス',
        ],
    ],

    'connector_task_line' => [
        'table_name' => 'タスク明細',
        'field' => [
            'id' => 'ID',
            'source_repository' => 'Source Repository',
            'target_repository' => 'Target Repository',
            'status' => 'ステータス',
        ],
    ],
];
