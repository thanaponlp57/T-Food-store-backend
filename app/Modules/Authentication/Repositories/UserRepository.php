<?php

namespace App\Modules\Authentication\Repositories;

use App\Modules\Authentication\Models\User;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTProvider;

class UserRepository
{
    public function getOne(
        string $username,
        string $password
    ): ?User {
        $user = User::query()->where('username', $username)->first();

        if ($user === null) return null;
        if (!Hash::check($password, $user['password'])) return null;

        return $user;
    }

    public function generateToken(User $user): string
    {
        $role = $user->roles->first();

        $userInfo = [
            'user' => [
                'id' => $user->id,
                'username' => $user->username,
            ],
            'role' => [
                'id' => $role->id,
                'name' => $role->name,
            ]
        ];

        $payload = [
            'iss' => env('APP_NAME'),
            'iat' => time(),
            'exp' => strtotime('+1 years', time()),
            'user' => base64_encode(json_encode($userInfo))
        ];

        return JWTProvider::encode($payload, env('JWT_SECRET'));
    }

    public function decodeToken(string $token): ?object
    {
        try {
            $credentials = JWTProvider::decode($token, env('JWT_SECRET'), ['HS256']);
            $base64 = $credentials['user'];
            $json = base64_decode($base64);
            $user = json_decode($json);
            return $user;
        } catch (\Exception $e) {
            return null;
        }
    }
}
