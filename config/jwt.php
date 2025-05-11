<?php

use function PHPSTORM_META\map;

return [ 
    'key' => env('JWT_KEY', 'secret'),
    'jwt_ttl' => 60 * 60 * 24
];