<?php

use App\Http\Controllers\Transporter\Connector\ConnectorTaskController;
use App\Http\Controllers\Transporter\ConnectorController;
use App\Http\Controllers\Transporter\Node\Oauth\LogilessController as OauthLogilessController;
use App\Http\Controllers\Transporter\Node\Secret\BigqueryController;
use App\Http\Controllers\Transporter\Node\Secret\LogilessController as SecretLogilessController;
use App\Http\Controllers\Transporter\Node\Secret\ShopifyController;
use App\Http\Controllers\Transporter\NodeController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])
    ->prefix('transporter')
    ->name('transporter.')
    ->group(function () {
        Route::resource('connector.connector_task', ConnectorTaskController::class)
            ->only([
                'index',
                'show',
            ]);
        Route::resource('connector', ConnectorController::class);
    });

Route::middleware(['auth'])
    ->prefix('transporter')
    ->name('transporter.')
    ->group(function () {
        Route::get('node/{node}/oauth/logiless', OauthLogilessController::class)
            ->name('node.oauth.logiless');

        Route::get('node/{node}/secret/logiless/edit', [SecretLogilessController::class, 'edit'])
            ->name('node.secret.logiless.edit');
        Route::put('node/{node}/secret/logiless', [SecretLogilessController::class, 'update'])
            ->name('node.secret.logiless.update');
        Route::get('node/{node}/secret/bigquery/edit', [BigqueryController::class, 'edit'])
            ->name('node.secret.bigquery.edit');
        Route::put('node/{node}/secret/bigquery', [BigqueryController::class, 'update'])
            ->name('node.secret.bigquery.update');
        Route::get('node/{node}/secret/shopify/edit', [ShopifyController::class, 'edit'])
            ->name('node.secret.shopify.edit');
        Route::put('node/{node}/secret/shopify', [ShopifyController::class, 'update'])
            ->name('node.secret.shopify.update');

        Route::resource('node', NodeController::class);
    });
