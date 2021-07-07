<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use app\User;

class Podcast extends Model
{
    protected $table = 'podcasts';

	protected $hidden = [
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function songs() {
        return $this->hasMany(Song::class,'podcast_id');
    }

	protected $guarded = [];
}
