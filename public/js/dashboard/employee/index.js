$(function (){
    $('#refresh-board-btn').on('click', function (){
        const that = this;
        $(that).html(spinner+ 'Refreshing');
        setInterval(function (){
            $(that).html('<i class="la la-refresh"></i> Refresh Board');
            $('#calendar').fullCalendar('refetchEvents');
        }, 2000);
    });
});
