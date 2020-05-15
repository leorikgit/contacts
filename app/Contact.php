<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Contact extends Model
{
    use Searchable;

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
    public function scopeBirthdays($query){
        return $query->where('birthday', 'like', '%-'.now()->format('m').'-%');
    }
}
