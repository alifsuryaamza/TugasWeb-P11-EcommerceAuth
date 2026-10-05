<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Admin Panel</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 grid grid-cols-3 gap-4">
            @foreach ($stats as $label => $total)
                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <p class="text-gray-500">{{ $label }}</p>
                    <p class="text-3xl font-bold">{{ $total }}</p>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>