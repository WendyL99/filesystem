<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateFileEducationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_educations', function (Blueprint $table) {
            $table->id('eduID');
            $table->integer('fileID');
            $table->string('school_name')->comment('毕业院校');
            $table->string('major_name')->comment('所读专业')->nullable();
            $table->string('education_background')->comment('学历');
            $table->date('graduate_date')->comment('毕业时间');
            $table->text('awards')->comment('获奖情况')->nullable();
            $table->index('fileID');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE `file_educations` comment '员工教育程度表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('file_educations');
    }
}
