<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Page;

class Rating extends Model
{
    protected $table = 'ratings';

	protected $hidden = [
    ];

    public function page()
    {
        return $this->belongsTo(Page::class, 'page_id');
    }

	protected $guarded = [];
}
