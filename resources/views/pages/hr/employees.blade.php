<x-main :title="$title" :js="$js" :dashboardLink="$dashboardLink">

    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">{{ $title }}</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item active">{{ $title }}</li>
                </ul>
            </div>
            <div class="col-auto float-right ml-auto">
                <button type="button" class="btn add-btn" data-toggle="modal" data-target="#add-employee-modal"><i class="fa fa-plus"></i> Add Employee</button>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="employees-table" class="table table-striped" style="width: 100%">
                    <thead class="bg-light">
                    <tr>
                        <th class="text-center"></th>
                        <th class="text-center">Employee ID</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Contact</th>
                        <th class="text-center">Designation</th>
                        <th class="text-center">Department</th>
                        <th class="text-center"></th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <div id="add-employee-modal" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <form id="add-employee-form" class="modal-content">
                @csrf
                <div class="modal-header border-bottom">
                    <h5 class="modal-title"><i class="fa fa-plus"></i> Add Employee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group row">
                                <div class="col-sm-12 col-md-3 col-lg-3">
                                    <label style="bottom: 0; position: absolute">Avatar</label>
                                </div>
                                <div class="col-sm-12 col-md-9 col-lg-9">
                                    <div class="employee-avatar mb-3">
                                        <img src="{{ asset('img/user.jpg') }}" style="width: 100px">
                                    </div>
                                    <input type="file" name="avatar" class="form-control-file">
                                </div>
                            </div>
                            <hr>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-3 col-lg-3">First Name</label>
                                <div class="col-sm-12 col-md-9 col-lg-9">
                                    <input type="text" name="firstname" class="form-control" placeholder="Enter first name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-3 col-lg-3">Middle Name</label>
                                <div class="col-sm-12 col-md-9 col-lg-9">
                                    <input type="text" name="middlename" class="form-control" placeholder="Enter middle name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-3 col-lg-3">Last Name</label>
                                <div class="col-sm-12 col-md-9 col-lg-9">
                                    <input type="text" name="lastname" class="form-control" placeholder="Enter last name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-3 col-lg-3">Gender</label>
                                <div class="col-sm-12 col-md-9 col-lg-9">
                                    <select name="gender" class="custom-select">
                                        <option value="">-- select --</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-3 col-lg-3">Birthday</label>
                                <div class="col-sm-12 col-md-9 col-lg-9">
                                    <input type="date" name="birthday" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-3 col-lg-3">Address</label>
                                <div class="col-sm-12 col-md-9 col-lg-9">
                                    <textarea name="address" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-3 col-lg-3">Designation</label>
                                <div class="col-sm-12 col-md-9 col-lg-9">
                                    <input type="text" name="designation" class="form-control" placeholder="Enter employee designation">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-3 col-lg-3">Department</label>
                                <div class="col-sm-12 col-md-9 col-lg-9">
                                    <input type="text" name="department" class="form-control" placeholder="Enter employee designation">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-3 col-lg-3">Email</label>
                                <div class="col-sm-12 col-md-9 col-lg-9">
                                    <input type="email" name="email" class="form-control" placeholder="Enter valid email address">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-3 col-lg-3">Contact</label>
                                <div class="col-sm-12 col-md-9 col-lg-9">
                                    <input type="number" name="contact" class="form-control" placeholder="Enter employee contact number">
                                </div>
                            </div>
                            <hr>
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-3 col-lg-3">Password</label>
                                <div class="col-sm-12 col-md-9 col-lg-9">
                                    <input type="password" name="password" class="form-control" placeholder="Enter password">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top">
                    <button type="submit" class="btn btn-secondary">Add</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>

    <div id="edit-employee-modal" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <form id="edit-employee-form" class="modal-content">
                @csrf
                <div class="modal-header border-bottom">
                    <h5 class="modal-title"><i class="fa fa-edit"></i> Edit Employee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group row">
                                <div class="col-sm-12 col-md-3 col-lg-3 text-center">
                                    <label style="bottom: 0; position: absolute">Avatar</label>
                                </div>
                                <div class="col-sm-12 col-md-9 col-lg-9">
                                    <div class="employee-avatar mb-3">
                                        <img src="{{ asset('img/user.jpg') }}" style="width: 100px">
                                    </div>
                                    <input type="file" name="avatar" class="form-control-file">
                                </div>
                            </div>
                            <hr>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-3 col-lg-3">First Name</label>
                                <div class="col-sm-12 col-md-9 col-lg-9">
                                    <input type="text" name="firstname" class="form-control" placeholder="Enter first name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-3 col-lg-3">Middle Name</label>
                                <div class="col-sm-12 col-md-9 col-lg-9">
                                    <input type="text" name="middlename" class="form-control" placeholder="Enter middle name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-3 col-lg-3">Last Name</label>
                                <div class="col-sm-12 col-md-9 col-lg-9">
                                    <input type="text" name="lastname" class="form-control" placeholder="Enter last name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-3 col-lg-3">Gender</label>
                                <div class="col-sm-12 col-md-9 col-lg-9">
                                    <select name="gender" class="custom-select">
                                        <option value="">-- select --</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-3 col-lg-3">Birthday</label>
                                <div class="col-sm-12 col-md-9 col-lg-9">
                                    <input type="date" name="birthday" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-3 col-lg-3">Address</label>
                                <div class="col-sm-12 col-md-9 col-lg-9">
                                    <textarea name="address" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-3 col-lg-3">Designation</label>
                                <div class="col-sm-12 col-md-9 col-lg-9">
                                    <input type="text" name="designation" class="form-control" placeholder="Enter employee designation">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-3 col-lg-3">Department</label>
                                <div class="col-sm-12 col-md-9 col-lg-9">
                                    <input type="text" name="department" class="form-control" placeholder="Enter employee designation">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-3 col-lg-3">Email</label>
                                <div class="col-sm-12 col-md-9 col-lg-9">
                                    <input type="email" name="email" class="form-control" placeholder="Enter valid email address">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-3 col-lg-3">Contact</label>
                                <div class="col-sm-12 col-md-9 col-lg-9">
                                    <input type="number" name="contact" class="form-control" placeholder="Enter employee contact number">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top">
                    <input type="hidden" name="id">
                    <button type="submit" class="btn btn-secondary">Edit</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>

</x-main>
