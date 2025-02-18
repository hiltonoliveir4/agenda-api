<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Exception;

class UserController extends Controller
{
    public function __construct(protected UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        try {
            $users = $this->userService->getAllUsers();
            return response()->json($users);
        } catch (Exception $e) {
            return response()->json(['error' => 'Unable to fetch users', 'message' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            $user = $this->userService->getUserById($id);
            return response()->json($user);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function store(UserRequest $request)
    {
        try {
            $request['password'] = bcrypt($request['password']);
            $user = $this->userService->createUser($request->all());

            return response()->json($user, 201);
        } catch (ValidationException $e) {
            return response()->json(['error' => 'Validation error', 'messages' => $e->errors()], 422);
        } catch (Exception $e) {
            return response()->json(['error' => 'Unable to create user', 'message' => $e->getMessage()], 500);
        }
    }

    public function update(UserRequest $request, $id)
    {
        try {
            $user = $this->userService->updateUser($id, $request->all());
            return response()->json($user);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function destroy($id)
    {
        try {
            $this->userService->deleteUser($id);
            return response()->json(['message' => 'User deleted']);
        } catch (Exception $e) {
            return response()->json(['error' => 'Unable to delete user', 'message' => $e->getMessage()], 500);
        }
    }
}
