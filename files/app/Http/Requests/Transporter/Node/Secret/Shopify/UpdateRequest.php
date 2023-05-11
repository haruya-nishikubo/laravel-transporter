<?php

namespace App\Http\Requests\Transporter\Node\Secret\Shopify;

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
            'node.secret.api_key' => [
                'required',
            ],
            'node.secret.api_secret_key' => [
                'required',
            ],
            'node.secret.scope' => [
                'required',
            ],
            'node.secret.host_name' => [
                'required',
            ],
            'node.secret.api_version' => [
                'required',
            ],
            'node.secret.api_access_token' => [
                'required',
            ],
        ];
    }
}
