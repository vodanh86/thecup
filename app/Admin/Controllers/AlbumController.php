<?php

namespace App\Admin\Controllers;

use App\Models\Album;
use App\Models\Page;
use App\Models\Category;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\AuthUser;
use Encore\Admin\Facades\Admin;

class AlbumController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Album';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Album());

        $grid->column('id', __('Id'));
        $grid->column('title', __('Title'));
        $grid->column('description', __('Description'));
        $grid->column('image', __('Image'))->image(url('http://d12uuz3kv8rnlp.cloudfront.net'), 50, 50);
        $grid->column('author_id', __('Author id'));
        $grid->column('view', __('View'));
        $grid->column('category_id', __('Category id'));
        $grid->column('published_at', __('Published at'));
        $grid->column('status', __('Status'))->using(Constant::PAGE_STATUS);
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->model()->where('type', 1);
        $grid->model()->orderBy('id', 'DESC');
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
        $show = new Show(Album::findOrFail($id));

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
        $form = new Form(new Album());

        $form->text('title', __('Title'))->required();
        $form->ckeditor('description', __('Description'))->required();
        $form->cropper('image', __('Image'))->move('album')->cRatio(70, 70);
        $form->hasMany('photos', function (Form\NestedForm $form) {
            $form->text('title', 'Nội dung');
            $form->image('image', 'Ảnh');
        });
        $form->select('author_id', __('Tác giả'))->options(AuthUser::all()->pluck('name', 'id'))->default(Admin::user()->id)->setWidth(3, 2);
        $form->hidden('slug');
        $form->number('view', __('View'))->default(0);
        $form->hidden('type')->default(1);
        $form->select('category_id', __('Danh mục'))->options(Category::all()->pluck('title', 'id'))->setWidth(3, 2)->required();
        $form->datetime('published_at', __('Published at'))->default(date('Y-m-d H:i:s'));
        $form->select('status', __('Status'))->options(Constant::PAGE_STATUS)->setWidth(3, 2);
        $form->saving(function ($form) {
            if (!($form->model()->id && $form->model()->title == $form->title)){
                $form->slug = Util::createSlug($form->title, Album::get());
            }
        });
        return $form;
    }
}
