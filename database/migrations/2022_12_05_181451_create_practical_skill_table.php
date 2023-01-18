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
        Schema::create('practical_skill', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('practical_id');
            $table->unsignedBigInteger('skill_id');
            $table->unsignedBigInteger('added_by');
            $table->softDeletes();

            $table->foreign('practical_id')->references('id')->on('practicals');
            $table->foreign('skill_id')->references('id')->on('skills');
            $table->foreign('added_by')->references('id')->on('users');
            $table->unique(['practical_id','skill_id']);
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
        Schema::dropIfExists('practical_skill');
    }
};
