app.controller('DetalleController', ['$scope', '$rootScope', '$routeParams', '$location', '$anchorScroll','$http',
		function($scope, $rootScope, $routeParams, $location, $anchorScroll,$http) {
	  	this.name = "DetalleController";
	  	this.params = $routeParams;
	  	
			this.goTop = function() {
	  		$location.hash('top-page');
	  		$anchorScroll();
	  	}

	  	$scope.verMas = function() {
	  		console.log("ver mas");
	  		$('div.contenido').toggleClass('expanded');
	  		$('a.ver-mas').toggleClass('compress')
	  	}

	  	$http
    	.get('http://private-e8dc6-modernizacion.apiary-mock.com/compromisos/'+this.params.opt)
    	.success(function(data,status,header,config){
    		$scope.medida = data
    	})
    	.error(function (data, status, header, config) { utils.alert('Hubo error en la comunicación en servidor, intente más tarde!') })
	  	//$scope.medida = this.medida;

	}
])