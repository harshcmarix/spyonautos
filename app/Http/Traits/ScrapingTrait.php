<?php

namespace App\Http\Traits;

use App\Models\{
    ProductFlag,
    PriceHistory,
    MainImagesHistory,
    ProductMainImage,
    ProductThumbImage,
    ThumbImageCountHistory,
    VideoHistory
};
use Illuminate\Support\Facades\DB;

/**
 * Trait ScrapingTrait
 * @package App\Http\Traits
 */
trait ScrapingTrait
{
    /**
     * Insert product price history
     * @param int $productId
     * @param $price
     * @param string $scrapeDate
     * @return bool
     */
    public function insertProductPriceHistory(int $productId, $price, string $scrapeDate): bool
    {
        if (!empty($productId) && !empty($price) && !empty($scrapeDate)) {
//            $priceHistoryModel = new PriceHistory();
//            $priceHistoryModel->productId = $productId;
//            $priceHistoryModel->price = $price;
//            $priceHistoryModel->scrape_date = $scrapeDate;
//            if ($priceHistoryModel->save()) {
//                return true;
//            }
            $data = [];
            $data['productId'] = $productId;
            $data['price'] = $price;
            $data['scrape_date'] = $scrapeDate;
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['updated_at'] = date('Y-m-d H:i:s');

            DB::table('price_history')->insert($data);

            return true;
        }

        return false;
    }

    /**
     * Insert product video history
     * @param int $productId
     * @param string $hasVideo
     * @param string $scrapeDate
     * @return bool
     */
    public function insertProductVideoHistory(int $productId, string $hasVideo, string $scrapeDate): bool
    {
        if (!empty($productId) && !empty($hasVideo) && !empty($scrapeDate)) {
//            $videoHistoryModel = new VideoHistory();
//            $videoHistoryModel->productId = $productId;
//            $videoHistoryModel->has_video = $hasVideo;
//            $videoHistoryModel->scrape_date = $scrapeDate;
//            if ($videoHistoryModel->save()) {
//                return true;
//            }
            $data = [];
            $data['productId'] = $productId;
            $data['has_video'] = $hasVideo;
            $data['scrape_date'] = $scrapeDate;
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['updated_at'] = date('Y-m-d H:i:s');

            DB::table('video_history')->insert($data);

            return true;
        }

        return false;
    }

    /**
     * Insert product thumb image count history
     * @param int $productId
     * @param int $imageCount
     * @param string $scrapeDate
     * @return bool
     */
    public function insertProductThumbImageCountHistory(int $productId, int $imageCount, string $scrapeDate): bool
    {
        if (!empty($productId) && !empty($imageCount) && !empty($scrapeDate)) {
//            $thumbImageCountHistoryModel = new ThumbImageCountHistory();
//            $thumbImageCountHistoryModel->productId = $productId;
//            $thumbImageCountHistoryModel->count = $imageCount;
//            $thumbImageCountHistoryModel->scrape_date = $scrapeDate;
//            if ($thumbImageCountHistoryModel->save()) {
//                return true;
//            }

            $data = [];
            $data['productId'] = $productId;
            $data['count'] = $imageCount;
            $data['scrape_date'] = $scrapeDate;
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['updated_at'] = date('Y-m-d H:i:s');

            DB::table('thumb_image_count_history')->insert($data);

            return true;
        }

        return false;
    }

    /**
     * Insert product main image and it's history
     * @param int $productId
     * @param string $mainImage
     * @param string $scrapeDate
     * @return bool
     */
    public function insertProductMainImage(int $productId, string $mainImage, string $scrapeDate): bool
    {
        if (!empty($productId) && !empty($mainImage) && !empty($scrapeDate)) {
//            // Insert product main image
//            $productMainImageModel = new ProductMainImage();
//            $productMainImageModel->productId = $productId;
//            $productMainImageModel->url = $mainImage;
//            $productMainImageModel->scrape_date = $scrapeDate;
//            if ($productMainImageModel->save()) {
//                // Insert product main image history
//                $mainImagesHistoryModel = new MainImagesHistory();
//                $mainImagesHistoryModel->productId = $productId;
//                $mainImagesHistoryModel->url = $mainImage;
//                $mainImagesHistoryModel->scrape_date = $scrapeDate;
//                $mainImagesHistoryModel->save();
//
//                return true;
//            }

            $data = [];
            $data['productId'] = $productId;
            $data['url'] = $mainImage;
            $data['scrape_date'] = $scrapeDate;
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['updated_at'] = date('Y-m-d H:i:s');
            DB::table('product_main_images')->insert($data);
            DB::table('main_images_history')->insert($data);

            return true;
        }

        return false;
    }

    /**
     * Insert product thumb images
     * @param int $productId
     * @param array $thumbImages
     * @param string $scrapeDate
     * @return bool
     */
    public function insertProductThumbImages(int $productId, array $thumbImages, string $scrapeDate): bool
    {
        if (!empty($productId) && !empty($thumbImages) && !empty($scrapeDate)) {
            $productThumbImages = [];
            foreach ($thumbImages as $thumbImage) {
//                $productThumbImageModel = new ProductThumbImage();
//                $productThumbImageModel->productId = $productId;
//                $productThumbImageModel->url = $thumbImage;
//                $productThumbImageModel->scrape_date = $scrapeDate;
//                $productThumbImageModel->save();
                $data = [];
                $data['productId'] = $productId;
                $data['url'] = $thumbImage;
                $data['scrape_date'] = $scrapeDate;
                $data['created_at'] = date('Y-m-d H:i:s');
                $data['updated_at'] = date('Y-m-d H:i:s');
                $productThumbImages[] = $data;
            }
            DB::table('product_thumb_images')->insert($productThumbImages);

            return true;
        }

        return false;
    }

    /**
     * Update product thumb images
     * @param int $productId
     * @param array $thumbImages
     * @param string $scrapeDate
     * @return bool
     */
    public function updateProductThumbImages(int $productId, array $thumbImages, string $scrapeDate): bool
    {
        if (!empty($productId) && !empty($thumbImages) && !empty($scrapeDate)) {
            $arrayDiff1 = $thumbImages;
            $arrayDiff2 = $thumbImages;
            $productThumbImages = ProductThumbImage::select('url')->where(array('productId' => $productId))->get()->all();
            if (!empty($productThumbImages)) {
                $resultArray = array_column($productThumbImages, 'url');
                $arrayDiff1 = array_diff($thumbImages, $resultArray);
                $arrayDiff2 = array_diff($resultArray, $thumbImages);
            }

            if (!empty($arrayDiff1) || !empty($arrayDiff2)) {
                DB::table('product_thumb_images')->where('productId', $productId)->delete();

                $productThumbImages = [];
                foreach ($thumbImages as $thumbImage) {
//                    $productThumbImageModel = new ProductThumbImage();
//                    $productThumbImageModel->productId = $productId;
//                    $productThumbImageModel->url = $thumbImage;
//                    $productThumbImageModel->scrape_date = $scrapeDate;
//                    $productThumbImageModel->save();
                    $data = [];
                    $data['productId'] = $productId;
                    $data['url'] = $thumbImage;
                    $data['scrape_date'] = $scrapeDate;
                    $data['created_at'] = date('Y-m-d H:i:s');
                    $data['updated_at'] = date('Y-m-d H:i:s');
                    $productThumbImages[] = $data;
                }

                DB::table('product_thumb_images')->insert($productThumbImages);
            }

            return true;
        }

        return false;
    }

    /**
     * Insert product flags
     * @param int $productId
     * @param array $flags
     * @param string $scrapeDate
     * @return bool
     */
    public function insertProductFlags(int $productId, array $flags, string $scrapeDate): bool
    {
        if (!empty($productId) && !empty($flags) && !empty($scrapeDate)) {
            $productFlags = [];
            foreach ($flags as $flag) {
//                $productFlagModel = new ProductFlag();
//                $productFlagModel->productId = $productId;
//                $productFlagModel->flag = $flag;
//                $productFlagModel->scrape_date = $scrapeDate;
//                $productFlagModel->save();
                $flagData = [];
                $flagData['productId'] = $productId;
                $flagData['flag'] = $flag;
                $flagData['scrape_date'] = $scrapeDate;
                $flagData['created_at'] = date('Y-m-d H:i:s');
                $flagData['updated_at'] = date('Y-m-d H:i:s');
                $productFlags[] = $flagData;
            }
            DB::table('product_flags')->insert($productFlags);

            return true;
        }

        return false;
    }

    /**
     * Update product flags
     * @param int $productId
     * @param array $flags
     * @param string $scrapeDate
     * @return bool
     */
    public function updateProductFlags(int $productId, array $flags, string $scrapeDate): bool
    {
        if (!empty($productId) && !empty($flags) && !empty($scrapeDate)) {
            $arrayDiff1 = $flags;
            $arrayDiff2 = $flags;
            $productFlags = ProductFlag::select('flag')->where(array('productId' => $productId))->get()->all();
            if (!empty($productFlags)) {
                $resultArray = array_column($productFlags, 'flag');
                $arrayDiff1 = array_diff($flags, $resultArray);
                $arrayDiff2 = array_diff($resultArray, $flags);
            }

            if (!empty($arrayDiff1) || !empty($arrayDiff2)) {
                DB::table('product_flags')->where('productId', $productId)->delete();
                $productFlags = [];
                foreach ($flags as $flag) {
//                    $productFlagModel = new ProductFlag();
//                    $productFlagModel->productId = $productId;
//                    $productFlagModel->flag = $flag;
//                    $productFlagModel->scrape_date = $scrapeDate;
//                    $productFlagModel->save();
                    $flagData = [];
                    $flagData['productId'] = $productId;
                    $flagData['flag'] = $flag;
                    $flagData['scrape_date'] = $scrapeDate;
                    $flagData['created_at'] = date('Y-m-d H:i:s');
                    $flagData['updated_at'] = date('Y-m-d H:i:s');
                    $productFlags[] = $flagData;
                }
                DB::table('product_flags')->insert($productFlags);
            }

            return true;
        }

        return false;
    }
}
