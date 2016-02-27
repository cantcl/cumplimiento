app.controller('SeguimientoController', ['$scope', '$route', '$routeParams', '$location', '$anchorScroll',
	function($scope, $route, $routeParams, $location, $anchorScroll) {
	 
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

   this.updates  = [
		   {"id": 123, "titulo": "Ley de Protección de Datos Personales", "hitos": {"cumplidos": "04", "total": 10}, "avance": 37, "institucion": "Ministerio de Economía"},
		   {"id": 125, "titulo": "Gestión Digital del Estado: firma electrónica", "hitos": {"cumplidos": "05", "total": 09}, "avance": 64, "institucion": "Ministerio de Hacienda"},
		   {"id": 163, "titulo": "Generando una visión país sobre gobernanza de Internet", "hitos": {"cumplidos": "02", "total": 10}, "avance": 24, "institucion": "Ministerio de Economía"}
	]

  

	 $scope.ejes = [
	    	{'id': "der", 'nombre': "derechos", 'titulo': 'Derechos', 'avance': "25", 'medidas': "10", 'en_desarrollo': "05", 'por_iniciar': "05", "actualizaciones": this.updates},
	    	{'id': "con", 'nombre': "conectividad", 'titulo': 'Conectividad', 'avance': "33", 'medidas': "14", 'en_desarrollo': "06", 'por_iniciar': "04", "actualizaciones": this.updates},
	    	{'id': "gob", 'nombre': "gobierno", 'titulo': 'Gobierno', 'avance': "59", 'medidas': "13", 'en_desarrollo': "06", 'por_iniciar': "07", "actualizaciones": this.updates},
	    	{'id': "eco", 'nombre': "economia", 'titulo': 'Economía', 'avance': "22", 'medidas': "10", 'en_desarrollo': "04", 'por_iniciar': "06", "actualizaciones": this.updates},
	    	{'id': "com", 'nombre': "competencia", 'titulo': 'Competencias', 'avance': "71", 'medidas': "13", 'en_desarrollo': "09", 'por_iniciar': "04", "actualizaciones": this.updates}
	    ];

	}

]);