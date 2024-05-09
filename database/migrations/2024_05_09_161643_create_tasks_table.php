<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('todo_id')->nullable(false);
            $table->string('title',50);
            $table->text('description')->nullable(true);
            $table->dateTime('start_date')->nullable(true);
            $table->dateTime('end_date')->nullable(false);
            $table->enum('status',['green','yellow','red'])->default('green');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('todo_id')->references('id')->on('todos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
