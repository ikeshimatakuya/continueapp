<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
        Schema::create('months', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('month_training_aim_start_at');
            $table->string('month_training_aim_finish_at');
            $table->string('month_training_aim');
            $table->string('month_training_aim_base');
            $table->string('month_training_aim_upper');
            $table->string('month_training_aim_lower');
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
        Schema::dropIfExists('months');
    }
};
