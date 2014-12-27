'use strict';

/**
 * @ngdoc function
 * @name appApp.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of the appApp
 */
 angular.module('appApp')
 .controller('MultiCtrl', ['$scope', '$http', function ($scope, $http) {

 	$scope.regional = '';
 	$scope.percent = 0;
 	$scope.cont = 0;
 	$scope.headerCSV = [];
 	$scope.maxRow = 10;

 	var cont = 0;
 	$scope.getIpList = function(){
 		$scope.regional = $scope.regional || '';
 		$scope.dataList = [];
 		var url = 'http://10.66.6.241:82/code-dev/Staff/getListaCodPos/';
 		url = url + $scope.regional;
 		
 		//console.log(url);
 		
 		$http.get(url).success(function(data) {
 			$scope.ipList = data;
 			//console.log($scope.ipList);
 			$scope.exe();
 		});
 	};
 	$scope.exe = function(){ 		
 		
		for (var i = 0; i < $scope.ipList.length; i++) {
			$scope.getData(i);		
		}
	};
 	$scope.getData = function (i) {
 		var codpos = $scope.ipList[i]['COD_POS'];
 		var url = 'http://10.66.6.241:82/code-dev/analytics/actividadWorstOffender/';
 		url = url + codpos + '/?fechaInicial=' + $scope.fecha1 + '&fechaFinal=' + $scope.fecha2;
		
		if (i === 0) {$scope.cont = 0};

 		$http.get(url).success(function(data) {
 			$scope.dataList = $scope.dataList.concat(data);
 			$scope.cont++;
 			$scope.percent = ($scope.cont/$scope.ipList.length)*100;
 			if ($scope.headerCSV.length === 0) {
 				for (var key in $scope.dataList[i]) {
 					$scope.headerCSV.push(key);
 				}
 			};
 			if ($scope.percent === 100) {$scope.getLabores()};

	 	}).error(function(){
	 		$scope.cont++;
 			$scope.percent = ($scope.cont/$scope.ipList.length)*100;
 			if ($scope.percent === 100) {$scope.getLabores()};
	 	});
 	};
 	$scope.getLabores = function(){
 		$scope.laborArray = _.pluck($scope.dataList, 'labor');
 		$scope.laborArray = _.uniq($scope.laborArray);
 	};

 	$scope.worstOffender = function(){
 		$scope.listaFiltradaAsesores = _.where($scope.dataList, {cargo: "Asesor", labor: $scope.labor});
 		var coleccion = $scope.listaFiltradaAsesores;
 	}
 	
 }]);
