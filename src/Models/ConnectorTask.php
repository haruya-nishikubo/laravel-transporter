<?php

namespace HaruyaNishikubo\Transporter\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConnectorTask extends Model
{
    use HasFactory;
    use SoftDeletes;

    public const STATUS_READY = 'ready';
    public const STATUS_RUNNING = 'running';
    public const STATUS_COMPLETED = 'completed';
    public const STATUS_ERROR = 'error';

    protected $fillable = [
        'connector_id',
        'start_cursor_at',
        'end_cursor_at',
        'status',
    ];

    protected $dates = [
        'start_cursor_at',
        'end_cursor_at',
    ];

    public function connector(): BelongsTo
    {
        return $this->belongsTo(Connector::class);
    }

    public function connectorTaskLines(): HasMany
    {
        return $this->hasMany(ConnectorTaskLine::class);
    }
}
