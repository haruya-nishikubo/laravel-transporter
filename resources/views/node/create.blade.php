<x-transporter::layouts.app>
    <div class="mt-8 mb-4 sm:px-6 lg:px-8">
        <x-transporter::breadcrumb.default :items="[
            __('transporter::models.node.table_name') => route('transporter.node.index'),
            __('transporter::actions.create') => null,
        ]" />
    </div>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-transporter::card.default>
                <x-transporter::card.header>{{ __('transporter::actions.create') }}</x-transporter::card.header>
                <form action="{{ route('transporter.node.store') }}" method="POST">
                    @csrf

                    @include('transporter::node.form')
                </form>
            </x-transporter::card.default>
        </div>
    </div>
</x-transporter::layouts.app>
