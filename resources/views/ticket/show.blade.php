<x-app-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
        <div class="flex sm:justify-between">
            <h1 class="text-white text-lg font-bold">{{$ticket->title}}</h1>

        </div>
        <div
            class="w-full sm:max-w-xl mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg justify-center flex-col">
            <div class="text-white flex justify-between py-4">
                <p class="pt-1">{{$ticket->description}}</p>
                <p class="pt-1">{{$ticket->created_at->format('m-d-Y')}}</p>
                @if( $ticket->attachment)
                <a class="pt-1" href="{{'/storage/' . $ticket->attachment}}">Attachment</a>
                @endif
            </div>
            <div class="flex justify-between">
                <p class="text-white justify-end py-2">Status: {{$ticket->status}}</p>
                @if ($ticket->status === 'Open')
                <div class="flex m-4">
                    <a href="{{route('ticket.edit', $ticket->id)}}">
                        <x-primary-button>Edit</x-primary-button>
                    </a>
                    <form class="ml-3 pb-3" action="{{route('ticket.destroy', $ticket->id)}}" method="post">
                        @method('delete')
                        @csrf
                        <x-primary-button>Delete</x-primary-button>
                    </form>
                    @else
                    <a class="ml-3 pb-3" href="{{route('ticket.index', $ticket->id)}}">
                        <x-primary-button>Back Home</x-primary-button>
                    </a>
                    @endif
                </div>
                @if (auth()->user()->isAdmin && $ticket->status === 'Open')
                <div class="flex m-2">
                    <form class="ml-3 pb-3" action="{{route('ticket.update', $ticket->id)}}" method="post">
                        @csrf
                        @method('patch')
                        <input type="hidden" name="status" value="Approved">
                        <x-primary-button>Approve</x-primary-button>
                    </form>
                    <form class="ml-2 pb-3" action="{{route('ticket.update', $ticket->id)}}" method="post">
                        @csrf
                        @method('patch')
                        <input type="hidden" name="status" value="Rejected">
                        <x-primary-button class="ml-3">Reject</x-primary-button>
                    </form>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>