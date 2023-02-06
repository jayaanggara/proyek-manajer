<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('project_name',50);
            $table->text('project_description')->nullable();
            $table->string('logo');
            $table->string('status',50);
            $table->foreignId('user')->unsigned();
            $table->foreignId('client')->unsigned();            
            $table->date('start_date');
            $table->date('end_date');
            $table->string('site',50);
            $table->string('company_name',50);
            $table->foreignId('template_id')->nullable()->unsigned();
            $table->timestamps();
            
            $table->foreign('user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('client')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
