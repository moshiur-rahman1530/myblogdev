<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReplayComment extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function comment(){
        return $this->belongsTo('App\Models\Comment');
    }
    public function userdata(){
        return $this->belongsTo('App\Models\User','user_id');
    }
}
