<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Page;
use App\Models\User;

class Comment extends Model
{
    protected $table = 'comments';

	protected $hidden = [
    ];

    public function page()
    {
        return $this->belongsTo(Page::class, 'page_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

	protected $guarded = [];
}
