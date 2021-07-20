<?php

namespace App\Admin\Controllers;

use App\Models\Page;
use App\Models\Category;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\AuthUser;
use Encore\Admin\Facades\Admin;
use App\Admin\Controllers\Util;

class PageController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Page';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Page());

        $grid->column('id', __('Id'));
        $grid->column('title', __('Title'));
        $grid->column('description', __('Description'));
        $grid->column('image', __('Image'))->image(url(env("AWS_URL")), 50, 50);
        $grid->column('author_id', __('Author id'));
        $grid->column('feature', __('Feature'));
        $grid->column('view', __('View'));
        $grid->column('category_id', __('Category id'));
        $grid->column('published_at', __('Published at'));
        $grid->column('status', __('Status'))->using(Constant::PAGE_STATUS);
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->model()->where('type', 0);
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
        $show = new Show(Page::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('title', __('Title'));
        $show->field('description', __('Description'));
        $show->field('content', __('Content'));
        $show->field('image', __('Image'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('author_id', __('Author id'));
        $show->field('view', __('View'));
        $show->field('category_id', __('Category id'));
        $show->field('published_at', __('Published at'));
        $show->field('status', __('Status'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Page());

        $form->text('title', __('Title'))->required();
        $form->ckeditor('description', __('Description'))->required();
        $form->ckeditor('content', __('Content'))->required();
        $form->image('image', __('Image'))->uniqueName();
        $form->select('author_id', __('Tác giả'))->options(AuthUser::all()->pluck('name', 'id'))->default(Admin::user()->id)->setWidth(3, 2);
        $form->hidden('slug');
        $form->hidden('type')->default(0);
        $form->number('view', __('View'))->default(0);
        $form->select('category_id', __('Danh mục'))->options(Category::all()->pluck('title', 'id'))->setWidth(3, 2)->required();
        $form->switch('feature', __("Bài nổi bật"))->states(Constant::ON_STATE);
        $form->switch('slide', __("Hiện lên slide"))->states(Constant::ON_STATE);
        $form->datetime('published_at', __('Published at'))->default(date('Y-m-d H:i:s'));
        $form->select('status', __('Status'))->options(Constant::PAGE_STATUS)->setWidth(3, 2);
        $form->saving(function ($form) {
            $form->slug = Util::createSlug($form->title, Page::get());
        });

        return $form;
    }
}
