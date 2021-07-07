<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use app\Album;

class Photo extends Model
{
    protected $table = 'photos';

	protected $hidden = [
    ];

    public function album()
    {
        return $this->belongsTo(Album::class, 'album_id');
    }

	protected $guarded = [];
}
