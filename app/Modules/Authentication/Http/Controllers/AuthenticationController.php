<?php

namespace App\Modules\Authentication\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Authentication\Repositories\UserLogonRepository;
use App\Modules\Authentication\Repositories\UserRepository;
use Illuminate\Http\Request;

class AuthenticationController  extends Controller
{
    protected $userRepository;
    protected $userLogonRepository;

    public function __construct(
        UserRepository $userRepository,
        UserLogonRepository $userLogonRepository
    ) {
        $this->userRepository = $userRepository;
        $this->userLogonRepository = $userLogonRepository;
    }

    public function login(Request $request)
    {
        $user = $this->userRepository->getOne(
            $request->input('username'),
            $request->input('password')
        );
        if (!$user) return response()->json(['msg' => 'Invalid username or password'], 400);

        $token = $this->userRepository->generateToken($user);
        $this->userLogonRepository->create($user->id, $token);
        return response()->json(['msg' => 'Successfully logged in', 'token' => $token]);
    }

    public function logout(Request $request)
    {
        $userLogon = $this->userLogonRepository->getOne($request->header('authorization'));
        if (!$userLogon) return response()->json(['msg' => 'Token not found']);

        $this->userLogonRepository->delete($userLogon->id);
        return response()->json(['msg' => 'Successfully logged out']);
    }
}
