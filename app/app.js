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
		'AppNavbar'
	])
	.config(function ($routeProvider) {
		$routeProvider
			.when('/sms', {
				templateUrl: 'htmls/sms.html',
				controller: 'cuController'
			})
			.when('/', {
				template: '<h2>Hola mundo</h2>',
			})
			.otherwise({
				redirectTo: '/sms'
			});
	});