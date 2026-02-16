<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-4">Welcome to the Library Management System</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="bg-blue-100 p-4 rounded-lg shadow">
                            <h4 class="font-bold text-blue-800">Books</h4>
                            <p class="mt-2">Manage your book inventory.</p>
                            <a href="{{ route('books.index') }}" class="text-blue-600 hover:text-blue-800 font-bold mt-2 inline-block">Go to Books &rarr;</a>
                        </div>
                        
                        <div class="bg-green-100 p-4 rounded-lg shadow">
                            <h4 class="font-bold text-green-800">Members</h4>
                            <p class="mt-2">Manage library members.</p>
                            <a href="{{ route('members.index') }}" class="text-green-600 hover:text-green-800 font-bold mt-2 inline-block">Go to Members &rarr;</a>
                        </div>
                        
                        <div class="bg-purple-100 p-4 rounded-lg shadow">
                            <h4 class="font-bold text-purple-800">Circulation</h4>
                            <p class="mt-2">Borrow and return books.</p>
                            <a href="{{ route('circulation.index') }}" class="text-purple-600 hover:text-purple-800 font-bold mt-2 inline-block">Go to Circulation &rarr;</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
