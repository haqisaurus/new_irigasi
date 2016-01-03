
	var app = null;
	var siteUrl = $('#site-url').val();
	// Backbone.emulateHTTP = true;
 //    Backbone.emulateJSON = true;
    // $.mobile.date.prototype.options.dateFormat = "yy-mm-dd";

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
    	urlRoot : 'api/water',
    	getCustomUrl: function(method) {
    		
    		switch(method) {
    			case 'read': 
	    			return '/api/water/' + this.id;
	    			break;
	    		case 'create': 
	    			return '/api/water';
	    			break;
	    		case 'update': 
	    			return '/api/water/' + this.id;
	    			break;
	    		case 'delete': 
	    			return '/api/water/' + this.id;
	    			break;
    		}
    	},
    	sync: function(method, model, options) {
    		
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
    	url: '/api/water'
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


	        	$('#date').datepicker({
	        		dateFormat: 'yy-mm-dd',
	        	});
				
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
				region_id: regionID,
	    		date: date,
	    		left: left,
	    		right: right,
	    		limpas: limpas,
			}

			var waterModel = new this.model.water(data);

			// loader
			$.mobile.loading( "show" );
			waterModel.save().done(function(response) {
				if(response.status) {
					alert('Input berhasil');
					app.navigate('home', {trigger: true});
				} else {
					alert('Input gagal!!!');
				}
			})
			.fail(function(error) {
				var msg = $.parseJSON(error.responseText);

				if (msg.error.region_id) {
					$('#region-id').css('border', '1px solid red');
				} else {
					$('#region-id').css('border', '1px transparent');
				};

				if (msg.error.date) {
					$('#date').css('border', '1px solid red');
				} else {
					$('#date').css('border', '1px transparent');
				};

				if (msg.error.right) {
					$('#right').css('border', '1px solid red');
				} else {
					$('#right').css('border', '1px transparent');
				};

				if (msg.error.left) {
					$('#left').css('border', '1px solid red');
				} else {
					$('#left').css('border', '1px transparent')
				};

				if (msg.error.limpas) {
					$('#limpas').css('border', '1px solid red');
				} else {
					$('#limpas').css('border', '1px transparent');
				}
				
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

	var editView = Backbone.View.extend({
		model: {
				region: Region, 
				water: Water
			},
		
		initialize: function(id) {
			
			this.idSearch = id;
	        this.template = _.template($('#edit').html());
		},
		render: function(eventName) {
			var _this = this;
			var regions = new this.model.region();
			var water = new this.model.water({id: this.idSearch});
			$.when(regions.fetch(), water.fetch()).done(function(response1, response2) {
				
				var _data = { 
						data: {
							regions : response1[0],
							water : response2[0]
						}
					};

				$(_this.el).append(_this.template(_data));
	        	$(_this.el).trigger('create');

	        	$('#date').datepicker({
	        		dateFormat: 'yy-mm-dd',
	        	});
  				
			});
			

	        return this;
		},
		events: {
			'click #btn-update': 'saveAction',
		},
		saveAction: function(event) {

			var ID = $('#id').val();
			var regionID = $('#region-id').val();
			var date = $('#date').val();
			var right = $('#right').val();
			var left = $('#left').val();
			var limpas = $('#limpas').val();

			// loader
			$.mobile.loading( "show" );

			var water = new this.model.water({
				id: ID,
				region_id: regionID,
				date: date,
				left: left,
				right: right,
				limpas: limpas,
			});

			water.save().done(function(response) {

				if(response.status) {
					alert('Udpate berhasil');
					app.navigate('list-water', {trigger: true});
				} else {
					alert('Update gagal!!!');
				}
			})
			.fail(function(error) {

				if (msg.error.region_id) {
					$('#region-id').css('border', '1px solid red');
				} else {
					$('#region-id').css('border', '1px transparent');
				};

				if (msg.error.date) {
					$('#date').css('border', '1px solid red');
				} else {
					$('#date').css('border', '1px transparent');
				};

				if (msg.error.right) {
					$('#right').css('border', '1px solid red');
				} else {
					$('#right').css('border', '1px transparent');
				};

				if (msg.error.left) {
					$('#left').css('border', '1px solid red');
				} else {
					$('#left').css('border', '1px transparent')
				};

				if (msg.error.limpas) {
					$('#limpas').css('border', '1px solid red');
				} else {
					$('#limpas').css('border', '1px transparent');
				};

			}).always(function() {
				$.mobile.loading( "hide" );
			});

			
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
	        'edit-water/:id': 'editWater',
	        'delete-water/:id': 'deleteWater',
	    },

	    initialize:function () {
	    
	 		$('.back').on('click', function(event) {
	            window.history.back();

	        });
	      
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

	    editWater: function(id) {
	       	this.changePage(new editView(id));
	    },

	    deleteWater: function(id) {
	    	var water = new Water({id: id});
	    	water.destroy().done(function(response) {
	    		if(response.status) {
					alert('Hapus data id ' + id + ' berhasil');
					app.navigate('list-water', {trigger: true});
				} else {
					alert('Hapus data id ' + id + ' gagal!!!');
				}
	    	})
	    },

	    changePage:function (page) {
	        $(page.el).attr('data-role', 'page');
	        page.render();
	        
	        $('#content').html($(page.el));
	        var transition = $.mobile.defaultPageTransition;
	        // We don't want to slide the first page
	        
	        $.mobile.changePage($(page.el), {changeHash:false, transition: 'pop'});
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
