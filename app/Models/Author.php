<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\AuthUser;

class Author extends Model
{
    protected $table = 'authors';

	protected $hidden = [
    ];

    public function admin_user()
    {
        return $this->belongsTo(AuthUser::class, 'admin_user_id');
    }

	protected $guarded = [];
}
