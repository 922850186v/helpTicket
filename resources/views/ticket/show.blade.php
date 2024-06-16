<x-app-layout>
    <div class="flex flex-col sm:justify-center items-center mt-6 pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900 m-6">
        <div class="flex justify-between w-full sm:max-w-2xl mt-6">
            <h1 class="text-white text-lg font-bold">Ticket Details</h1>
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
                            <td><a class="pt-1" href="{{"/storage/" . $ticket->attachment}}">Document</a></td>
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
        <div class="w-full sm:max-w-2xl mt-6">
            @if ($getAllMessagesinTicket->count()>0)
            <div
                class="text-white w-full sm:max-w-2xl mt-2 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg justify-center flex-col">
                <table class="columns-3">
                    @foreach ($getAllMessagesinTicket as $message)
                    <tr class="m-auto">
                        <td class="float-right px-4">{{$message->name}} :</td>
                        <td class="pl-1"><b>{{$message->message}}</b></td>
                        <td class="px-6">{{$message->updated_at}}</td>
                    </tr>
                    @endforeach
                </table>
            </div>
            @else
            <div
                class="text-white w-full sm:max-w-2xl mt-2 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg text-center flex-col">
                <p>No Messages.</p>
            </div>
            @endif
            <!-- <p class="text-white float-right">You : <i>{{auth()->user()->message}}</i></p> -->

            @if ($ticket->status === 'Open')
            @if (auth()->user()->isAdmin)
            <form class="mt-6" action="{{route('message.store', $ticket->id)}}" method="post">
                @csrf
                @method('post')
                <p class=" text-white text-lg font-bold">Send Message to User</p>
                <div class="mt-4 ">
                    <x-input-label for="message" />
                    <x-textarea placeholder="Type your message" id="message" name="message" value="" />
                    <x-input-error :messages="$errors->get('message')" class="mt-2" />
                    <input type="hidden" name="ticket_id" value={{$ticket->id}}>
                </div>
                <div class="flex mt-2 mb-6">
                    <x-primary-button class="">
                        Send
                    </x-primary-button>
                </div>
            </form>
        </div>
        @else
        <div class="w-full sm:max-w-2xl mt-6">
            <form class="mt-6" action="{{route('message.store', $ticket->id)}}" method="post">
                @csrf
                @method('post')
                <p class=" text-white text-lg font-bold">Send Message to Admin</p>
                <div class="mt-4 ">
                    <x-input-label for="message" />
                    <x-textarea placeholder="Type your message" id="message" name="message" value="" />
                    <x-input-error :messages="$errors->get('message')" class="mt-2" />
                    <input type="hidden" name="ticket_id" value={{$ticket->id}}>
                </div>
                <div class="flex mt-2 mb-6">
                    <x-primary-button class="">
                        Send
                    </x-primary-button>
                </div>
            </form>
        </div>
        @endif
        @endif
    </div>
</x-app-layout>