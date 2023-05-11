<?php

namespace App\Http\Requests\Transporter\Node;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
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
                'required',
                'string',
            ],

            'node.type' => [
                'required',
                'string',
                Rule::in(array_keys(__('transporter::models.node.const.type'))),
            ],
        ];
    }
}
