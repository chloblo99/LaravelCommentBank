<x-app-layout>
    <x-slot name='header'>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ _('Conclusion')}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                <table>
                    <head>
                        <th>#</th>
                        <th>Comment</th>
                        </head>
                        <body>
                            Hi there
                            <!-- @foreach($list as $conclusion)
                            <tr><td>{{ $conclusion->id }}</td><td>{{ $conclusion->comment }}</td></tr>
                            @endforeach -->
                        </body>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>



<!-- To get the conclusion comment bank
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('commentBank.conclusion')" :active="request()->routeIs('commentBank.conclusion')">
                        {{ __('Conclusion') }}
                    </x-nav-link>
                </div>
                -->