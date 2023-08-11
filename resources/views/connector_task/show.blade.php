<x-transporter::layouts.app>
    <div class="mt-8 mb-4 sm:px-6 lg:px-8">
        <x-transporter::breadcrumb.default :items="[
            __('transporter::models.connector_task.table_name') => route('transporter.connector_task.index'),
            $connector_task->name => null,
        ]" />
    </div>

    <div class="mt-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-transporter::card.default>
                <x-transporter::card.header>{{ __('transporter::actions.show') }}</x-transporter::card.header>
                <div class="mt-4">
                    <label class="block font-medium text-sm text-gray-700">{{ __('transporter::models.connector.table_name') }}</label>
                    <p>{{ $connector_task->connector->name }}</p>
                </div>

                <div class="mt-4">
                    <label class="block font-medium text-sm text-gray-700">{{ __('transporter::models.connector_task.field.start_cursor_at') }}</label>
                    <p>{{ $connector_task->start_cursor_at }}</p>
                </div>

                <div class="mt-4">
                    <label class="block font-medium text-sm text-gray-700">{{ __('transporter::models.connector_task.field.end_cursor_at') }}</label>
                    <p>{{ $connector_task->end_cursor_at }}</p>
                </div>

                <div class="mt-4">
                    <label class="block font-medium text-sm text-gray-700">{{ __('transporter::models.connector_task.field.status') }}</label>
                    <p>{{ $connector_task->status }}</p>
                </div>
            </x-transporter::card.default>
        </div>
    </div>

    <div class="mt-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-transporter::card.default>
                <x-transporter::card.header>{{ __('transporter::models.connector_task_line.table_name') }}</x-transporter::card.header>

                <table class="table-auto w-full">
                    <thead>
                    <tr>
                        <x-transporter::tables.th>{{ __('transporter::models.connector_task_line.field.id') }}</x-transporter::tables.th>
                        <x-transporter::tables.th>{{ __('transporter::models.connector_task_line.field.source_repository') }}</x-transporter::tables.th>
                        <x-transporter::tables.th>{{ __('transporter::models.connector_task_line.field.target_repository') }}</x-transporter::tables.th>
                        <x-transporter::tables.th>{{ __('transporter::models.connector_task_line.field.status') }}</x-transporter::tables.th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($connector_task_lines as $connector_task_line)
                        <tr>
                            <x-transporter::tables.td>{{ $connector_task_line->id }}</x-transporter::tables.td>
                            <x-transporter::tables.td>{{ __(sprintf('transporter::class.%s', $connector_task_line->source_repository)) }}</x-transporter::tables.td>
                            <x-transporter::tables.td>{{ __(sprintf('transporter::class.%s', $connector_task_line->target_repository)) }}</x-transporter::tables.td>
                            <x-transporter::tables.td>{{ $connector_task_line->status }}</x-transporter::tables.td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $connector_task_lines->links() }}
                </div>
            </x-transporter::card.default>
        </div>
    </div>
</x-transporter::layouts.app>
