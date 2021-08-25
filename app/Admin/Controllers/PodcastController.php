<?php

namespace App\Admin\Controllers;

use App\Models\Page;
use App\Models\Podcast;
use App\Models\Category;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\AuthUser;
use Encore\Admin\Facades\Admin;
use App\Admin\Actions\Podcast\ViewSongs;

class PodcastController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Podcast';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Page());

        $grid->column('id', __('Id'))->sortable();
        $grid->column('title', __('Title'))->style('max-width:200px;');
        $grid->column('description', __('Description'))->style('max-width:300px;')->display(function ($title) {
            return "<span>". Util::extractContent($title) . "</span>";
        });
        $grid->column('image', __('Image'))->image(url(env("AWS_URL")), 50, 50);
        $grid->column('author.name', __('Author'));
        $grid->column('feature', __('Feature'))->using(Constant::YES_NO_STATUS)->sortable();
        $grid->column('view', __('View'))->sortable();
        $grid->column('category.title', __('Category'));
        $grid->column('status', __('Status'))->using(Constant::PAGE_STATUS)->sortable();
        $grid->column('slug', __('Preview'))->display(function ($slug) {
            return "<a href='".url('/page/'.$slug)."' target='_blank'>Link</span>";
        });
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->model()->where('type', 2);
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
        $show = new Show(Podcast::findOrFail($id));

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
        $form = new Form(new Podcast());

        $form->text('title', __('Title'))->required();
        $form->ckeditor('description', __('Description'))->required();
        $form->image('image', __('Image'))->insert(public_path('resources/watermark.png'), 'bottom-right', 30, 10);
        /*$form->hasMany('songs', function (Form\NestedForm $form) {
            $form->text('title', 'Tiêu đề');
            $form->file('link', 'Bài hát')->rules('mimes:audio/mpeg');
            $form->text('description', 'Nội dung');
        });*/
        $form->hidden('type')->default(2);
        $form->select('author_id', __('Tác giả'))->options(AuthUser::all()->pluck('name', 'id'))->default(Admin::user()->id)->setWidth(3, 2);
        $form->hidden('slug');
        $form->number('view', __('View'))->default(0);
        $form->select('category_id', __('Danh mục'))->options(Category::all()->pluck('title', 'id'))->setWidth(3, 2)->required();
        $form->datetime('published_at', __('Published at'))->default(date('Y-m-d H:i:s'));
        if (Admin::user()->isRole('manager')) {
            $form->select('status', __('Status'))->options(Constant::PAGE_STATUS)->setWidth(3, 2)->default(0);
        } else {
            $form->select('status', __('Status'))->options(Constant::PAGE_STATUS)->setWidth(3, 2)->default(0)->readonly();
        }
        $form->saving(function ($form) {
            if (!($form->model()->id && $form->model()->title == $form->title)){
                $form->slug = Util::createSlug($form->title, Podcast::get());
            }
        });
        return $form;
    }
}
