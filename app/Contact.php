<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $guarded = [];
    protected $dates = ['birthday'];

    public function SetBirthdayAttribute($Birthday){

        $this->attributes['birthday'] = Carbon::parse($Birthday);
    }
    public function path(){
        return '/contacts/'. $this->id;
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
