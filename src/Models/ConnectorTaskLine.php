<?php

namespace HaruyaNishikubo\Transporter\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConnectorTaskLine extends Model
{
    use HasFactory;
    use SoftDeletes;

    public const STATUS_READY = 'ready';
    public const STATUS_RUNNING = 'running';
    public const STATUS_COMPLETED = 'completed';
    public const STATUS_ERROR = 'error';

    protected $fillable = [
        'connector_task_id',
        'source_repository',
        'target_repository',
        'status',
    ];

    public function connectorTask(): BelongsTo
    {
        return $this->belongsTo(ConnectorTask::class);
    }
}
