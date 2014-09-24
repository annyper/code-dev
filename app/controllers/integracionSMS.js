(function(){
	var app = angular.module('integracionSMS', []);

	app.controller('cuController', function($scope, $http){
		
		$scope.spiner = true;

		$http.get('http://10.66.6.241:82/code-dev/analytics/getClientesSMS').success(function(data) {
			$scope.usuarios = data;
			$scope.spiner = false;
		});
		
		//$scope.usuarios = datos;
		var scope = $scope;
		$scope.datosForm = {};
		$scope.swForm = false;
		$scope.boton = 'Agregar usuario';


		$scope.showForm = function(){
			//this.swForm = this.swForm || false;
			$scope.swForm = !$scope.swForm;
			$scope.boton = $scope.swForm ? 'Ocultar form' : 'Agregar usuario';			
			$scope.datosForm = {};
		};
		
		$scope.agregarUsuario = function(){
			//console.log(this.datosForm);
			if (typeof($scope.datosForm.$$hashKey) === 'string') {
				// Actualizar
				$http.post('http://10.66.6.241:82/code-dev/sms/updateClienteSMS/' + $scope.datosForm.ID, $scope.datosForm).success(function(){
					var user = _.findWhere($scope.usuarios, {ID: scope.datosForm.ID});        
					var index = $scope.usuarios.indexOf(user);
					$scope.usuarios[index] = scope.datosForm;
					scope.datosForm = {};                
					//Hide Modal.
					$('#modal-sms').modal('hide');
				});

			}else{
				//Crear
				$http.post('http://10.66.6.241:82/code-dev/sms/setClienteSMS', $scope.datosForm).success(function(dat){
					console.log(dat);
					if (dat) {
						$scope.usuarios.unshift(scope.datosForm);
						scope.datosForm = {};
						scope.showForm();
					};
					
				});
			}
			//console.log(typeof(this.datosForm.$$hashKey));
		};
		$scope.editForm = function(idNumber){
			var user = _.clone(_.findWhere($scope.usuarios, {CELULAR: idNumber}));
			$scope.datosForm = user;
			console.log(user);
		};

		$scope.deleteUser = function(celular){
			$http.post('http://10.66.6.241:82/code-dev/sms/deleteClienteSMS/' + celular, $scope.datosForm).success(function(dat){
					if (dat) {
						var user = _.findWhere($scope.usuarios, {CELULAR: scope.datosForm.CELULAR});
						var index = $scope.usuarios.indexOf(user);

						$scope.usuarios.splice(index, 1);

						$scope.datosForm = {};
						$('#collapseDelete').removeClass('in');
						$('#modal-sms').modal('hide');
					}					
				});
		};

		$scope.ocultar = function(){
			$scope.swForm = false;
			$scope.boton = 'Agregar usuario';
			$('#collapseDelete').removeClass('in');
			//this.datosForm = {};
		};

	});

	//app.controller('editController')

	app.directive('formCrud', function(){
		return{
			restrict: 'E',
			templateUrl: "htmls/form-crud.html"
		};
	});

	datos = [
	{
		"ID" : 1,
		"CELULAR" : "3002354374",
		"NOMBRE" : "ANAMARIA PEREIRA",
		"CARGO" : "COORDINADOR COC",
		"TIPO_CLIENTE" : "COC",
		"COD_CDE" : null,
		"REGIONAL" : null
	},
	{
		"ID" : 2,
		"CELULAR" : "3006139335",
		"NOMBRE" : "RONALD MAURICIO CORREA",
		"CARGO" : "COORDINADOR COC",
		"TIPO_CLIENTE" : "COC",
		"COD_CDE" : null,
		"REGIONAL" : null
	},
	{
		"ID" : 5,
		"CELULAR" : "3002043910",
		"NOMBRE" : "JORGE ROJAS",
		"CARGO" : "GERENTE DE TIENDAS",
		"TIPO_CLIENTE" : "DIR",
		"COD_CDE" : null,
		"REGIONAL" : null
	}];


})();