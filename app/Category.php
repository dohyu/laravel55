<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'parent_id',
        'title',
        'key_name',
        'key_value',
    ];

    public function parent()
    {
	    return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}
