<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('tasks', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->text('description')->nullable();
      $table->dateTime('due_date')->nullable();
      $table->enum('priority', ['high', 'medium', 'low'])->default('medium');
      $table->enum('status', ['pending', 'in_progress', 'completed', 'canceled'])->default('pending');
      $table->unsignedBigInteger('project_id')->nullable();
      //add this once the projects table is created
//      $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('tasks');
  }
};