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
	    	.get(api_prefix + 'compromisos/'+this.params.opt)
	    	.success(function(data,status,header,config){
	    		console.log(data);
	    		$scope.medida = data
	    		$scope.medida.avance = Math.ceil(parseFloat($scope.medida.avance));
	    	})
	    	.error(function (data, status, header, config) { 
	    		console.error('Hubo error en la comunicación en servidor, intente más tarde!')
	    	});
	  	//$scope.medida = this.medida;

	}
])