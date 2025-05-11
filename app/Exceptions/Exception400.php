<?php

namespace App\Exceptions;

use Exception;

class Exception400 extends Exception
{
    function __construct($message){
        parent::__construct($message);
    }

    public function render($request){
        return response()->json([
            'message' => $this->getMessage()
        ], 400);
    }
}
