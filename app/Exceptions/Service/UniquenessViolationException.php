<?php

namespace App\Exceptions\Service;

use Exception;

class UniquenessViolationException extends Exception
{
    function __construct($attribute, $value){

      parent::__construct("$attribute with $value already exists");

    }

    public function render($request){
        return response()->json([
            'message' => $this->getMessage()
        ], 400);
    }
}
