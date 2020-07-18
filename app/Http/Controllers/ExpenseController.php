<?php

namespace App\Http\Controllers;

use App\Expense;
use App\ExpenseType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ExpenseController extends Controller
{
    public function index()
    {
        Gate::authorize('view-expenses');
        $request = Request::capture();
        $expenses = collect();
        $title = "";
        if ($request->has('type')) {
            $expenseType = ExpenseType::find($request->get('type'));
            if ($expenseType != null) {
                $title = $expenseType->name;
                $expenses = $expenseType->expenses()->orderByDesc('created_at')->paginate(10);
            } else {
                $expenses = Expense::orderByDesc('created_at')->paginate(10);
            }
        } else {
            $expenses = Expense::orderByDesc('created_at')->paginate(10);
        }
        $expenseTypes = ExpenseType::all();
        return view('expenses', compact('expenses', 'expenseTypes', 'title'));
    }

    //add expense
    public function add(Request $request)
    {
        Gate::authorize('add-expense');
        $this->validate($request, [
            'expenseType' => 'required|integer',
            'amount' => 'required|integer|min:0',
        ]);
        Expense::create([
            'expense_type_id' => $request->get('expenseType'),
            'amount' => $request->get('amount'),
            'description' => $request->get('description'),
            'issuer' => auth()->id()
        ]);
        return redirect()->back()->with('success', 'Expense Added');
    }

    //update expense
    public function update(Request $request, $id)
    {
        Gate::authorize('edit-expense');
        $expense = Expense::find($id);
        if ($expense == null) {
            return redirect()->back()->with('error', 'Expense Not Found');
        }
        $this->validate($request, [
            'expenseType' => 'required|integer',
            'amount' => 'required|integer|min:0',
        ]);
        $expense->expense_type_id = $request->get('expenseType');
        $expense->amount = $request->get('amount');
        $expense->description = $request->get('description');
        $expense->save();
        return redirect()->back()->with('success', 'Expense Updated!');
    }

    //delete expense
    public function delete($id){
        Gate::authorize('delete-expense');
        $expense = Expense::find($id);
        if ($expense == null) {
            return redirect()->back()->with('error', 'Expense Not Found');
        }
        $expense->delete();
        return redirect()->back()->with('success', 'Expense Deleted!');
    }
}
