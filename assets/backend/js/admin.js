var APP = function(app, $) {
// this is global variables
app = {
	BASE_URL: $('#BASE_URL').val(),
	SITE_URL: $('#SITE_URL').val(),

};

app.init = function() {
	app.bootstrap();
}
app.bootstrap = function() {
	$('#confirm-delete').on('shown.bs.modal', function(e) {
		$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
	});

	$("#wide").mask("9999.99999", { autoclear: false});
	$("#left").mask("99.99999", { autoclear: false});
	$("#right").mask("99.99999", { autoclear: false});
	$("#limpas").mask("99.99999", { autoclear: false});

	$("#date" ).datepicker({
		'dateFormat' : 'yy-mm-dd',
	});
}
return app;
}(APP || {}, jQuery);

jQuery(function($){
	APP.init();
	
});