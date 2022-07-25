<x-main :title="$title" :js="$js" :dashboardLink="$dashboardLink">

    <div class="row">
        <div class="col-md-4">
            <div class="card punch-status">

                <div class="card-body">
                    <h5 class="card-title">Timesheet <small class="text-muted">{{ \Carbon\Carbon::parse(now())->format('d M Y') }}</small></h5>
                    <div class="punch-det">
                        <h6>Punch In at</h6>
                        <p>{{ \Carbon\Carbon::parse(now())->format('D, jS M Y h:i A') }}</p>
                    </div>
                    <div class="punch-info">
                        <div class="punch-hours">
                            <span>3.45 hrs</span>
                        </div>
                    </div>
                    <div class="punch-btn-section">
                        <button type="button" class="btn btn-primary punch-btn">Punch Out</button>
                    </div>
                    <div class="statistics">
                        <div class="row">
                            <div class="col-md-6 col-6 text-center">
                                <div class="stats-box">
                                    <p>Break</p>
                                    <h6>1.21 hrs</h6>
                                </div>
                            </div>
                            <div class="col-md-6 col-6 text-center">
                                <div class="stats-box">
                                    <p>Overtime</p>
                                    <h6>3 hrs</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <table class="table table-striped border">
                <thead>
                <tr>
                    <th class="text-center">Date</th>
                    <th class="text-center">Time In</th>
                    <th class="text-center">Time Out</th>
                </tr>
                </thead>
            </table>

        </div>
        <div class="col-md-8">
            <div class="card att-statistics">
                <div class="card-header">
                    <h5 class="card-title pb-0 mb-0"><strong>Sales Board</strong></h5>
                </div>
                <div class="card-body">
                    <button id="refresh-board-btn" type="button" class="btn btn-info float-right">
                        <i class="la la-refresh"></i> Refresh Board
                    </button>
                   <div id="calendar">
                   </div>
                </div>
            </div>
        </div>
    </div>

</x-main>
