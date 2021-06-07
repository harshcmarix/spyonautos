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
        return $this->hasMany('App\Models\PriceHistory', 'productId')->limit(4)->orderBy('created_at', 'DESC');
    }

    /**
     * Get main image history
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function mainImagesHistory()
    {
        return $this->hasMany('App\Models\MainImagesHistory', 'productId');
    }

    /**
     * Get thumbnail image count history
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function thumbImageCountHistory()
    {
        return $this->hasMany('App\Models\ThumbImageCountHistory', 'productId');
    }
}
