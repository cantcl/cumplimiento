app.controller('HomeController', ['$scope', '$route', '$routeParams', '$location',
	  function($scope, $route, $routeParams, $location) {
	    this.$route = $route;
	    this.$location = $location;
	    this.$routeParams = $routeParams;
	    
	    var homeIntro = $('.intro-agenda');


	    // generar servicio o factory...
			$scope.ejes = [
	    	{'id': "der", 'nombre': "derechos", 'titulo': 'Derechos', 'avance': "25", 'medidas': "10", 'en_desarrollo': "05", 'por_iniciar': "05"},
	    	{'id': "con", 'nombre': "conectividad", 'titulo': 'Conectividad', 'avance': "33", 'medidas': "14", 'en_desarrollo': "06", 'por_iniciar': "04"},
	    	{'id': "gob", 'nombre': "gobierno", 'titulo': 'Gobierno', 'avance': "59", 'medidas': "13", 'en_desarrollo': "06", 'por_iniciar': "07"},
	    	{'id': "eco", 'nombre': "economia", 'titulo': 'Economía', 'avance': "22", 'medidas': "10", 'en_desarrollo': "04", 'por_iniciar': "06"},
	    	{'id': "com", 'nombre': "competencia", 'titulo': 'Competencias', 'avance': "71", 'medidas': "13", 'en_desarrollo': "09", 'por_iniciar': "04"}
	    ];

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
				$('#navbar2 > ul.nav > li').removeClass('active');
				$('#navbar2 > ul.nav > li.' + clase).addClass('active');
				var newContent = $('#detalle_template').text()
				$('.intro-agenda').empty().html(newContent).toggleClass(clase).toggleClass($scope.lastClase);
				$('.intro-agenda .ico-eje').toggleClass(clase).toggleClass($scope.lastClase).css('-webkit-filter','brightness(10)').css('filter','brightness(10)');
				$scope.lastClase = clase;
				$('.close-intro').removeClass('hide');
				$('.cent > div').on('click', function(){
					$('.cent > div').removeClass('active');
					$(this).addClass('active')
				});
			}

			$scope.closeIntro = function() {
				$route.reload();
			}

	}]);