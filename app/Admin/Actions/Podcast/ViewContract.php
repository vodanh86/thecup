<?php

namespace App\Admin\Actions\Podcast;

use App\Models\Podcast;
use App\Models\Song;
use Encore\Admin\Actions\RowAction;


class viewSongs extends RowAction
{
    protected $id;
    protected $podcastId;
    public $name = "Xem bài hát";
    //
    public function __construct($podcastId)
    {
        $this->podcastId = $podcastId;
    }

    protected function script()
    {
        return <<<SCRIPT

$('.grid-check-row').on('click', function () {

    // Your code.
    console.log($(this).data('id'));

});

SCRIPT;
    }

    public function href()
    {
        $contractRecord = Song::where('podcast_id', '=', $this->podcastId)->first();
        $link = "../admin/songs?podcast_id=" . $this->podcastId;
        return $link;
    }

    public function __toString()
    {
        return $this->render();
    }
}
