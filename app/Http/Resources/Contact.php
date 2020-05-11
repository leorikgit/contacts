<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Contact extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => [
                'type' => 'contacts',
                'contact_id' => $this->id,
                'attributes' => [
                    'name' => $this->name,
                    'email' => $this->email,
                    'birthday' => $this->birthday->format('m/d/Y'),
                    'company' => $this->company
                ]
            ],
            'links' => [
                'self' => $this->path()
            ]
        ];
    }
}
