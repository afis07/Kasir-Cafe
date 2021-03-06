
/**
* Theme: Uplon Admin Template
* Author: Coderthemes
 * Email: coderthemes@gmail.com
* Form pickers
*/

$(document).ready(function () {

    // Time Picker
    jQuery('#timepicker').timepicker({
        defaultTIme: false,
        icons: {
            up: 'zmdi zmdi-chevron-up',
            down: 'zmdi zmdi-chevron-down'
        }
    });
    jQuery('#timepicker2').timepicker({
        showMeridian: false,
        icons: {
            up: 'zmdi zmdi-chevron-up',
            down: 'zmdi zmdi-chevron-down'
        }
    });
    jQuery('#timepicker3').timepicker({
        minuteStep: 15,
        icons: {
            up: 'zmdi zmdi-chevron-up',
            down: 'zmdi zmdi-chevron-down'
        }
    });

    //colorpicker start

    $('.colorpicker-default').colorpicker({
        format: 'hex'
    });
    $('.colorpicker-rgba').colorpicker();

    // Date Picker
    jQuery('#datepicker').datepicker();
	jQuery('#mulai').datepicker({
		format: "yyyy-mm-dd",
        autoclose: true,
        todayHighlight: true
    });
    jQuery('#sampai').datepicker({
		format: "yyyy-mm-dd",
        autoclose: true,
        todayHighlight: true
    });
    jQuery('#datepicker-inline').datepicker();
    jQuery('#datepicker-multiple-date').datepicker({
        format: "YYYY-MM-DD",
        clearBtn: true,
        multidate: true,
        multidateSeparator: ","
    });
    jQuery('#date-range').datepicker({
        toggleActive: true
    });

    //Clock Picker
    $('.clockpicker').clockpicker({
        donetext: 'Done'
    });

    $('#single-input').clockpicker({
        placement: 'bottom',
        align: 'left',
        autoclose: true,
        'default': 'now'
    });
    $('#check-minutes').click(function (e) {
        // Have to stop propagation here
        e.stopPropagation();
        $("#single-input").clockpicker('show')
            .clockpicker('toggleView', 'minutes');
    });


    //Date range picker
    $('.input-daterange-datepicker').daterangepicker({
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-custom',
        cancelClass: 'btn-secondary'
    });
    $('.input-daterange-timepicker').daterangepicker({
        timePicker: true,
        format: 'MM/DD/YYYY h:mm A',
        timePickerIncrement: 30,
        timePicker12Hour: true,
        timePickerSeconds: false,
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-custom',
        cancelClass: 'btn-secondary'
    });
    $('.input-limit-datepicker').daterangepicker({
        format: 'YYYY/MM/DD',
        minDate: '06/01/2015',
        maxDate: '06/30/2016',
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-custom',
        cancelClass: 'btn-secondary',
        dateLimit: {
            days: 6
        }
    });

    $('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));

    $('#reportrange').daterangepicker({
        format: 'YYYY/MM/DD',
        startDate: moment().subtract(29, 'days'),
        endDate: moment(),
        minDate: '01/01/2012',
        maxDate: '12/31/2016',
        dateLimit: {
            days: 60
        },
        showDropdowns: true,
        showWeekNumbers: true,
        timePicker: false,
        timePickerIncrement: 1,
        timePicker12Hour: true,
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        opens: 'left',
        drops: 'down',
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-custom',
        cancelClass: 'btn-secondary',
        separator: ' to ',
        locale: {
            applyLabel: 'Submit',
            cancelLabel: 'Cancel',
            fromLabel: 'From',
            toLabel: 'To',
            customRangeLabel: 'Custom',
            daysOfWeek: ['Mi', 'Se', 'Se', 'Se', 'Ra', 'Ka', 'Jum'],
            monthNames: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
            firstDay: 1
        }
    }, function (start, end, label) {
        console.log(start.toISOString(), end.toISOString(), label);
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    });

});