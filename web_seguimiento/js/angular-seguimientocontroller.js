app.controller('SeguimientoController', ['$scope', '$route', '$routeParams', '$location', '$anchorScroll','$http',
	function($scope, $route, $routeParams, $location, $anchorScroll,$http) {
	 
	 this.name = "SeguimientoController";
   this.params = $routeParams;

   $scope.goTop = function() {
  		$location.hash('top-page');
  		$anchorScroll();
  	}

   $scope.ver = function(medida) {
   	$scope.goTop();
   	$location.url('/seguimiento/medida/' + medida);
   }

	$http
  	.get('http://private-e8dc6-modernizacion.apiary-mock.com/compromisos')
  	.success(function(data,status,header,config){
  		$scope.ejes = data.ejes
  	})
  	.error(function (data, status, header, config) { utils.alert('Hubo error en la comunicación en servidor, intente más tarde!') })  
	}

	

]);