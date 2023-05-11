<x-transporter::layouts.app>
  <div class="mt-8 mb-4 sm:px-6 lg:px-8">
    <x-transporter::breadcrumb.default :items="[
            __('transporter::models.connector.table_name') => route('transporter.connector.index'),
            $connector->name => route('transporter.connector.show', $connector),
            __('transporter::actions.edit') => null,
        ]"/>
  </div>

  <div class="py-4">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <x-transporter::card.default>
        <x-transporter::card.header>{{ __('transporter::actions.edit') }}</x-transporter::card.header>
        <form action="{{ route('transporter.connector.update', $connector) }}" method="POST">
          @csrf
          @method('PUT')

          @include('transporter::connector.form')
        </form>
      </x-transporter::card.default>
    </div>
  </div>
</x-transporter::layouts.app>
