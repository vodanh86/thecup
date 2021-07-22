<?php

namespace App\Admin\Controllers;

use App\Models\Author;
use App\Models\AuthUser;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class AuthorController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Author';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Author());

        $grid->column('id', __('Id'));
        $grid->column('title', __('Nghệ danh'));
        $grid->column('avatar', __('Avatar'))->image(url(env("AWS_URL")), 50, 50);
        $grid->column('birth_date', __('Birth date'));
        $grid->column('quote', __('Quote'));
        $grid->column('admin_user.username', __('Tên tài khoản'));
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
        $show = new Show(Author::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('title', __('Stage name'));
        $show->field('avatar', __('Avatar'));
        $show->field('birth_date', __('Birth date'));
        $show->field('quote', __('Quote'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('slug', __('Slug'));
        $show->field('admin_user_id', __('Admin user id'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Author());

        $form->text('title', __('Nghệ danh'));
        $form->image('avatar', __('Avatar'))->move('avatar');
        $form->date('birth_date', __('Birth date'))->default(date('Y-m-d'));
        $form->textarea('quote', __('Quote'));
        $form->hidden('slug', __('Slug'));
        $form->select('admin_user_id')->options(AuthUser::all()->pluck('name','id'))->required();
        $form->saving(function ($form) {
            if (!($form->model()->id && $form->model()->title == $form->title)){
                $form->slug = Util::createSlug($form->title, Author::get());
            }
        });
        return $form;
    }
}
