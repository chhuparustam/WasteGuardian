<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('workers', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->string('name')->notNull();
        $table->string('email')->notNull();
        $table->string('phone')->notNull();
        $table->string('address')->notNull();
        $table->string('specialization')->notNull();
        $table->string('photo')->notNull(); // <-- Remove ->after()
        $table->string('password')->notNull();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('workers', function (Blueprint $table) {
            $table->dropColumn('photo');
        });
    }
}
