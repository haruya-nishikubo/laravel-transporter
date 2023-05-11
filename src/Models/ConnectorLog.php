<?php

namespace HaruyaNishikubo\Transporter\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConnectorLog extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'connector_id',
        'label',
        'message',
    ];

    protected $casts = [
        'message' => 'array',
    ];
}
