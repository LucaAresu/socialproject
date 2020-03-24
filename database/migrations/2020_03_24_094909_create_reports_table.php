<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->unsignedBigInteger('reportable_id');
            $table->string('reportable_type');
            $table->unsignedBigInteger('reporter');
            $table->unsignedBigInteger('reported');
            $table->primary(['reporter','reportable_id','reportable_type']);
            $table->foreign('reporter')->references('id')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('reported')->references('id')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reports');
    }
}
