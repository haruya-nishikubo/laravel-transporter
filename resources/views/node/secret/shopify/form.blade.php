    <div class="mt-4">
        <x-transporter::forms.label :required="true"
                       :title="__(sprintf('transporter::models.node.json.%s.secret.api_key', $node->type))">
            <x-transporter::forms.input type="text"
                           name="node[secret][api_key]"
                           value="{{ old('node.secret.api_key', $node->secret['api_key'] ?? null) }}"
                           required="required" />
        </x-transporter::forms.label>
    </div>

    <div class="mt-4">
        <x-transporter::forms.label :required="true"
                       :title="__(sprintf('transporter::models.node.json.%s.secret.api_secret_key', $node->type))">
            <x-transporter::forms.input type="text"
                           name="node[secret][api_secret_key]"
                           value="{{ old('node.secret.api_secret_key', $node->secret['api_secret_key'] ?? null) }}"
                           required="required" />
        </x-transporter::forms.label>
    </div>

    <div class="mt-4">
        <x-transporter::forms.label :required="true"
                       :title="__(sprintf('transporter::models.node.json.%s.secret.scope', $node->type))">
            <x-transporter::forms.input type="text"
                           name="node[secret][scope]"
                           value="{{ old('node.secret.scope', $node->secret['scope'] ?? null) }}"
                           required="required" />
        </x-transporter::forms.label>
    </div>

    <div class="mt-4">
        <x-transporter::forms.label :required="true"
                       :title="__(sprintf('transporter::models.node.json.%s.secret.host_name', $node->type))">
            <x-transporter::forms.input type="text"
                           name="node[secret][host_name]"
                           value="{{ old('node.secret.host_name', $node->secret['host_name'] ?? null) }}"
                           required="required" />
        </x-transporter::forms.label>
    </div>

    <div class="mt-4">
        <x-transporter::forms.label :required="true"
                       :title="__(sprintf('transporter::models.node.json.%s.secret.api_version', $node->type))">
            <x-transporter::forms.input type="text"
                           name="node[secret][api_version]"
                           value="{{ old('node.secret.api_version', $node->secret['api_version'] ?? null) }}"
                           required="required" />
        </x-transporter::forms.label>
    </div>

    <div class="mt-4">
        <x-transporter::forms.label :required="true"
                       :title="__(sprintf('transporter::models.node.json.%s.secret.api_access_token', $node->type))">
            <x-transporter::forms.input type="text"
                           name="node[secret][api_access_token]"
                           value="{{ old('node.secret.api_access_token', $node->secret['api_access_token'] ?? null) }}"
                           required="required" />
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
