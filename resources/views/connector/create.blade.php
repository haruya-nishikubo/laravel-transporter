<x-transporter::layouts.app>
    <div class="mt-8 mb-4 sm:px-6 lg:px-8">
        <x-transporter::breadcrumb.default :items="[
            __('transporter::models.connector.table_name') => route('transporter.connector.index'),
            __('transporter::actions.create') => null,
        ]" />
    </div>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-transporter::card.default>
                <x-transporter::card.header>{{ __('transporter::actions.create') }}</x-transporter::card.header>
                <form action="{{ route('transporter.connector.store') }}" method="POST">
                    @csrf

                    @include('transporter::connector.form')
                </form>
            </x-transporter::card.default>
        </div>
    </div>
</x-transporter::layouts.app>
