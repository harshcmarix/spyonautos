<?php

namespace App\Http\Controllers;

use App\Jobs\AutoTraderImportProcess;
use App\Models\Job;
use File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\LazyCollection;
use Image;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Traits\ScrapingTrait;

/**
 * Class ProductController
 * @package App\Http\Controllers
 */
class ProductController extends Controller
{
    /**
     * Use scraping trait
     */
    use ScrapingTrait;

    /**
     * @param $path
     */
    public function start_reading_autotrader($path)
    {
        $portal = 1;
        //$path = storage_path() . "/json/renault_co_uk.jl";

        $string = file_get_contents($path);

        $new_string = str_replace("}
{", '},{', $string);
        $final_string = '[' . $new_string . ']';

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
                } else {
                    $value['has_video'] = 'false';
                }
            }

            if ($productData === null) {
                $product = Product::create($value);
                $productId = DB::getPdo()->lastInsertId();

                if ($productId != 0 && $productId > 0) {
                    if (isset($value['price'])) {
                        $this->newPriceInsert($value['price'], $productId, $newScrapeDate);
                    }

                    if (isset($value['has_video'])) {
                        $this->newHasVideoInsert($value['has_video'], $productId, $newScrapeDate);
                    }

                    if (isset($value['thumb_image_count'])) {
                        $this->newImageCountInsert($value['thumb_image_count'], $productId, $newScrapeDate);
                    }

                    if (isset($value['main_image']) && $value['main_image'] != '') {
                        $mainImage = $value['main_image'];
                        $createDirName = '/images/autotrader_co_uk/' . $value['listing_id'] . '/main_image/' . date('Y-m-d');
                        $this->mainImageInsert($mainImage, $productId, $createDirName, $newScrapeDate);
                    }

                    if (isset($thumbnails) && $thumbnails != '') {
                        $createDirName = '/images/autotrader_co_uk/' . $value['listing_id'] . '/thumbnails/' . date('Y-m-d');
                        $this->thumbImageInsert($thumbnails, $productId, $createDirName, $newScrapeDate);
                    }

                    if (isset($flags) && $flags != '') {
                        $this->flagsInsert($flags, $productId, $newScrapeDate);
                    }
                }
            } else {
                if (isset($value['main_image']) && $value['main_image'] != '' && $value['main_image'] != $mainImg) {
                    $mainImage = $value['main_image'];

                    $createDirName = '/images/autotrader_co_uk/' . $value['listing_id'] . '/main_image/' . date('Y-m-d');
                    $this->mainImageUpdate($mainImage, $pId, $createDirName, $newScrapeDate);
                }

                if (isset($value['price']) && $value['price'] != $oldPrice) {
                    $this->newPriceInsert($value['price'], $pId, $newScrapeDate);
                }

                if (isset($value['has_video']) && $value['has_video'] != $hasVideo) {
                    $this->newHasVideoInsert($value['has_video'], $pId, $newScrapeDate);
                }

                if (isset($value['thumb_image_count']) && $value['thumb_image_count'] != $thumbImageCount) {
                    $this->newImageCountInsert($value['thumb_image_count'], $pId, $newScrapeDate);
                }

                if (isset($thumbnails) && $thumbnails != '') {
                    $createDirName = '/images/autotrader_co_uk/' . $value['listing_id'] . '/thumbnails/' . date('Y-m-d');
                    $this->thumbImageUpdate($thumbnails, $pId, $createDirName, $newScrapeDate);
                }

                if (isset($flags) && $flags != '') {
                    $this->flagsUpdate($flags, $pId, $newScrapeDate);
                }

                $value['updated_at'] = date('Y-m-d H:i:s');
                DB::table('products')->where('id', $pId)->update($value);
            }
        }
    }

    /**
     * @param $path
     */
    public function start_reading_renault($path)
    {
        $portal = 2;
        //$path = storage_path() . "/json/renault_co_uk.jl";

        $string = file_get_contents($path);

        $new_string = str_replace("}
{", '},{', $string);
        $final_string = '[' . $new_string . ']';

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
                $value['has_video'] = '"' . $value['has_video'] . '"';
            }

            if (isset($value['reg_date'])) {
                $value['reg_date'] = date('Y-m-d', strtotime($value['reg_date']));
            }

            if ($productData === null) {
                $product = Product::create($value);
                $productId = DB::getPdo()->lastInsertId();

                if ($productId != 0 && $productId > 0) {
                    if (isset($value['price'])) {
                        $this->newPriceInsert($value['price'], $productId, $newScrapeDate);
                    }

                    if (isset($value['has_video'])) {
                        $this->newHasVideoInsert($value['has_video'], $productId, $newScrapeDate);
                    }

                    if (isset($value['thumb_image_count'])) {
                        $this->newImageCountInsert($value['thumb_image_count'], $productId, $newScrapeDate);
                    }

                    if (isset($value['main_image']) && $value['main_image'] != '') {
                        $mainImage = $value['main_image'];
                        $createDirName = '/images/renault_co_uk/' . $value['listing_id'] . '/main_image/' . date('Y-m-d');
                        $this->mainImageInsert($mainImage, $productId, $createDirName, $newScrapeDate);
                    }

                    if (isset($thumbnails) && $thumbnails != '') {
                        $createDirName = '/images/renault_co_uk/' . $value['listing_id'] . '/thumbnails/' . date('Y-m-d');
                        $this->thumbImageInsert($thumbnails, $productId, $createDirName, $newScrapeDate);
                    }

                    if (isset($flags) && $flags != '') {
                        $this->flagsInsert($flags, $productId, $newScrapeDate);
                    }
                }
            } else {
                if (isset($value['main_image']) && $value['main_image'] != '' && $value['main_image'] != $mainImg) {
                    $mainImage = $value['main_image'];
                    $createDirName = '/images/renault_co_uk/' . $value['listing_id'] . '/main_image/' . date('Y-m-d');
                    $this->mainImageUpdate($mainImage, $pId, $createDirName, $newScrapeDate);
                }

                if (isset($value['price']) && $value['price'] != $oldPrice) {
                    $this->newPriceInsert($value['price'], $pId, $newScrapeDate);
                }

                if (isset($value['has_video']) && $value['has_video'] != $hasVideo) {
                    $this->newHasVideoInsert($value['has_video'], $pId, $newScrapeDate);
                }

                if (isset($value['thumb_image_count']) && $value['thumb_image_count'] != $thumbImageCount) {
                    $this->newImageCountInsert($value['thumb_image_count'], $pId, $newScrapeDate);
                }

                if (isset($thumbnails) && $thumbnails != '') {
                    $createDirName = '/images/renault_co_uk/' . $value['listing_id'] . '/thumbnails/' . date('Y-m-d');
                    $this->thumbImageUpdate($thumbnails, $pId, $createDirName, $newScrapeDate);
                }

                if (isset($flags) && $flags != '') {
                    $this->flagsUpdate($flags, $pId, $newScrapeDate);
                }

                $value['updated_at'] = date('Y-m-d H:i:s');
                DB::table('products')->where('id', $pId)->update($value);
            }
        }
    }

    /**
     * Create directory
     * @param $createDirName
     * @return mixed
     */
    function createFolderDire($createDirName)
    {
        $folderdirpath = public_path() . $createDirName;
        if (!File::exists($folderdirpath)) {
            File::makeDirectory($folderdirpath, $mode = 0777, true, true);
        }

        return $createDirName;
    }

    /**
     * Insert main image and it's history
     * @param $mainImage
     * @param $productId
     * @param $createDirName
     * @param $scrapeDate
     */
    public function mainImageInsert($mainImage, $productId, $createDirName, $scrapeDate)
    {
        $imageName = basename($mainImage);
        try {
            $data = [];
            $data['productId'] = $productId;
            $data['url'] = $mainImage;
            $data['scrape_date'] = $scrapeDate;
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['updated_at'] = date('Y-m-d H:i:s');
            DB::table('product_main_images')->insert($data);
            DB::table('main_images_history')->insert($data);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Update main image and it's history
     * @param $mainImage
     * @param $pId
     * @param $createDirName
     * @param $scrapeDate
     */
    public function mainImageUpdate($mainImage, $pId, $createDirName, $scrapeDate)
    {
        $result = DB::table('product_main_images')->select('url')->where(array('productId' => $pId))->get();

        $mainImg = '';
        if (!empty($result)) {
            $resultArray = [];
            foreach ($result as $value) {
                $resultArray[] = $value->url;
                $mainImg = $resultArray[0];
            }
        }

        if ($mainImage != $mainImg) {
            DB::table('product_main_images')->where('productId', $pId)->delete();
            try {
                $filename = basename($mainImage);
                $data = [];
                $data['productId'] = $pId;
                $data['url'] = $mainImage;
                $data['scrape_date'] = $scrapeDate;
                $data['created_at'] = date('Y-m-d H:i:s');
                $data['updated_at'] = date('Y-m-d H:i:s');
                DB::table('product_main_images')->insert($data);
                DB::table('main_images_history')->insert($data);
            } catch (\Exception $e) {
                echo $e->getMessage();
            }
        }
    }

    /**
     * Insert thumbnail image
     * @param $thumbnails
     * @param $productId
     * @param $createDirName
     * @param $scrapeDate
     */
    public function thumbImageInsert($thumbnails, $productId, $createDirName, $scrapeDate)
    {
        foreach ($thumbnails as $thumbnail) {
            try {
                $filename = basename($thumbnail);
                $data = [];
                $data['productId'] = $productId;
                $data['url'] = $thumbnail;
                $data['scrape_date'] = $scrapeDate;
                $data['created_at'] = date('Y-m-d H:i:s');
                $data['updated_at'] = date('Y-m-d H:i:s');
                DB::table('product_thumb_images')->insert($data);
            } catch (\Exception $e) {
                echo $e->getMessage();
            }
        }
    }

    /**
     * Update thumbnail image
     * @param $thumbnails
     * @param $pId
     * @param $createDirName
     * @param $scrapeDate
     */
    public function thumbImageUpdate($thumbnails, $pId, $createDirName, $scrapeDate)
    {
        $result = DB::table('product_thumb_images')->select('url')->where(array('productId' => $pId))->get();
        if (!empty($result)) {
            $resultArray = [];
            foreach ($result as $value) {
                $resultArray[] = $value->url;
            }
            $arrayDiff1 = array_diff($thumbnails, $resultArray);
            $arrayDiff2 = array_diff($resultArray, $thumbnails);
        } else {
            $arrayDiff1 = $thumbnails;
            $arrayDiff2 = $thumbnails;
        }

        if (!empty($arrayDiff1) || !empty($arrayDiff2)) {
            DB::table('product_thumb_images')->where('productId', $pId)->delete();
            foreach ($thumbnails as $thumbnail) {
                try {
                    $filename = basename($thumbnail);
                    $data = [];
                    $data['productId'] = $pId;
                    $data['url'] = $thumbnail;
                    $data['scrape_date'] = $scrapeDate;
                    $data['created_at'] = date('Y-m-d H:i:s');
                    $data['updated_at'] = date('Y-m-d H:i:s');
                    DB::table('product_thumb_images')->insert($data);
                } catch (\Exception $e) {
                    echo $e->getMessage();
                }
            }
        }
    }

    /**
     * Insert flag
     * @param $flags
     * @param $productId
     * @param $scrapeDate
     */
    public function flagsInsert($flags, $productId, $scrapeDate)
    {
        foreach ($flags as $flag) {
            $flagData = [];
            $flagData['productId'] = $productId;
            $flagData['flag'] = $flag;
            $flagData['scrape_date'] = $scrapeDate;
            $flagData['created_at'] = date('Y-m-d H:i:s');
            $flagData['updated_at'] = date('Y-m-d H:i:s');
            DB::table('product_flags')->insert($flagData);
        }
    }

    /**
     * Update flag
     * @param $flags
     * @param $pId
     * @param $scrapeDate
     */
    public function flagsUpdate($flags, $pId, $scrapeDate)
    {
        foreach ($flags as $flag) {
            $flagResult = DB::table('product_flags')->where([['productId', '=', $pId], ['flag', '=', $flag]])->first();
            if (empty($flagResult)) {
                $flagData = [];
                $flagData['productId'] = $pId;
                $flagData['flag'] = $flag;
                $flagData['scrape_date'] = $scrapeDate;
                $flagData['created_at'] = date('Y-m-d H:i:s');
                $flagData['updated_at'] = date('Y-m-d H:i:s');
                DB::table('product_flags')->insert($flagData);
            }
        }
    }

    /**
     * Insert price history
     * @param $price
     * @param $productId
     * @param $scrapeDate
     */
    public function newPriceInsert($price, $productId, $scrapeDate)
    {
        $data = [];
        $data['productId'] = $productId;
        $data['price'] = $price;
        $data['scrape_date'] = $scrapeDate;
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');

        DB::table('price_history')->insert($data);
    }

    /**
     * Insert video history
     * @param $has_video
     * @param $productId
     * @param $scrapeDate
     */
    public function newHasVideoInsert($has_video, $productId, $scrapeDate)
    {
        $data = [];
        $data['productId'] = $productId;
        $data['has_video'] = $has_video;
        $data['scrape_date'] = $scrapeDate;
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');

        DB::table('video_history')->insert($data);
    }

    /**
     * Insert thumbnail image count history
     * @param $imgCount
     * @param $productId
     * @param $scrapeDate
     */
    public function newImageCountInsert($imgCount, $productId, $scrapeDate)
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
     * Display a listing of the resource
     */
    public function index()
    {
        p("Working");

//        $portal = Product::PORTAL_TYPE_AUTOTRADER;
//        $filePath = storage_path() . "/json_files/" . config('constants.autotrader_file_name');
//
//        /* ################### Import Auto Trader Product Start ################### */
//        try {
//            $content = file_get_contents($filePath);
//            $content = str_replace("}
//{", '},{', $content);
//            $content = '[' . $content . ']';
//            $products = json_decode($content, true);
//            if (!empty($products)) {
//                foreach ($products as $productDetail) {
//                    $isProductInsert = false;
//                    // If product exist then update details otherwise insert details
//                    $productModel = Product::where(["listing_id" => $productDetail['listing_id']])->first();
//                    if (!$productModel instanceof Product) {
//                        $productModel = new Product();
//                        $isProductInsert = true;
//                    }
//
//                    // Get old attributes
//                    $oldPrice = '';
//                    $oldMainImage = '';
//                    $oldThumbImageCount = '';
//                    $oldHasVideo = '';
//                    if ($isProductInsert == false) {
//                        $oldPrice = $productModel->price;
//                        $oldMainImage = $productModel->main_image;
//                        $oldThumbImageCount = $productModel->thumb_image_count;
//                        $oldHasVideo = $productModel->has_video;
//                    }
//
//                    $productModel->name = !empty($productDetail['name']) ? $productDetail['name'] : '';
//                    $productModel->description = !empty($productDetail['description']) ? $productDetail['description'] : '';
//                    $productModel->portal = $portal;
//                    $productModel->price = !empty($productDetail['price']) ? $productDetail['price'] : '';
//                    // Insert thumbnail image count
//                    $productModel->thumb_image_count = 0;
//                    if (!empty($productDetail['thumbnails'])) {
//                        $productModel->thumb_image_count = count($productDetail['thumbnails']);
//                    }
//                    // Insert has video flag
//                    $productModel->has_video = null;
//                    if (isset($productDetail['has_video'])) {
//                        $productModel->has_video = 'false';
//                        $productDetail['has_video'] = $productModel->has_video;
//                        if ($productDetail['has_video'] == true) {
//                            $productModel->has_video = 'true';
//                            $productDetail['has_video'] = $productModel->has_video;
//                        }
//                    }
//                    $productModel->image_count = !empty($productDetail['image_count']) ? $productDetail['image_count'] : 0;
//                    $productModel->main_image = !empty($productDetail['main_image']) ? $productDetail['main_image'] : '';
//                    $productModel->location = !empty($productDetail['location']) ? $productDetail['location'] : '';
//                    $productModel->seller = !empty($productDetail['seller']) ? $productDetail['seller'] : '';
//                    $productModel->review_score = !empty($productDetail['review_score']) ? $productDetail['review_score'] : '';
//                    $productModel->review_count = !empty($productDetail['review_count']) ? $productDetail['review_count'] : 0;
//                    $productModel->url = !empty($productDetail['url']) ? $productDetail['url'] : '';
//                    // Add scrape date only once
//                    if ($isProductInsert == true) {
//                        $productModel->scrape_date = !empty($productDetail['scrape_date']) ? $productDetail['scrape_date'] : null;
//                    }
//                    $productModel->listing_id = !empty($productDetail['listing_id']) ? $productDetail['listing_id'] : '';
//                    $productModel->listing_date = !empty($productDetail['listing_date']) ? date('Y-m-d', strtotime($productDetail['listing_date'])) : null;
//                    $productModel->car_id = !empty($productDetail['car_id']) ? $productDetail['car_id'] : 0;
//                    $productModel->reg_year = !empty($productDetail['reg_year']) ? $productDetail['reg_year'] : '';
//                    $productModel->body_type = !empty($productDetail['body_type']) ? $productDetail['body_type'] : '';
//                    $productModel->mileage = !empty($productDetail['mileage']) ? $productDetail['mileage'] : '';
//                    $productModel->engine = !empty($productDetail['engine']) ? $productDetail['engine'] : '';
//                    $productModel->hp = !empty($productDetail['hp']) ? $productDetail['hp'] : '';
//                    $productModel->transmission = !empty($productDetail['transmission']) ? $productDetail['transmission'] : '';
//                    $productModel->fuel = !empty($productDetail['fuel']) ? $productDetail['fuel'] : '';
//                    $productModel->vrm = !empty($productDetail['vrm']) ? $productDetail['vrm'] : '';
//                    if ($productModel->save()) {
//                        // Insert product price history
//                        if (!empty($productDetail['price']) && $productDetail['price'] != $oldPrice) {
//                            $this->insertProductPriceHistory($productModel->id, $productDetail['price'], $productDetail['scrape_date']);
//                        }
//
//                        // Insert product video history
//                        if (!empty($productDetail['has_video']) && $productDetail['has_video'] != $oldHasVideo) {
//                            $this->insertProductVideoHistory($productModel->id, $productDetail['has_video'], $productDetail['scrape_date']);
//                        }
//
//                        // Insert product thumb image count history
//                        if (!empty($productDetail['thumbnails']) && count($productDetail['thumbnails']) != $oldThumbImageCount) {
//                            $this->insertProductThumbImageCountHistory($productModel->id, count($productDetail['thumbnails']), $productDetail['scrape_date']);
//                        }
//
//                        // Insert product main image and it's history
//                        if (!empty($productDetail['main_image']) && $productDetail['main_image'] != $oldMainImage) {
//                            $this->insertProductMainImage($productModel->id, $productDetail['main_image'], $productDetail['scrape_date']);
//                        }
//
//                        if ($isProductInsert == false) {
//                            // Update product thumb images
//                            if (!empty($productDetail['thumbnails'])) {
//                                $this->updateProductThumbImages($productModel->id, $productDetail['thumbnails'], $productDetail['scrape_date']);
//                            }
//                        } else {
//                            // Insert product thumb images
//                            if (!empty($productDetail['thumbnails'])) {
//                                $this->insertProductThumbImages($productModel->id, $productDetail['thumbnails'], $productDetail['scrape_date']);
//                            }
//                        }
//
//                        if ($isProductInsert == false) {
//                            // Update product flags
//                            if (!empty($productDetail['flags'])) {
//                                $this->updateProductFlags($productModel->id, $productDetail['flags'], $productDetail['scrape_date']);
//                            }
//                        } else {
//                            // Insert product flags
//                            if (!empty($productDetail['flags'])) {
//                                $this->insertProductFlags($productModel->id, $productDetail['flags'], $productDetail['scrape_date']);
//                            }
//                        }
//                    }
//                }
//            }
//
//            return true;
//        } catch (\Exception $e) {
//            $message = $e->getMessage() . ' in ' . $e->getFile() . ' at line no.' . $e->getLine();
//            Log::channel('autotraderimportlog')->error($message);
//        } catch (\Throwable $e) {
//            $message = $e->getMessage() . ' in ' . $e->getFile() . ' at line no.' . $e->getLine();
//            Log::channel('autotraderimportlog')->error($message);
//        }
//        /* ################### Import Auto Trader Product End ################### */
//
//        return false;


//        $portal = Product::PORTAL_TYPE_RENAULT;
//        $filePath = storage_path() . "/json_files/" . config('constants.renault_file_name');
//
//        /* ################### Import Renault Product Start ################### */
//        try {
//            $content = file_get_contents($filePath);
//            $content = str_replace("}
//{", '},{', $content);
//            $content = '[' . $content . ']';
//            $products = json_decode($content, true);
//            if (!empty($products)) {
//                foreach ($products as $productDetail) {
//                    $isProductInsert = false;
//                    // If product exist then update details otherwise insert details
//                    $productModel = Product::where(["listing_id" => $productDetail['listing_id']])->first();
//                    if (!$productModel instanceof Product) {
//                        $productModel = new Product();
//                        $isProductInsert = true;
//                    }
//
//                    // Get old attributes
//                    $oldPrice = '';
//                    $oldMainImage = '';
//                    $oldThumbImageCount = '';
//                    $oldHasVideo = '';
//                    if ($isProductInsert == false) {
//                        $oldPrice = $productModel->price;
//                        $oldMainImage = $productModel->main_image;
//                        $oldThumbImageCount = $productModel->thumb_image_count;
//                        $oldHasVideo = $productModel->has_video;
//                    }
//
//                    $productModel->name = !empty($productDetail['name']) ? $productDetail['name'] : '';
//                    $productModel->description = !empty($productDetail['description']) ? $productDetail['description'] : '';
//                    $productModel->portal = $portal;
//                    // Insert reg date
//                    $productModel->reg_date = null;
//                    if (!empty($productDetail['reg_date'])) {
//                        $productModel->reg_date = date('Y-m-d', strtotime($productDetail['reg_date']));
//                    }
//                    $productModel->price = !empty($productDetail['price']) ? $productDetail['price'] : '';
//                    // Insert thumbnail image count
//                    $productModel->thumb_image_count = 0;
//                    if (!empty($productDetail['thumbnails'])) {
//                        $productModel->thumb_image_count = count($productDetail['thumbnails']);
//                    }
//                    // Insert has video flag
//                    $productModel->has_video = null;
//                    if (isset($productDetail['has_video'])) {
//                        $productModel->has_video = 'false';
//                        $productDetail['has_video'] = $productModel->has_video;
//                        if ($productDetail['has_video'] == true) {
//                            $productModel->has_video = 'true';
//                            $productDetail['has_video'] = $productModel->has_video;
//                        }
//                    }
//                    $productModel->image_count = !empty($productDetail['image_count']) ? $productDetail['image_count'] : 0;
//                    $productModel->main_image = !empty($productDetail['main_image']) ? $productDetail['main_image'] : '';
//                    $productModel->location = !empty($productDetail['location']) ? $productDetail['location'] : '';
//                    $productModel->seller = !empty($productDetail['seller']) ? $productDetail['seller'] : '';
//                    $productModel->review_score = !empty($productDetail['review_score']) ? $productDetail['review_score'] : '';
//                    $productModel->review_count = !empty($productDetail['review_count']) ? $productDetail['review_count'] : 0;
//                    $productModel->url = !empty($productDetail['url']) ? $productDetail['url'] : '';
//                    // Add scrape date only once
//                    if ($isProductInsert == true) {
//                        $productModel->scrape_date = !empty($productDetail['scrape_date']) ? $productDetail['scrape_date'] : null;
//                    }
//                    $productModel->listing_id = !empty($productDetail['listing_id']) ? $productDetail['listing_id'] : '';
//                    $productModel->listing_date = !empty($productDetail['listing_date']) ? date('Y-m-d', strtotime($productDetail['listing_date'])) : null;
//                    $productModel->car_id = !empty($productDetail['car_id']) ? $productDetail['car_id'] : 0;
//                    $productModel->reg_year = !empty($productDetail['reg_year']) ? $productDetail['reg_year'] : '';
//                    $productModel->body_type = !empty($productDetail['body_type']) ? $productDetail['body_type'] : '';
//                    $productModel->mileage = !empty($productDetail['mileage']) ? $productDetail['mileage'] : '';
//                    $productModel->engine = !empty($productDetail['engine']) ? $productDetail['engine'] : '';
//                    $productModel->hp = !empty($productDetail['hp']) ? $productDetail['hp'] : '';
//                    $productModel->transmission = !empty($productDetail['transmission']) ? $productDetail['transmission'] : '';
//                    $productModel->fuel = !empty($productDetail['fuel']) ? $productDetail['fuel'] : '';
//                    $productModel->vrm = !empty($productDetail['vrm']) ? $productDetail['vrm'] : '';
//                    if ($productModel->save()) {
//                        // Insert product price history
//                        if (!empty($productDetail['price']) && $productDetail['price'] != $oldPrice) {
//                            $this->insertProductPriceHistory($productModel->id, $productDetail['price'], $productDetail['scrape_date']);
//                        }
//
//                        // Insert product video history
//                        if (!empty($productDetail['has_video']) && $productDetail['has_video'] != $oldHasVideo) {
//                            $this->insertProductVideoHistory($productModel->id, $productDetail['has_video'], $productDetail['scrape_date']);
//                        }
//
//                        // Insert product thumb image count history
//                        if (!empty($productDetail['thumbnails']) && count($productDetail['thumbnails']) != $oldThumbImageCount) {
//                            $this->insertProductThumbImageCountHistory($productModel->id, count($productDetail['thumbnails']), $productDetail['scrape_date']);
//                        }
//
//                        // Insert product main image and it's history
//                        if (!empty($productDetail['main_image']) && $productDetail['main_image'] != $oldMainImage) {
//                            $this->insertProductMainImage($productModel->id, $productDetail['main_image'], $productDetail['scrape_date']);
//                        }
//
//                        if ($isProductInsert == false) {
//                            // Update product thumb images
//                            if (!empty($productDetail['thumbnails'])) {
//                                $this->updateProductThumbImages($productModel->id, $productDetail['thumbnails'], $productDetail['scrape_date']);
//                            }
//                        } else {
//                            // Insert product thumb images
//                            if (!empty($productDetail['thumbnails'])) {
//                                $this->insertProductThumbImages($productModel->id, $productDetail['thumbnails'], $productDetail['scrape_date']);
//                            }
//                        }
//
//                        if ($isProductInsert == false) {
//                            // Update product flags
//                            if (!empty($productDetail['flags'])) {
//                                $this->updateProductFlags($productModel->id, $productDetail['flags'], $productDetail['scrape_date']);
//                            }
//                        } else {
//                            // Insert product flags
//                            if (!empty($productDetail['flags'])) {
//                                $this->insertProductFlags($productModel->id, $productDetail['flags'], $productDetail['scrape_date']);
//                            }
//                        }
//                    }
//                }
//            }
//
//            return true;
//        } catch (\Exception $e) {
//            $message = $e->getMessage() . ' in ' . $e->getFile() . ' at line no.' . $e->getLine();
//            Log::channel('renaultimportlog')->error($message);
//        } catch (\Throwable $e) {
//            $message = $e->getMessage() . ' in ' . $e->getFile() . ' at line no.' . $e->getLine();
//            Log::channel('renaultimportlog')->error($message);
//        }
//        /* ################### Import Renault Product End ################### */
//
//        return false;
    }

    /**
     * Show the form for creating a new product
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View\
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created product
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);

        Product::create($request->all());

        return redirect()->route('products.index')
            ->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified product
     * @param Product $product
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified product
     * @param Product $product
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified product
     * @param Request $request
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);

        $product->update($request->all());

        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified product
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully');
    }
}
