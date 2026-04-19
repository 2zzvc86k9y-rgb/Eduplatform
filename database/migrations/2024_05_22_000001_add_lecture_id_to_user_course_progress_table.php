<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('user_course_progress', function (Blueprint $table) {
            if (!Schema::hasColumn('user_course_progress', 'lecture_id')) {
                $table->unsignedBigInteger('lecture_id')->after('course_id')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('user_course_progress', function (Blueprint $table) {
            if (Schema::hasColumn('user_course_progress', 'lecture_id')) {
                $table->dropColumn('lecture_id');
            }
        });
    }
}; 