<x-transporter::layouts.app>
    <div class="mt-8 mb-4 sm:px-6 lg:px-8">
        <x-transporter::breadcrumb.default :items="[
            __('transporter::models.connector.table_name') => route('transporter.connector.index'),
            $connector->name => null,
        ]" />
    </div>

    <div class="mt-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-transporter::card.default>
                <x-transporter::card.header>{{ __('transporter::actions.show') }}</x-transporter::card.header>
                <div class="mt-4">
                    <label class="block font-medium text-sm text-gray-700">{{ __('transporter::models.connector.field.name') }}</label>
                    <p>{{ $connector->name }}</p>
                </div>

                <div class="mt-4">
                    <label class="block font-medium text-sm text-gray-700">{{ __('transporter::models.connector.field.source_node_id') }}</label>
                    <p>{{ $connector->sourceNode->name }}</p>
                </div>

                <div class="mt-4">
                    <label class="block font-medium text-sm text-gray-700">{{ __('transporter::models.connector.field.target_node_id') }}</label>
                    <p>{{ $connector->targetNode->name }}</p>
                </div>

                <div class="mt-4">
                    <label class="block font-medium text-sm text-gray-700">{{ __('transporter::models.connector.field.interval') }}</label>
                    <p>{{ $connector->interval }}</p>
                </div>

                <div class="mt-4">
                    <label class="block font-medium text-sm text-gray-700">{{ __('transporter::models.connector.field.next_start_cursor_at') }}</label>
                    <p>{{ $connector->next_start_cursor_at }}</p>
                </div>

                <div class="mt-4">
                    <label class="block font-medium text-sm text-gray-700">{{ __('transporter::models.connector.field.next_end_cursor_at') }}</label>
                    <p>{{ $connector->next_end_cursor_at }}</p>
                </div>

                <div class="mt-4">
                    <label class="block font-medium text-sm text-gray-700">{{ __('transporter::models.connector.field.is_enabled') }}</label>
                    <p>{{ $connector->is_enabled }}</p>
                </div>

                <div class="flex justify-end mt-4">
                    <x-transporter::links.button-info href="{{ route('transporter.connector.edit', $connector) }}">
                        <span class="material-icons align-middle">edit</span>
                        <span>{{ __('transporter::actions.edit') }}</span>
                    </x-transporter::links.button-info>
                </div>

                <div class="flex justify-end mt-4">
                    <form actions="{{ route('transporter.connector.destroy', $connector) }}" method="POST" onsubmit="return confirm('{{ __('transporter::actions.confirm-destroy') }}')">
                        @csrf
                        @method('DELETE')

                        <x-transporter::forms.submit-danger>
                            <span class="material-icons align-middle">delete</span>
                            <span>{{ __('transporter::actions.destroy') }}</span>
                        </x-transporter::forms.submit-danger>
                    </form>
                </div>
            </x-transporter::card.default>
        </div>
    </div>

    <div class="mt-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-transporter::card.default>
                <x-transporter::card.header>{{ __('transporter::models.connector_task.table_name') }}</x-transporter::card.header>
                <table class="table-auto w-full">
                    <thead>
                    <tr>
                        <x-transporter::tables.th>{{ __('transporter::models.connector_task.field.id') }}</x-transporter::tables.th>
                        <x-transporter::tables.th>{{ __('transporter::models.connector_task.field.start_cursor_at') }}</x-transporter::tables.th>
                        <x-transporter::tables.th>{{ __('transporter::models.connector_task.field.end_cursor_at') }}</x-transporter::tables.th>
                        <x-transporter::tables.th>{{ __('transporter::models.connector_task.field.status') }}</x-transporter::tables.th>
                        <x-transporter::tables.th class="text-right"></x-transporter::tables.th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($connector->connectorTasks as $connector_task)
                        <tr>
                            <x-transporter::tables.td>{{ $connector_task->id }}</x-transporter::tables.td>
                            <x-transporter::tables.td>{{ $connector_task->start_cursor_at }}</x-transporter::tables.td>
                            <x-transporter::tables.td>{{ $connector_task->end_cursor_at }}</x-transporter::tables.td>
                            <x-transporter::tables.td>{{ $connector_task->status }}</x-transporter::tables.td>
                            <x-transporter::tables.td class="text-right">
                                <x-transporter::links.button-default href="{{ route('transporter.connector.connector_task.show', ['connector' => $connector, 'connector_task' => $connector_task]) }}">
                                    <span class="material-icons align-middle">read_more</span>
                                    <span>{{ __('transporter::actions.show') }}</span>
                                </x-transporter::links.button-default>
                            </x-transporter::tables.td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </x-transporter::card.default>
        </div>
    </div>
</x-transporter::layouts.app>
