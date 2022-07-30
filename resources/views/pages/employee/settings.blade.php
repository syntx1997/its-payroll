<x-main :title="$title" :js="$js" :dashboardLink="$dashboardLink" :avatar="$avatar">

    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">{{ $title }}</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item active">{{ $title }}</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <p><strong>UPDATE INFORMATION</strong></p>
                    <form id="update-info-form">
                        @csrf
                        <div class="form-group row">
                            <label class="col-3">First Name</label>
                            <div class="col-9">
                                <input type="text" name="firstname" value="{{ $employee->firstname }}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-3">Middle Name</label>
                            <div class="col-9">
                                <input type="text" name="middlename" value="{{ $employee->middlename }}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-3">Last Name</label>
                            <div class="col-9">
                                <input type="text" name="lastname" value="{{ $employee->lastname }}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-3">Address</label>
                            <div class="col-9">
                                <textarea name="address" class="form-control">{{ $employee->address }}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-3">Contact #</label>
                            <div class="col-9">
                                <input type="text" name="contact" value="{{ $employee->contact }}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-3"></div>
                            <div class="col-9">
                                <input type="hidden" name="id" value="{{ $employee->id }}">
                                <button type="submit" class="btn btn-block btn-primary">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <p><strong>UPDATE PASSWORD</strong></p>
                    <form id="update-password-form">
                        @csrf
                        <div id="notification"></div>
                        <div class="mb-3 row">
                            <label class="col-3">Current Password</label>
                            <div class="col-9">
                                <input type="password" name="current_password" class="form-control" />
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-3">New Password</label>
                            <div class="col-9">
                                <input type="password" name="new_password" class="form-control" />
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-3">Confirm New Password</label>
                            <div class="col-9">
                                <input type="password" name="confirm_password" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-3"></div>
                            <div class="col-9">
                                <input type="hidden" name="id" value="{{ auth()->user()->id }}">
                                <button type="submit" class="btn btn-block btn-primary">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-main>
