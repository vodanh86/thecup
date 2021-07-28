<?php

namespace App\Admin\Controllers;

use App\Models\Comment;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class CommentController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Comment';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Comment());

        $grid->column('id', __('Id'));
        $grid->column('page_id', __('Page id'));
        $grid->column('verify', __('Verify'));
        $grid->column('user_id', __('User id'));
        $grid->column('comment', __('Comment'));
        $grid->column('avatar', __('Avatar'));
        $grid->column('name', __('Name'));
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
        $show = new Show(Comment::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('page_id', __('Page id'));
        $show->field('verify', __('Verify'));
        $show->field('user_id', __('User id'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('comment', __('Comment'));
        $show->field('avatar', __('Avatar'));
        $show->field('name', __('Name'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Comment());

        $form->number('page_id', __('Page id'));
        $form->number('verify', __('Verify'));
        $form->number('user_id', __('User id'));
        $form->text('comment', __('Comment'));
        $form->image('avatar', __('Avatar'));
        $form->text('name', __('Name'));

        return $form;
    }
}
