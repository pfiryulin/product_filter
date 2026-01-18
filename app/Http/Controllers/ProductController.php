<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;

class ProductController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request) : AnonymousResourceCollection|Response
    {
        $products = Product::query();

        if($request->has('name'))
        {
            $products = $products->where('name', 'like', '%'.$request->title.'%');
        }
        if($request->has('price_from'))
        {
            $products = $products->where('price', '>=', $request->price_from);
        }
        if($request->has('price_to'))
        {
            $products = $products->where('price', '<=', $request->price_to);
        }
        if($request->has('category_id'))
        {
            $products = $products->where('category_id', $request->category_id);
        }
        if($request->has('in_stock'))
        {
            $products = $products->where('in_stock', $request->boolean('in_stock'));
        }
        if($request->has('rating_from'))
        {
            $products = $products->where('rating', '>=', $request->rating_from);
        }
        if($request->has('sort'))
        {
            $products = $products->orderBy($request->sort, $request->direction);
        }

        $products = $products->with('categories');
        $products = $products->paginate($request->has('per_page') ? $request->per_page : 10);

        if($products->isEmpty())
        {
            return response([
                'message' => 'Products not found',
            ], 404);
        }

        return ProductResource::collection($products);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
