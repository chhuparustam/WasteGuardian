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
<<<<<<< HEAD
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
=======
    {
        Schema::create('workers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('address');
            $table->string('specialization');
            $table->string('photo')->nullable();
            $table->string('password');
            $table->timestamps();
        });
    }
>>>>>>> 177629a868bc4dd03541ae756ddb6a331f1f9ece

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
