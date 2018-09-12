<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'name','price','quantity','created_at','updated_at'
    ];

    public function scopeDateFilter(Builder $builder, Request $request) : Builder
    {
        return $builder->when(!is_null($request->min_date) && !is_null($request->max_date),function (Builder $builder) use ($request){
            return $builder->whereBetween('created_at',[$request->min_date,$request->max_date]);
        })
            ->when(!is_null($request->min_date),function (Builder $builder) use ($request){
                return $builder->whereDate('created_at','>=',$request->min_date);
            })
            ->when(!is_null($request->max_date),function (Builder $builder) use ($request){
                return $builder->whereDate('created_at','<=',$request->max_date);
            });
    }

    public function scopePriceFilter(Builder $builder, Request $request) : Builder
    {
        return $builder->when(!is_null($request->min_price) && !is_null($request->max_price), function (Builder $builder) use ($request){
            return $builder->whereBetween('price',[$request->min_price,$request->max_price]);
        })
            ->when(!is_null($request->min_price),function (Builder $builder) use ($request){
                return $builder->where('price','>=',$request->min_price);
            })
            ->when(!is_null($request->max_price),function (Builder $builder) use ($request){
                return $builder->where('price','<=',$request->max_price);
            });
    }

    public function scopeQuantityFilter(Builder $builder, Request $request) : Builder
    {
        return $builder->when(!is_null($request->quantity),function (Builder $builder) use ($request){
            return $builder->where('quantity','>=',$request->quantity);
        });
    }

    public function scopeSortOrder(Builder $builder, Request $request) : Builder
    {
        return $builder->when(!is_null($request->sort_by),function (Builder $builder) use ($request){
            return $builder->orderBy($request->sort_by,$request->sort_order);
        });
    }

}
