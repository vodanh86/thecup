<?php

namespace App\Admin\Controllers;

use App\Models\Plan;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class PlanController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Plan';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Plan());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('duration', __('Duration'));
        $grid->column('added_month', __('Added month'));
        $grid->column('price', __('Price'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

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
        $show = new Show(Plan::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('duration', __('Duration'));
        $show->field('added_month', __('Added month'));
        $show->field('price', __('Price'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Plan());

        $form->text('name', __('Tên gói'));
        $form->number('duration', __('Thời gian subscribe(Theo tháng)'));
        $form->number('added_month', __('Só tháng cộng thêm'));
        $form->currency('price', __('Giá'))->symbol('VND');

        return $form;
    }
}
