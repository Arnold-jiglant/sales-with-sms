<?php

namespace App\Http\Controllers;

use App\Http\Resources\LossResource;
use App\InventoryProduct;
use App\Loss;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class LossController extends Controller
{
    public function getLosses($invProductID)
    {
        Gate::authorize('edit-inventory');
        return InventoryProduct::find($invProductID)->losses()->get()->transform(function (Loss $loss) {
            return new LossResource($loss);
        });
    }

    //add loss
    public function addLoss(Request $request, $invProductID)
    {
        Gate::authorize('edit-inventory');
        InventoryProduct::find($invProductID)->losses()->save(new Loss([
            'quantity' => $request->get('quantity'),
            'amount' => $request->get('amount'),
            'description' => $request->get('description'),
        ]));
        return response()->json(['success']);
    }

    //update loss
    public function update(Request $request, $id)
    {
        Gate::authorize('edit-inventory');
        $loss = Loss::find($id);
        if ($loss == null) {
            return response()->json([
                'Loss Info Not Found'
            ]);
        }
        $loss->quantity = $request->get('quantity');
        $loss->amount = $request->get('amount');
        $loss->description = $request->get('description');
        $loss->save();
        return response()->json(['success']);
    }

    //delete loss
    public function delete($id)
    {
        Gate::authorize('edit-inventory');
        $loss = Loss::find($id);
        $loss->delete();
        return response()->json(['success']);
    }
}
