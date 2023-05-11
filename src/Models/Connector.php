<?php

namespace HaruyaNishikubo\Transporter\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Connector extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'source_node_id',
        'target_node_id',
        'interval',
        'next_start_cursor_at',
        'next_end_cursor_at',
        'is_enabled',
    ];

    protected $dates = [
        'next_start_cursor_at',
        'next_end_cursor_at',
    ];

    protected $casts = [
        'is_enabled' => 'bool',
    ];

    public function sourceNode(): BelongsTo
    {
        return $this->belongsTo(Node::class, 'source_node_id');
    }

    public function targetNode(): BelongsTo
    {
        return $this->belongsTo(Node::class, 'target_node_id');
    }

    public function connectorTasks(): HasMany
    {
        return $this->hasMany(ConnectorTask::class);
    }

    public function connectorLogs(): HasMany
    {
        return $this->hasMany(ConnectorLog::class);
    }

    public function sourceRepositories(): array
    {
        return config(sprintf('transporter.%s.source_repositories', $this->sourceNode->type));
    }

    public function targetRepository(): string
    {
        return config(sprintf('transporter.%s.target_repository', $this->targetNode->type));
    }
}
