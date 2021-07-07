<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use app\User;

class Album extends Model
{
    protected $table = 'albums';

	protected $hidden = [
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function photos() {
        return $this->hasMany(Photo::class,'album_id');
    }

	protected $guarded = [];
}
