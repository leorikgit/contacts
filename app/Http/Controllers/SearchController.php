<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;
use App\Http\Resources\ContactCollection as contactResource;

class SearchController extends Controller
{
    public function index(){

        $data = request()->validate([
            'searchTerm' => 'required'
        ]);
        $contacts = Contact::search($data['searchTerm'])->where('user_id', request()->user()->id)->get();
        return new contactResource($contacts);
    }
}
