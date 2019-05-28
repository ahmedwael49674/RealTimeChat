<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statuses', function (Blueprint $table) {
            $table->integer('id');
            $table->string('name');
        });
        DB::table('statuses')->insert([
        ['id' => 1, 'name' => 'online'],['id' => 2, 'name' => 'away'],
        ['id' => 3, 'name' => 'busy'],['id' => 4, 'name' => 'offline']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('statuses');
    }
}
