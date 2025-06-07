<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
        public function up()
    {
        Schema::create('service_bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('cleaning_service_id')->constrained()->onDelete('cascade');
            $table->text('details')->nullable();
            $table->decimal('amount', 8, 2);
            $table->string('status')->default('pending'); // pending, assigned, completed
            $table->string('payment_status')->default('unpaid'); // unpaid, paid
            $table->string('ref_id')->nullable(); // eSewa reference
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
        Schema::dropIfExists('service_bookings');
    }
}
