<?php

namespace App\Http\Requests\Transporter\Node;

use HaruyaNishikubo\Transporter\Models\Node;
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
            'node.name' => [
                'nullable',
                'string',
            ],

            'node.type' => [
                'nullable',
                'string',
            ],

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
        $validated = $this->validated();

        $query = Node::query();

        if (isset($validated['node']['name'])) {
            $query->where('name', 'LIKE', "%{$validated['node']['name']}%");
        }

        if (isset($validated['node']['type'])) {
            $query->where('type', 'LIKE', "%{$validated['node']['type']}%");
        }

        $query->latest($validated['sort_by'] ?? 'id');

        return $query;
    }
}
