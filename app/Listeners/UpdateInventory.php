<?php

namespace App\Listeners;

use App\Events\InventoryChanged;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateInventory
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param InventoryChanged $event
     * @return void
     */
    public function handle(InventoryChanged $event)
    {
        $inventory = $event->inventory;
        $invProducts = $inventory->inventoryProducts()->get();
        $inventory->Cost = $invProducts->sum(function ($product) {
            return $product->cost;
        });
        $inventory->expectedAmount = $invProducts->sum(function ($product) {
            return ($product->sellingPrice * $product->remainingQty) + $product->SaleAmount;
        });
        $inventory->save();
    }
}
