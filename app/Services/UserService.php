<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class UserService
{
    public function getAllUsers()
    {
        return Cache::remember('users', 60, function () {
            return User::all();
        });
    }

    public function getUserById($id)
    {
        try {
            return Cache::remember("user:$id", 60, function () use ($id) {
                return User::findOrFail($id);
            });
        } catch (ModelNotFoundException $e) {
            throw new Exception('User not found');
        }
    }

    public function createUser(array $validatedData)
    {
        $user = User::create($validatedData);
        Cache::forget('users');
        return $user;
    }

    public function updateUser($id, array $validatedData)
    {
        $user = User::findOrFail($id);
        $user->update($validatedData);

        Cache::forget("user:$id");
        Cache::forget('users');

        return $user;
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        Cache::forget("user:$id");
        Cache::forget('users');
    }
}
