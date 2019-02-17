<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
	    'value',
	    'parent_id',
    ];

    public function parent()
    {
	    $this->belongsTo(Category::class, 'parent_id', 'id');
    }

    public function children()
    {
        $this->hasMany(Category::class, 'parent_id')->latest();
    }
}
