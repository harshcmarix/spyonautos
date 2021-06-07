<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Log;
use Illuminate\Console\Command;
use App\Http\Controllers\ProductController;

/**
 * Class ScrapingCron
 * @package App\Console\Commands
 */
class ScrapingCron extends Command
{
    /**
     * The name and signature of the console command.
     * @var string
     */
    protected $signature = 'scraping:cron';

    /**
     * The console command description.
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->ProductController = new ProductController;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Log::info("Cron is working fine!");

        Log::channel('customlog')->info("Process Start: Autotrader");
        $link = storage_path() . "/json_files/autotrader_co_uk.jl";
        $this->ProductController->start_reading_autotrader($link);
        Log::channel('customlog')->info("Process End: Autotrader");


        Log::channel('customlog')->info("Process Start: Renault");
        $link = storage_path() . "/json_files/renault_co_uk.jl";
        $this->ProductController->start_reading_renault($link);
        Log::channel('customlog')->info("Process End: Renault");
    }
}
