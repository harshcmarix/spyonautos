<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class ThumbImageCountHistory
 * @package App\Models
 */
class ThumbImageCountHistory extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = "thumb_image_count_history";

    /**
     * Get products
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function products()
    {
        return $this->belongsTo('App\Models\Product');
    }
}
