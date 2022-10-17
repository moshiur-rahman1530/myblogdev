<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function topics()
    {
        return $this->belongsTo('App\Models\Topic','topic_name','id');
    }
    public function users()
    {
        return $this->belongsTo('App\Models\User','blog_author','id');
    }

    public function comments(){
        return $this->hasMany('App\Models\Comment');
    }

    public function likes()
    {
        return $this->hasMany(Like::class,'blog_id');
    }
}
