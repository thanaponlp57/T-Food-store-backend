<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AlterRolesTable1 extends Migration
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
                'name' => 'customer'
            ],
            [
                'id' => 2,
                'name' => 'store'
            ]
        ];

        DB::table('roles')->insert($rowToBeInserts);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('roles')->whereIn('id', [1, 2])->delete();
    }
}
