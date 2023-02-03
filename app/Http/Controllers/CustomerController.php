<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Authentication\Models\Customer;
use App\Modules\Authentication\Models\User;
use App\Modules\Authentication\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    protected $userRepository;

    public function __construct(
        UserRepository $userRepository
    ) {
        $this->userRepository = $userRepository;
    }


    public function show(Request $request, $id)
    {
        // $hashed = Hash::make('plain-text');
        // return ['reponse' => Hash::check('plain-text', $hashed)];

        $data = $this->userRepository->decodeToken($request->header('authorization'));

        return $data;

        // $user = User::find(1);
        // $roles = $user->roles;
        // return $roles;
        // return User::query()->where('id', $id)->first()->roles->first();


        return Customer::query()->where('id', $id)->first();
    }
}
