<?php

namespace App\Admin\Controllers;

use App\Admin\Models\FileBasics;
use App\Admin\Models\FileWorkExperience;
use App\Models\WorkExperience;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class FileWorkExperienceController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '工作经历';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new FileWorkExperience());

        if($post = request('fileID')) {
            $grid->model()->ofBasics($post);
        }

        $grid->column('fileID', config('constants.CN.FILEID'));
        $grid->column('company_name', config('constants.CN.COMPANY_NAME'));
        $grid->column('position', config('constants.CN.POSITION'));
        $grid->column('work_start_time', config('constants.CN.WORK_START_TIME'));
        $grid->column('work_end_time', config('constants.CN.WORK_END_TIME'));

        $grid->filter(function ($filter){
            $filter->like('company_name',config('constants.CN.COMPANY_NAME'));
        });

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
        $show = new Show(FileWorkExperience::findOrFail($id));

        $show->field('fileID',config('constants.CN.FILEID'));
        $show->field('company_name', config('constants.CN.COMPANY_NAME'));
        $show->field('position', config('constants.CN.POSITION'));
        $show->field('work_start_time', config('constants.CN.WORK_START_TIME'));
        $show->field('work_end_time', config('constants.CN.WORK_END_TIME'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        //$form = new Form(new FileWorkExperience());

        $form = new Form(new WorkExperience());

        $form->text('fileID', config('constants.CN.FILEID'))
            ->options(FileBasics::all()->pluck('fileID', 'fileID'))
            ->value(request('fileID'));

        $form->text('company_name',config('constants.CN.COMPANY_NAME'));
        $form->text('position', config('constants.CN.POSITION'));
        $form->date('work_start_time', config('constants.CN.WORK_START_TIME'));
        $form->date('work_end_time', config('constants.CN.WORK_END_TIME'));

        return $form;
    }
}
