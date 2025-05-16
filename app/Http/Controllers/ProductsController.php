<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilterProductRequest;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\User;
use Exception;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    public function index(FilterProductRequest $request)
    {

        $validated = $request->validated();
        $query = Product::query();

        foreach ($validated as $field => $value) {

            if (is_null($value)) {
                continue;
            }
            if ($field === 'with_image') {
                $query->where('image_url', $value == 'true' ? '!=' : '=', null);
                continue;
            }
            if ($field === 'id') {
                $query->where('id', '=', $value);
                continue;
            }
            $query->where($field, 'like', '%' . $value . '%');
        }

        $products = $query->paginate(10);


        // $products = Product::paginate(10);

        return ProductResource::collection($products);
    }

    public function store(ProductRequest $request)
    {

        $validated = $request->validated();


        DB::beginTransaction();

        try {
            $product = Product::create($validated);
            DB::commit();

            return response()->json([
                'message' => 'Product created successfully',
                'product' => new ProductResource($product)
            ], 201);
        } catch (Exception $th) {
            DB::rollBack();

            return response()->json([
                'message' => 'Error creating product',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function show(string $id)
    {
        $product = Product::where('id', '=', $id)->first();

        if (!$product) {
            return response()->json([
                'message' => 'Product not found'
            ], 404);
        }
        return response()->json([
            'product' => new ProductResource($product)
        ], 200);
    }
}
