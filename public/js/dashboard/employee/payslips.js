const viewPayslipModal = $('#view-payslip-modal');
const payslipTable = $('#payslip-table');

const api = '/func/payslip/';

$(function (){

    const paySlipDataTable = payslipTable.DataTable({
        'ajax': api + 'get-employee-slip',
        'columns': [
            {
                'className': 'text-center',
                'orderable': false,
                'data': 'name'
            },
            {
                'className': 'text-center',
                'orderable': false,
                'data': 'designation'
            },
            {
                'className': 'text-center',
                'orderable': false,
                'data': 'department'
            },
            {
                'className': 'text-center',
                'orderable': false,
                'data': 'start_date'
            },
            {
                'className': 'text-center',
                'orderable': false,
                'data': 'end_date'
            },
            {
                'className': 'text-center',
                'orderable': false,
                'data': 'actions'
            }
        ]
    });

});

function resetComputation() {
    $('#view-earnings-list li').not('li:last').remove();
    $('#view-deductions-list li').not('li:last').remove();
}

$(document).on('click', '#view-payslip-btn', function (){
    resetComputation();
    const data = $(this).data();
    const computation = data.computations;
    const employee = data.employee;

    $('#view-month-txt').text(computation.month);
    $('#view-employee-id-txt').text(employee.employee_id);
    $('#view-department-txt').text(employee.department);
    $('#view-designation-txt').text(employee.designation);
    $('#view-basic-salary-txt').text(employee.basic_salary);
    $('#view-employee-name-txt').text(employee.name);
    $('#view-salary-date-txt').text(computation.start_date + ' - ' + computation.end_date);
    $('#view-days-txt').text(computation.days);
    $('#view-days-worked-txt').text(computation.days_worked);
    $('#view-gross-txt').text(computation.total_gross);
    $('#view-tdeductions-txt').text(computation.total_deduction);
    $('#view-net-txt').text(computation.total_net);

    const earnings = computation.gross;
    for(let i = 0; i < earnings.length; i++) {
        $('#view-earnings-list').prepend(
            `
                        <li class="list-group-item">
                            ${earnings[i]['name']}
                            <span class="float-right">
                                ₱${earnings[i]['amount']}
                            </span>
                        </li>
                    `
        );
    }

    const deductions = computation.deductions;
    for(let i = 0; i < deductions.length; i++) {
        $('#view-deductions-list').prepend(
            `
                        <li class="list-group-item">
                            ${deductions[i]['name']}
                            <span class="float-right">
                                ₱${deductions[i]['deduction']}
                            </span>
                        </li>
                    `
        );
    }

    showModal(viewPayslipModal);
});

$(document).on('click', '#download-payslip-btn', function (){
    const pdf = new jsPDF('p', 'mm', 'letter');
    var firstPage;
    const that = this;

    $(that).html(spinner + ' Downloading');
    html2canvas($('.export-pdf'), {
        onrendered: function (canvas){
            firstPage = canvas.toDataURL('image/png', 1.0);
            pdf.addImage(firstPage, 'PNG', 0, 0, 216, 0);
            pdf.save('payslip.pdf');
            $(that).html('<i class="la la-file-download"></i> Download Payslip');
        }
    });
});
