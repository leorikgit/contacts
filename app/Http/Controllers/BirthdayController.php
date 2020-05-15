<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\ContactCollection as birthdayCollection;
class BirthdayController extends Controller
{
    public function index(){
       $contact = \request()->user()->contacts()->birthdays()->get();
//       dd($contact);
        return new birthdayCollection($contact);
    }
}
