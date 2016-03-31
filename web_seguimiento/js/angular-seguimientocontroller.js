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
  	.get(api_prefix + 'compromisos')
  	.success(function(data,status,header,config){
      console.log(data.ejes);
  		$scope.ejes = data.ejes
  	})
  	.error(function (data, status, header, config) { console.error('Hubo error en la comunicación en servidor, intente más tarde!') })  
	}

	

]);