<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Models\Product;

class addProductJob implements ShouldQueue
{
    use Queueable;
    protected $productName;

    /**
     * Create a new job instance.
     */
    public function __construct($productName)
    {
        $this->productName = $productName;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Product::create($this->productName);
    }
}
