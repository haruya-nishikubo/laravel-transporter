    <div class="mt-4">
        <x-transporter::forms.label :required="true"
                       :title="__('transporter::models.node.field.name')">
            <x-transporter::forms.input type="text"
                           name="node[name]"
                           value="{{ old('node.name', $node->name) }}"
                           required="required" />
        </x-transporter::forms.label>
    </div>

    <div class="mt-4">
        <x-transporter::forms.label :required="true"
                       :title="__('transporter::models.node.field.type')">
            <x-transporter::forms.select name="node[type]">
                @foreach(__('transporter::models.node.const.type') as $value => $text)
                    <option value="{{ $value }}" @selected($node->type == $value)>{{ $text }}</option>
                @endforeach
            </x-transporter::forms.select>
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
