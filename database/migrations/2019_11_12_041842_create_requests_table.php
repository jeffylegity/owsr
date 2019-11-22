<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
         $table->bigIncrements('id');
         $table->string('request_to');
         $table->integer('requestor');
         $table->string('request_id');
         $table->string('type_of_request');
         $table->string('area_of_request');
         $table->string('plant_designation'); 
         $table->string('model')->nullable();
         $table->string('ln_bn')->nullable();
         $table->string('request_concern');
         $table->string('route_to_supervisor');
         $table->string('route_to_manager');
         $table->string('attached_file')->nullable();
         $table->string('request_status');
         $table->boolean('supervisor_approval')->nullable();
         $table->boolean('manager_approval')->nullable();
         $table->dateTime('date_requested');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requests');
    }
}
