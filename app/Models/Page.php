<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Models\Category;

class Page extends Model
{
    protected $table = 'pages';

	protected $hidden = [
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
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
