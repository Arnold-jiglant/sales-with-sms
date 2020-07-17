<?php

namespace App\Http\Controllers;

use App\Configuration;
use App\ExpenseType;
use App\Role;
use App\RolePermission;
use App\SellMethod;
use Illuminate\Http\Request;

class ConfigurationController extends Controller
{
    public function index()
    {
        $sellMethods = SellMethod::all();
        $roles = Role::all()->except([1]);
        $expenseCategories = ExpenseType::all();
        return view('configure', compact('sellMethods', 'roles', 'expenseCategories'));
    }

    //choose selling Method
    public function changeSellMethod(Request $request)
    {
        $this->validate($request, [
            'sellMethod' => 'required',
        ]);
//        return $request->all();
        $method = Configuration::where('name', 'sellMethod')->first();
        $method->value = $request->get('sellMethod');
        $method->save();
        return $this->redirectWithSuccess('Selling Method Changed');
    }

    //add Expense Type
    public function addExpenseType(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:expense_types',
        ]);
        ExpenseType::create([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
        ]);
        return $this->redirectWithSuccess('Expense Category Added');
    }

    //update Expense Type
    public function updateExpenseType(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|unique:App\ExpenseType,name,' . $id,
        ]);
        $category = ExpenseType::find($id);
        if ($category == null) {
            return $this->redirectWithError('Category Not Found');
        }
//        return $request->all();
        $category->name = $request->get('name');
        $category->description = $request->get('description');
        $category->save();
        return $this->redirectWithSuccess('Category Updated');
    }

    //delete Expense Type
    public function deleteExpenseType($id)
    {
        $category = ExpenseType::find($id);
        if ($category == null) {
            return $this->redirectWithError('Category Not Found');
        }
        if ($category->hasExpenses) {
            $category->delete();
        } else {
            $category->forceDelete();
        }
        return $this->redirectWithSuccess('Category Deleted!');
    }

    //view add role form
    public function viewAddRoleForm()
    {
        return view('add-role');
    }

    //add role
    public function addRole(Request $request)
    {
        $this->validate($request, ['name' => 'required|unique:App\Role']);
        $role = Role::create(['name' => $request->get('name')]);
        $permissions = [];
        foreach ($request->get('permissions') as $item) {
            $permissions[] = new RolePermission(['permission_code' => $item]);
        }
        $role->permissions()->saveMany($permissions);
        return redirect()->route('configure')->with('success', 'New Role Added');
    }

    //show edit role form
    public function editRole($id)
    {
        $role = Role::find($id);
        if ($role == null) {
            return $this->redirectWithError('Role Not Found');
        }
       $permissions = $role->permissions()->pluck('permission_code');
        return view('edit-role',compact('role','permissions'));
    }

    //update role
    public function updateRole(Request $request, $id)
    {
        $role = Role::find($id);
        if ($role == null) {
            return $this->redirectWithError('Role Not Found');
        }
        $this->validate($request, ['name' => 'required|unique:App\Role,name,'.$id]);
        $role->permissions()->delete();
        $permissions = [];
        foreach ($request->get('permissions') as $item) {
            $permissions[] = new RolePermission(['permission_code' => $item]);
        }
        $role->permissions()->saveMany($permissions);
        return redirect()->route('configure')->with('success','Role Updated');
    }

    //delete role
    public function deleteRole($id)
    {
        $role = Role::find($id);
        if ($role == null) {
            return $this->redirectWithError('Role Not Found');
        }
        $role->permissions()->delete();
        $role->delete();
        return $this->redirectWithSuccess('Role deleted!');
    }

    function redirectWithError($message = '')
    {
        return redirect()->back()->with('error', $message);
    }

    function redirectWithSuccess($message = '')
    {
        return redirect()->back()->with('success', $message);
    }
}
