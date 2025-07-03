<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterServiceBookingAddDateTime extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('service_bookings', function (Blueprint $table) {
            $table->date('booking_date')->nullable();
            $table->time('booking_time')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('service_bookings', function (Blueprint $table) {
            //
        });
    }
}
