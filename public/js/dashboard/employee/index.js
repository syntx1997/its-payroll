const api = '/func/attendance/';
const attendanceTable = $('#attendance-table');

$(function (){

    const attendanceDataTable = attendanceTable.DataTable({
        'ajax': api + 'get-all',
        'columns': [
            {
                'className': 'text-center',
                'orderable': false,
                'data': 'created_at'
            },
            {
                'className': 'text-center',
                'orderable': false,
                'data': 'time_in'
            },
            {
                'className': 'text-center',
                'orderable': false,
                'data': 'time_out'
            }
        ],
        "lengthChange": false,
        "orderable": false,
        "info": false,
        "bFilter": false,
        "bInfo": false
    });


    $('#refresh-board-btn').on('click', function (){
        const that = this;
        $(that).html(spinner+ 'Refreshing');
        setInterval(function (){
            $(that).html('<i class="la la-refresh"></i> Refresh Board');
            $('#calendar').fullCalendar('refetchEvents');
        }, 2000);
    });

    $('#punch-btn').on('click', function (){
        const that = this;
        $(that).html(spinner+ 'Punching');

        $.ajax({
            url: api + 'punch',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type: 'POST',
            dataType: 'JSON',
            success: function (){
                $(that).html('Punch');
            }
        });
    });
});
