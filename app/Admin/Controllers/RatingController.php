<?php

namespace App\Admin\Controllers;

use App\Models\Rating;
use App\Models\Page;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class RatingController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Rating';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Rating());

        $grid->column('id', __('Id'));
        $grid->column('page.title', __('Bài viết'));
        $grid->column('total', __('Tổng số điểm'));
        $grid->column('number', __('Số lượt rate'));
        $grid->column('trung bình ')->display(function () {
            if ($this->number == 0){
                return 0;
            } else {
                return $this->total / $this->number;
            };
        });
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
        $show = new Show(Rating::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('page_id', __('Page id'));
        $show->field('total', __('Total'));
        $show->field('number', __('Number'));
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
        $form = new Form(new Rating());
        $form->select('page_id', __('Bài viết '))->options(Page::all()->pluck('title', 'id'));
        $form->number('total', __('Total'));
        $form->number('number', __('Number'));

        return $form;
    }
}
