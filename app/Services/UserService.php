<?php

namespace App\Services;

use App\Models\User;
use App\Services\UserServiceContract;
use Illuminate\Support\Facades\Hash;


class UserService implements UserServiceContract {

    public function index() { 
        return User::paginate();
    }

    protected static function notUniqueEmailResponse(){
        return response('Email already in use', 400);
    }

    protected static function notUniqueUsernameResponse(){
        return response('Username already in use', 400);
    }

    public function store($array) {

        $user = new User;
        
        if (!$this->isEmailUnique($array['email'])){
            return UserService::notUniqueEmailResponse();
        }

        if (!$this->isUsernameUnique($array['username'])){
            return UserService::notUniqueUsernameResponse();
        }

        $array['password'] = Hash::make($array['password']);

        $user->fill($array);

        $user->save();
        
        return $user;
    }

    public function show($id) {
        User::query()->findOrFail($id);
    }

    public function update($id, array $array) {
        $user = $this->resolveUser($id);

        if (isset($array['email']) && !$this->isEmailUnique($array['email'])){
            return UserService::notUniqueEmailResponse();
        }

        if (isset($array['username']) && !$this->isUsernameUnique($array['username'])){
            return UserService::notUniqueUsernameResponse();
        }

        $user->fill($array);

        $user->save();

        return $user;
    }

    protected function isEmailUnique(string $email){
        return 0 == User::query()->where('email', '=', $email)->count();
    }

    protected function isUsernameUnique(string $username){
        return 0 == User::query()->where('username', '=', $username)->count();
    }
    
    protected function resolveUser($user){
        return $user instanceof User ? $user : User::query()->findOrFail($user);
    }
}
