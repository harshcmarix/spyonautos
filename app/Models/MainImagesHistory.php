<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class MainImagesHistory
 * @package App\Models
 */
class MainImagesHistory extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = "main_images_history";

    /**
     * Get products
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function products()
    {
        return $this->belongsTo('App\Models\Product');
    }
}
