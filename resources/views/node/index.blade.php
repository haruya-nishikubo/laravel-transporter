<x-transporter::layouts.app>
    <div class="mt-8 mb-4 sm:px-6 lg:px-8">
        <x-transporter::breadcrumb.default :items="[
            __('transporter::models.node.table_name') => null,
        ]" />
    </div>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="py-4">
                <x-transporter::card.default>
                    <x-transporter::card.header>{{ __('transporter::actions.search') }}</x-transporter::card.header>
                    <form action="{{ route('transporter.node.index') }}" method="GET">
                        <div class="grid grid-cols-2 gap-4 mt-4">
                        <div>
                            <x-transporter::forms.label :title="__('transporter::models.node.field.name')">
                                <x-transporter::forms.input type="text"
                                    name="node[name]"
                                    value="{{ old('node.name', $criteria['node']['name'] ?? '') }}" />
                            </x-transporter::forms.label>
                        </div>

                        <div>
                            <x-transporter::forms.label :title="__('transporter::models.node.field.type')">
                                <x-transporter::forms.input type="text"
                                    name="node[type]"
                                    value="{{ old('node.type', $criteria['node']['type'] ?? '') }}" />
                            </x-transporter::forms.label>
                        </div>

                        </div>
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
                            <x-transporter::tables.th>{{ __('transporter::models.node.field.name') }}</x-transporter::tables.th>
                            <x-transporter::tables.th>{{ __('transporter::models.node.field.type') }}</x-transporter::tables.th>
                            <x-transporter::tables.th class="text-right">
                                <x-transporter::links.button-info href="{{ route('transporter.node.create') }}">
                                    <span class="material-icons align-middle">create</span>
                                    <span>{{ __('transporter::actions.create') }}</span>
                                </x-transporter::links.button-info>
                            </x-transporter::tables.th>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach($nodes as $node)
                        <tr>
                            <x-transporter::tables.td>{{ $node->name }}</x-transporter::tables.td>
                            <x-transporter::tables.td>{{ $node->type }}</x-transporter::tables.td>
                            <x-transporter::tables.td class="text-right">
                                <x-transporter::links.button-default href="{{ route('transporter.node.show', $node) }}">
                                    <span class="material-icons align-middle">read_more</span>
                                    <span>{{ __('transporter::actions.show') }}</span>
                                </x-transporter::links.button-default>
                            </x-transporter::tables.td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $nodes->appends($criteria)->links() }}
                </div>
            </x-transporter::card.default>
        </div>
    </div>
</x-transporter::layouts.app>
