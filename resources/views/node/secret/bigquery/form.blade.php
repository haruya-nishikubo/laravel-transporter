    <div class="mt-4">
        <x-transporter::forms.label :required="true"
                       :title="__(sprintf('transporter::models.node.json.%s.secret.project_id', $node->type))">
            <x-transporter::forms.input type="text"
                           name="node[secret][project_id]"
                           value="{{ old('node.secret.project_id', $node->secret['project_id'] ?? null) }}"
                           required="required" />
        </x-transporter::forms.label>
    </div>

    <div class="mt-4">
        <x-transporter::forms.label :required="true"
                       :title="__(sprintf('transporter::models.node.json.%s.secret.dataset', $node->type))">
            <x-transporter::forms.input type="text"
                           name="node[secret][dataset]"
                           value="{{ old('node.secret.dataset', $node->secret['dataset'] ?? null) }}"
                           required="required" />
        </x-transporter::forms.label>
    </div>

    <div class="mt-4">
        <x-transporter::forms.label :required="true"
                       :title="__(sprintf('transporter::models.node.json.%s.secret.key_file', $node->type))">
            <x-transporter::forms.textarea name="node[secret][key_file]" required="required">{{ old('node.secret.key_file', json_encode($node->secret['key_file'] ?? null)) }}</x-transporter::forms.textarea>
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
