<x-transporter::layouts.app>
    <div class="mt-8 mb-4 sm:px-6 lg:px-8">
        <x-transporter::breadcrumb.default :items="[
            __('transporter::models.connector.table_name') => route('transporter.connector.index'),
            $connector->name => route('transporter.connector.show', $connector),
            __('transporter::models.connector_log.table_name') => null,
        ]" />
    </div>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="py-4">
                <x-transporter::card.default>
                    <x-transporter::card.header>{{ __('transporter::actions.search') }}</x-transporter::card.header>
                    <form action="{{ route('transporter.connector.connector_log.index', $connector) }}" method="GET">
                        <div class="grid grid-cols-2 gap-4 mt-4">
                            <div>
                                <x-transporter::forms.select name="sort_by">
                                    <option value="id">ID</option>
                                </x-transporter::forms.select>
                            </div>

                            <div class="flex justify-end">
                                <x-transporter::forms.submit-info>
                                    <span class="material-icons align-middle">search</span>
                                    <span>{{ __('transporter::actions.search') }}</span>
                                </x-transporter::forms.submit-info>
                            </div>
                        </div>
                    </form>
                </x-transporter::card.default>
            </div>

            <x-transporter::card.default>
                <x-transporter::card.header>{{ __('transporter::actions.index') }}</x-transporter::card.header>
                <table class="table-auto w-full">
                    <thead>
                        <tr>
                            <x-transporter::tables.th>{{ __('transporter::models.connector_log.field.created_at') }}</x-transporter::tables.th>
                            <x-transporter::tables.th>{{ __('transporter::models.connector_log.field.label') }}</x-transporter::tables.th>
                            <x-transporter::tables.th>{{ __('transporter::models.connector_log.field.message') }}</x-transporter::tables.th>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach($connector_logs as $connector_log)
                        <tr>
                            <x-transporter::tables.td>{{ $connector_log->created_at }}</x-transporter::tables.td>
                            <x-transporter::tables.td>{{ $connector_log->label }}</x-transporter::tables.td>
                            <x-transporter::tables.td>{{ json_encode($connector_log->message) }}</x-transporter::tables.td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $connector_logs->appends($criteria)->links() }}
                </div>
            </x-transporter::card.default>
        </div>
    </div>
</x-transporter::layouts.app>
