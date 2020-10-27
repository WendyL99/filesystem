<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateFileWorkExperienceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_work_experience', function (Blueprint $table) {
            $table->id('weID');
            $table->integer('fileID');
            $table->string('company_name')->comment('公司名称');
            $table->string('position')->comment('职位');
            $table->date('work_start_time')->comment('工作开始时间');
            $table->date('work_end_time')->comment('工作结束时间');
            $table->index('fileID');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE `file_work_experience` comment '员工工作经验表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('file_work_experience');
    }
}
