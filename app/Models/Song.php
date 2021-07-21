<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Podcast;

class Song extends Model
{
    protected $table = 'songs';

	protected $hidden = [
    ];

    public function podcast()
    {
        return $this->belongsTo(Podcast::class, 'podcast_id');
    }

	protected $guarded = [];
}
