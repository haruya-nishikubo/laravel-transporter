    <div class="mt-4">
        <x-transporter::forms.label :required="true"
                       :title="__('transporter::models.connector.field.name')">
            <x-transporter::forms.input type="text"
                           name="connector[name]"
                           value="{{ old('connector.name', $connector->name) }}"
                           required="required" />
        </x-transporter::forms.label>
    </div>

    <div class="mt-4">
        <x-transporter::forms.label :required="true"
                       :title="__('transporter::models.connector.field.source_node_id')">
            <x-transporter::forms.select name="connector[source_node_id]">
                @foreach($nodes as $node)
                    <option value="{{ $node->id }}" @selected($connector->source_node_id == $node->id)>{{ $node->name }}</option>
                @endforeach
            </x-transporter::forms.select>
        </x-transporter::forms.label>
    </div>

    <div class="mt-4">
        <x-transporter::forms.label :required="true"
                       :title="__('transporter::models.connector.field.target_node_id')">
            <x-transporter::forms.select name="connector[target_node_id]">
                @foreach($nodes as $node)
                    <option value="{{ $node->id }}" @selected($connector->target_node_id == $node->id)>{{ $node->name }}</option>
                @endforeach
            </x-transporter::forms.select>
        </x-transporter::forms.label>
    </div>

    <div class="mt-4">
        <x-transporter::forms.label :required="true"
                       :title="__('transporter::models.connector.field.interval')">
            <x-transporter::forms.input type="text"
                           name="connector[interval]"
                           value="{{ old('connector.interval', $connector->interval) }}"
                           required="required" />
        </x-transporter::forms.label>
    </div>

    <div class="mt-4">
        <x-transporter::forms.label :required="true"
                       :title="__('transporter::models.connector.field.next_start_cursor_at')">
            <x-transporter::forms.input type="datetime-local"
                           name="connector[next_start_cursor_at]"
                           value="{{ old('connector.next_start_cursor_at', ($connector->next_start_cursor_at ?? now())->format('Y-m-d H:i')) }}"
                           required="required" />
        </x-transporter::forms.label>
    </div>

    <div class="mt-4">
        <x-transporter::forms.label :required="true"
                       :title="__('transporter::models.connector.field.next_end_cursor_at')">
            <x-transporter::forms.input type="datetime-local"
                           name="connector[next_end_cursor_at]"
                           value="{{ old('connector.next_end_cursor_at', ($connector->next_end_cursor_at ?? now()->addHours(1))->format('Y-m-d H:i')) }}"
                           required="required" />
        </x-transporter::forms.label>
    </div>

    <div class="mt-4">
        <x-transporter::forms.toggle name="connector[is_enabled]"
                        :checked="old('connector.is_enabled', $connector->is_enabled)">{{ __('transporter::models.connector.field.is_enabled') }}</x-transporter::forms.toggle>
    </div>


<div>
    <div class="flex justify-end mt-4">
        <x-transporter::forms.submit-success>
            <span class="material-icons align-middle">save</span>
            <span>{{ __('transporter::actions.save') }}</span>
        </x-transporter::forms.submit-success>
    </div>
</div>
