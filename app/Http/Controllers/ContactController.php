<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Exceptions\ContactNotFoundException;
use http\Env\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Resources\Contact as contactResource;
class ContactController extends Controller
{

    public function index(){
        return request()->user()->contacts;
    }
    public function store(){


        request()->user()->contacts()->create($this->validateData());
    }
    public function show($id){

        try {
            $contact = Contact::findOrFail($id);
        }catch (ModelNotFoundException $e) {
            throw new ContactNotFoundException();
        }

        if(request()->user()->isNot($contact->user)){

            return response([], 403);
        }

        return new contactResource($contact);

    }
    public function update(Contact $contact){

        if(request()->user()->isNot($contact->user)){
            return response([], 403);
        }
        $contact->update($this->validateData());

        return new contactResource($contact);

    }
    public function destroy(Contact $contact){

        if(request()->user()->isNot($contact->user)){
            return response([], 403);
        }

        $contact->delete();
        return response()->json([], 204);
    }
    private function validateData(){
        return $data = request()->validate([
            'name'      => 'required',
            'email'     => 'required|email',
            'birthday'  => 'required',
            'company'    => 'required',
        ]);
    }
}
