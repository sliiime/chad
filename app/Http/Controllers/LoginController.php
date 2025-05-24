<?php

namespace App\Http\Controllers;

use App\Domain\Services\Contracts\LoginServiceContract;
use App\Http\Requests\LoginRequest;

class LoginController extends Controller
{
    protected $loginService;

    public function __construct(LoginServiceContract $loginService){
        $this->loginService = $loginService;
    }

    public function login(LoginRequest $request){
        $user = $this->loginService->authenticatedUser($request->validated());

        if (is_null($user)){
            return response('Invalid credentials', 400);
        }

        return $this->loginService->success($user);
    }
}
