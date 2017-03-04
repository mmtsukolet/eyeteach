'use strict'

var elixir = require('laravel-elixir');

elixir(function(mix) {

	/** default styles located @ resources/assets/css/ */
	mix.styles([''], 'public/css/stylesheets.css');

	/** default js located @ resources/js */
	mix.scripts([
		'../../../bower_components/jquery/dist/jquery.min.js',
		'../../../bower_components/tether/dist/js/tether.min.js',
		'../../../bower_components/pace/pace.js',
		'../../../bower_components/bootstrap/dist/js/bootstrap.min.js',
		'../../../bower_components/chart.js/dist/Chart.min.js',
		'../../../bower_components/datatables.net/js/jquery.dataTables.min.js',
		'resources/assets/js/app.js',
		'resources/assets/js/sweetalert.min.js',
		'resources/assets/js/custom.js',
		
	], 'public/js/all.js');

	mix.copy('resources/assets/img', 'public/assets/img');
	mix.copy('resources/assets/fonts', 'public/assets/fonts');

});