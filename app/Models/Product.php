<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Eloquent;
class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
        'name', 'description', 'portal', 'reg_date', 'price', 'thumb_image_count', 'image_count', 'main_image','location','seller','review_score','review_count','url','scrape_date','has_video','listing_id','listing_date','car_id','reg_year','body_type','mileage','engine','hp','transmission','fuel','vrm'
    ];

    public function priceHistory()
    {
        return $this->hasMany('App\Models\PriceHistory','productId')->limit(4)->orderBy('created_at', 'DESC');
    }

    public function mainImagesHistory()
    {
        return $this->hasMany('App\Models\MainImagesHistory','productId');
    }

    public function thumbImageCountHistory()
    {
        return $this->hasMany('App\Models\ThumbImageCountHistory','productId');
    }
}
