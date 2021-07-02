<x-app-layout>
    <x-slot name="header">
        <x-customer-sku-sub-links />
    </x-slot>
    <div class="mt-2">
        <div class="max-w-9xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <livewire:page-files-sku-group />
            </div>
        </div>
    </div>
</x-app-layout>