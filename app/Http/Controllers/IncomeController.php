<?php

namespace App\Http\Controllers;

use App\Income;
use App\IncomeType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class IncomeController extends Controller
{
    public function index()
    {
        Gate::authorize('view-incomes');
        $request = Request::capture();
        $incomes = collect();
        $title = "";
        if ($request->has('type')) {
            $IncomeType = IncomeType::find($request->get('type'));
            if ($IncomeType != null) {
                $title = $IncomeType->name;
                $incomes = $IncomeType->incomes()->orderByDesc('created_at')->paginate(10);
            } else {
                $incomes = Income::orderByDesc('created_at')->paginate(10);
            }
        } else {
            $incomes = Income::orderByDesc('created_at')->paginate(10);
        }
        $incomeTypes = IncomeType::orderBy('name')->get();
        return view('incomes', compact('incomes', 'incomeTypes', 'title'));
    }

    //add income
    public function add(Request $request)
    {
        Gate::authorize('add-income');
        $this->validate($request, [
            'incomeType' => 'required|integer',
            'amount' => 'required|integer|min:0',
        ]);
        Income::create([
            'income_type_id' => $request->get('incomeType'),
            'amount' => $request->get('amount'),
            'description' => $request->get('description'),
            'issuer' => auth()->id()
        ]);
        return redirect()->back()->with('success', 'Income Added');
    }

    //update income
    public function update(Request $request, $id)
    {
        Gate::authorize('edit-income');
        $income = Income::find($id);
        if ($income == null) {
            return redirect()->back()->with('error', 'Income Not Found');
        }
        $this->validate($request, [
            'incomeType' => 'required|integer',
            'amount' => 'required|integer|min:0',
        ]);
        $income->income_type_id = $request->get('incomeType');
        $income->amount = $request->get('amount');
        $income->description = $request->get('description');
        $income->save();
        return redirect()->back()->with('success', 'Income Updated!');
    }

    //delete income
    public function delete($id)
    {
        Gate::authorize('delete-income');
        $income = Income::find($id);
        if ($income == null) {
            return redirect()->back()->with('error', 'Income Not Found');
        }
        $income->delete();
        return redirect()->back()->with('success', 'Income Deleted!');
    }
}
