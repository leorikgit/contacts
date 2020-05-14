<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Exceptions\ContactNotFoundException;
use App\Exceptions\ValidationErrorException;
use http\Env\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Resources\Contact as contactResource;
use App\Http\Resources\ContactCollection as ContactCollection;
use Illuminate\Validation\ValidationException;


class ContactController extends Controller
{
    public function index(){
        $this->authorize('viewAny', Contact::class);

        return new ContactCollection(request()->user()->contacts);

    }
    public function store(){
        $this->authorize('create', Contact::class);

        $contact = request()->user()->contacts()->create($this->validateData());
        return (new contactResource($contact))->response()->setStatusCode(201);
    }
    public function show($id){

        try{
            $contact = Contact::findOrFail($id);
        }catch (ModelNotFoundException $e) {
            throw new ContactNotFoundException();
        }
        $this->authorize('view', $contact);

        return new contactResource($contact);

    }
    public function update(Contact $contact){

        $this->authorize('update', $contact);

        $contact->update($this->validateData());

        return (new contactResource($contact))->response()->setStatusCode(200);

    }
    public function destroy(Contact $contact){

        $this->authorize('delete', $contact);

        $contact->delete();
        return response()->json([], 204);
    }


    private function validateData(){

        try{
             return $data = request()->validate([
                 'name'      => 'required',
                 'email'     => 'required|email',
                 'birthday'  => 'required',
                 'company'    => 'required',
             ]);
        }catch(ValidationException $e){
            throw new ValidationErrorException(json_encode($e->errors()));
        }


    }
}
