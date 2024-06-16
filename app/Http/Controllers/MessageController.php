<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMessageRequest;
use App\Models\Message;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMessageRequest $request)
    {
        // dd($request->ticket_id);
        $message = Message::create([
            'user_id' => auth()->user()->id,
            'ticket_id'=>$request->ticket_id,
            'message'=>$request->message
        ]);

        return response()->redirectTo(route('ticket.show', $request->ticket_id));
        
    }
    //

    /**
     * Display the specified resource.
     */
    public function show(Message $message)
    {
        // Assuming you want to retrieve the ticket associated with this message
        $ticket = Ticket::findOrFail($message->ticket_id);

        return view('ticket.show', compact('message', 'ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Message $message)
    {
        //
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Message $message)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message)
    {
        //
    }
}