<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function post(){
        return $this->belongsTo('App\Models\Blog');
    }
    public function users(){
        return $this->belongsTo('App\Models\User','user_id');
    }
    public function user(){
        return $this->belongsTo('App\Models\User','user_id');
    }
    public function replies(){
        return $this->hasMany('App\Models\ReplayComment')->whereNull('parent_id');
    }
    public function nestedreplies(){
        return $this->hasMany('App\Models\ReplayComment','comment_id')->whereNotNull('parent_id');
    }
}
