<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'slug', 'order', 'parent_id'];

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    /**
     * 获取根分类
     *
     * @param Builder $builder
     */
    public function scopeRoots(Builder $builder)
    {
        $builder->whereNull('parent_id');
    }

    /**
     * 分类排序
     *
     * @param Builder $builder
     * @param string  $direction
     */
    public function scopeSort(Builder $builder, $direction = 'asc')
    {
        $builder->orderBy('order', $direction);
    }
}
