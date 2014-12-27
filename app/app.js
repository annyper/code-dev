'use strict';

/**
 * @ngdoc overview
 * @name appApp
 * @description
 * # appApp
 *
 * Main module of the application.
 */
angular
	.module('appApp', [
		'integracionSMS',
		'ngRoute',
		'AppNavbar',
		'ngCsv'
	])
	.config(function ($routeProvider) {
		$routeProvider
			.when('/sms', {
				templateUrl: 'htmls/sms.html',
				controller: 'cuController'
			})
			.when('/', {
				templateUrl: 'htmls/reportes.html',
				controller: 'MultiCtrl'
			})
			.when('/dashboard',{
				templateUrl: 'htmls/dashboard.html',
				controller: 'DashBoard'
			})
			.when('/dashboard2', {
				template: '<h1>¿Qué dijiste? Coroné!</h1>'
			})
			.otherwise({
				redirectTo: '/sms'
			});
	});