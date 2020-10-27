<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateFileBasicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_basics', function (Blueprint $table) {
            $table->id('fileID');
            $table->integer('uid')->comment('OA user id');
            $table->string('userid',16)->comment('wechatwork userid');
            $table->string('wechat_source',16)->comment("企业微信来源:JIEBEILI=>杰钡利,TECKLE=>德河, COMPRAME=>拉丁, GLOBAL=>金河");
            $table->string('cname',64)->comment('chinese name');
            $table->string('ename', 64)->comment('English name');
            $table->tinyInteger('status')->comment('status:0-待入职｜1-在职｜2-已离职');
            $table->date('hiredate')->comment('入职日期');
            $table->string('ID_CARD',18)->comment('身份证号');
            $table->string('sex',4)->comment('性别: F-女｜M-男');
            $table->date('birthdate')->comment('出生日期');
            $table->tinyInteger('marital_status')->comment('婚姻状态: 0-未婚｜1-已婚｜2-离异｜3-再婚');
            $table->tinyInteger('has_children')->comment('有无小孩: 0-无｜1-有,1个｜2-有,2个｜3-有,3个｜4-有,3个以上');
            $table->tinyInteger('company')->comment('公司名称：0-广州杰钡利贸易有限公司｜1-广州环朝商贸有限公司｜2-金河服务｜3-德河信息科技｜4-广州市拉丁互联网科技有限公司');
            $table->string('department',256)->comment('所在部门');
            $table->string('position',128)->comment('职位');
            $table->tinyInteger('position_level')->comment('级别: 0-员工｜1-组长｜2-主管｜3-部门经理｜4-总监｜5-CEO');
            $table->string('bank_name',256)->comment('员工工资卡所在的银行名称')->default('中国招商银行');
            $table->string('bank_card_num',18)->comment('银行卡号');
            $table->integer('social_insurance_base')->comment('购买社保基数');
            $table->integer('provident_fund_base')->comment('购买公积金基数')->default(2100);
            $table->integer('provivent_fund_rate')->comment('公积金购买比例百分比')->default(7);
            $table->integer('province_id')->comment('省份代码');
            $table->integer('city_id')->comment('城市代码');
            $table->integer('district_id')->comment('区县代码');
            $table->string('current_address')->comment('现居住地址');
            $table->string('luanguage',64)->comment('语言: 1-国语｜2-粤语｜3-英语｜4-其他');
            $table->string('QQ',32)->comment('QQ号或者QQ邮箱');
            $table->integer('phone')->comment('联系方式');
            $table->string('emegency_contact_relationship',16)->comment('紧急联系人关系');
            $table->string('emegency_contact_name',16)->comment('紧急联系人姓名');
            $table->integer('emegency_contact')->comment('紧急联系人联系方式');
            $table->index('uid');
            $table->index('userid');
            $table->index('wechat_source');
            $table->index('company');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE `file_basics` comment '员工基本资料表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('file_basics');
    }
}
