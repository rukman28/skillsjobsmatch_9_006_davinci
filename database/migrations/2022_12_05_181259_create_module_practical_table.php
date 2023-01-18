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
        Schema::create('module_practical', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('module_id');
            $table->unsignedBigInteger('practical_id');
            $table->unsignedBigInteger('added_by');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('module_id')->references('id')->on('modules');
            $table->foreign('practical_id')->references('id')->on('practicals');
            $table->foreign('added_by')->references('id')->on('users');
            $table->unique(['module_id','practical_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('module_practical');
    }
};
