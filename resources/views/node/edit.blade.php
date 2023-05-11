<x-transporter::layouts.app>
    <div class="mt-8 mb-4 sm:px-6 lg:px-8">
        <x-transporter::breadcrumb.default :items="[
            __('transporter::models.node.table_name') => route('transporter.node.index'),
            $node->name => route('transporter.node.show', $node),
            __('transporter::actions.edit') => null,
        ]" />
    </div>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-transporter::card.default>
                <x-transporter::card.header>{{ __('transporter::actions.edit') }}</x-transporter::card.header>
                <form action="{{ route('transporter.node.update', $node) }}" method="POST">
                    @csrf
                    @method('PUT')

                    @include('transporter::node.form')
                </form>
            </x-transporter::card.default>
        </div>
    </div>
</x-transporter::layouts.app>
