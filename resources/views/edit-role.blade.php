@extends('layout.app')
@section('title')
    Role
@stop
@section('configure')
    active
@stop
@section('content')
    <div class="container mt-2">
        <div class="row">
            <div class="col">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a><span>System Configuration</span></a></li>
                    <li class="breadcrumb-item"><a><span>Add Role</span></a></li>
                </ol>
            </div>
        </div>
        <h3 class="mt-3">Edit Role</h3>
        <div class="col-md-11 col-lg-10 col-xl-8 offset-lg-1 offset-xl-1 mb-2">
            <form id="edit-role-form" method="POST" action="{{route('editRole',$role->id)}}">
                {{csrf_field()}}
                <input type="hidden" name="_method" value="PUT">
                <div class="form-group">
                    <label for="name">Role Name:</label>
                    <input class="form-control form-control-sm" type="text" placeholder="role name" id="name"
                           name="name" value="{{$role->name}}">
                    @error('name')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <h5>Permissions</h5>
                <button id="checkAllBtn" class="btn btn-primary btn-sm custom-btn mr-2" type="button"><i
                        class="icon ion-checkmark"></i>&nbsp;Check
                    all
                </button>
                <button id="unCheckAllBtn" class="btn btn-primary btn-sm custom-btn" type="button"><i
                        class="icon ion-android-close"></i>&nbsp;Uncheck
                    all
                </button>
                <div
                    class="table-responsive table-bordered mt-1" id="permissions-table">
                    <table class="table table-bordered table-sm">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Section</th>
                            <th>Permissions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td rowspan="4" class="align-middle">1</td>
                            <td rowspan="4" class="align-middle font-weight-bold">USER</td>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input user" type="checkbox" id="viewUser"
                                           name="permissions[]"
                                           value="US1" {{$permissions->contains(\App\Permission::$VIEW_USERS)?'checked':''}}>
                                    <label class="custom-control-label" for="viewUser">View Users</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input user" type="checkbox" id="addUser"
                                           name="permissions[]"
                                           value="US2" {{$permissions->contains(\App\Permission::$ADD_USERS)?'checked':''}}>
                                    <label class="custom-control-label" for="addUser">Add Users</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input user" type="checkbox" id="editUser"
                                           name="permissions[]"
                                           value="US3" {{$permissions->contains(\App\Permission::$EDIT_USERS)?'checked':''}}>
                                    <label class="custom-control-label" for="editUser">Edit Users</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input user" type="checkbox" name="permissions[]"
                                           value="US4"
                                           id="deleteUser" {{$permissions->contains(\App\Permission::$DELETE_USERS)?'checked':''}}>
                                    <label class="custom-control-label" for="deleteUser">Delete Users</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td rowspan="5" class="align-middle">2</td>
                            <td rowspan="5" class="align-middle font-weight-bold">CUSTOMER</td>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input customer" type="checkbox" name="permissions[]"
                                           value="CU1"
                                           id="viewCustomer" {{$permissions->contains(\App\Permission::$VIEW_CUSTOMERS)?'checked':''}}>
                                    <label class="custom-control-label" for="viewCustomer">View Customers</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input customer" type="checkbox" name="permissions[]"
                                           value="CU2"
                                           id="addCustomer" {{$permissions->contains(\App\Permission::$ADD_CUSTOMERS)?'checked':''}}>
                                    <label class="custom-control-label" for="addCustomer">Add Customers</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input customer" type="checkbox" name="permissions[]"
                                           value="CU3"
                                           id="editCustomer" {{$permissions->contains(\App\Permission::$EDIT_CUSTOMERS)?'checked':''}}>
                                    <label class="custom-control-label" for="editCustomer">Edit Customers</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input customer" type="checkbox" name="permissions[]"
                                           value="CU4"
                                           id="deleteCustomer" {{$permissions->contains(\App\Permission::$DELETE_CUSTOMERS)?'checked':''}}>
                                    <label class="custom-control-label" for="deleteCustomer">Delete Customers</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input customer" type="checkbox" name="permissions[]"
                                           value="CU5" id="payDebt" {{$permissions->contains(\App\Permission::$RECEIVE_DEBT_PAYMENT)?'checked':''}}>
                                    <label class="custom-control-label" for="payDebt">Receive Debt Payment</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td rowspan="4" class="align-middle">3</td>
                            <td rowspan="4" class="align-middle font-weight-bold">EXPENSE</td>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input expense" type="checkbox" name="permissions[]"
                                           value="EX1"
                                           {{$permissions->contains(\App\Permission::$VIEW_EXPENSES)?'checked':''}}
                                           id="viewExpense">
                                    <label class="custom-control-label" for="viewExpense">View Expenses</label></div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input expense" type="checkbox" name="permissions[]"
                                           value="EX2"
                                           id="addExpense" {{$permissions->contains(\App\Permission::$ADD_EXPENSES)?'checked':''}}>
                                    <label class="custom-control-label" for="addExpense">Add Expenses</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input expense" type="checkbox" name="permissions[]"
                                           value="EX3"
                                           id="editExpense" {{$permissions->contains(\App\Permission::$EDIT_EXPENSES)?'checked':''}}>
                                    <label class="custom-control-label" for="editExpense">Edit Expenses</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input expense" type="checkbox" name="permissions[]"
                                           value="EX4"
                                           id="deleteExpense" {{$permissions->contains(\App\Permission::$DELETE_EXPENSES)?'checked':''}}>
                                    <label class="custom-control-label" for="deleteExpense">Delete Expenses</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td rowspan="4" class="align-middle">4</td>
                            <td rowspan="4" class="align-middle font-weight-bold">INVENTORY</td>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input inventory" type="checkbox" name="permissions[]"
                                           value="IN1"
                                           id="viewInventory" {{$permissions->contains(\App\Permission::$VIEW_INVENTORY)?'checked':''}}>
                                    <label class="custom-control-label" for="viewInventory">View Inventory</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input inventory" type="checkbox" name="permissions[]"
                                           value="IN2"
                                           id="addInventory" {{$permissions->contains(\App\Permission::$ADD_INVENTORY)?'checked':''}}>
                                    <label class="custom-control-label" for="addInventory">Add Inventory</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input inventory" type="checkbox" name="permissions[]"
                                           value="IN3"
                                           id="editInventory" {{$permissions->contains(\App\Permission::$EDIT_INVENTORY)?'checked':''}}>
                                    <label class="custom-control-label" for="editInventory">Edit Inventory</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input inventory" type="checkbox" name="permissions[]"
                                           value="IN4"
                                           id="deleteInventory" {{$permissions->contains(\App\Permission::$DELETE_INVENTORY)?'checked':''}}>
                                    <label class="custom-control-label" for="deleteInventory">Delete Inventory</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td rowspan="4" class="align-middle">5</td>
                            <td rowspan="4" class="align-middle font-weight-bold">EXTRA INCOME</td>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input income" type="checkbox" name="permissions[]"
                                           value="INC1"
                                           id="viewIncome" {{$permissions->contains(\App\Permission::$VIEW_INCOMES)?'checked':''}}>
                                    <label
                                        class="custom-control-label" for="viewIncome">View Incomes</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input income" type="checkbox" name="permissions[]"
                                           value="INC2"
                                           id="addIncome" {{$permissions->contains(\App\Permission::$ADD_INCOME)?'checked':''}}>
                                    <label class="custom-control-label" for="addIncome">Add Incomes</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input income" type="checkbox" name="permissions[]"
                                           value="INC3"
                                           id="editIncome" {{$permissions->contains(\App\Permission::$EDIT_INCOME)?'checked':''}}>
                                    <label
                                        class="custom-control-label" for="editIncome">Edit Incomes</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input income" type="checkbox" name="permissions[]"
                                           value="INC4" id="deleteIncome" {{$permissions->contains(\App\Permission::$DELETE_INCOME)?'checked':''}}>
                                    <label class="custom-control-label" for="deleteIncome">Delete Incomes</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="align-middle">6</td>
                            <td class="align-middle font-weight-bold">SALE</td>
                            <td>
                                <div class="custom-control custom-checkbox"><input class="custom-control-input sale"
                                                                                   type="checkbox" name="permissions[]"
                                                                                   value="SE1"
                                                                                   {{$permissions->contains('SE1')?'checked':''}}
                                                                                   id="sellProduct"><label
                                        class="custom-control-label" for="sellProduct">Sell Products</label></div>
                            </td>
                        </tr>
                        <tr>
                            <td class="align-middle">7</td>
                            <td class="align-middle font-weight-bold">REPORT</td>
                            <td>
                                <div class="custom-control custom-checkbox"><input class="custom-control-input report"
                                                                                   type="checkbox" name="permissions[]"
                                                                                   value="RE1"
                                                                                   {{$permissions->contains('RE1')?'checked':''}}
                                                                                   id="viewReport"><label
                                        class="custom-control-label" for="viewReport">View Report</label></div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="d-block text-center">
                    <button class="btn btn-primary custom-btn mt-3" type="submit">Update Role</button>
                </div>
            </form>
        </div>
    </div>
@stop

@section('script')
    <script>
        $(document).ready(function () {
            //check all
            $('#checkAllBtn').click(function () {
                $('#edit-role-form input[type="checkbox"]').each(function (i, item) {
                    $(this).prop('checked', true).attr('checked', true);
                });
            });
            //uncheck all
            $('#unCheckAllBtn').click(function () {
                $('#edit-role-form input[type="checkbox"]').each(function (i, item) {
                    $(this).prop('checked', false).attr('checked', false);
                });
            });
            //check first item
            $("input[type='checkbox']").change(function (e) {
                let cla = $(this).attr('class').split(' ').pop();
                let classItem = $("input[type='checkbox']." + cla);
                let firstItem = classItem.first();
                if ($(this).is(':checked')) {
                    firstItem.prop('checked', true).attr('checked', true);
                } else {
                    if ($(this).attr('id') === firstItem.attr('id')) {
                        classItem.each(function (i, item) {
                            if ($(this).is(':checked')) {
                                $(this).prop('checked', false).attr('checked', false);
                            }
                        });
                    }
                }
            });

            //submit form
            $('#edit-role-form').submit(function () {
                let check = false;
                $('#edit-role-form input[type="checkbox"]').each(function (i, item) {
                    if ($(this).is(':checked')) {
                        check = true;
                    }
                });
                if (!check) {
                    alert("Select at least one permission");
                    return false
                }
            });
        });
    </script>
@stop
