<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use DB;
use Image;
use File;
class ProductController extends Controller
{

    public function start_reading_autotrader($path)
    {
        $portal = 1;
        //$path = storage_path() . "/json/renault_co_uk.jl";
        $string = file_get_contents($path); 

        $new_string = str_replace("}
{", '},{', $string);
        $final_string = '['.$new_string.']';

        $jsons = json_decode($final_string, true); 

        foreach ($jsons as $value) {
            
            $value['portal'] = $portal;
            $newScrapeDate = $value['scrape_date'];
            $productData = Product::where('listing_id', '=', $value['listing_id'])->first();
            if (!empty($productData)) {
                $scrapeDate = $productData->scrape_date;
                $pId = $productData->id;
                $mainImg = $productData->main_image;
                $oldPrice = $productData->price;
                $thumbImageCount = $productData->thumb_image_count;
                $hasVideo = $productData->has_video;
            }

            // if (isset($value['main_image'])) {

            //     $mainImage = $value['main_image'];
            //     unset($value['main_image']);
            // }

            if (isset($value['thumbnails'])) {

                $thumbnails = $value['thumbnails'];
                $value['thumb_image_count'] = count($thumbnails);
                unset($value['thumbnails']);
            }

            if (isset($value['flags'])) {
                $flags = $value['flags'];
                unset($value['flags']);
            }

            if (isset($value['has_video'])) {
                if ($value['has_video'] == true) {
                    $value['has_video'] = 'true';
                }else{
                    $value['has_video'] = 'false';
                }
                //$value['has_video'] = '"'.$value['has_video'].'"';
            }

            if ($productData === null) {

                $product = Product::create($value);
                $productId = DB::getPdo()->lastInsertId();

                if ($productId != 0 && $productId > 0) {

                    if (isset($value['price'])) {

                        $this->newPriceInsert($value['price'],$productId,$newScrapeDate);
                    }

                    if (isset($value['has_video'])) {

                        $this->newHasVideoInsert($value['has_video'],$productId,$newScrapeDate);
                    }

                    if (isset($value['thumb_image_count'])) {

                        $this->newImageCountInsert($value['thumb_image_count'],$productId,$newScrapeDate);
                    }

                    if (isset($value['main_image']) && $value['main_image'] != '') {

                        $mainImage = $value['main_image'];
                        $createDirName = '/images/autotrader_co_uk/' . $value['listing_id'] . '/main_image/' . date('Y-m-d');

                        $this->mainImageInsert($mainImage,$productId,$createDirName,$newScrapeDate);
                        
                    }

                    if (isset($thumbnails) && $thumbnails != '') {



                        $createDirName = '/images/autotrader_co_uk/' . $value['listing_id'] . '/thumbnails/' . date('Y-m-d');
                        $this->thumbImageInsert($thumbnails,$productId,$createDirName,$newScrapeDate);
                    }
                    if (isset($flags) && $flags != '') {
                        
                        $this->flagsInsert($flags,$productId,$newScrapeDate);
                    }
                }
            } else {

                //if ((strtotime($newScrapeDate) != strtotime($scrapeDate))) {

                    if (isset($value['main_image']) && $value['main_image'] != '' && $value['main_image'] != $mainImg) {
                        $mainImage = $value['main_image'];

                        $createDirName = '/images/autotrader_co_uk/' . $value['listing_id'] . '/main_image/' . date('Y-m-d');
                        $this->mainImageUpdate($mainImage,$pId,$createDirName,$newScrapeDate);
                    }

                    if (isset($value['price']) && $value['price'] != $oldPrice) {

                        $this->newPriceInsert($value['price'],$pId,$newScrapeDate);
                    }

                    if (isset($value['has_video']) && $value['has_video'] != $hasVideo) {

                        $this->newHasVideoInsert($value['has_video'],$pId,$newScrapeDate);
                    }

                    if (isset($value['thumb_image_count']) && $value['thumb_image_count'] != $thumbImageCount) {

                        $this->newImageCountInsert($value['thumb_image_count'],$pId,$newScrapeDate);
                    }

                    if (isset($thumbnails) && $thumbnails != '') {
                        
                        $createDirName = '/images/autotrader_co_uk/' . $value['listing_id'] . '/thumbnails/' . date('Y-m-d');
                        $this->thumbImageUpdate($thumbnails,$pId,$createDirName,$newScrapeDate);
                    }
                    if (isset($flags) && $flags != '') {
                        $this->flagsUpdate($flags,$pId,$newScrapeDate);
                    }

                    $value['updated_at'] = date('Y-m-d H:i:s');
                    DB::table('products')->where('id', $pId)->update($value);
                //}
            }
        }
        
    }

    public function start_reading_renault($path)
    {
        $portal = 2;
        //$path = storage_path() . "/json/renault_co_uk.jl";
        $string = file_get_contents($path); 

        $new_string = str_replace("}
{", '},{', $string);
        $final_string = '['.$new_string.']';

        $jsons = json_decode($final_string, true); 

        foreach ($jsons as $value) {
            
            $value['portal'] = $portal;
            $newScrapeDate = $value['scrape_date'];
            $productData = Product::where('listing_id', '=', $value['listing_id'])->first();
            if (!empty($productData)) {
                $scrapeDate = $productData->scrape_date;
                $pId = $productData->id;
                $mainImg = $productData->main_image;
                $oldPrice = $productData->price;
                $thumbImageCount = $productData->thumb_image_count;
                $hasVideo = $productData->has_video;
            }

            // if (isset($value['main_image'])) {

            //     $mainImage = $value['main_image'];
            //     unset($value['main_image']);
            // }

            if (isset($value['thumbnails'])) {

                $thumbnails = $value['thumbnails'];
                $value['thumb_image_count'] = count($thumbnails);
                unset($value['thumbnails']);
            }

            if (isset($value['flags'])) {
                $flags = $value['flags'];
                unset($value['flags']);
            }

            if (isset($value['has_video'])) {
                $value['has_video'] = '"'.$value['has_video'].'"';
            }

            if (isset($value['reg_date'])) {
                $value['reg_date'] = date('Y-m-d', strtotime($value['reg_date']));
            }

            if ($productData === null) {

                $product = Product::create($value);
                $productId = DB::getPdo()->lastInsertId();

                if ($productId != 0 && $productId > 0) {

                    if (isset($value['price'])) {

                        $this->newPriceInsert($value['price'],$productId,$newScrapeDate);
                    }

                    if (isset($value['has_video'])) {

                        $this->newHasVideoInsert($value['has_video'],$productId,$newScrapeDate);
                    }

                    if (isset($value['thumb_image_count'])) {

                        $this->newImageCountInsert($value['thumb_image_count'],$productId,$newScrapeDate);
                    }

                    if (isset($value['main_image']) && $value['main_image'] != '') {

                        $mainImage = $value['main_image'];
                        $createDirName = '/images/renault_co_uk/' . $value['listing_id'] . '/main_image/' . date('Y-m-d');

                        $this->mainImageInsert($mainImage,$productId,$createDirName,$newScrapeDate);
                        
                    }

                    if (isset($thumbnails) && $thumbnails != '') {

                        $createDirName = '/images/renault_co_uk/' . $value['listing_id'] . '/thumbnails/' . date('Y-m-d');
                        $this->thumbImageInsert($thumbnails,$productId,$createDirName,$newScrapeDate);
                    }
                    if (isset($flags) && $flags != '') {
                        
                        $this->flagsInsert($flags,$productId,$newScrapeDate);
                    }
                }
            } else {

                //if ((strtotime($newScrapeDate) != strtotime($scrapeDate))) {

                    if (isset($value['main_image']) && $value['main_image'] != '' && $value['main_image'] != $mainImg) {
                        
                        $mainImage = $value['main_image'];
                        $createDirName = '/images/renault_co_uk/' . $value['listing_id'] . '/main_image/' . date('Y-m-d');
                        $this->mainImageUpdate($mainImage,$pId,$createDirName,$newScrapeDate);

                    }

                    if (isset($value['price']) && $value['price'] != $oldPrice) {

                        $this->newPriceInsert($value['price'],$pId,$newScrapeDate);
                    }

                    if (isset($value['has_video']) && $value['has_video'] != $hasVideo) {

                        $this->newHasVideoInsert($value['has_video'],$pId,$newScrapeDate);
                    }

                    if (isset($value['thumb_image_count']) && $value['thumb_image_count'] != $thumbImageCount) {

                        $this->newImageCountInsert($value['thumb_image_count'],$pId,$newScrapeDate);
                    }

                    if (isset($thumbnails) && $thumbnails != '') {
                        
                        $createDirName = '/images/renault_co_uk/' . $value['listing_id'] . '/thumbnails/' . date('Y-m-d');
                        $this->thumbImageUpdate($thumbnails,$pId,$createDirName,$newScrapeDate);
                    }
                    if (isset($flags) && $flags != '') {
                        $this->flagsUpdate($flags,$pId,$newScrapeDate);
                    }

                    $value['updated_at'] = date('Y-m-d H:i:s');
                    DB::table('products')->where('id', $pId)->update($value);
                //}
            }

        }
        
    }

    function createFolderDire($createDirName)
    { 
        
        $folderdirpath = public_path().$createDirName;
        
        if (!File::exists($folderdirpath)) {
            
            File::makeDirectory($folderdirpath, $mode = 0777, true, true);
            
        }    
        
        return $createDirName;
    }

    public function mainImageInsert($mainImage,$productId,$createDirName,$scrapeDate)
    {
        //$imageIdPath = $this->createFolderDire($createDirName);
        
        //foreach ($mainImage as $mainImage) {

            $imageName = basename($mainImage);
            try {
                //Image::make($mainImage)->save(public_path($imageIdPath .'/'. $imageName));
                $data = [];
                $data['productId'] = $productId;
                $data['url'] = $mainImage;
                //$data['image'] = $imageIdPath.'/'.$imageName;
                $data['scrape_date'] = $scrapeDate;
                $data['created_at'] = date('Y-m-d H:i:s');
                $data['updated_at'] = date('Y-m-d H:i:s');
                //ProductThumbImage::create($data);
                DB::table('product_main_images')->insert($data);
                DB::table('main_images_history')->insert($data);
            }catch (\Exception $e) {
                echo $e->getMessage();
                //not throwing  error when exception occurs
            }
        //}
    }

     public function mainImageUpdate($mainImage,$pId,$createDirName,$scrapeDate)
    {

        $result = DB::table('product_main_images')->select('url')->where(array('productId' => $pId))->get();

        $mainImg = '';
        if (!empty($result)) {
            $resultArray = []; 
            foreach ($result as $value){ 
            $resultArray[] = $value->url;
            $mainImg = $resultArray[0];
            }   
        }

        if ($mainImage != $mainImg) {
            
            //$imageIdPath = $this->createFolderDire($createDirName);
            DB::table('product_main_images')->where('productId',$pId)->delete();

            //foreach ($mainImage as $mainImage) {
                try{
                    $filename = basename($mainImage);

                    //Image::make($mainImage)->save(public_path($imageIdPath . '/' . $filename));
                    $data = [];
                    $data['productId'] = $pId;
                    $data['url'] = $mainImage;
                    //$data['image'] = $imageIdPath.'/'.$filename;
                    $data['scrape_date'] = $scrapeDate;
                    $data['created_at'] = date('Y-m-d H:i:s');
                    $data['updated_at'] = date('Y-m-d H:i:s');
                    DB::table('product_main_images')->insert($data);
                    DB::table('main_images_history')->insert($data);
                }catch (\Exception $e) {
                    echo $e->getMessage();
                //not throwing  error when exception occurs
                }
            //}

        }
    }

    public function thumbImageInsert($thumbnails,$productId,$createDirName,$scrapeDate)
    {
        
        // $imageIdPath = $this->createFolderDire($createDirName);
        // echo $imageIdPath;
        foreach ($thumbnails as $thumbnail) {

            try{
                $filename = basename($thumbnail);

                //Image::make($thumbnail)->save(public_path($imageIdPath.'/'. $filename));
                $data = [];
                $data['productId'] = $productId;
                $data['url'] = $thumbnail;
                //$data['image'] = $imageIdPath.'/'.$filename;
                $data['scrape_date'] = $scrapeDate;
                $data['created_at'] = date('Y-m-d H:i:s');
                $data['updated_at'] = date('Y-m-d H:i:s');
                //ProductThumbImage::create($data);
                DB::table('product_thumb_images')->insert($data);
                //DB::table('thumb_images_history')->insert($data);
            }catch (\Exception $e) {
                echo $e->getMessage();
                //not throwing  error when exception occurs
            }
        }
    }

    public function thumbImageUpdate($thumbnails,$pId,$createDirName,$scrapeDate)
    {
        //$result = DB::table('product_thumb_images')->where([['productId', '=', $pId]])->get(['url'])->toArray();
        $result = DB::table('product_thumb_images')->select('url')->where(array('productId' => $pId))->get();
        //$result = json_decode(json_encode($result), true);
        if (!empty($result)) {
            $resultArray = [];
            foreach ($result as $value){
            $resultArray[] = $value->url;
            }
            $arrayDiff1=array_diff($thumbnails,$resultArray);
            $arrayDiff2=array_diff($resultArray,$thumbnails);
        }else{
            $arrayDiff1 = $thumbnails;
            $arrayDiff2 = $thumbnails;
        }

        if (!empty($arrayDiff1) || !empty($arrayDiff2)) {
            
            //$imageIdPath = $this->createFolderDire($createDirName);
            DB::table('product_thumb_images')->where('productId',$pId)->delete();

            foreach ($thumbnails as $thumbnail) {

                // $result = DB::table('product_thumb_images')->where([['productId', '=', $pId],['url', '=', $thumbnail]])->first();
                // echo "<pre>";print_r($result);
                // if (empty($result)) {

                    //DB::table('product_thumb_images')->where('productId',$pId)->delete();
                    try{
                        $filename = basename($thumbnail);

                        //Image::make($thumbnail)->save(public_path($imageIdPath . '/' . $filename));
                        $data = [];
                        $data['productId'] = $pId;
                        $data['url'] = $thumbnail;
                        //$data['image'] = $imageIdPath.'/'.$filename;
                        $data['scrape_date'] = $scrapeDate;
                        $data['created_at'] = date('Y-m-d H:i:s');
                        $data['updated_at'] = date('Y-m-d H:i:s');
                        //ProductThumbImage::create($data);
                        DB::table('product_thumb_images')->insert($data);
                        //DB::table('thumb_images_history')->insert($data);
                    }catch (\Exception $e) {
                        echo $e->getMessage();
                        //not throwing  error when exception occurs
                    }
                //}
            }

        }
    }

    public function flagsInsert($flags,$productId,$scrapeDate)
    {
        foreach ($flags as $flag) {
            $flagData = [];
            $flagData['productId'] = $productId;
            $flagData['flag'] = $flag;
            $flagData['scrape_date'] = $scrapeDate;
            $flagData['created_at'] = date('Y-m-d H:i:s');
            $flagData['updated_at'] = date('Y-m-d H:i:s');
            //ProductThumbImage::create($flagData);
            DB::table('product_flags')->insert($flagData);
        }
    }

    public function flagsUpdate($flags,$pId,$scrapeDate)
    {
        foreach ($flags as $flag) {
            $flagResult = DB::table('product_flags')->where([['productId', '=', $pId],['flag', '=', $flag]])->first();
            if (empty($flagResult)) {
                $flagData = [];
                $flagData['productId'] = $pId;
                $flagData['flag'] = $flag;
                $flagData['scrape_date'] = $scrapeDate;
                $flagData['created_at'] = date('Y-m-d H:i:s');
                $flagData['updated_at'] = date('Y-m-d H:i:s');
                //ProductThumbImage::create($flagData);
                DB::table('product_flags')->insert($flagData);
            }
        }
    }

    public function newPriceInsert($price,$productId,$scrapeDate)
    {
        $data = [];
        $data['productId'] = $productId;
        $data['price'] = $price;
        $data['scrape_date'] = $scrapeDate;
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');

        DB::table('price_history')->insert($data);
    }

    public function newHasVideoInsert($has_video,$productId,$scrapeDate)
    {
        $data = [];
        $data['productId'] = $productId;
        $data['has_video'] = $has_video;
        $data['scrape_date'] = $scrapeDate;
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');

        DB::table('video_history')->insert($data);
    }

    public function newImageCountInsert($imgCount,$productId,$scrapeDate)
    {
        $data = [];
        $data['productId'] = $productId;
        $data['count'] = $imgCount;
        $data['scrape_date'] = $scrapeDate;
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');

        DB::table('thumb_image_count_history')->insert($data);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        die("Working");
        $portal = 1;
        $path = storage_path() . "/json/autotrader_co_uk.jl";
        $string = file_get_contents($path); 

        $new_string = str_replace("}
{", '},{', $string);
        $final_string = '['.$new_string.']';

        $jsons = json_decode($final_string, true); 

        foreach ($jsons as $value) {
            
            $value['portal'] = $portal;
            $newScrapeDate = $value['scrape_date'];
            $productData = Product::where('listing_id', '=', $value['listing_id'])->first();
            if (!empty($productData)) {
                $scrapeDate = $productData->scrape_date;
                $pId = $productData->id;
                $mainImg = $productData->main_image;
                $oldPrice = $productData->price;
            }

            if (isset($value['main_image'])) {

                $mainImage = $value['main_image'];
                unset($value['main_image']);
            }

            if (isset($value['thumbnails'])) {

                $thumbnails = $value['thumbnails'];
                unset($value['thumbnails']);
            }

            if (isset($value['flags'])) {
                $flags = $value['flags'];
                unset($value['flags']);
            }

            if ($productData === null) {

                $product = Product::create($value);
                $productId = DB::getPdo()->lastInsertId();

                if ($productId != 0 && $productId > 0) {

                    if (isset($value['price'])) {

                        $this->newPriceInsert($value['price'],$productId);
                    }

                    if (isset($mainImage) && $mainImage != '') {

                        $createDirName = '/images/autotrader_co_uk/' . $value['listing_id'] . '/main_image/' . date('Y-m-d');

                        $this->mainImageInsert($mainImage,$productId,$createDirName);
                        
                    }

                    if (isset($thumbnails) && $thumbnails != '') {

                        $createDirName = '/images/autotrader_co_uk/' . $value['listing_id'] . '/thumbnails/' . date('Y-m-d');
                        $this->thumbImageInsert($thumbnails,$productId,$createDirName);
                    }
                    if (isset($flags) && $flags != '') {
                        
                        $this->flagsInsert($flags,$productId);
                    }
                }
            } else {

                //if ((strtotime($newScrapeDate) != strtotime($scrapeDate))) {

                    if (isset($mainImage) && $mainImage) {
                        //$mainImage = $value['main_image'];

                        $createDirName = '/images/autotrader_co_uk/' . $value['listing_id'] . '/main_image/' . date('Y-m-d');
                        $this->mainImageUpdate($mainImage,$pId,$createDirName);

                    }

                    $value['updated_at'] = date('Y-m-d H:i:s');
                    DB::table('products')->where('id', $pId)->update($value);

                    if (isset($value['price']) && $value['price'] != $oldPrice) {

                        $this->newPriceInsert($value['price'],$pId);
                    }
                    if (isset($thumbnails) && $thumbnails != '') {
                        
                        $createDirName = '/images/autotrader_co_uk/' . $value['listing_id'] . '/thumbnails/' . date('Y-m-d');
                        $this->thumbImageUpdate($thumbnails,$pId,$createDirName);
                    }
                    if (isset($flags) && $flags != '') {
                        $this->flagsUpdate($flags,$pId);
                    }
                //}
            }
            
        }
            // return view('products.index',compact('products'))
            //     ->with('i', (request()->input('page', 1) - 1) * 5);
    }
   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }
  
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);
    
        Product::create($request->all());
   
        return redirect()->route('products.index')
                        ->with('success','Product created successfully.');
    }
   
    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('products.show',compact('product'));
    }
   
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('products.edit',compact('product'));
    }
  
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);
  
        $product->update($request->all());
  
        return redirect()->route('products.index')
                        ->with('success','Product updated successfully');
    }
  
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
  
        return redirect()->route('products.index')
                        ->with('success','Product deleted successfully');
    }
}
