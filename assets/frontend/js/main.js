var APP = function(app, $) {
// this is global variables
app = {
	BASE_URL: $('#base_url').val(),
	SITE_URL: $('#site_url').val(),

};

app.init = function() {
	app.bootstrap();
	app.onChange();
}
app.bootstrap = function() {
	$('#confirm-delete').on('shown.bs.modal', function(e) {
		$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
	});

	$("#wide").mask("999.99999", { autoclear: false});
	$("#left").mask("99.99999", { autoclear: false});
	$("#right").mask("99.99999", { autoclear: false});
	$("#limpas").mask("99.99999", { autoclear: false});

	$("#date" ).datepicker({
		'dateFormat' : 'yy-mm-dd',
	});
}

app.onChange = function() {

	$('form')
	.off('change', 'select[name=region]')
	.on('change', 'select[name=region]', function(e) {

		$.ajax({
			url: app.SITE_URL + '/ajax-by-region-id',
			type: 'POST',
			dataType: 'json',
			data: {'region-id': $(this).val()},
		})
		.done(function(response) {
			$('select[name=year]').find('option').remove();
			console.log($('select[name=year]').find('option'))
			$.each(response, function(index, el) {
				var tmp = $('<option/>', { 'value' : el.tahun }).text(el.tahun);
				$('select[name=year]').append(tmp);
			});
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
		
	});
}

return app;
}(APP || {}, jQuery);

jQuery(function($){
	APP.init();
	
});