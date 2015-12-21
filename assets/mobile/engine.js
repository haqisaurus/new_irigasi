

	var base_url = $('#site-url').val();

	var Auth = Backbone.Model.extend({
		defaults: {
			username: '',
			password: '',
			remember: 'off',
		},
		initialize: function() {

		},
		login: function(username, password, remember) {
			$.ajax({
				url: base_url + '/login-action-ajax',
				type: 'POSt',
				dataType: 'json',
				data: {
					username: username,
					password: password,
					remember: remember,
				},
				beforeSend: function() {

					$.mobile.loading( "show" );
				},
				statusCode: {
					401: function() {
						$('#popupDialog').find('.ui-title').text('Akun yang anda masukan tidak terdaftar!!!');
						$.mobile.changePage('#popupDialog', {
				            transition: 'fade ',
				            changeHash: true,
				            role: 'dialog'
				        });
						$('#popupDialog').on('pageshow', function(event, ui) {
				        	$('#close-dialog').focus();
				        });
					}
				},
			})
			.done(function(response) {
				console.log(response);
				if (response.status) {
					window.location.href = base_url + '/juru';
				} else	{
					$('#popupDialog').find('.ui-title').html(response.error.username + '<br>' + response.error.password);
					$.mobile.changePage('#popupDialog', {
			            transition: 'fade ',
			            changeHash: true,
			            role: 'dialog'
			        });
					$('#popupDialog').on('pageshow', function(event, ui) {
			        	$('#close-dialog').focus();
			        });
				};
			})
			.fail(function(error, a, b) {

				
			})
			.always(function() {
				console.log("complete");
				$.mobile.loading( "hide" );
			});
			
		},
    });
	

	var LoginView = Backbone.View.extend({

	    initialize: function() {
	    	
	        this.template = _.template($('#login').html());
	    },
	    render:function (eventName) {
	    	
	        $(this.el).html(this.template());
	        return this;
	    },
	    events: {
	    	'click #login-button' : 'loginAction',
	    },
	    loginAction: function(event) {

	    	var username = this.$el.find('#username').val();
	    	var password = this.$el.find('#password').val();
	    	var remember = this.$el.find('#remember').is(":checked");

	    	var auth = new Auth() 

	    	auth.login(username, password, remember);
	    }

	});

	var AppRouter = Backbone.Router.extend({

	    routes:{
	        "":"login",
	    },

	    initialize:function () {
	    
	        this.loginPage = new LoginView({ el: $("#login") });
	        this.loginPage.render();
	    },

	    login:function () {
	        
	        $.mobile.changePage( "#login" , { reverse: false, changeHash: false } );
	    },

	    
	});

	$(document).ready(function () {

	    $( document ).on( "mobileinit",
			// Set up the "mobileinit" handler before requiring jQuery Mobile's module
			function() {
				// Prevents all anchor click handling including the addition of active button state and alternate link bluring.
				$.mobile.linkBindingEnabled = false;

				// Disabling this will prevent jQuery Mobile from handling hash changes
				$.mobile.hashListeningEnabled = false;
			}
		);

	    app = new AppRouter();
	    Backbone.history.start();
	});
