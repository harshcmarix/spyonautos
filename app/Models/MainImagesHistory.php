<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Eloquent;
class MainImagesHistory extends Model
{
    use HasFactory;

    protected $table = "main_images_history";

    public function products()
    {
        return $this->belongsTo('App\Models\Product');
    }
}
