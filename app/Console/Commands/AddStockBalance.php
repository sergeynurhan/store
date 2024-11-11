<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;

class AddStockBalance extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:add-stock-balance';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $products = Product::all();

        foreach ($products as $product)
        {
            if ($product->stock_balance < 100)
            {
                $product->increment('stock_balance', 10);
            }
        }
    }
}
