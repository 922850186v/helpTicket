<x-app-layout>
    <div class="flex flex-col sm:justify-center items-center mt-6 pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900 m-6">
        <div class="flex justify-between w-full sm:max-w-2xl mt-6">
            <h1 class=" text-white text-lg font-bold">Ticket Details</h1>
            <a class="mx-3 pb-3" href="{{route('ticket.index', $ticket->id)}}">
                <x-primary-button>Back Home</x-primary-button>
            </a>
        </div>
        <div
            class="w-full sm:max-w-2xl mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg justify-center flex-col">
            <div class="table-responsive text-center">
                <h1 class="text-white text-lg font-bold">{{$ticket->title}}</h1>
                <table class="text-white table-auto w-full mt-3">
                    <thead>
                        <th>Id</th>
                        <th>Description</th>
                        @if( $ticket->attachment)
                        <th>Attachment</th>
                        @endif
                        <th>Created On</th>
                        <th>Status</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$ticket->id}}</td>
                            <td>{{$ticket->description}}</td>
                            @if( $ticket->attachment)
                            <td><a class="pt-1" href="{{"/storage/" . $ticket->attachment}}">Attachment</a></td>
                            @endif
                            <td>{{$ticket->created_at->format('m-d-Y')}}</td>
                            <td>{{$ticket->status}}</td>
                        </tr>
                    </tbody>
                </table>
                <div class="flex mt-6 justify-center">
                    @if ($ticket->status === 'Open')
                    <a href="{{route('ticket.edit', $ticket->id)}}">
                        <x-primary-button>Edit</x-primary-button>
                    </a>
                    <form class="ml-3 pb-3" action="{{route('ticket.destroy', $ticket->id)}}" method="post">
                        @method('delete')
                        @csrf
                        <x-primary-button>Delete</x-primary-button>
                    </form>
                    @else
                    <p class="text-white">Ticket is Closed.</p>
                    @endif
                    @if (auth()->user()->isAdmin && $ticket->status === 'Open')
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
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>