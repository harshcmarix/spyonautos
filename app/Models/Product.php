<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Product
 * @package App\Models
 */
class Product extends Model
{
    use HasFactory;

    /**
     * Identify portal type
     */
    const PORTAL_TYPE_AUTOTRADER = 1;
    const PORTAL_TYPE_RENAULT = 2;

    /**
     * @var string
     */
    protected $table = 'products';

    /**
     * @var string[]
     */
    protected $fillable = [
        'name', 'description', 'portal', 'reg_date', 'price', 'thumb_image_count', 'image_count', 'main_image', 'location', 'seller', 'review_score', 'review_count', 'url', 'scrape_date', 'has_video', 'listing_id', 'listing_date', 'car_id', 'reg_year', 'body_type', 'mileage', 'engine', 'hp', 'transmission', 'fuel', 'vrm'
    ];

    /**
     * Get price history
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function priceHistory()
    {
        return $this->hasMany('App\Models\PriceHistory', 'productId')->limit(4)->orderBy('scrape_date', 'DESC');
    }

    /**
     * Get main image history
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function mainImagesHistory()
    {
        return $this->hasMany('App\Models\MainImagesHistory', 'productId')->limit(4)->orderBy('scrape_date', 'DESC');
    }

    /**
     * Get thumbnail image count history
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function thumbImageCountHistory()
    {
        return $this->hasMany('App\Models\ThumbImageCountHistory', 'productId')->limit(4)->orderBy('scrape_date', 'DESC');
    }
}
