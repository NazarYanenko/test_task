<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $this->validate($request,[
           'min_date'  => 'date|nullable',
           'max_date'  => 'date|nullable',
           'max_price' => 'numeric|nullable',
           'min_price' => 'numeric|nullable',
           'sort_by'   => 'string|nullable',
           'order_by'  => 'string|nullable',
        ]);

        $products = Product::query()
            ->dateFilter($request)
            ->priceFilter($request)
            ->quantityFilter($request)
            ->sortOrder($request)
            ->get();

        return response()->json($products);
    }
}
