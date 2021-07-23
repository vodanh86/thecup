<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use app\User;

class Page extends Model
{
    protected $table = 'pages';

	protected $hidden = [
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

        /**
     * The columns of the full text index
     */
    protected $searchable = [
        'title',
        'description',
        'content'
    ];

	protected $guarded = [];
    
}
