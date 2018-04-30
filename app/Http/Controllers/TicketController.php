<?php

namespace App\Http\Controllers;

use App\Model\Comment;
use App\Model\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){


        $tickets = Ticket::MyTickets()->get();

        $urgent = $tickets->where('priority' ,'high')->where('status' ,'open')->count();
        $open =  $tickets->where('status' ,'open')->count();
        $closed =  $tickets->where('status' ,'closed')->count();
        $total = $tickets->count();
        $comments = Comment::count();

        return view('tickets.index' ,compact('tickets' ,'comments','urgent' ,'open' ,'closed' ,'total'));
    }

    public function create(){
        return view('tickets.create');
    }

    public function show($ticket_id)
    {
        $ticket = Ticket::where('id', $ticket_id)->firstOrFail();
        $comments = $ticket->comments;
        return view('tickets.show', compact('ticket' ,'comments'));
    }

    public function save(Request $request)
    {
        $this->validate($request, [
            'subject'     => 'required',
            'priority'  => 'required',
            'content'   => 'required'
        ]);

        $ticket = new Ticket([
            'subject'     => $request->input('subject'),
            'user_id'   => Auth::user()->id,
            'priority'  => $request->input('priority'),
            'content'   => $request->input('content'),
            'status'    => "open",
        ]);

        $ticket->save();

        return redirect()->back()->with("status", "A ticket with ID: #$ticket->id has been opened.");
    }


    public function close($ticket_id)
    {
        $ticket = Ticket::where('id', $ticket_id)->update(['status' => 'closed']);
        return redirect()->back()->with("status", "A ticket with ID: #$ticket_id has been marked as Resolved.");

    }


    public function urgent($ticket_id)
    {
        $ticket = Ticket::where('id', $ticket_id)->update(['priority' => 'high']);

        return redirect()->back()->with("danger", "A ticket with ID: #$ticket_id has been updated as URGENT.");

    }


}
