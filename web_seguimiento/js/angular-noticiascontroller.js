app.controller('NoticiasController', ['$scope', '$rootScope', '$routeParams', '$location', '$anchorScroll', '$http',
	function($scope, $rootScope, $routeParams, $location, $anchorScroll, $http) {
  	this.name = "NoticiasController";
  	this.params = $routeParams;

  	this.goTop = function() {
  		$location.hash('top-page');
  		$anchorScroll();
  	}
  	$http
    	.get(api_prefix + '/noticias')
    	.success(function(data,status,header,config){
    		$scope.notices = data;
    		if ($scope.noticias.params.opt == undefined){
    			$scope.notice = data[data.length - 1]
		  	}
    	})
    	.error(function (data, status, header, config) { utils.alert('Hubo error en la comunicación en servidor, intente más tarde!') })
  	if (this.params.opt != undefined){
  		$http
	    	.get('http://private-e8dc6-modernizacion.apiary-mock.com/noticias/'+this.params.opt)
	    	.success(function(data,status,header,config){
	    		$scope.notice = data;
	    	})
	    	.error(function (data, status, header, config) { utils.alert('Hubo error en la comunicación en servidor, intente más tarde!') })
  	}						
	}
]);