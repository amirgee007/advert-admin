<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Ticket extends Model
{
    protected $table = 'tickets';
    protected $guarded = [];


    protected $LOW = 'low';
    protected $MEDIUM = 'medium';
    protected $HIGH = 'high';


    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function ScopeMyTickets($query){

        return $query->where('user_id', Auth::user()->id);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
