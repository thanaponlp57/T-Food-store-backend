<?php

namespace App\Modules\Authentication\Repositories;

use App\Modules\Authentication\Models\UserLogon;

class UserLogonRepository
{
    public function create(
        int $userId,
        string $token
    ): void {
        $userLogon = new UserLogon();
        $userLogon->user_id = $userId;
        $userLogon->token = $token;
        $userLogon->save();
    }

    public function getOne($token): ?UserLogon
    {
        return UserLogon::query()->where('token', $token)->first();
    }

    public function delete(int $id): void
    {
        UserLogon::query()->where('id', $id)->delete();
    }
}
