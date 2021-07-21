<?php

namespace App\Admin\Controllers;

use App\Models\Category;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Admin\Controllers\Constant;
use App\Admin\Controllers\Util;


class CategoryController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Loại tin tức';

    public function index(Content $content)
    {
        return Admin::content(function (Content $content) {
            $content->header('Categories');
            $content->body(Category::tree());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Category());

        $grid->column('id', __('Id'));
        $grid->column('title', __('Tiêu đề'));
        $grid->column('parent_id', __('Loại tin tức'));
        $grid->column('order', __('Thứ tự'));
        $grid->column('show', __('Hiện'));
        $grid->column('created_at', __('Ngày tạo'));
        $grid->column('updated_at', __('Ngày cập nhật'));

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
        $show = new Show(Category::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('title', __('Tiêu đề'));
        $show->field('parent_id', __('Loại tin tức'));
        $show->field('order', __('Thứ tự'));
        $show->field('show', __('Hiện'));
        $show->field('created_at', __('Ngày tạo'));
        $show->field('updated_at', __('Ngày cập nhật'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Category());

        $form->text('title', __('Tiêu đề'))
        ->creationRules('required|unique:categories|max:100|regex:/^[a-zA-Z0-9ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂẾưăạảấầẩẫậắằẳẵặẹẻẽềềểếỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s]+$/', [
            'regex' => 'Tên chỉ gồm ký tự',
            'max' => 'Tên không được dài quá 100 ký tự'
        ]) 
        ->updateRules('required|unique:categories,title,{{id}}|max:100|regex:/^[a-zA-Z0-9ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂẾưăạảấầẩẫậắằẳẵặẹẻẽềềểếỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s]+$/', [
            'regex' => 'Tên chỉ gồm ký tự',
            'max' => 'Tên không được dài quá 100 ký tự'
        ]);
        //$form->number('parent_id', __('Parent id'));
        $form->select('parent_id', __('Loại tin tức'))->options(Category::pluck('title','id'))->required()->setWidth(3, 2);
        $form->hidden('slug');
        $form->number('order', __('Thứ tự'))->setWidth(3, 2)->min(0);
        $form->image('image', __('Image'));
        $form->switch('show', __('Hiện'))->states(Constant::SWITCH_STATE);
        $form->saving(function ($form) {
            if (!($form->model()->id && $form->model()->title == $form->title)){
                $form->slug = Util::createSlug($form->title, Page::get());
            }
        });
        return $form;
    }

    public function category()
    {
        if (request()->has('q')){
            return Category::where('parent_id', request()->get('q'))->get(['id', 'title as text']);
        }
        return Category::all()->get(['id', 'title as text']);
    }
}
