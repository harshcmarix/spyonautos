<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use DB;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Product;
use Validator;
use App\Http\Resources\Product as ProductResource;
   
class ProductController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
    
        return $this->sendResponse(ProductResource::collection($products), 'Products retrieved successfully.');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'name' => 'required',
            'detail' => 'required'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $product = Product::create($input);
   
        return $this->sendResponse(new ProductResource($product), 'Product created successfully.');
    } 
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $product = Product::find($id);
  
        // if (is_null($product)) {
        //     return $this->sendError('Product not found.');
        // }
   
        // return $this->sendResponse(new ProductResource($product), 'Product retrieved successfully.');

        // $product = DB::table('products')
        //  ->leftjoin('price_history', 'price_history.productId', '=', 'products.id')
        //  ->leftjoin('product_main_images', 'product_main_images.productId', '=', 'products.id')
        //  ->select('products.*', 'price_history.*', 'product_main_images.*')
        //  ->where('products.id',$id)
        //  //->groupBy('users.id')
        //  ->orderBy('products.id', 'DESC')
        //  ->get();
        $product = \App\Models\Product::with(['priceHistory','mainImagesHistory'])
        ->where('products.id',$id)
        ->first();
         //->paginate(10);
         return $this->sendResponse($product, 'Product retrieved successfully.');
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'name' => 'required',
            'detail' => 'required'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $product->name = $input['name'];
        $product->detail = $input['detail'];
        $product->save();
   
        return $this->sendResponse(new ProductResource($product), 'Product updated successfully.');
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
   
        return $this->sendResponse([], 'Product deleted successfully.');
    }

    public function productDetail(Request $request)
    {
        // $product = Product::find($id);
        $input = $request->all();
        //echo "<pre>";print_r($input['url']);die();
        $product = \App\Models\Product::with(['priceHistory','mainImagesHistory','thumbImageCountHistory'])
        ->where('products.url',$input['url'])
        ->first();

        $reletedProduct = \App\Models\Product::with([])
        //->where('products.url',$input['url'])
        ->limit(4)
        ->get();

        if (is_null($product)) {
            return $this->sendError('Product not found.');
        }
        $newArray = ["vehicleData" => $product,"otherData" => $reletedProduct];
        return $this->sendResponse($newArray, 'Product retrieved successfully.');
    }
}