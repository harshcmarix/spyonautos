<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;
use App\Http\Traits\ScrapingTrait;
use Illuminate\Support\Facades\Log;

/**
 * Class RenaultImport
 * @package App\Console\Commands
 */
class RenaultImport extends Command
{
    /**
     * Use scraping trait
     */
    use ScrapingTrait;

    /**
     * The name and signature of the console command
     * @var string
     */
    protected $signature = 'import:renaultImport';

    /**
     * The console command description
     * @var string
     */
    protected $description = 'This command is used to import renault products from json file';

    /**
     * Create a new command instance
     * RenaultImport constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command
     * @return int
     */
    public function handle()
    {
        $portal = Product::PORTAL_TYPE_RENAULT;
        $filePath = storage_path() . "/json_files/" . config('constants.renault_file_name');

        /* ################### Import Renault Product Start ################### */
        try {
            $content = file_get_contents($filePath);
            $content = str_replace("}
{", '},{', $content);
            $content = '[' . $content . ']';
            $products = json_decode($content, true);
            if (!empty($products)) {
                foreach ($products as $productDetail) {
                    $isProductInsert = false;
                    // If product exist then update details otherwise insert details
                    $productModel = Product::where(["listing_id" => $productDetail['listing_id']])->first();
                    if (!$productModel instanceof Product) {
                        $productModel = new Product();
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

                    $productModel->name = !empty($productDetail['name']) ? $productDetail['name'] : '';
                    $productModel->description = !empty($productDetail['description']) ? $productDetail['description'] : '';
                    $productModel->portal = $portal;
                    // Insert reg date
                    $productModel->reg_date = null;
                    if (!empty($productDetail['reg_date'])) {
                        $productModel->reg_date = date('Y-m-d', strtotime($productDetail['reg_date']));
                    }
                    $productModel->price = !empty($productDetail['price']) ? $productDetail['price'] : '';
                    // Insert thumbnail image count
                    $productModel->thumb_image_count = 0;
                    if (!empty($productDetail['thumbnails'])) {
                        $productModel->thumb_image_count = count($productDetail['thumbnails']);
                    }
                    // Insert has video flag
                    $productModel->has_video = null;
                    if (isset($productDetail['has_video'])) {
                        $productModel->has_video = 'false';
                        $productDetail['has_video'] = $productModel->has_video;
                        if ($productDetail['has_video'] == true) {
                            $productModel->has_video = 'true';
                            $productDetail['has_video'] = $productModel->has_video;
                        }
                    }
                    $productModel->image_count = !empty($productDetail['image_count']) ? $productDetail['image_count'] : 0;
                    $productModel->main_image = !empty($productDetail['main_image']) ? $productDetail['main_image'] : '';
                    $productModel->location = !empty($productDetail['location']) ? $productDetail['location'] : '';
                    $productModel->seller = !empty($productDetail['seller']) ? $productDetail['seller'] : '';
                    $productModel->review_score = !empty($productDetail['review_score']) ? $productDetail['review_score'] : '';
                    $productModel->review_count = !empty($productDetail['review_count']) ? $productDetail['review_count'] : 0;
                    $productModel->url = !empty($productDetail['url']) ? $productDetail['url'] : '';
                    $productModel->scrape_date = !empty($productDetail['scrape_date']) ? $productDetail['scrape_date'] : '';
                    $productModel->listing_id = !empty($productDetail['listing_id']) ? $productDetail['listing_id'] : '';
                    $productModel->listing_date = !empty($productDetail['listing_date']) ? $productDetail['listing_date'] : null;
                    $productModel->car_id = !empty($productDetail['car_id']) ? $productDetail['car_id'] : 0;
                    $productModel->reg_year = !empty($productDetail['reg_year']) ? $productDetail['reg_year'] : '';
                    $productModel->body_type = !empty($productDetail['body_type']) ? $productDetail['body_type'] : '';
                    $productModel->mileage = !empty($productDetail['mileage']) ? $productDetail['mileage'] : '';
                    $productModel->engine = !empty($productDetail['engine']) ? $productDetail['engine'] : '';
                    $productModel->hp = !empty($productDetail['hp']) ? $productDetail['hp'] : '';
                    $productModel->transmission = !empty($productDetail['transmission']) ? $productDetail['transmission'] : '';
                    $productModel->fuel = !empty($productDetail['fuel']) ? $productDetail['fuel'] : '';
                    $productModel->vrm = !empty($productDetail['vrm']) ? $productDetail['vrm'] : '';
                    if ($productModel->save()) {
                        // Insert product price history
                        if (!empty($productDetail['price']) && $productDetail['price'] != $oldPrice) {
                            $this->insertProductPriceHistory($productModel->id, $productDetail['price'], $productDetail['scrape_date']);
                        }

                        // Insert product video history
                        if (!empty($productDetail['has_video']) && $productDetail['has_video'] != $oldHasVideo) {
                            $this->insertProductVideoHistory($productModel->id, $productDetail['has_video'], $productDetail['scrape_date']);
                        }

                        // Insert product thumb image count history
                        if (!empty($productDetail['thumbnails']) && count($productDetail['thumbnails']) != $oldThumbImageCount) {
                            $this->insertProductThumbImageCountHistory($productModel->id, count($productDetail['thumbnails']), $productDetail['scrape_date']);
                        }

                        // Insert product main image and it's history
                        if (!empty($productDetail['main_image']) && $productDetail['main_image'] != $oldMainImage) {
                            $this->insertProductMainImage($productModel->id, $productDetail['main_image'], $productDetail['scrape_date']);
                        }

                        if ($isProductInsert == false) {
                            // Update product thumb images
                            if (!empty($productDetail['thumbnails'])) {
                                $this->updateProductThumbImages($productModel->id, $productDetail['thumbnails'], $productDetail['scrape_date']);
                            }
                        } else {
                            // Insert product thumb images
                            if (!empty($productDetail['thumbnails'])) {
                                $this->insertProductThumbImages($productModel->id, $productDetail['thumbnails'], $productDetail['scrape_date']);
                            }
                        }

                        if ($isProductInsert == false) {
                            // Update product flags
                            if (!empty($productDetail['flags'])) {
                                $this->updateProductFlags($productModel->id, $productDetail['flags'], $productDetail['scrape_date']);
                            }
                        } else {
                            // Insert product flags
                            if (!empty($productDetail['flags'])) {
                                $this->insertProductFlags($productModel->id, $productDetail['flags'], $productDetail['scrape_date']);
                            }
                        }
                    }
                }
            }

            return true;
        } catch (\Exception $e) {
            $message = $e->getMessage() . ' in ' . $e->getFile() . ' at line no.' . $e->getLine();
            Log::channel('renaultimportlog')->error($message);
        } catch (\Throwable $e) {
            $message = $e->getMessage() . ' in ' . $e->getFile() . ' at line no.' . $e->getLine();
            Log::channel('renaultimportlog')->error($message);
        }
        /* ################### Import Renault Product End ################### */

        return false;
    }
}
