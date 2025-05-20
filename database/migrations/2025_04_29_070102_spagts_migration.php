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
        // Systems
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('image_key', 50)->nullable();
            $table->string('email', 100)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('roles', ['Admin', 'Teacher', 'Student']);
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });

        Schema::create('cache', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->mediumText('value');
            $table->integer('expiration');
        });

        Schema::create('cache_locks', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->string('owner');
            $table->integer('expiration');
        });

        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('queue')->index();
            $table->longText('payload');
            $table->unsignedTinyInteger('attempts');
            $table->unsignedInteger('reserved_at')->nullable();
            $table->unsignedInteger('available_at');
            $table->unsignedInteger('created_at');
        });

        Schema::create('job_batches', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name');
            $table->integer('total_jobs');
            $table->integer('pending_jobs');
            $table->integer('failed_jobs');
            $table->longText('failed_job_ids');
            $table->mediumText('options')->nullable();
            $table->integer('cancelled_at')->nullable();
            $table->integer('created_at');
            $table->integer('finished_at')->nullable();
        });

        Schema::create('failed_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->text('connection');
            $table->text('queue');
            $table->longText('payload');
            $table->longText('exception');
            $table->timestamp('failed_at')->useCurrent();
        });
        Schema::create('personal_access_tokens', function (Blueprint $table) {
            $table->id();
            $table->morphs('tokenable');
            $table->string('name');
            $table->string('token', 64)->unique();
            $table->text('abilities')->nullable();
            $table->timestamp('last_used_at')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();
        });
        //Our schema
        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_id')->constrained('users');
            $table->string('name', 50);
            $table->timestamps();
        });

        Schema::create('modules', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->foreignId('teacher_id')->constrained('users');
            $table->timestamps();
        });

        Schema::create('class_module', function (Blueprint $table) {
            $table->id();
            $table->foreignId('class_id')->constrained('classes');
            $table->foreignId('module_id')->constrained('modules');
            $table->timestamps();
        });

        Schema::create('user_class', function (Blueprint $table) {
            $table->id();
            $table->foreignId('class_id')->constrained('classes');
            $table->foreignId('user_id')->constrained('users');
            $table->timestamps();
        });

        Schema::create('weekly_goals', function (Blueprint $table) {
            $table->id();
            $table->date('start_date');
            $table->date('end_date');
            $table->text('goal_content');
            $table->boolean('is_completed')->nullable();
            $table->foreignId('student_id')->nullable()->constrained('users');
            $table->enum('semester', [1, 2, 3, 4, 5, 6]);
            $table->timestamps();
        });

        Schema::create('self_study_plan', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable();
            $table->text('lesson_learned')->nullable();
            $table->integer('time_allocation')->nullable();
            $table->text('learning_resources')->nullable();
            $table->text('learning_activities')->nullable();
            $table->integer('concentration')->nullable();
            $table->text('follow_plan_reflection')->nullable();
            $table->text('evaluation')->nullable();
            $table->text('reinforcing_techniques')->nullable();
            $table->text('note')->nullable();
            $table->foreignId('module_id')->nullable()->constrained('modules');
            $table->foreignId('student_id')->nullable()->constrained('users');
            $table->enum('semester', [1, 2, 3, 4, 5, 6]);
            $table->timestamps();
        });

        Schema::create('in_class_plan', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable();
            $table->text('lesson_learned')->nullable();
            $table->integer('self_assessment')->nullable();
            $table->text('difficulties')->nullable();
            $table->text('plan_to_improve')->nullable();
            $table->boolean('problem_solved')->nullable();
            $table->foreignId('module_id')->nullable()->constrained('modules');
            $table->foreignId('student_id')->nullable()->constrained('users');
            $table->enum('semester', [1, 2, 3, 4, 5, 6]);
            $table->timestamps();
        });

        Schema::create('semester_goals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('modules_id')->constrained('modules');
            $table->foreignId('student_id')->constrained('users');
            $table->text('student_expected_course');
            $table->text('student_expected_teacher');
            $table->text('student_expected_themselves');
            $table->text('student_evaluation')->nullable();
            $table->text('teacher_evaluation')->nullable();
            $table->enum('semester', [1, 2, 3, 4, 5, 6]);
            $table->timestamps();
        });

        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->string('commentable_type', 50);
            $table->unsignedBigInteger('commentable_id');
            $table->string('field_name', 100);
            $table->integer('row');
            $table->foreignId('commenter_id')->constrained('users');
            $table->text('content');
            $table->timestamps();
        });

        Schema::create('replies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('comment_id')->constrained('comments');
            $table->foreignId('replier_id')->constrained('users');
            $table->text('content');
            $table->timestamps();
        });
        Schema::create('timetables', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->dateTime('start');
            $table->dateTime('end');
            $table->boolean('all_day')->default(false);
            $table->string('color')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->string('image_key', 255)->nullable();
            $table->string('module', 50);
            $table->date('date');
            $table->text('description');
            $table->foreignId('student_id')->constrained('users');
            $table->enum('semester', [1, 2, 3, 4, 5, 6]);
            $table->timestamps();
        });
}

    public function down(): void
    {
        Schema::dropIfExists('timetables');
        Schema::dropIfExists('replies');
        Schema::dropIfExists('comments');
        Schema::dropIfExists('semester_goals');
        Schema::dropIfExists('in_class_plan');
        Schema::dropIfExists('self_study_plan');
        Schema::dropIfExists('weekly_goals');
        Schema::dropIfExists('user_class');
        Schema::dropIfExists('class_module');
        Schema::dropIfExists('modules');
        Schema::dropIfExists('users');
        Schema::dropIfExists('certificates');
        Schema::dropIfExists('failed_jobs');
        Schema::dropIfExists('job_batches');
        Schema::dropIfExists('jobs');
        Schema::dropIfExists('cache_locks');
        Schema::dropIfExists('cache');
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('personal_access_tokens');
        Schema::dropIfExists('classes');
    }
};
