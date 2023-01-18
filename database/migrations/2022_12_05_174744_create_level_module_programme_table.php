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
        Schema::create('level_module_programme', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('level_id');
            $table->unsignedBigInteger('module_id');
            $table->unsignedBigInteger('programme_id');
            $table->unsignedBigInteger('added_by');
            $table->timestamps();

            $table->foreign('level_id')->references('id')->on('levels');
            $table->foreign('module_id')->references('id')->on('modules');
            $table->foreign('programme_id')->references('id')->on('programmes');
            $table->foreign('added_by')->references('id')->on('users');
            $table->unique(['module_id','programme_id'],'level_module_programme_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('level_module_programme');
    }
};
