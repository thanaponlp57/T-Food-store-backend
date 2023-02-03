<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AlterUserRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $rowToBeInserts = [
            [
                'id' => 1,
                'role_id' => 1,
                'user_id' => 1
            ]
        ];

        DB::table('user_roles')->insert($rowToBeInserts);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('user_roles')->where('id', 1)->delete();
    }
}
