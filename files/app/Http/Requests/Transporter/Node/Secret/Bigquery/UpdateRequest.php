<?php

namespace App\Http\Requests\Transporter\Node\Secret\Bigquery;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'node.secret.project_id' => [
                'required',
                'string',
            ],
            'node.secret.dataset' => [
                'required',
                'string',
            ],
            'node.secret.key_file' => [
                'required',
                'json',
            ],
        ];
    }
}
