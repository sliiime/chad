<?php

namespace App\Exceptions\Services;

use App\Exceptions\Exception400;

class MissingKeyException extends Exception400
{
    function __construct($key){
        parent::__construct("Container doesn't have attribute with key(s): $key");
    }

    public static function disjunction(...$keys){
        return new MissingKeyException(implode(' or ', $keys));
    }
}
