
	var app = null;
	var siteUrl = $('#site-url').val();
	Backbone.emulateHTTP = true;
    Backbone.emulateJSON = true;

// MODEL
	var Region = Backbone.Model.extend({
		defaults: {
			region_name: '',
		},
		urlRoot : siteUrl + '/get-region-ajax',
    });

    var Year = Backbone.Model.extend({
		defaults: {
			year: '',
		},
		urlRoot : siteUrl + '/get-year-ajax',
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
	    			return siteUrl + '/get-water-ajax';
	    			break;
	    		case 'create': 
	    			return siteUrl + '/add-water-ajax';
	    			break;
	    		case 'update': 
	    			return siteUrl + '/';
	    			break;
	    		case 'delete': 
	    			return siteUrl + '/';
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
    	url: siteUrl + '/get-region-ajax'
	});

    var WaterCollection = Backbone.Collection.extend({
    	model: Water,
    	url: siteUrl + '/get-water-ajax'
    });

// END : COLLECTION 

// VIEW	
	var SearchView = Backbone.View.extend({
		model: {
			years: Year,
			regions: Region,
		},
		el : $('#search-water'),
	    initialize: function() {
	    	
	        this.template = _.template($('#template-search').html());
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
		el : $('#list-water'),
		initialize: function() {
	        this.template = _.template($('#template-list').html());
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
		el : $('#add-water'),
		initialize: function() {
	        this.template = _.template($('#template-create').html());
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
		el : $('#home'),
	    initialize: function() {
	    	
	        this.template = _.template($('#template-home').html());
	    },
	    render:function () {
	    
	    	// reset page
	    	$(this.el).empty();

	        $(this.el).html(this.template());
	        
	        $(this.el).trigger('create');

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
	    
	        this.home = new HomeView();
	        this.add = new AddView();
	        this.list = new ListView();
	        this.search = new SearchView();
	        alert('initialize')
	    },

	    home:function () {
	        // $.mobile.changePage( "#home" , { reverse: false, changeHash: false } );
	        this.home.render();

	    },

	    addData: function() {
	    	// $.mobile.changePage( "#add-water" , { reverse: false, changeHash: false } );
	    	this.add.render();
	    },

	    listWater: function() {
	    	// $.mobile.changePage( "#list-water" , { reverse: false, changeHash: false } );
	    	this.list.render();
	    	alert('adf')
	    },

	    searchWater: function() {
	    	// $.mobile.changePage( "#search-water" , { reverse: false, changeHash: false } );
	    	this.search.render();
	    }
	    
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
