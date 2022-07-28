const attendanceTable = $('#attendance-table');
const api = '/func/attendance/';

$(function (){
    const attendanceDataTable = attendanceTable.DataTable({
        'ajax': api + 'get-all-employees',
        'columns': [
            {
                'className': 'text-center',
                'orderable': false,
                'data': 'avatar_html'
            },
            {
                'className': 'text-center',
                'orderable': false,
                'data': 'name'
            },
            {
                'className': 'text-center',
                'orderable': false,
                'data': '1'
            },
            {
                'className': 'text-center',
                'orderable': false,
                'data': '2'
            },
            {
                'className': 'text-center',
                'orderable': false,
                'data': '3'
            },
            {
                'className': 'text-center',
                'orderable': false,
                'data': '4'
            },
            {
                'className': 'text-center',
                'orderable': false,
                'data': '5'
            },
            {
                'className': 'text-center',
                'orderable': false,
                'data': '6'
            },
            {
                'className': 'text-center',
                'orderable': false,
                'data': '7'
            },
            {
                'className': 'text-center',
                'orderable': false,
                'data': '8'
            },
            {
                'className': 'text-center',
                'orderable': false,
                'data': '9'
            },
            {
                'className': 'text-center',
                'orderable': false,
                'data': '10'
            },
            {
                'className': 'text-center',
                'orderable': false,
                'data': '11'
            },
            {
                'className': 'text-center',
                'orderable': false,
                'data': '12'
            },
            {
                'className': 'text-center',
                'orderable': false,
                'data': '13'
            },
            {
                'className': 'text-center',
                'orderable': false,
                'data': '14'
            },
            {
                'className': 'text-center',
                'orderable': false,
                'data': '15'
            },
            {
                'className': 'text-center',
                'orderable': false,
                'data': '16'
            },
            {
                'className': 'text-center',
                'orderable': false,
                'data': '17'
            },
            {
                'className': 'text-center',
                'orderable': false,
                'data': '18'
            },
            {
                'className': 'text-center',
                'orderable': false,
                'data': '19'
            },
            {
                'className': 'text-center',
                'orderable': false,
                'data': '20'
            },
            {
                'className': 'text-center',
                'orderable': false,
                'data': '21'
            },
            {
                'className': 'text-center',
                'orderable': false,
                'data': '22'
            },
            {
                'className': 'text-center',
                'orderable': false,
                'data': '23'
            },
            {
                'className': 'text-center',
                'orderable': false,
                'data': '24'
            },
            {
                'className': 'text-center',
                'orderable': false,
                'data': '25'
            },
            {
                'className': 'text-center',
                'orderable': false,
                'data': '26'
            },
            {
                'className': 'text-center',
                'orderable': false,
                'data': '27'
            },
            {
                'className': 'text-center',
                'orderable': false,
                'data': '28'
            },
            {
                'className': 'text-center',
                'orderable': false,
                'data': '29'
            },
            {
                'className': 'text-center',
                'orderable': false,
                'data': '30'
            },
            {
                'className': 'text-center',
                'orderable': false,
                'data': '31'
            }
        ],
        "lengthChange": false,
        "orderable": false,
        "info": false,
        "searching": false
    });
})
