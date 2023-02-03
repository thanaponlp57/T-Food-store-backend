<?php

use App\Modules\Authentication\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Hash;

class AlterUserTable1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $user = new User();
        $user->username = 'customer';
        $user->password = Hash::make('123456');
        $user->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        User::query()->where('username', 'customer')->delete();
    }
}
