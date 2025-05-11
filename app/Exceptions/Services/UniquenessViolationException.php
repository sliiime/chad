<?php

namespace App\Exceptions\Services;

use Exception;

class UniquenessViolationException extends Exception
{
    function __construct($attribute, $value){
      parent::__construct("$attribute with $value already exists");

    }


}
