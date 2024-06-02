<x-app-layout>
    <div class="flex flex-col sm:justify-center items-center mt-6 pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900 m-6">
        <div class="flex justify-between w-full sm:max-w-xl mt-6">
            <h1 class="text-white text-lg font-bold ">Update Support Ticket</h1>
            <a class="" href="{{route('ticket.show', $ticket->id)}}">
                <x-primary-button class="my-3">
                    Back
                </x-primary-button>
            </a>
        </div>
        <div class="w-full sm:max-w-xl mt-6 px-6 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
            <form action="{{route('ticket.update', $ticket->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div class="mt-4 ">
                    <x-input-label for="title" :value="__('Title')" />
                    <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" autofocus
                        value="{{$ticket->title}}" />
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                </div>
                <div class="mt-4 ">
                    <x-input-label for="title" :value="__('Description')" />
                    <x-textarea placeholder="Fill the Description" id="description" name="description"
                        value="{{$ticket->description}}" />
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>
                <div class="mt-4 ">
                    @if( $ticket->attachment)
                    <a class="pt-1 text-white" href="{{'/storage/' . $ticket->attachment}}">Current Attachment</a>
                    @endif
                    <x-input-label for="title" :value="__('Attachment')" />
                    <x-file-input id="attachment" type="file" name="attachment"></x-file-input>
                    <x-input-error :messages="$errors->get('attachment')" class="mt-2" />
                </div>
                <div class="flex items-center justify-center mt-6 mb-6">
                    <x-primary-button class="ml-3">
                        Update
                    </x-primary-button>
                </div>
            </form>
        </div>
</x-app-layout>