<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApprovalsTable extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::create('approvals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type');
            $table->unsignedBigInteger('type_id');
            $table->string('approver_type');
            $table->unsignedBigInteger('approver_id');
            $table->enum('status', [0,1,2]);
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
        Schema::dropIfExists('approvals');
    }
}
