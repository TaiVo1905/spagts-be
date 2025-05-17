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
        //
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->string('image_key', 255)->nullable();
            $table->string('module', 50);
            $table->date('date');
            $table->text('description');
            $table->foreignId('student_id')->constrained('users');
            $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
