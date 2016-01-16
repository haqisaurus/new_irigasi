$(function() {

    $('#date').datepicker({'dateFormat' : 'yy-mm-dd'});
    $('#year-month').datepicker({
        'dateFormat' : 'yy-mm',
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        onClose: function(dateText, inst) { 
            console.log(dateText, inst)
            var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
            var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
            $(this).datepicker('setDate', new Date(year, month, 1));
            var startDate = $('#startmonth').val() || 0;
            var endDate = $('#endmonth').val() || 0;
            dt1 = Date.parse(startDate);
            dt2 = Date.parse(endDate);
            
        },
    });

    $('#year').datepicker({
        'dateFormat' : 'yy',
        showButtonPanel: true,
        changeYear: true,
        onClose: function(dateText, inst) { 
            console.log(dateText, inst)
            var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
            $(this).datepicker('setDate', new Date(year));
            var startDate = $('#startmonth').val() || 0;
            var endDate = $('#endmonth').val() || 0;
            dt1 = Date.parse(startDate);
            dt2 = Date.parse(endDate);
        },
    });
});


