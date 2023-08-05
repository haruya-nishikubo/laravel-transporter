<?php

namespace HaruyaNishikubo\Transporter\Models;

use HaruyaNishikubo\Transporter\Models\Node\Collection\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use HaruyaNishikubo\Transporter\Models\Node\Source\Repository\Repository as SourceRepository;
use HaruyaNishikubo\Transporter\Models\Node\Target\Repository\Repository as TargetRepository;

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
        'source_repository_attributes',
        'target_repository',
        'status',
    ];

    protected $casts = [
        'source_repository_attributes' => 'array',
    ];

    public function connectorTask(): BelongsTo
    {
        return $this->belongsTo(ConnectorTask::class);
    }

    public function connectorTaskLineLogs(): HasMany
    {
        return $this->hasMany(ConnectorTaskLineLog::class);
    }

    public function buildSourceRepository(): SourceRepository
    {
        return new $this->source_repository($this->connectorTask->connector->sourceNode);
    }

    public function buildTargetRepository(Collection $collection): TargetRepository
    {
        return new $this->target_repository($this->connectorTask->connector->targetNode, $collection);
    }
}
