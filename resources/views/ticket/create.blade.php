<x-app-layout>
    <div class="flex flex-col sm:justify-center items-center mt-6 pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900 m-6">
        <h1 class="text-white text-lg font-bold m-6">Create the Support Ticket</h1>
        <div class="w-full sm:max-w-md mt-6 px-6 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
            <form action="{{route('ticket.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mt-4 ">
                    <x-input-label for="title" :value="__('Title')" />
                    <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" autofocus />
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                </div>
                <div class="mt-4 ">
                    <x-input-label for="title" :value="__('Description')" />
                    <x-textarea placeholder="Fill the Description" id="description" name="description" />
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>
                <div class="mt-4 ">
                    <x-input-label for="title" :value="__('Attachment')" />
                    <x-file-input id="attachment" type="file" name="attachment"></x-file-input>
                    <x-input-error :messages="$errors->get('attachment')" class="mt-2" />
                </div>
                <div class="flex items-center justify-center mt-6 mb-6">
                    <x-primary-button class="ml-3">
                        Submit
                    </x-primary-button>
                </div>
            </form>
        </div>
</x-app-layout>