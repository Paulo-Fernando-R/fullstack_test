<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilterProductRequest;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Exception;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{

    public function __construct(
        protected Product $repository,
    ) {}

    public function index(FilterProductRequest $request)
    {

        $validated = $request->validated();
        $query = $this->repository->query();

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


        // $products = $this->repository->paginate(10);

        return ProductResource::collection($products);
    }

    public function show(string $id)
    {
        $product = $this->repository->where('id', '=', $id)->first();

        if (!$product) {
            return response()->json([
                'message' => 'Product not found'
            ], 404);
        }
        return response()->json([
            'product' => new ProductResource($product)
        ], 200);
    }

    public function store(ProductRequest $request)
    {
        $validated = $request->validated();

        DB::beginTransaction();

        try {
            $product = $this->repository->create($validated);
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

    public function update(ProductRequest $request, string $id)
    {

        $product = $this->repository->findOrFail($id);
        $validated = $request->validated();

        DB::beginTransaction();

        try {

            // $validated['updated_at'] = now()->format('Y-m-d\TH:i:s.000\Z');
            unset($validated['created_at']);
            //dd($validated);
            $product->update($validated);

            DB::commit();

            return response()->json([
                'message' => 'Product updated successfully',
                'product' => new ProductResource($product)
            ], 200);
        } catch (Exception $th) {
            DB::rollBack();

            return response()->json([
                'message' => 'Error updating product',
                'error' => $th->getMessage()
            ], 500);
        }
    }



    public function destroy(string $id)
    {
        $product = $this->repository->findOrFail($id);

        DB::beginTransaction();

        try {
            $product->delete();
            DB::commit();

            return response()->json([
                'message' => 'Product deleted successfully'
            ], 204);
        } catch (Exception $th) {
            DB::rollBack();

            return response()->json([
                'message' => 'Error deleting product',
                'error' => $th->getMessage()
            ], 500);
        }
    }
}
