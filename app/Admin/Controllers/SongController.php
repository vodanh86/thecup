<?php

namespace App\Admin\Controllers;

use App\Models\Song;
use App\Models\Podcast;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class SongController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Song';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Song());

        $grid->column('id', __('Id'));
        $grid->column('title', __('Title'));
        $grid->column('link', __('Link'))->display(function ($title) {
            return "<audio controls>".
                        '<source src="'.url(env('AWS_URL')).$title.'" type="audio/mpeg">'.
                    "</audio>";
        
        });
        $grid->column('podcast.title', __('Podcast'));
        $grid->column('description', __('Description'));
        $grid->column('duration', __('Duration'));

        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        if (isset($_GET['podcast_id']) ) {
            $grid->model()->where('podcast_id', $_GET['podcast_id']);
        }
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
        $show = new Show(Song::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('title', __('Title'));
        $show->field('link', __('Link'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('podcast_id', __('Podcast id'));
        $show->field('description', __('Description'));
        $show->field('duration', __('Duration'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Song());
        $duration = 0;
        $form->text('title', __('Title'))->required();
        $form->file('link', __('Link'))->required();
        $form->select('podcast_id', __('Podcast '))->options(Podcast::all()->pluck('title', 'id'))->required();
        $form->hidden('slug');
        $form->text('description', __('Description'));
        $form->hidden('duration');
        $form->submitted(function (Form $form) {
            global $duration;
            $file = $_FILES["link"]["tmp_name"];
            $ratio = 16000; //bytespersec
            $file_size = filesize($file);
            $duration = ($file_size / $ratio);
        });
        $form->saving(function ($form) {
            global $duration;
            $form->duration = $duration;
            if (!($form->model()->id && $form->model()->title == $form->title)){
                $form->slug = Util::createSlug($form->title, Song::get());
            }
        });
        return $form;
    }
}
