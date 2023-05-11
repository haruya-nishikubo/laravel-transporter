<?php

namespace App\Http\Requests\Transporter\Connector;

use HaruyaNishikubo\Transporter\Models\Connector;
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
        $query = Connector::query();

        $query->latest($validated['sort_by'] ?? 'id');

        return $query;
    }
}
