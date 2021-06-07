<?php

namespace App\Http\Controllers;

use File;
use Image;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class ProductController
 * @package App\Http\Controllers
 */
class ProductController extends Controller
{

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
        die("Working");
        $portal = 1;
        $path = storage_path() . "/json/autotrader_co_uk.jl";
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
                        $this->newPriceInsert($value['price'], $productId);
                    }

                    if (isset($mainImage) && $mainImage != '') {
                        $createDirName = '/images/autotrader_co_uk/' . $value['listing_id'] . '/main_image/' . date('Y-m-d');
                        $this->mainImageInsert($mainImage, $productId, $createDirName);
                    }

                    if (isset($thumbnails) && $thumbnails != '') {
                        $createDirName = '/images/autotrader_co_uk/' . $value['listing_id'] . '/thumbnails/' . date('Y-m-d');
                        $this->thumbImageInsert($thumbnails, $productId, $createDirName);
                    }

                    if (isset($flags) && $flags != '') {
                        $this->flagsInsert($flags, $productId);
                    }
                }
            } else {
                if (isset($mainImage) && $mainImage) {
                    $createDirName = '/images/autotrader_co_uk/' . $value['listing_id'] . '/main_image/' . date('Y-m-d');
                    $this->mainImageUpdate($mainImage, $pId, $createDirName);
                }

                $value['updated_at'] = date('Y-m-d H:i:s');
                DB::table('products')->where('id', $pId)->update($value);

                if (isset($value['price']) && $value['price'] != $oldPrice) {
                    $this->newPriceInsert($value['price'], $pId);
                }

                if (isset($thumbnails) && $thumbnails != '') {
                    $createDirName = '/images/autotrader_co_uk/' . $value['listing_id'] . '/thumbnails/' . date('Y-m-d');
                    $this->thumbImageUpdate($thumbnails, $pId, $createDirName);
                }

                if (isset($flags) && $flags != '') {
                    $this->flagsUpdate($flags, $pId);
                }
            }
        }
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
