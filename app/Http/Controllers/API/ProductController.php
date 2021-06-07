<?php

namespace App\Http\Controllers\API;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Product as ProductResource;
use App\Http\Controllers\API\BaseController as BaseController;

/**
 * Class ProductController
 * @package App\Http\Controllers\API
 */
class ProductController extends BaseController
{
    /**
     * Display a listing of the product
     * @return \Illuminate\Http\JsonResponse\
     */
    public function index()
    {
        $products = Product::all();

        return $this->sendResponse(ProductResource::collection($products), 'Products retrieved successfully.');
    }

    /**
     * Store a newly created product
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\JsonResponse\
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required',
            'detail' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $product = Product::create($input);

        return $this->sendResponse(new ProductResource($product), 'Product created successfully.');
    }

    /**
     * Display the specified product
     * @param $id
     * @return \Illuminate\Http\JsonResponse\
     */
    public function show($id)
    {
        $product = Product::with(['priceHistory', 'mainImagesHistory'])
            ->where('products.id', $id)
            ->first();

        return $this->sendResponse($product, 'Product retrieved successfully.');
    }

    /**
     * Update the specified product
     * @param Request $request
     * @param Product $product
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\JsonResponse\
     */
    public function update(Request $request, Product $product)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required',
            'detail' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $product->name = $input['name'];
        $product->detail = $input['detail'];
        $product->save();

        return $this->sendResponse(new ProductResource($product), 'Product updated successfully.');
    }

    /**
     * Remove the specified product
     * @param Product $product
     * @return \Illuminate\Http\JsonResponse\
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return $this->sendResponse([], 'Product deleted successfully.');
    }

    /**
     * Get product detail
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\JsonResponse\
     */
    public function productDetail(Request $request)
    {
        $input = $request->all();
        $product = Product::with(['priceHistory', 'mainImagesHistory', 'thumbImageCountHistory'])
            ->where('products.url', $input['url'])
            ->first();

        $reletedProduct = Product::with([])
            ->limit(4)
            ->get();

        if (is_null($product)) {
            return $this->sendError('Product not found.');
        }
        
        $newArray = ["vehicleData" => $product, "otherData" => $reletedProduct];
        return $this->sendResponse($newArray, 'Product retrieved successfully.');
    }
}
