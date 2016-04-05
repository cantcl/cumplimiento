app.controller('HomeController', ['$scope', '$route', '$routeParams', '$location','$http','$compile',
	  function($scope, $route, $routeParams, $location, $http,$compile) {
	    this.$route = $route;
	    this.$location = $location;
	    this.$routeParams = $routeParams;
	    
	    var homeIntro = $('.intro-agenda');
	    $scope.includes = {};

	    // generar servicio o factory...
	    $http
	    	.get(api_prefix + 'compromisos')
	    	.success(function(data,status,header,config){
	    		$http
		    	.get('http://private-e8dc6-modernizacion.apiary-mock.com/noticias')
		    	.success(function(data,status,header,config){
		    		$scope.notices = data;
		    	})
		    	.error(function (data, status, header, config) { utils.alert('Hubo error en la comunicación en servidor, intente más tarde!') })



	    		//$scope.notices = data.noticias;
	    		$scope.ejes = data.ejes
	    	})
	    	.error(function (data, status, header, config) { utils.alert('Hubo error en la comunicación en servidor, intente más tarde!') })
	    	
				
	    $scope.lastClase = '';

	    $scope.initIntro = function() {

	    	$scope.includes.intro	= 'include_homeintro.html';

				var popover_options = {
					'placement': 'top',
					'trigger': 'hover',
					'html': true
				} 

				$('.progress-graph').each(function(i){
					$(this).data('content', $('#popover_template').text());
				}).promise().done(function(){
					$('.progress-graph').popover(popover_options);	
				})

			}


			$scope.initIntro();

			$scope.showTab = function(clase){

				var eje_id = clase.substr(0,3);
				$scope.includes.intro	= 'include_homeintroeje.html';
				pos = $scope.ejes.map(function(e) { return e.codigo; }).indexOf(eje_id);
				$scope.eje = $scope.ejes[pos];
				

				$http.get(api_prefix + 'lineas/' + $scope.eje.id)
		    	.success(function(data,status,header,config){
		    		$scope.eje.lineas_accion = data.lineas_accion;
		    		$scope.idx_medidas = 0;
	    		})
	    		.error(function (data, status, header, config) { 
	    			utils.alert('Hubo error en la comunicación en servidor, intente más tarde!');
	    		});
				$scope.eje.clase = clase;
				$('#navbar2 > ul.nav > li').removeClass('active');
				$('#navbar2 > ul.nav > li.' + clase).addClass('active');
			}

			 $scope.showCont = function(index){
			 	$scope.idx_medidas = index;
			}

			$scope.closeIntro = function() {
				$route.reload();
			}

	}]);