
	$(document).bind("mobileinit", function () {
	    $.mobile.ajaxEnabled = false;
	    $.mobile.linkBindingEnabled = false;
	    $.mobile.hashListeningEnabled = false;
	    $.mobile.pushStateEnabled = false;

	    // Remove page from DOM when it's being replaced
	    $('div[data-role="page"]').live('pagehide', function (event, ui) {
	        $(event.currentTarget).remove();
	    });
	});

	window.User = Backbone.Model.extend({
		defaults: {
			username: '',
			password: '',
			first_name: '',
			last_name: '',
			level: ''
		},
		initialize: function() {

		}
    });

    window.UserCollection = Backbone.Collection.extend({
    	model: Window.user,
    	url: ''
    });
	

	window.LoginView = Backbone.View.extend({

	    template:_.template($('#login').html()),

	    render:function (eventName) {
	        $(this.el).html(this.template());
	        return this;
	    },
	    events: {
	    	'click #login-button' : 'loginAction',
	    },
	    loginAction: function(event) {

	    }

	});

	var AppRouter = Backbone.Router.extend({

	    routes:{
	        "":"login",
	    },

	    initialize:function () {
	        // // Handle back button throughout the application
	        // $('.back').live('click', function(event) {
	        //     window.history.back();
	        //     return false;
	        // });
	        this.firstPage = true;
	    },

	    login:function () {
	        console.log('#home');
	        this.changePage(new LoginView());
	    },

	    

	    changePage:function (page) {
	        $(page.el).attr('data-role', 'page');
	        page.render();
	        $('body').append($(page.el));
	        var transition = $.mobile.defaultPageTransition;
	        // We don't want to slide the first page
	        if (this.firstPage) {
	            transition = 'none';
	            this.firstPage = false;
	        }
	        $.mobile.changePage($(page.el), {changeHash:false, transition: transition});
	    }

	});

	$(document).ready(function () {
	    console.log('document ready');
	    app = new AppRouter();
	    Backbone.history.start();
	});
