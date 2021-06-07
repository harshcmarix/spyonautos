<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Eloquent;
class ThumbImageCountHistory extends Model
{
    use HasFactory;

    protected $table = "thumb_image_count_history";

    public function products()
    {
        return $this->belongsTo('App\Models\Product');
    }
}
