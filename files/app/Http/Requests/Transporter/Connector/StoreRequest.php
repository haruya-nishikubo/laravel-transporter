<?php

namespace App\Http\Requests\Transporter\Connector;

use HaruyaNishikubo\Transporter\Models\Node;
use Illuminate\Foundation\Http\FormRequest;

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
            'connector.name' => [
                'required',
                'string',
            ],

            'connector.source_node_id' => [
                'required',
                'numeric',
                sprintf('exists:%s,id', Node::class),
            ],

            'connector.target_node_id' => [
                'required',
                'numeric',
                sprintf('exists:%s,id', Node::class),
            ],

            'connector.interval' => [
                'required',
                'numeric',
            ],

            'connector.next_start_cursor_at' => [
                'required',
                'date',
            ],

            'connector.next_end_cursor_at' => [
                'required',
                'date',
            ],

            'connector.is_enabled' => [
                'required',
                'numeric',
            ],

        ];
    }
}
