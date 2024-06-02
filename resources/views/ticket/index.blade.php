<x-app-layout>
    <div
        class="min-h-screen flex flex-col w-full sm:justify-center sm:ml-auto items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
        <div class="flex justify-between w-full sm:max-w-lg">
            @if (auth()->user()->isAdmin)
            <h1 class="text-white text-lg font-bold">Review Support Tickets</h1>
            @else
            <h1 class="text-white text-lg font-bold">Your Support Tickets</h1>
            @endif
            <div>
                <a href="{{ route('ticket.create') }}" class="bg-white rounded-lg p-2">Create New</a>
            </div>
        </div>
        <div
            class="text-white text-center sm:justify-center items-center sm:min-w-xl mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
            <div class="table-responsive">
                @if (count($tickets))
                <table class="table-auto w-full">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">Id</th>
                            <th class="px-4 py-2">Title</th>
                            @if (auth()->user()->isAdmin)
                            <th class="px-4 py-2">User</th>
                            @endif
                            <th class="px-4 py-2">Status</th>
                            <th class="px-4 py-2">Updated</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tickets as $ticket)
                        <tr>
                            <td class="px-4 py-2">{{$ticket->id}}</td>
                            <td class="px-4 py-2"><a
                                    href="{{ route('ticket.show', $ticket->id) }}">{{ $ticket->title }}</a></td>
                            @if (auth()->user()->isAdmin)
                            <td class="px-4 py-2">{{$ticket->user->name}}
                            </td>
                            @endif
                            <td class="px-4 py-2">{{$ticket->status}}</td>
                            <td class="px-4 py-2">{{ $ticket->updated_at->diffForHumans() }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <p colspan="3" class="px-4 py-2 text-center text-white">You don't have any support ticket
                    yet.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>