<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterTenancyRequest;
use App\Http\Requests\RegisterUserRequest;
use Core\Enums\Status;
use Core\UseCase\Tenancy\RegisterTenancy;
use Core\UseCase\Users\RegisterUser;

class RegisterController extends Controller
{
    public function registerUser(RegisterUserRequest $request)
    {
        $user = RegisterUser::execute(
            $request->name,
            $request->tenant_id,
            $request->email,
            $request->password
        );

        return response()->json(['message' => 'User register successful!', 'user' => $user], 201);
    }

    public function registerTenancy(RegisterTenancyRequest $request)
    {

        $tenancy = RegisterTenancy::execute(
            $request->name,
            $request->status == 'active' ? Status::ACTIVE : Status::INACTIVE
        );

        return response()->json(['message' => 'Tenancy register successful!', 'tenancy' => $tenancy], 201);
    }
}
