<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Product
 *
 * @property int                             $id
 * @property string                          $name        商品名称
 * @property string                          $slug
 * @property string|null                     $poster      商品大图
 * @property string|null                     $description 商品描述
 * @property int                             $price       商品价格，单位为分，默认一元
 * @property int|null                        $category_id
 * @property string|null                     $brand       厂商信息
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Category|null              $category
 * @method static Builder|Product filter()
 * @method static Builder|Product newModelQuery()
 * @method static Builder|Product newQuery()
 * @method static Builder|Product query()
 * @method static Builder|Product whereBrand($value)
 * @method static Builder|Product whereCategoryId($value)
 * @method static Builder|Product whereCreatedAt($value)
 * @method static Builder|Product whereDescription($value)
 * @method static Builder|Product whereId($value)
 * @method static Builder|Product whereName($value)
 * @method static Builder|Product wherePoster($value)
 * @method static Builder|Product wherePrice($value)
 * @method static Builder|Product whereSlug($value)
 * @method static Builder|Product whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Product extends Model
{
    protected $fillable = ['name', 'slug', 'poster', 'description', 'price', 'category_id', 'brand'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function scopeFilter(Builder $builder)
    {
        // 允许查询的参数
        $allow_filters = [
            'category_id', 'price', 'brand',
        ];

        $filters = request()->query();

        foreach ($filters as $filter_field => $filter_value) {
            if (in_array($filter_field, $allow_filters, true)) {
                $builder->where($filter_field, $filter_value);
            }
        }
    }
}
