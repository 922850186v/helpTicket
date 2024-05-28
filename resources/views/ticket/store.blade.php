<x-app-layout>
    <div
        class="w-full sm:max-w-md mt-6 px-6 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg justify-center flex-col">
        Your
        Tickets:
        <table>
            <thead>
                <th>Ticket ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Status</th>
            </thead>
            <tbody>
                @foreach(DB::table('tickets')->where('user_id', Auth::id())->get() as $ticket)
                <tr>
                    <td>{{ htmlspecialchars($ticket->id) }}</td>
                    <td>{{ htmlspecialchars($ticket->title) }}</td>
                    <td>{{ htmlspecialchars($ticket->description) }}</td>
                    <td>{{ htmlspecialchars($ticket->status) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>