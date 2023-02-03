<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AlterFoodTable1 extends Migration
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
                'name' => 'ผัดกระเพรา',
                'price' => 65.00
            ],
            [
                'id' => 2,
                'name' => 'ข้าวไข่เจียว',
                'price' => 40.00
            ],
            [
                'id' => 3,
                'name' => 'ยำวุ้นเส้น',
                'price' => 85.00
            ],
        ];

        DB::table('foods')->insert($rowToBeInserts);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('foods')->whereIn('id', [1, 2, 3])->delete();
    }
}
