<div class="flex items-center justify-between rounded-md py-8 mt-8 ml-8 bg-gray-800/80">
    <ul>
        <li>
            <x-transporter::sidebar.label>Transporter</x-transporter::sidebar.label>
        </li>
        <ul class="ml-4 mt-4">
            <li>
                <x-transporter::sidebar.link :href="route('transporter.connector.index')" :active="request()->routeIs('transporter.connector.*')">
                    <span class="material-symbols-outlined align-middle">share</span>
                    <span>{{ __('transporter::models.connector.table_name') }}</span>
                </x-transporter::sidebar.link>
            </li>
        </ul>
        <ul class="ml-4 mt-4">
            <li>
                <x-transporter::sidebar.link :href="route('transporter.node.index')" :active="request()->routeIs('transporter.node.*')">
                    <span class="material-symbols-outlined align-middle">line_start_circle</span>
                    <span>{{ __('transporter::models.node.table_name') }}</span>
                </x-transporter::sidebar.link>
            </li>
        </ul>
    </ul>
</div>
