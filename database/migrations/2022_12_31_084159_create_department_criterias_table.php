<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartmentCriteriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('department_criterias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('department_subcategory_id')->default(0);
            $table->unsignedBigInteger('criteria_id')->default(0);
            $table->integer('points')->default(0);
            $table->text('guidelines')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('department_criterias');
    }
}
