<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('languages', function (Blueprint $table) {
            $table->id();
            $table->string('name', 256);
        });

        DB::table('languages')->insert([
            ['name' => 'Crnogorski'],
            ['name' => 'Srpski'],
            ['name' => 'Bosanski'],
            ['name' => 'Hrvatski'],
            ['name' => 'Slovenski'],
            ['name' => 'Mađarski'],
            ['name' => 'Engleski'],
            ['name' => 'Francuski'],
            ['name' => 'Italijanski'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('languages');
    }
};
