<div>
    <!-- Navigation Links -->
    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
        <x-jet-nav-link href="{{ route('customer_sku') }}" :active="request()->routeIs('customer_sku')">
            {{ __('Files/Uploads') }}
        </x-jet-nav-link>
        <x-jet-nav-link href="{{ route('customer_sku.all_data') }}" :active="request()->routeIs('customer_sku.all_data')">
            {{ __('All Data') }}
        </x-jet-nav-link>
    </div>
</div>