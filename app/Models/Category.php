<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Category
 *
 * @property int                                                      $id
 * @property string                                                   $name
 * @property string                                                   $slug
 * @property int                                                      $order
 * @property int|null                                                 $parent_id
 * @property \Illuminate\Support\Carbon|null                          $created_at
 * @property \Illuminate\Support\Carbon|null                          $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|Category[] $children
 * @property-read int|null                                            $children_count
 * @property-read Category|null                                       $parent
 * @method static Builder|Category newModelQuery()
 * @method static Builder|Category newQuery()
 * @method static Builder|Category query()
 * @method static Builder|Category roots()
 * @method static Builder|Category sort($direction = 'asc')
 * @method static Builder|Category whereCreatedAt($value)
 * @method static Builder|Category whereId($value)
 * @method static Builder|Category whereName($value)
 * @method static Builder|Category whereOrder($value)
 * @method static Builder|Category whereParentId($value)
 * @method static Builder|Category whereSlug($value)
 * @method static Builder|Category whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
