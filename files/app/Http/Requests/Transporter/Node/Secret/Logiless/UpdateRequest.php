<?php

namespace App\Http\Requests\Transporter\Node\Secret\Logiless;

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
            'node.secret.merchant_id' => [
                'required',
                'numeric',
            ],
            'node.secret.client_id' => [
                'required',
                'string',
            ],
            'node.secret.client_secret' => [
                'required',
                'string',
            ],
            'node.secret.redirect_uri' => [
                'required',
                'url',
            ],
            'node.secret.oauth' => [
                'nullable',
                'json',
            ],
            'node.secret.expired_at' => [
                'nullable',
                'date',
            ],
        ];
    }
}
