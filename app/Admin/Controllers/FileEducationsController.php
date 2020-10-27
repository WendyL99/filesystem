<?php

namespace App\Admin\Controllers;

use App\Admin\Models\FileBasics;
use App\Admin\Models\FileEducations;
use App\Models\Educations;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class FileEducationsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '教育程度';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new FileEducations());

        if($post = request('fileID')) {
            $grid->model()->ofBasics($post);
        }

        $grid->column('eduID', __('ID'));
        $grid->column('fileID', config('constants.CN.FILEID'));
        $grid->column('school_name', config('constants.CN.SCHOOL_NAME'));
        $grid->column('major_name', config('constants.CN.MAJOR_NAME'));
        $grid->column('education_background', config('constants.CN.EDUCATION_BACKGROUND'));
        $grid->column('graduate_date', config('constants.CN.GRADUATE_DATE'));
        $grid->column('awards', config('constants.CN.AWARDS'));
        $grid->column('created_at', config('constants.CN.CREATEDAT'));
        $grid->column('updated_at', config('constants.CN.UPDATEDAT'));

        $grid->filter(function ($filter){
            $filter->like('school_name',config('constants.CN.SCHOOL_NAME'));
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
        $show = new Show(FileEducations::findOrFail($id));

        //$show->field('eduID', __('ID'));
        $show->field('fileID', config('constants.CN.FILEID'));
        $show->field('school_name', config('constants.CN.SCHOOL_NAME'));
        $show->field('major_name', config('constants.CN.MAJOR_NAME'));
        $show->field('education_background', config('constants.CN.EDUCATION_BACKGROUND'));
        $show->field('graduate_date',config('constants.CN.GRADUATE_DATE'));
        $show->field('awards', config('constants.CN.AWARDS'));
        $show->field('created_at', config('constants.CN.CREATEDAT'));
        $show->field('updated_at', config('constants.CN.UPDATEDAT'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        //$form = new Form(new FileEducations());

        $form = new Form(new Educations());

        $form->text('fileID', config('constants.CN.FILEID'))
            ->options(FileBasics::all()->pluck('fileID', 'fileID'))
            ->value(request('fileID'));

        $form->text('school_name', config('constants.CN.SCHOOL_NAME'));
        $form->text('major_name', config('constants.CN.MAJOR_NAME'));
        $form->text('education_background', config('constants.CN.EDUCATION_BACKGROUND'));
        $form->date('graduate_date', config('constants.CN.GRADUATE_DATE'))->default(date('Y-m'));
        $form->textarea('awards', config('constants.CN.AWARDS'));

        return $form;
    }
}
