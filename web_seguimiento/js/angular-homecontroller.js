app.controller('HomeController', ['$scope', '$route', '$routeParams', '$location','$http','$compile',
	  function($scope, $route, $routeParams, $location, $http,$compile) {
	    this.$route = $route;
	    this.$location = $location;
	    this.$routeParams = $routeParams;
	    
	    var homeIntro = $('.intro-agenda');


	    // generar servicio o factory...
	    $http
	    	.get('http://private-e8dc6-modernizacion.apiary-mock.com/compromisos')
	    	.success(function(data,status,header,config){
	    		$scope.notices = data.noticias;
	    		$scope.ejes = data.ejes
	    	})
	    	.error(function (data, status, header, config) { utils.alert('Hubo error en la comunicación en servidor, intente más tarde!') })
	    	
				
	    $scope.lastClase = '';

	    $scope.initIntro = function() {

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
				var newContent = $('#detalle_template').text();				
				$('.intro-agenda').empty().html(newContent).toggleClass(clase).toggleClass($scope.lastClase);
				$('.intro-agenda .ico-eje').toggleClass(clase).toggleClass($scope.lastClase).css('-webkit-filter','brightness(10)').css('filter','brightness(10)');
				$scope.lastClase = clase;
				$('.close-intro').removeClass('hide');
				$("#contenido .cent").children().remove();
				$.each($scope.ejes,function(index,eje){
					if(clase.substring(0,3)==eje.codigo){
						$scope.eje = eje;
						$.each(eje.compromisos,function(index,compromiso){
							if(index==0){
								var element = $compile("<div class='active' ng-href='#' ng-click='showCont("+compromiso.compromiso.id+")'><p class='pull-left'>"+compromiso.compromiso.nombre+"</p><i class='pull-right fa fa-play'></i></div>")($scope);
								$("#contenido .der table").children().remove();
								$.each(compromiso.compromiso.hitos,function(index,hito){
									$("#contenido .der table").append("<tr><td><i class='fa fa-circle-o'></i></td><td class='texto'>"+hito.descripcion+"</td></tr>");
								});
							}
							else
								var element = $compile("<div ng-href='#' ng-click='showCont("+compromiso.compromiso.id+")'><p class='pull-left'>"+compromiso.compromiso.nombre+"</p><i class='pull-right fa fa-play'></i></div>")($scope);
							$("#contenido .cent").append(element);
						})
					}
				});
				$('.cent > div').on('click', function(){
					$('.cent > div').removeClass('active');
					$(this).addClass('active')
				});
			}

			 $scope.showCont = function(id){
				$("#contenido .der table").children().remove();
				$.each($scope.eje.compromisos,function(index,compromiso){
					if((compromiso.compromiso.id+"")==id){
						$.each(compromiso.compromiso.hitos,function(index,hito){
							$("#contenido .der table").append("<tr><td><i class='fa fa-circle-o'></i></td><td class='texto'>"+hito.descripcion+"</td></tr>");
						});
					}
			 	})
			}

			$scope.closeIntro = function() {
				$route.reload();
			}

	}]);