<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterUserRequest;
use Core\UseCase\Users\RegisterUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function register(RegisterUserRequest $request)
    {
        $user = RegisterUser::execute(
            $request->name,
            $request->tenant_id,
            $request->email,
            $request->password
        );

        return response()->json(['message' => 'User register successful!', 'user' => $user], 201);
    }
}
