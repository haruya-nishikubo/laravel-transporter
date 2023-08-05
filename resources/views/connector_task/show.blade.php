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
</x-transporter::layouts.app>
