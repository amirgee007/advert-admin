<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';
    protected $guarded = [];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
