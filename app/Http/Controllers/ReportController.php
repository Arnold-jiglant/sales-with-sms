<?php

namespace App\Http\Controllers;

use App\Inventory;
use App\Receipt;
use App\Sale;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    static public $MONTHLY = 'monthly';
    static public $YEARLY = 'yearly';


    public function dashboard()
    {
        //Today Sales
        $todaySales = Sale::whereDate('created_at', Carbon::today())->get()->sum(function ($sale) {
            return $sale->quantity * ($sale->sellingPrice - $sale->discount);
        });

        //Lats Month Sales
        $lastMonthSales = Sale::whereYear('created_at', Carbon::now()->subMonths()->year)->whereMonth('created_at', Carbon::now()->subMonths()->month)->get()
            ->sum(function ($sale) {
                return $sale->quantity * ($sale->sellingPrice - $sale->discount);
            });

        //Sales Progress
        $salesProgress = Inventory::unfinished()->get()->transform(function (Inventory $inventory) {
            return $inventory->progress;
        })->average();

        //Pending Debts
        $pendingDebts = Receipt::withDebt()->get()->sum(function (Receipt $receipt) {
            return $receipt->debtAmount;
        });

        //Stock Level
        $inventories = Inventory::unfinished()->orderBy('created_at')->get();
        $products = collect();
        foreach ($inventories as $inventory) {
            $products->add($inventory->inventoryProducts()->get()->filter(function ($product) {  //Filter product with qty>0
                return $product->remainingQty > 0;
            }));
        }
        $productStatus = $products->collapse()->take(7);


        //Latest Sales
        $latestSales = Sale::orderByDesc('created_at')->limit(5)->get();

        //Customer Debts
        $customerDebts = Receipt::withDebt()->limit(7)->get();

        //Sales Chart
        $salesOverview = collect();
        $title = 'Daily';

        $request = Request::capture();
        if ($request->has('time')) {
            if ($request->get('time') == self::$YEARLY) {
                for ($i = 0; $i < 7; $i++) {
                    $date = Carbon::now()->subYears($i);
                    $salesOverview->add(array(' ' . $date->year => Receipt::whereDate('created_at', $date)->get()
                        ->sum(function ($receipt) {
                            return $receipt->payedAmount;
                        })));
                }
                $title = 'Yearly';
                $salesOverview = $salesOverview->collapse()->reverse();
            } else {
                for ($i = 0; $i < 7; $i++) {
                    $date = Carbon::now()->subMonths($i);
                    $salesOverview->add(array(substr($date->monthName, 0, 3) => Receipt::whereDate('created_at', $date)->get()
                        ->sum(function ($receipt) {
                            return $receipt->payedAmount;
                        })));
                }
                $title = 'Monthly';
                $salesOverview = $salesOverview->collapse()->reverse();
            }
        } else {
            for ($i = 0; $i < 7; $i++) {
                $date = Carbon::now()->subDays($i);
                $salesOverview->add(array($i == 0 ? 'Today' : $date->day . ' ' . substr($date->dayName, 0, 3) => Receipt::whereDate('created_at', $date)->get()
                    ->sum(function ($receipt) {
                        return $receipt->payedAmount;
                    })));
            }
            $salesOverview = $salesOverview->collapse()->reverse();
        }


        return view('dashboard',
            compact('todaySales', 'lastMonthSales', 'salesProgress', 'pendingDebts', 'latestSales', 'productStatus', 'salesOverview', 'title','customerDebts'));
    }
}
