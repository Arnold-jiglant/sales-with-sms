@extends('layout.app')
@section('title')
    Users
@stop
@section('content')
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a><span>Dashboard</span></a></li>
                    <li class="breadcrumb-item"><a><span>Users</span></a></li>
                </ol>
            </div>
        </div>
        <h3 class="mt-1">Users</h3>
    </div>
    <div class="col-lg-11 col-xl-10 offset-lg-1 offset-xl-1">
        <div class="row">
            <div class="col-6">
                <p>Total 200 showing 20-30</p>
            </div>
            <div class="col order-sm-1"><button class="btn btn-primary btn-sm custom-btn float-right" type="button" data-toggle="modal" data-target="#add-user-modal"><i class="icon ion-android-add"></i>Add User</button></div>
        </div>
        <div class="table-responsive table-bordered text-center" id="products-table">
            <table class="table table-bordered table-hover table-sm">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>1</td>
                    <td>Juma Hassan</td>
                    <td>hassan@emeil.com</td>
                    <td>Seller</td>
                    <td>Active</td>
                    <td>
                        <div class="options"><a href="#" class="option-link edit" data-toggle="modal" data-target="#edit-user-modal"><i class="icon ion-edit"></i>&nbsp;<span class="link-text">edit</span></a><a href="#" class="option-link delete" data-toggle="modal"
                                                                                                                                                                                                                  data-target="#reset-user-modal"><i class="icon ion-ios-refresh-empty"></i>&nbsp;<span class="link-text">reset</span></a><a href="#" class="option-link delete" data-toggle="modal" data-target="#delete-user-modal"><i class="icon ion-android-delete"></i>&nbsp;<span class="link-text">delete</span></a></div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-11 col-md-10 col-lg-7 offset-1 offset-md-1 offset-lg-3">
            <nav>
                <ul class="pagination">
                    <li class="page-item"><a class="page-link" href="#" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                    <li class="page-item"><a class="page-link" href="#">5</a></li>
                    <li class="page-item"><a class="page-link" href="#" aria-label="Next"><span aria-hidden="true">»</span></a></li>
                </ul>
            </nav>
        </div>
    </div>
@stop
@section('modal')
    <div class="modal fade" role="dialog" tabindex="-1" id="add-user-modal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="icon ion-plus"></i>&nbsp;Add User</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
                <div class="modal-body">
                    <form>
                        <div class="form-group"><label>First Name:</label><input class="form-control form-control-sm" type="text" placeholder="first name" id="firstName"></div>
                        <div class="form-group"><label>Last Name:</label><input class="form-control form-control-sm" type="text" placeholder="last name" id="lastName"></div>
                        <div class="form-group"><label>E-mail:</label><input class="form-control form-control-sm" type="text" placeholder="email@email.com" id="email"></div>
                        <div class="form-group"><label>Role:</label><select class="custom-select custom-select-sm" name="role_id" id="role"><option value="12" selected="">This is item 1</option><option value="13">This is item 2</option><option value="14">This is item 3</option></select></div>
                        <div
                            class="form-group"><label>Status:</label>
                            <div class="custom-control custom-switch"><input class="custom-control-input" type="checkbox" id="active"><label class="custom-control-label" for="active">Active</label></div>
                        </div>
                        <div class="float-right"><button class="btn btn-light btn-sm mr-2" type="button" data-dismiss="modal">Close</button><button class="btn btn-primary btn-sm custom-btn" type="button">Add</button></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" role="dialog" tabindex="-1" id="edit-user-modal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="icon ion-edit"></i>&nbsp;Edit User</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
                <div class="modal-body">
                    <form>
                        <div class="form-group"><label>First Name:</label><input class="form-control form-control-sm" type="text" placeholder="first name" id="editFirstName"></div>
                        <div class="form-group"><label>Last Name:</label><input class="form-control form-control-sm" type="text" placeholder="last name" id="editLastName"></div>
                        <div class="form-group"><label>E-mail:</label><input class="form-control form-control-sm" type="text" placeholder="email@email.com" id="editEmail"></div>
                        <div class="form-group"><label>Role:</label><select class="custom-select custom-select-sm" name="role_id" id="editRole"><option value="12" selected="">This is item 1</option><option value="13">This is item 2</option><option value="14">This is item 3</option></select></div>
                        <div
                            class="form-group"><label>Status:</label>
                            <div class="custom-control custom-switch"><input class="custom-control-input" type="checkbox" id="editActive"><label class="custom-control-label" for="editActive">Active</label></div>
                        </div>
                        <div class="float-right"><button class="btn btn-light btn-sm mr-2" type="button" data-dismiss="modal">Close</button><button class="btn btn-primary btn-sm custom-btn" type="button">Update</button></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" role="dialog" tabindex="-1" id="reset-user-modal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="icon ion-ios-refresh-empty"></i>&nbsp;Reset User Password</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
                <div class="modal-body">
                    <form>
                        <p>Are you sure you want to reset this user password?</p>
                        <div class="float-right"><button class="btn btn-light btn-sm mr-2" type="button" data-dismiss="modal">Close</button><button class="btn btn-primary btn-sm custom-btn" type="button">Reset</button></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" role="dialog" tabindex="-1" id="delete-user-modal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="icon ion-android-delete"></i>&nbsp;Delete User</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
                <div class="modal-body">
                    <form>
                        <p>Are you sure you want to delete this user?</p>
                        <div class="float-right"><button class="btn btn-light btn-sm mr-2" type="button" data-dismiss="modal">Close</button><button class="btn btn-primary btn-sm custom-btn" type="button">Delete</button></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
