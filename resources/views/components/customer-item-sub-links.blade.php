<div>
    <!-- Navigation Links -->
    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
        <x-jet-nav-link href="{{ route('customer_items') }}" :active="request()->routeIs('customer_items')">
            {{ __('Files/Uploads') }}
        </x-jet-nav-link>
        <x-jet-nav-link href="{{ route('customer_items.all_data') }}" :active="request()->routeIs('customer_items.all_data')">
            {{ __('All Data') }}
        </x-jet-nav-link>
    </div>
</div>