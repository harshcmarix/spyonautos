<?php

namespace App\Jobs;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Http\Traits\ScrapingTrait;
use Illuminate\Support\Facades\DB;

/**
 * Class AutoTraderImportProcess
 * @package App\Jobs
 */
class AutoTraderImportProcess implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 250;

    /**
     * Use scraping trait
     */
    use ScrapingTrait;

    public $products = [];

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($products)
    {
        $this->products = $products;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
//        ini_set('memory_limit', '1G');
//        ini_set('max_execution_time', '0');
        $portal = Product::PORTAL_TYPE_AUTOTRADER;
        $products = $this->products;
        if (!empty($products)) {
            foreach ($products as $productDetail) {
                $productDetail['portal'] = $portal;
                /* ################### Insert/Update Product Start ################### */
                $isProductInsert = false;
                // If product exist then update details otherwise insert details
                $productModel = Product::where(["listing_id" => $productDetail['listing_id']])->first();
                if (!$productModel instanceof Product) {
                    $isProductInsert = true;
                }

                // Get old attributes
                $oldPrice = '';
                $oldMainImage = '';
                $oldThumbImageCount = '';
                $oldHasVideo = '';
                if ($isProductInsert == false) {
                    $oldPrice = $productModel->price;
                    $oldMainImage = $productModel->main_image;
                    $oldThumbImageCount = $productModel->thumb_image_count;
                    $oldHasVideo = $productModel->has_video;
                }

                // Insert thumbnail image count
                $productDetail['thumb_image_count'] = 0;
                if (!empty($productDetail['thumbnails'])) {
                    $thumbnails = $productDetail['thumbnails'];
                    $productDetail['thumb_image_count'] = count($productDetail['thumbnails']);
                    unset($productDetail['thumbnails']);
                }

                // Insert flags
                if (!empty($productDetail['flags'])) {
                    $flags = $productDetail['flags'];
                    unset($productDetail['flags']);
                }

                // Insert has video flag
                if (isset($productDetail['has_video'])) {
                    $productDetail['has_video'] = 'false';
                    if ($productDetail['has_video'] == true) {
                        $productDetail['has_video'] = 'true';
                    }
                }

                if (!empty($productDetail['listing_date'])) {
                    $productDetail['listing_date'] = date('Y-m-d', strtotime($productDetail['listing_date']));
                }

                if ($isProductInsert == true) {
                    $product = Product::create($productDetail);
                    $productId = DB::getPdo()->lastInsertId();
                } else {
                    $productId = $productModel->id;
                    // Not update scrape date
                    unset($productDetail['scrape_date']);

                    $productDetail['updated_at'] = date('Y-m-d H:i:s');
                    DB::table('products')->where('id', $productId)->update($productDetail);
                }
                /* ################### Insert/Update Product End ################### */

                /* ################### Insert/Update Product Details Start ################### */
                if (!empty($productId)) {
                    // Insert product price history
                    if (!empty($productDetail['price']) && $productDetail['price'] != $oldPrice) {
                        $this->insertProductPriceHistory($productId, $productDetail['price'], $productDetail['scrape_date']);
                    }

                    // Insert product video history
                    if (!empty($productDetail['has_video']) && $productDetail['has_video'] != $oldHasVideo) {
                        $this->insertProductVideoHistory($productId, $productDetail['has_video'], $productDetail['scrape_date']);
                    }

                    // Insert product thumb image count history
                    if (!empty($thumbnails) && count($thumbnails) != $oldThumbImageCount) {
                        $this->insertProductThumbImageCountHistory($productId, count($thumbnails), $productDetail['scrape_date']);
                    }

                    // Insert product main image and it's history
                    if (!empty($productDetail['main_image']) && $productDetail['main_image'] != $oldMainImage) {
                        $this->insertProductMainImage($productId, $productDetail['main_image'], $productDetail['scrape_date']);
                    }

                    if ($isProductInsert == false) {
                        // Update product thumb images
                        if (!empty($thumbnails)) {
                            $this->updateProductThumbImages($productId, $thumbnails, $productDetail['scrape_date']);
                        }
                    } else {
                        // Insert product thumb images
                        if (!empty($thumbnails)) {
                            $this->insertProductThumbImages($productId, $thumbnails, $productDetail['scrape_date']);
                        }
                    }

                    if ($isProductInsert == false) {
                        // Update product flags
                        if (!empty($flags)) {
                            $this->updateProductFlags($productId, $flags, $productDetail['scrape_date']);
                        }
                    } else {
                        // Insert product flags
                        if (!empty($flags)) {
                            $this->insertProductFlags($productId, $flags, $productDetail['scrape_date']);
                        }
                    }
                }
                /* ################### Insert/Update Product Details End ################### */
            }

            return true;
        }

        return false;
    }
}
