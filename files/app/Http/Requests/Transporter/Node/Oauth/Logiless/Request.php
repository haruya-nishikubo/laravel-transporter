<?php

namespace App\Http\Requests\Transporter\Node\Oauth\Logiless;

use Illuminate\Foundation\Http\FormRequest;

class Request extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'code' => [
                'required',
            ],
        ];
    }
}
