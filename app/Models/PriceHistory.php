<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class PriceHistory
 * @package App\Models
 */
class PriceHistory extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = "price_history";

    /**
     * Get products
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function products()
    {
        return $this->belongsTo('App\Models\Product');
    }
}
