<?php

namespace HaruyaNishikubo\Transporter\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Crypt;

class Node extends Model
{
    use HasFactory;
    use SoftDeletes;

    public const TYPE_LOGILESS = 'logiless';
    public const TYPE_BIGQUERY = 'bigquery';
    public const TYPE_SHOPIFY = 'shopify';

    protected $fillable = [
        'name',
        'type',
        'secret',
    ];

    protected $hidden = [
        'secret',
    ];

    public function secret(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => (empty($value))
                ? []
                : Crypt::decrypt($value),
            set: fn ($value) => (is_array($value))
                ? Crypt::encrypt($value)
                : Crypt::encrypt(json_decode($value, true))
        );
    }

    public function canAuth(): bool
    {
        return match ($this->type) {
            self::TYPE_LOGILESS => isset($this->secret['client_id']) && isset($this->secret['redirect_uri']),
            default => false,
        };
    }

    public function authUrl(): string
    {
        return match ($this->type) {
            self::TYPE_LOGILESS => sprintf('%s?%s',
                config('transporter.logiless.uri.oauth.auth'),
                http_build_query([
                    'client_id' => $this->secret['client_id'],
                    'response_type' => 'code',
                    'redirect_uri' => $this->secret['redirect_uri'],
                ])
            ),
            default => '',
        };
    }

    public function tokenUrl(string $code): string
    {
        return match ($this->type) {
            self::TYPE_LOGILESS => sprintf('%s?%s',
                config('transporter.logiless.uri.oauth.token'),
                http_build_query([
                    'client_id' => $this->secret['client_id'],
                    'client_secret' => $this->secret['client_secret'],
                    'code' => $code,
                    'grant_type' => 'authorization_code',
                    'redirect_uri' => $this->secret['redirect_uri'],
                ])
            ),
            default => '',
        };
    }
}
