<x-transporter::layouts.app>
    <div class="mt-8 mb-4 sm:px-6 lg:px-8">
        <x-transporter::breadcrumb.default :items="[
            __('transporter::models.node.table_name') => route('transporter.node.index'),
            $node->name => null,
        ]" />
    </div>

    <div class="mt-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-transporter::card.default>
                <x-transporter::card.header>{{ __('transporter::actions.show') }}</x-transporter::card.header>
                <div class="mt-4">
                    <label class="block font-medium text-sm text-gray-700">{{ __('transporter::models.node.field.name') }}</label>
                    <p>{{ $node->name }}</p>
                </div>

                <div class="mt-4">
                    <label class="block font-medium text-sm text-gray-700">{{ __('transporter::models.node.field.type') }}</label>
                    <p>{{ __("transporter::models.node.const.type.{$node->type}") }}</p>
                </div>

                <div class="flex justify-end mt-4">
                    <x-transporter::links.button-info href="{{ route('transporter.node.edit', $node) }}">
                        <span class="material-icons align-middle">edit</span>
                        <span>{{ __('transporter::actions.edit') }}</span>
                    </x-transporter::links.button-info>
                </div>

                <div class="flex justify-end mt-4">
                    <form action="{{ route('transporter.node.destroy', $node) }}" method="POST" onsubmit="return confirm('{{ __('transporter::actions.confirm-destroy') }}')">
                        @csrf
                        @method('DELETE')

                        <x-transporter::forms.submit-danger>
                            <span class="material-icons align-middle">delete</span>
                            <span>{{ __('transporter::actions.destroy') }}</span>
                        </x-transporter::forms.submit-danger>
                    </form>
                </div>
            </x-transporter::card.default>

            <x-transporter::card.default>
                <x-transporter::card.header>{{ __('transporter::models.node.field.secret') }}</x-transporter::card.header>

                <div class="mt-4">
                    <pre>{{ json_encode($node->secret, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) }}</pre>
                </div>

                <div class="flex justify-end mt-4">
                    <x-transporter::links.button-info href="{{ route(sprintf('transporter.node.secret.%s.edit', $node->type), $node) }}">
                        <span class="material-icons align-middle">edit</span>
                        <span>{{ __('transporter::actions.edit') }}</span>
                    </x-transporter::links.button-info>
                </div>
            </x-transporter::card.default>

            @if ($node->canAuth())
                <x-transporter::card.default>
                    <x-transporter::card.header>Oauth</x-transporter::card.header>

                    <div class="flex justify-end mt-4">
                        <x-transporter::links.button-info href="{{ $node->authUrl() }}" target="_blank">
                            <span>実行</span>
                        </x-transporter::links.button-info>
                    </div>
                </x-transporter::card.default>

            @endif
        </div>
    </div>
</x-transporter::layouts.app>
