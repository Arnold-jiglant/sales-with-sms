@extends('layout.app')
@section('title')
    Role
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
                                           name="permissions[]" value="1" {{$permissions->contains(1)?'checked':''}}>
                                    <label class="custom-control-label" for="viewUser">View Users</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input user" type="checkbox" id="addUser"
                                           name="permissions[]" value="2" {{$permissions->contains(2)?'checked':''}}>
                                    <label class="custom-control-label" for="addUser">Add Users</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input user" type="checkbox" id="editUser"
                                           name="permissions[]" value="3" {{$permissions->contains(3)?'checked':''}}>
                                    <label class="custom-control-label" for="editUser">Edit Users</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input user" type="checkbox" name="permissions[]"
                                           value="4" {{$permissions->contains(4)?'checked':''}}
                                           id="deleteUser"><label
                                        class="custom-control-label" for="deleteUser">Delete Users</label></div>
                            </td>
                        </tr>
                        <tr>
                            <td rowspan="4" class="align-middle">2</td>
                            <td rowspan="4" class="align-middle font-weight-bold">CUSTOMER</td>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input customer" type="checkbox" name="permissions[]"
                                           value="5" {{$permissions->contains(5)?'checked':''}}
                                           id="viewCustomer"><label
                                        class="custom-control-label" for="viewCustomer">View Customers</label></div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input customer" type="checkbox" name="permissions[]"
                                           value="6" {{$permissions->contains(6)?'checked':''}}
                                           id="addCustomer"><label
                                        class="custom-control-label" for="addCustomer">Add Customers</label></div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input customer" type="checkbox" name="permissions[]"
                                           value="7" {{$permissions->contains(7)?'checked':''}}
                                           id="editCustomer"><label
                                        class="custom-control-label" for="editCustomer">Edit Customers</label></div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input customer" type="checkbox" name="permissions[]"
                                           value="8" {{$permissions->contains(8)?'checked':''}}
                                           id="deleteCustomer"><label
                                        class="custom-control-label" for="deleteCustomer">Delete Customers</label></div>
                            </td>
                        </tr>
                        <tr>
                            <td rowspan="4" class="align-middle">3</td>
                            <td rowspan="4" class="align-middle font-weight-bold">EXPENSE</td>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input expense" type="checkbox" name="permissions[]"
                                           value="9" {{$permissions->contains(9)?'checked':''}}
                                           id="viewExpense"><label
                                        class="custom-control-label" for="viewExpense">View Expenses</label></div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input expense" type="checkbox" name="permissions[]"
                                           value="10" {{$permissions->contains(10)?'checked':''}}
                                           id="addExpense"><label
                                        class="custom-control-label" for="addExpense">Add Expenses</label></div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input expense" type="checkbox" name="permissions[]"
                                           value="11" {{$permissions->contains(11)?'checked':''}}
                                           id="editExpense"><label
                                        class="custom-control-label" for="editExpense">Edit Expenses</label></div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input expense" type="checkbox" name="permissions[]"
                                           value="12" {{$permissions->contains(12)?'checked':''}}
                                           id="deleteExpense"><label
                                        class="custom-control-label" for="deleteExpense">Delete Expenses</label></div>
                            </td>
                        </tr>
                        <tr>
                            <td rowspan="4" class="align-middle">4</td>
                            <td rowspan="4" class="align-middle font-weight-bold">INVENTORY</td>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input expense" type="checkbox" name="permissions[]"
                                           value="13" {{$permissions->contains(13)?'checked':''}}
                                           id="viewInventory"><label
                                        class="custom-control-label" for="viewInventory">View Inventory</label></div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input expense" type="checkbox" name="permissions[]"
                                           value="14" {{$permissions->contains(14)?'checked':''}}
                                           id="addInventory"><label
                                        class="custom-control-label" for="addInventory">Add Inventory</label></div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input expense" type="checkbox" name="permissions[]"
                                           value="15" {{$permissions->contains(15)?'checked':''}}
                                           id="editInventory"><label
                                        class="custom-control-label" for="editInventory">Edit Inventory</label></div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input expense" type="checkbox" name="permissions[]"
                                           value="16" {{$permissions->contains(16)?'checked':''}}
                                           id="deleteInventory"><label
                                        class="custom-control-label" for="deleteInventory">Delete Inventory</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="align-middle">5</td>
                            <td class="align-middle font-weight-bold">SALE</td>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input sale" type="checkbox" name="permissions[]"
                                           value="17" {{$permissions->contains(17)?'checked':''}}
                                           id="sellProduct"><label
                                        class="custom-control-label" for="sellProduct">Sell Products</label></div>
                            </td>
                        </tr>
                        <tr>
                            <td class="align-middle">6</td>
                            <td class="align-middle font-weight-bold">REPORT</td>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input report" type="checkbox" name="permissions[]"
                                           value="18" {{$permissions->contains(18)?'checked':''}}
                                           id="viewReport"><label
                                        class="custom-control-label" for="viewReport">View Report</label></div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="d-block text-center">
                    <button class="btn btn-primary custom-btn mt-3" type="submit">Add New Role</button>
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
                    $(this).attr('checked', true);
                });
            });
            //uncheck all
            $('#unCheckAllBtn').click(function () {
                $('#edit-role-form input[type="checkbox"]').each(function (i, item) {
                    $(this).attr('checked', false);
                });
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
