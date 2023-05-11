    <div class="mt-4">
        <x-transporter::forms.label :required="true"
                       :title="__(sprintf('transporter::models.node.json.%s.secret.merchant_id', $node->type))">
            <x-transporter::forms.input type="text"
                           name="node[secret][merchant_id]"
                           value="{{ old('node.secret.merchant_id', $node->secret['merchant_id'] ?? null) }}"
                           required="required" />
        </x-transporter::forms.label>
    </div>

    <div class="mt-4">
        <x-transporter::forms.label :required="true"
                       :title="__(sprintf('transporter::models.node.json.%s.secret.client_id', $node->type))">
            <x-transporter::forms.input type="text"
                           name="node[secret][client_id]"
                           value="{{ old('node.secret.client_id', $node->secret['client_id'] ?? null) }}"
                           required="required" />
        </x-transporter::forms.label>
    </div>

    <div class="mt-4">
        <x-transporter::forms.label :required="true"
                       :title="__(sprintf('transporter::models.node.json.%s.secret.client_secret', $node->type))">
            <x-transporter::forms.input type="text"
                           name="node[secret][client_secret]"
                           value="{{ old('node.secret.client_secret', $node->secret['client_secret'] ?? null) }}"
                           required="required" />
        </x-transporter::forms.label>
    </div>

    <div class="mt-4">
        <x-transporter::forms.label :required="true"
                       :title="__(sprintf('transporter::models.node.json.%s.secret.redirect_uri', $node->type))">
            <x-transporter::forms.input type="text"
                           name="node[secret][redirect_uri]"
                           value="{{ old('node.secret.redirect_uri', $node->secret['redirect_uri'] ?? route('transporter.node.oauth.logiless', $node)) }}"
                           required="required" />
        </x-transporter::forms.label>
    </div>

    <div class="mt-4">
        <x-transporter::forms.label :title="__(sprintf('transporter::models.node.json.%s.secret.oauth', $node->type))">
            <x-transporter::forms.textarea name="node[secret][oauth]">{{ old('node.secret.oauth', json_encode($node->secret['oauth'] ?? null)) }}</x-transporter::forms.textarea>
        </x-transporter::forms.label>
    </div>

    <div class="mt-4">
        <x-transporter::forms.label :title="__(sprintf('transporter::models.node.json.%s.secret.expired_at', $node->type))">
            <x-transporter::forms.input type="datetime-local"
                           name="node[secret][expired_at]"
                           value="{{ old('node.secret.expired_at', $node->secret['expired_at'] ?? null) }}" />
        </x-transporter::forms.label>
    </div>

<div>
    <div class="flex justify-end mt-4">
        <x-transporter::forms.submit-success>
            <span class="material-icons align-middle">save</span>
            <span>{{ __('transporter::actions.save') }}</span>
        </x-transporter::forms.submit-success>
    </div>
</div>
