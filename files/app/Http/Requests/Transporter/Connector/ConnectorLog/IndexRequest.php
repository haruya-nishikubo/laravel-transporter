<?php

namespace App\Http\Requests\Transporter\Connector\ConnectorLog;

use HaruyaNishikubo\Transporter\Models\ConnectorTaskLineLog;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class IndexRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'sort_by' => [
                'nullable',
                Rule::in([
                    'id',
                ]),
            ],
        ];
    }

    public function queryWithValidated(): Builder
    {
        $query = ConnectorTaskLineLog::where('connector_id', $this->route('connector')->id);

        $query->latest($validated['sort_by'] ?? 'id');

        return $query;
    }
}
