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
        Schema::create('trainings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('training_year');
            $table->string('training_month');
            $table->string('training_start_at');
            $table->string('training_finish_at');
            $table->string('training_aim');
            $table->string('training_aim_base');
            $table->string('training_aim_upper');
            $table->string('training_aim_lower');
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
        Schema::dropIfExists('trainings');
    }
};
