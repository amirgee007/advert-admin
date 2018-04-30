<?php

namespace App\Http\Controllers;

use App\Model\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    public function postComment(Request $request)
    {
        $this->validate($request, [
            'content'   => 'required'
        ]);


        $comment = Comment::create([
            'ticket_id' => $request->input('ticket_id'),
            'user_id'   => Auth::user()->id,
            'content'   => $request->input('content'),
        ]);


        return redirect()->back()->with("status", "Your comment has be submitted.");
    }

}
