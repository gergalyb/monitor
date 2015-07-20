document.addEventListener('DOMContentLoaded', function(){
    $.material.init();
    $('.datepicker').datepicker();

    $('.date-input input').datepicker({
    format: "yyyy-mm-dd",
    weekStart: 1,
    language: "hu",
    orientation: "top right",
    autoclose: true,
    todayHighlight: true
    });

    $(function () {
    $('#datetimepicker').datetimepicker();
    $('#datetimepicker').data("DateTimePicker").format('YYYY-MM-DD HH:mm:ss');
    });
}, false)
