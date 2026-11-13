<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Filter extends Model
{
    protected $table = 'filter';
    protected $primaryKey = 'filter_id';
    public $timestamps = false;

    protected $fillable = [
        'filter_name',
        'filter_description',
    ];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(
            Product::class,
            'product_filter',
            'filter_id',
            'product_id'
        );
    }

    public function blogs(): BelongsToMany
    {
        return $this->belongsToMany(
            Blog::class,
            'blog_filter',
            'filter_id',
            'blog_id'
        );
    }
}
