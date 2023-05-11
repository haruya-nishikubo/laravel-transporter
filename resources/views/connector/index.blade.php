<x-transporter::layouts.app>
    <div class="mt-8 mb-4 sm:px-6 lg:px-8">
        <x-transporter::breadcrumb.default :items="[
            __('transporter::models.connector.table_name') => null,
        ]" />
    </div>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="py-4">
                <x-transporter::card.default>
                    <x-transporter::card.header>{{ __('transporter::actions.search') }}</x-transporter::card.header>
                    <form action="{{ route('transporter.connector.index') }}" method="GET">
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
                            <x-transporter::tables.th>{{ __('transporter::models.connector.field.name') }}</x-transporter::tables.th>
                            <x-transporter::tables.th>{{ __('transporter::models.connector.field.source_node_id') }}</x-transporter::tables.th>
                            <x-transporter::tables.th>{{ __('transporter::models.connector.field.target_node_id') }}</x-transporter::tables.th>
                            <x-transporter::tables.th></x-transporter::tables.th>
                            <x-transporter::tables.th></x-transporter::tables.th>
                            <x-transporter::tables.th class="text-right">
                                <x-transporter::links.button-info href="{{ route('transporter.connector.create') }}">
                                    <span class="material-icons align-middle">create</span>
                                    <span>{{ __('transporter::actions.create') }}</span>
                                </x-transporter::links.button-info>
                            </x-transporter::tables.th>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach($connectors as $connector)
                        <tr>
                            <x-transporter::tables.td>{{ $connector->name }}</x-transporter::tables.td>
                            <x-transporter::tables.td>{{ $connector->sourceNode->name }}</x-transporter::tables.td>
                            <x-transporter::tables.td>{{ $connector->targetNode->name }}</x-transporter::tables.td>
                            <x-transporter::tables.td class="text-right">
                                <x-transporter::links.button-default href="{{ route('transporter.connector.connector_task.index', $connector) }}">
                                    <span class="material-icons align-middle">task</span>
                                    <span>{{ __('transporter::models.connector_task.table_name') }}</span>
                                </x-transporter::links.button-default>
                            </x-transporter::tables.td>
                            <x-transporter::tables.td class="text-right">
                                <x-transporter::links.button-default href="{{ route('transporter.connector.connector_log.index', $connector) }}">
                                    <span class="material-icons align-middle">list</span>
                                    <span>{{ __('transporter::models.connector_log.table_name') }}</span>
                                </x-transporter::links.button-default>
                            </x-transporter::tables.td>
                            <x-transporter::tables.td class="text-right">
                                <x-transporter::links.button-default href="{{ route('transporter.connector.show', $connector) }}">
                                    <span class="material-icons align-middle">read_more</span>
                                    <span>{{ __('transporter::actions.show') }}</span>
                                </x-transporter::links.button-default>
                            </x-transporter::tables.td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $connectors->appends($criteria)->links() }}
                </div>
            </x-transporter::card.default>
        </div>
    </div>
</x-transporter::layouts.app>
