<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('appointments')) {

            Schema::dropIfExists('appointments');
            Schema::create('appointments', function (Blueprint $table) {
                $table->increments('id');
                $table->string('fullName');
                $table->string('phone');
                $table->string('email');
                $table->date('date');
                $table->integer('workingHour');
                $table->text('text');
                $table->integer('notification_type')->default(0);
                $table->integer('isActive')->default(0);
                $table->timestamps();


            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointments');
    }
}
