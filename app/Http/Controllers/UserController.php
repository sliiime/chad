<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserServiceContract;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;

class UserController extends Controller
{


    protected UserServiceContract $userService;

    public function __construct(UserServiceContract $userService){
        $this->userService = $userService;
    }

    protected function index(){
        return $this->userService->index();
    }

    protected function show($id) {
        $this->userService->show($id);
    }

    protected function store(UserStoreRequest $request){
        return $this->userService->store($request->validated());
    }

    protected function update($id, UserUpdateRequest $request){

        return $this->userService->update($id, $request->validated());
    }
}
