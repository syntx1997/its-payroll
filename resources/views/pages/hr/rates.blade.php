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
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="employees-table" class="table table-bordered" style="width: 100%">
                    <thead>
                    <tr>
                        <th class="text-center"></th>
                        <th class="text-center">Employee ID</th>
                        <th colspan="text-center">Name</th>
                        <th colspan="text-center">Email</th>
                        <th colspan="text-center">Contact</th>
                        <th colspan="text-center">Designation</th>
                        <th colspan="text-center">Rate</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <div id="set-rate-modal" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <form id="set-rate-form" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fa fa-pencil"></i> Set Rate</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-6">Employee ID</label>
                        <div class="col-6">
                            <strong>
                                <span id="employee_id_txt"></span>
                            </strong>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-6">Employee Name</label>
                        <div class="col-6">
                            <strong>
                                <span id="employee_name_txt"></span>
                            </strong>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3">Rate Per Day</label>
                        <div class="col-9">
                            <input type="number" name="rate" class="form-control" placeholder="Enter rate here">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="employee_id">
                    <button type="submit" class="btn btn-secondary">Set</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>

</x-main>
