<?php

namespace App\Exceptions;

use Exception;

class ContactNotFoundException extends Exception
{
    /**
     * Render the exception as an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function render($request)
    {

        return response()->json([
            'errors'=>[
                'code' => 404,
                'title' => 'Contact Not Found',
                'detail' => 'Unable to locate the Contact with the given information.'
            ]
        ], 404);
    }
}
