<?php

namespace App\Mail;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Class ProductImportStart
 * @package App\Mail
 */
class ProductImportStart extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Identify import type
     * @var string
     */
    public $importType = '';

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($portal)
    {
        $this->importType = '';
        if ($portal == Product::PORTAL_TYPE_AUTOTRADER) {
            $this->importType = 'auto-trader';
        }
        if ($portal == Product::PORTAL_TYPE_RENAULT) {
            $this->importType = 'renault';
        }
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Product Import Start')
            ->view('emails.product-import-start')
            ->from(config('constants.support_email'));
    }
}
