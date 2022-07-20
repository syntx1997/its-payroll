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
                <button type="button" class="btn add-btn" data-toggle="modal" data-target="#add-category-modal"><i class="fa fa-plus"></i> Add Category</button>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="categories-table" class="table bg-white" style="width: 100%">
                    <thead class="bg-light">
                    <tr>
                        <th class="text-center">ID#</th>
                        <th class="text-center">Category</th>
                        <th class="text-center"></th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <div id="add-category-modal" class="modal custom-modal fade" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <form id="add-category-form" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fa fa-plus"></i> Add Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-3">Category</div>
                        <div class="col-9">
                            <input type="text" name="name" class="form-control" placeholder="Enter Category Name">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-secondary">Add</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>

    <div id="edit-category-modal" class="modal custom-modal fade" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <form id="edit-category-form" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fa fa-edit"></i> Edit Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-3">Category</div>
                        <div class="col-9">
                            <input type="text" name="name" class="form-control" placeholder="Enter Category Name">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id">
                    <button type="submit" class="btn btn-secondary">Edit</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>

</x-main>
