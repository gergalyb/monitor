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
    $('#datetimepicker_cStatusDateTimeFROM').datetimepicker();
    $('#datetimepicker_cStatusDateTimeFROM').data("DateTimePicker").format('YYYY-MM-DD HH:mm:ss');
    });

    $( "#datetimepicker_cStatusDateTimeFROM" ).focusout(function() {
      if ($(this).val())
      {
          $(this).removeClass('empty');
      }
    });


    $(function () {
    $('#datetimepicker_cStatusDateTimeTO').datetimepicker();
    $('#datetimepicker_cStatusDateTimeTO').data("DateTimePicker").format('YYYY-MM-DD HH:mm:ss');
    });

    $( "#datetimepicker_cStatusDateTimeTO" ).focusout(function() {
      if ($(this).val())
      {
          $(this).removeClass('empty');
      }
    });

}, false);
