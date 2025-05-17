<?php

namespace App\Exceptions\Services;

use App\Exceptions\Exception400;
use Exception;

class UniquenessViolationException extends Exception400
{
    function __construct($attribute, $value){
      parent::__construct("$attribute with value '$value' already exists");

    }


}
