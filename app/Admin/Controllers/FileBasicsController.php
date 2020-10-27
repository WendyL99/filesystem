<?php

namespace App\Admin\Controllers;

use App\Admin\Models\FileBasics;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class FileBasicsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '基本信息';

    protected $wechat_source = '';

    protected $department_options = array();

    protected $oa_base_uri = '';

    protected $oa_token = '';

    public function __construct()
    {
        $this->oa_base_uri = env('CSOA_BASE_URI');
        $this->oa_token = base64_encode(date("Ymd").env('CSOA_TOKEN_SALT'));

        $this->wechat_source = config('constants.OPTIONS.WECHAT_SOURCE_OPT');

//        $departments = getDepartmentList($this->oa_base_uri, $this->oa_token);  //var_dump($departments);die;
//        foreach ($departments as $row){
//            $this->department_options[$row['id']] = $row['text'];
//        }
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new FileBasics());

        $grid->column('cname',config('constants.CN.CNAME'));
        $grid->column('ename',config('constants.CN.ENAME'));
        $grid->column('department', config('constants.CN.DEPARTMENT'))->using($this->department_options);
        $grid->column('status',config('constants.CN.STATUS'))->using(config('constants.OPTIONS.STATUS_OPT'));

//        $grid->tools(function (Grid\Tools $tools){
//            $tools->append(new BasicsImportAction());
//        });

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(FileBasics::findOrFail($id));

        $show->field('uid', config('constants.CN.UID'));
        $show->field('userid', config('constants.CN.USERID'));
        $show->field('wechat_source', config('constants.CN.WECHAT_SOURCE'))->using(config('constants.OPTIONS.WECHAT_SOURCE_OPT'));
        $show->field('cname', config('constants.CN.CNAME'));
        $show->field('ename', config('constants.CN.ENAME'));
        $show->field('status', config('constants.CN.STATUS'))->using(config('constants.OPTIONS.STATUS_OPT'));
        $show->field('hiredate', config('constants.CN.HIREDATE'));
        $show->field('ID_CARD', config('constants.CN.ID_CARD'));
        $show->field('sex', config('constants.CN.SEX'))->using(config('constants.OPTIONS.SEX_OPT'));
        $show->field('birthdate', config('constants.CN.BIRTHDATE'));
        $show->field('marital_status', config('constants.CN.MARITAL_STATUS'))->using(config('constants.OPTIONS.MARITAL_STATUS_OPT'));
        $show->field('has_children', config('constants.CN.HAS_CHILDREN'))->using(config('constants.OPTIONS.CHILDREN_OPT'));
        $show->field('company', config('constants.CN.COMPANY'))->using(config('constants.OPTIONS.COMPANY_OPT'));
        $show->field('department', config('constants.CN.DEPARTMENT'))->using($this->department_options);
        $show->field('position', config('constants.CN.POSITION'));
        $show->field('position_level', config('constants.CN.POSITION_LEVEL'))->using(config('constants.OPTIONS.POSITION_LEVEL_OPT'));
        $show->field('bank_name', config('constants.CN.BANK_NAME'));
        $show->field('bank_card_num', config('constants.CN.BANK_CARD_NUM'));
        $show->field('social_insurance_base', config('constants.CN.SOCIAL_INSURANCE_BASE'));
        $show->field('provident_fund_base', config('constants.CN.PROVIDENT_FUND_BASE'));
        $show->field('provivent_fund_rate', config('constants.CN.PROVIVENT_FUND_RATE'));
        $show->field('province_id','省份')->as(function ($code){
            return getAreaNameByCode($code);
        });
        $show->field('city_id','城市')->as(function ($code){
            return getAreaNameByCode($code);
        });
        $show->field('district_id','区')->as(function ($code){
            return getAreaNameByCode($code);
        });
        $show->field('current_address', config('constants.CN.DETAIL_ADDRESS'));
        $show->field('luanguage', config('constants.CN.LUANGUAGE'))->as(function ($id){
            $options = config('constants.OPTIONS.LUANGUAGE_OPT');
            return parseCheckboxValue($id, $options);
        });
        $show->field('QQ', 'QQ');
        $show->field('phone', config('constants.CN.PHONE'));
        $show->field('emegency_contact_name', config('constants.CN.EMEGENCY_CONTACT_NAME'));
        $show->field('emegency_contact_relationship', config('constants.CN.EMEGENCY_CONTACT_RELATIONSHIP'));
        $show->field('emegency_contact', config('constants.CN.EMEGENCY_CONTACT'));

        $show->educations('教育程度',function ($education){
            $education->resource('/file/educations');

            $education->eduID('ID');
            $education->school_name(config('constants.CN.SCHOOL_NAME'));
            $education->major_name(config('constants.CN.MAJOR_NAME'));
            $education->education_background(config('constants.CN.EDUCATION_BACKGROUND'));
            $education->graduate_date(config('constants.CN.GRADUATE_DATE'));

            $education->disableCreateButton();
            $education->disablePagination();
            $education->disableFilter();
            $education->disableExport();
            $education->disableRowSelector();
            $education->disableColumnSelector();
        });

        $show->workexperience('工作经验', function ($line){
            $line->resource('/file/workexperience');

            $line->weID('ID');
            $line->company_name(config('constants.CN.COMPANY_NAME'));
            $line->position(config('constants.CN.POSITION'));
            $line->work_start_time(config('constants.CN.WORK_START_TIME'));
            $line->work_end_time(config('constants.CN.WORK_END_TIME'));

            $line->disableCreateButton();
            $line->disablePagination();
            $line->disableFilter();
            $line->disableExport();
            $line->disableRowSelector();
            $line->disableColumnSelector();
        });

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new FileBasics());

        $form->text('cname',config('constants.CN.CNAME'));
        $form->text('ename',config('constants.CN.ENAME'));
        $form->select('company',config('constants.CN.COMPANY'))->options(config('constants.OPTIONS.COMPANY_OPT'));
        $form->select('department',config('constants.CN.DEPARTMENT'))->options($this->department_options)->load('uid', '/userlist/get');
        $form->text('position',config('constants.CN.POSITION'));
        $form->select('position_level',config('constants.CN.POSITION_LEVEL'))->options(config('constants.OPTIONS.POSITION_LEVEL_OPT'));
        $form->select('status',config('constants.CN.STATUS'))->options(config('constants.OPTIONS.STATUS_OPT'));
        $form->date('hiredate',config('constants.CN.HIREDATE'));
        $form->select('sex',config('constants.CN.SEX'))->options(config('constants.OPTIONS.SEX_OPT'));
        $form->text('ID_CARD',config('constants.CN.ID_CARD'));
        $form->date('birthdate',config('constants.CN.BIRTHDATE'));
        $form->select('marital_status',config('constants.CN.MARITAL_STATUS'))->options(config('constants.OPTIONS.MARITAL_STATUS_OPT'));
        $form->select('has_children',config('constants.CN.HAS_CHILDREN'))->options(config('constants.OPTIONS.CHILDREN_OPT'));
        $form->text('bank_name',config('constants.CN.BANK_NAME'))->default('中国招商银行');
        $form->text('bank_card_num',config('constants.CN.BANK_CARD_NUM'));
        $form->text('social_insurance_base',config('constants.CN.SOCIAL_INSURANCE_BASE'));
        $form->number('provident_fund_base',config('constants.CN.PROVIDENT_FUND_BASE'))->default(2100);
        $form->select('provivent_fund_rate',config('constants.CN.PROVIVENT_FUND_RATE'))->options([7=>7,8=>8,9=>9,10=>10,11=>11,12=>12]);
        $form->distpicker(['province_id', 'city_id', 'district_id'], config('constants.CN.CURRENT_ADDRESS'));
        $form->text('current_address',config('constants.CN.DETAIL_ADDRESS'));
        $form->checkbox('luanguage',config('constants.CN.LUANGUAGE'))->options(config('constants.OPTIONS.LUANGUAGE_OPT'));
        $form->text('QQ',config('constants.CN.QQ'));
        $form->mobile('phone',config('constants.CN.PHONE'));
        $form->text('emegency_contact_name',config('constants.CN.EMEGENCY_CONTACT_NAME'));
        $form->text('emegency_contact_relationship',config('constants.CN.EMEGENCY_CONTACT_RELATIONSHIP'));
        $form->mobile('emegency_contact',config('constants.CN.EMEGENCY_CONTACT'));
        $form->select('uid',config('constants.CN.UID'))->options(function ($default){
            $params = request()->route()->parameters();
            if($params && !empty($params) && isset($params['basic'])){
                $basics = FileBasics::findOrFail($params['basic']);
                $results = getOAUserList($basics->department, $default);
                foreach ($results as $key => $row){
                    $options[$row['id']] = $row['text'];
                }

                return $options;
            }
        });
        $form->select('wechat_source',config('constants.CN.WECHAT_SOURCE'))
            ->options($this->wechat_source)
            ->load('userid','/wechatusers/get');
        $form->select('userid',config('constants.CN.USERID'))->options(function ($default){
            $params = request()->route()->parameters();
            if($params && !empty($params) && isset($params['basic'])){
                $basics = FileBasics::findOrFail($params['basic']);
                $options = getWechatUserList($basics->wechat_source, $default);

                return $options;
            }
        });

        return $form;
    }

    public function edit($id, Content $content)
    {
        return $content
            ->title('员工档案')
            ->description('基本信息')
            ->row($this->form()->edit($id))
            ->row(Admin::grid(Educations::class, function (Grid $grid) use ($id){
                $grid->setName('教育程度')
                    ->setTitle('教育程度')
                    ->setRelation(FileBasics::find($id)->Educations())
                    ->resource('/file/educations');

                $grid->eduID('ID');
                $grid->school_name(config('constants.CN.SCHOOL_NAME'));
                $grid->major_name(config('constants.CN.MAJOR_NAME'));
                $grid->education_background(config('constants.CN.EDUCATION_BACKGROUND'));
                $grid->graduate_date(config('constants.CN.GRADUATE_DATE'));
                //$grid->created_at()->date('Y-m-d H:i:s');
                //$grid->updated_at()->date('Y-m-d H:i:s');

                $grid->disableFilter();
                $grid->disableExport();
            }))
            ->row(Admin::grid(WorkExperience::class, function (Grid $grid) use ($id){
                $grid->setName('工作经验')
                    ->setTitle('工作经验')
                    ->setRelation(FileBasics::find($id)->Workexperience())
                    ->resource('/file/workexperience');

                $grid->weID('ID');
                $grid->company_name(config('constants.CN.COMPANY_NAME'));
                $grid->position(config('constants.CN.POSITION'));
                $grid->work_start_time(config('constants.CN.WORK_START_TIME'));
                $grid->work_end_time(config('constants.CN.WORK_END_TIME'));

                $grid->disableFilter();
                $grid->disableExport();
            }));
    }
}
