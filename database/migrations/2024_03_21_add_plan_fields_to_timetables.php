<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('timetables', function (Blueprint $table) {
            $table->unsignedBigInteger('module_id')->nullable();
            $table->unsignedBigInteger('plan_id')->nullable();
            $table->enum('type', ['in_class', 'self_study'])->nullable();
            $table->integer('semester')->nullable();
            
            // Add foreign key constraints
            $table->foreign('module_id')->references('id')->on('modules')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('timetables', function (Blueprint $table) {
            $table->dropForeign(['module_id']);
            $table->dropColumn(['module_id', 'plan_id', 'type', 'semester']);
        });
    }
}; 