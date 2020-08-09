<?php

namespace App\Http\Controllers;

use App\Inventory;
use App\Receipt;
use App\Sale;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function dashboard()
    {
        $todaySales = Sale::whereDate('created_at', Carbon::today())->get()->sum(function ($sale) {
            return $sale->quantity * ($sale->sellingPrice - $sale->discount);
        });
        $lastMonthSales = Sale::whereMonth('created_at', Carbon::now()->subMonths()->month)->get()
            ->sum(function ($sale) {
                return $sale->quantity * ($sale->sellingPrice - $sale->discount);
            });
        $salesProgress = Inventory::unfinished()->get()->transform(function (Inventory $inventory) {
            return $inventory->progress;
        })->average();
        $pendingDebts = Receipt::withDebt()->get()->sum(function (Receipt $receipt) {
            return $receipt->debtAmount;
        });
        $latestSales = Sale::orderByDesc('created_at')->limit(5)->get();
        $inventories = Inventory::unfinished()->orderBy('created_at')->get();
        $products = collect();
        foreach ($inventories as $inventory) {
            $products->add($inventory->inventoryProducts()->get()->filter(function ($product) {  //Filter product with qty>0
                return $product->remainingQty > 0;
            }));
        }
        $productStatus = $products->collapse()->take(7);

        return view('dashboard', compact('todaySales', 'lastMonthSales', 'salesProgress','pendingDebts','latestSales','productStatus'));
    }
}
