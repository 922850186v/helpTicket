<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Models\Message;
use App\Notifications\TicketUpdateNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(User $user, Ticket $ticket)
    {
        $user = auth()->user();
        // dd($user = auth()->user()->isAdmin);
        $tickets = $user->isAdmin ? Ticket::latest()->get() : $user->tickets;

        return view('ticket.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ticket.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTicketRequest $request)
    {
        $ticket = Ticket::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => Auth::id()
        ]);

        if ($request->file('attachment')) {
            $this->storeAttachment($request, $ticket);
        }

        return response()->redirectTo(route('ticket.index', $ticket->id));
    }
    /**
     * Display the specified resource.
     */
    public function show(User $user, Ticket $ticket, Message $message)
    {
        $user = auth()->user();
        $statusChangedUserName = '';

        $getAllMessagesinTicket = $ticket->messages()
        ->with(['user:id,name'])
        ->orderBy('updated_at','asc')
        ->get();

        if($ticket->status_changed_by_id){
            $statusChangedUserName = $ticket->statusChangedUser()
            ->select('users.name')
            ->first()->name;
        }

        $ticketUpdatedAt = $ticket->updated_at;        
        
        return view('ticket.show', compact('ticket','getAllMessagesinTicket', 'statusChangedUserName','ticketUpdatedAt'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        return view('ticket.edit', compact('ticket'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTicketRequest $request, Ticket $ticket)
    {
        // dd($request);
        $ticket->update($request->except('attachment'));
        
        if ($request->has('status')) {
            $ticket->update(['status_changed_by_id' => auth()->user()->id]);
           $ticket->user->notify(new TicketUpdateNotification($ticket));
        }
        if ($request->hasFile('attachment')) {
            if($ticket->attachment && Storage::disk('public')->exists($ticket->attachment)){
                Storage::disk('public')->delete($ticket->attachment);
            }
            $this->storeAttachment($request, $ticket);
        }
        return redirect(route('ticket.show',$ticket->id));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        // $ticket->delete();
        return redirect(route('ticket.index'));
    }

    protected function storeAttachment($request, $ticket)
    {
        $ext = $request->file('attachment')->extension();
        $contents = file_get_contents($request->file('attachment'));
        $filename = Str::random(15);
        $path = "attachments/$filename.$ext";

        Storage::disk('public')->put($path, $contents);
        $ticket->update(['attachment' => $path]);
    }

        /**
     * Show messages related to a specific ticket.
     */
    // public function showMessages($ticketId)
    // {
    //     // Retrieve the authenticated user
    //     $user = auth()->user();

    //     // Retrieve messages related to the specified ticket ID for the authenticated user
    //     $messages = $user->messages->whereHas('ticket', function ($query) use ($ticketId) {
    //         $query->where('id', $ticketId);
    //     })->get();

    //     return view('ticket.messages', compact('messages'));
    // }
}