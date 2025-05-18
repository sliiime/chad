<?php

namespace App\Services\Implementations;

use App\Domain\Models\User;
use App\Exceptions\Services\UniquenessViolationException;
use App\Services\Contracts\UserServiceContract;
use Illuminate\Support\Facades\Hash;


class UserService implements UserServiceContract {

    public function index() {
        return User::paginate();
    }

    public function store($array) {

        $user = new User;
        $this->uniqueUsernameValidation($array['username']);
        $this->uniqueEmailValidation($array['email']);
        //Even the complexity of the password can be checked here.
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

        if (isset($array['email'])){
            $this->uniqueEmailValidation($array['email']);
        }

        if (isset($array['username'])){
            $this->uniqueUsernameValidation($array['username']);
        }

        $user->fill($array);

        $user->save();

        return $user;
    }

    protected function uniqueEmailValidation(string $email){
        if (!$this->isEmailUnique($email)){
            throw new UniquenessViolationException('email', $email);
        }
    }

    protected function uniqueUsernameValidation(string $username){
        if (!$this->isUsernameUnique($username)){
            throw new UniquenessViolationException('username', $username);
        }
    }

    protected function isEmailUnique(string $email){
        return !User::query()->where('email', '=', $email)->exists();
    }

    protected function isUsernameUnique(string $username){
        return !User::query()->where('username', '=', $username)->exists();
    }

    protected function resolveUser($user){
        return $user instanceof User ? $user : User::query()->findOrFail($user);
    }
}
