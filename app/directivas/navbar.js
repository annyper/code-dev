'use strict';

angular.module('AppNavbar', [])
	.directive('lsHeader', function(){

		function link(scope, element, attrs){
			
			scope.compararURL = function(url){

				if (location.hash === url) {
					return true;
				}else{
					return false;
				}
			}
		};
		return{
			restrict: 'E',			
			templateUrl: "htmls/navbar.html",
			link: link
		};	
	})
	.controller('header1', ['$scope','$location', function($scope){
		$scope.datos = {
			id: 1,
			nombrePrincipal: 'Une-Tigo',
			logo: '',
			enlaces: [
				{link: '/code-dev/gtr', nombre: 'GTR'},
				{link: '/code-dev/analytics', nombre: 'Analytics'},
				{link: '#/', nombre: 'Reportes'},
				{link: '#/sms', nombre: 'Directorio SMS'},
				{link: 'http://10.66.6.241:3000/checklist/#/checklist/8deedcd3508f2d84eafb4317e4dfb1ee', nombre: 'Checklist'},
				{link: '#/dashboard2', nombre: 'Dashboard'}
			],
			collapse:[
				{link: '#/', nombre: 'Ayuda'},
				{link: '#/about', nombre: 'Cerrar Sesión'}
			]			
		};
		
	}]);

