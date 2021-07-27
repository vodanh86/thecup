<?php

namespace App\Admin\Controllers;

use App\Models\Banner;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Admin\Controllers\Constant;

class BannerController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Banner';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Banner());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Tên banner'))->filter('like')->display(function($name) {
            return $name;
        });
        $grid->column('link', __('Địa chỉ liên kết'));
        $grid->position('Vị trí')->display(function($position) {
            return Constant::BANNER_POSITION[$position];
        });
        $grid->column('order', __('Sắp xếp'));
        $grid->column('img', __('Ảnh'))->image();
        $grid->show('Hiện')->display(function($show) {
            if (isset($show)){
                return Constant::SHOW_STATUS[$show];
            }
        });
        $grid->column('created_at', __('Ngày tạo'));
        $grid->column('updated_at', __('Ngày cập nhật'));
        $grid->filter(function($filter){
            // Remove the default id filter
            $filter->disableIdFilter();
            // Add a column filter
            $filter->like('name', 'Tên banner');
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
        $show = new Show(Banner::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Tên banner'));
        $show->field('link', __('Địa chỉ liên kết'));
        $show->field('position', __('Vị trí'));
        $show->field('order', __('Sắp xếp'));
        $show->field('show', __('Hiện'));
        $show->field('created_at', __('Ngày tạo'));
        $show->field('updated_at', __('Ngày cập nhật'));
        $show->field('img', __('Ảnh'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Banner());

        $form->text('name', __('Tên banner'));
        $form->url('link', __('Địa chỉ liên kết'))->required();
        $form->select('position', __('Vị trí'))->options(Constant::BANNER_POSITION)->setWidth(2, 2);
        $form->number('order', __('Sắp xếp'));
        $form->image('img', __('Ảnh'));
        $form->switch('show', __('Hiện'))->states(Constant::SWITCH_STATE);

        return $form;
    }
}
