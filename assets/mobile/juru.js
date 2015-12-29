
	var app = null;
	var siteUrl = $('#site-url').val();
	Backbone.emulateHTTP = true;
    Backbone.emulateJSON = true;
    $.mobile.date.prototype.options.dateFormat = "yy-mm-dd";

// MODEL
	var Region = Backbone.Model.extend({
		defaults: {
			region_name: '',
		},
		urlRoot : 'get-region-ajax',
    });

    var Year = Backbone.Model.extend({
		defaults: {
			year: '',
		},
		urlRoot : 'get-year-ajax',
    });

    var Water = Backbone.Model.extend({
    	defaults: {
    		region_id: '',
    		date: (new Date().getFullYear()) + '-' + (new Date().getMonth()) + '+' + (new Date().getDate()),
    		left: 0,
    		right: 0,
    		limpas: 0,
    	},
    	getCustomUrl: function(method) {
    		
    		switch(method) {
    			case 'read': 
	    			return '/get-water-ajax';
	    			break;
	    		case 'create': 
	    			return '/add-water-ajax';
	    			break;
	    		case 'update': 
	    			return '/';
	    			break;
	    		case 'delete': 
	    			return '/';
	    			break;
    		}
    	},
    	sync: function(method, model, options) {
    		console.log(method, model, options)
    		options || (options = {});
    		options.url = this.getCustomUrl(method.toLowerCase());
    		
    		return Backbone.sync.apply(this, arguments);
    	},
    	
    });
// END : MODEL

// COLLECTION
	var RegionCollection = Backbone.Collection.extend({
		model: Region,
    	url: 'get-region-ajax'
	});

    var WaterCollection = Backbone.Collection.extend({
    	model: Water,
    	url: 'get-water-ajax'
    });

// END : COLLECTION 

// VIEW	
	var SearchView = Backbone.View.extend({
		model: {
			years: Year,
			regions: Region,
		},
	    initialize: function() {
	    	
	        this.template = _.template($('#search').html());
	    },
	    render:function (eventName) {
	    	var _this = this;
	    	var yearsData = new this.model.years();
	    	var regionsData = new this.model.regions();
			var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

	    	// reset page
	    	$(_this.el).empty();

	    	regionsData.fetch().done(function(regionsResponse) {
	    		
	    		var param = {'region-id': regionsResponse[0].id};

	    		yearsData.fetch({data: param}).done(function(yearsResponse) {
	    			var _data = { 
		    			years: yearsResponse,
		    			months: months,
		    			regions: regionsResponse,
		    		 };
		    		
					$(_this.el).append(_this.template(_data));

		        	$(_this.el).trigger('create');
	    		});
	    	});
	    	
	    	
	        return this;
	    },
	    events: {
	    	'click #search-button' : 'resultSearch',
	    	'change #region' : 'changeYearList',
	    },
	    resultSearch: function(event) {

	    	var region 	= this.$el.find('#region').val();
	    	var year 	= this.$el.find('#year').val();
	    	var month 	= this.$el.find('#month').val();

	    	var resultList = new ListView();
	    	resultList.el = this.el;
	    	resultList.render(region, year, month);
	    	setTimeout(function() {
	    	$('a[href=#search-water]').hide();
	    	$('a[href=#home]').attr('href', '#list-water');

	    	}, 1000);
	    },
	    changeYearList: function(event) {
	    	var selectedArea = $(event.currentTarget).val();
	    	var yearsData = new this.model.years();

	    	var param = {'region-id': selectedArea};

    		yearsData.fetch({data: param}).done(function(yearsResponse) {
    			var options = '';
    			_.each(yearsResponse, function(val, key) {
    				options += '<option value=' + val.tahun + '>' + val.tahun + '</option>';
    			});
    			
    			$('#year').html(options);
    		});
	    }

	});

	var ListView = Backbone.View.extend({
		model: {
			debits: WaterCollection,
			regions: Region,
		},
		initialize: function() {
	        this.template = _.template($('#list').html());
		},
		render: function(region, year, month) {
			
			var _this = this;
			var debitsData = new this.model.debits();
			var regionsData = new this.model.regions();
			var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

			// from search
			if (arguments.length) {

				var today = ( months[month] + ' ' + year);
				// reset page
		    	$(_this.el).empty();
		    	month = parseInt(month) +1;
		    		
				var param = {'region-id': region, year: year, month: ("0" + month).slice(-2)};

				debitsData.fetch({data: param}).done(function(debitsResponse) {
					var _data = {
						data: debitsResponse, 
						date: today
					};

					$(_this.el).append(_this.template(_data));

		        	$(_this.el).trigger('create');
				});
	    	
			} else {
				// from default 
				var today = ( months[(new Date().getMonth())] + ' ' + new Date().getFullYear());
				// reset page
		    	$(_this.el).empty();

		    	regionsData.fetch().done(function(regionsResponse) {
		    		console.log(("0" + (new Date().getMonth()) ).slice(-2))
					var param = {'region-id': regionsResponse[0].id, month:  ("0" + (new Date().getMonth() + 1) ).slice(-2), year: new Date().getFullYear()};

					debitsData.fetch({data: param}).done(function(debitsResponse) {
						var _data = {
							data: debitsResponse, 
							date: today
						};

						$(_this.el).append(_this.template(_data));

			        	$(_this.el).trigger('create');
					})
		    	});
			};

			

	        return this;
		},
		events: {
			'change #region-id': 'changeList'
		}
	});

	var AddView = Backbone.View.extend({
		model: {
				region: Region, 
				water: Water
			},
		
		initialize: function() {
	        this.template = _.template($('#create').html());
		},
		render: function(eventName) {
			var _this = this;
			var regions = new this.model.region();
			
			// reset page
	    	$(_this.el).empty();

			regions.fetch().done(function(response) {
				
				var _data = { data: response };
				$(_this.el).append(_this.template(_data));
	        	$(_this.el).trigger('create');
				
			})

	        return this;
		},
		events: {
			'click #btn-save': 'saveAction',
		},
		saveAction: function(event) {

			var regionID = $('#region-id').val();
			var date = $('#date').val();
			var right = $('#right').val();
			var left = $('#left').val();
			var limpas = $('#limpas').val();

			var data = {
				'region-id': regionID,
	    		date: date,
	    		left: left,
	    		right: right,
	    		limpas: limpas,
			}

			var waterModel = new this.model.water(data);

			// loader
			$.mobile.loading( "show" );
			waterModel.save({}, {data: data}).done(function(response) {
				app.navigate('home', {trigger: true});
			})
			.fail(function(error) {
				var msg = $.parseJSON(error.responseText);
				var str = msg.error.date + '<br>' + msg.error.right + '<br>' + msg.error.left + '<br>' + msg.error.limpas + '<br>' + msg.error['region-id'];
				dialogShow(str)
			}).always(function() {
				$.mobile.loading( "hide" );
			});
		}
	});

	var HomeView = Backbone.View.extend({
		
	    initialize: function() {
	        this.template = _.template($('#home').html());
	    },
	    render:function () {
			$(this.el).html(this.template());
	        return this;
	    }
	});


// END : VIEW
	var AppRouter = Backbone.Router.extend({

	    routes:{
	        '': 'home',
	        'home': 'home',
	        'add-water': 'addData',
	        'list-water': 'listWater',
	        'search-water': 'searchWater',
	    },

	    initialize:function () {
	    
	 		$('.back').on('click', function(event) {
	            window.history.back();

	        });
	        this.firstPage = true;
	    },

	    home:function () {
	        this.changePage(new HomeView());
	    },

	    addData: function() {
	    	this.changePage(new AddView());
	    },

	    listWater: function() {
	    	this.changePage(new ListView());
	    },

	    searchWater: function() {
	    	this.changePage(new SearchView());
	    },

	    changePage:function (page) {
	        $(page.el).attr('data-role', 'page');
	        page.render();
	        
	        $('#content').html($(page.el));
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
	function dialogShow(msg) {
		$('#popupDialog').find('.ui-title').html(msg);

		$.mobile.changePage('#popupDialog', {
            transition: 'fade ',
            changeHash: true,
            role: 'dialog'
        });
		$('#popupDialog').on('pageshow', function(event, ui) {
        	$('#close-dialog').focus();
        });
	}
