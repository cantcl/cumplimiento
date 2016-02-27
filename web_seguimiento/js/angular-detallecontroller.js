app.controller('DetalleController', ['$scope', '$rootScope', '$routeParams', '$location', '$anchorScroll',
		function($scope, $rootScope, $routeParams, $location, $anchorScroll) {
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

	  	this.medida = {
	  		"id": 123,
	  		"titulo": "Política de Datos Abiertos",
	  		"descripcion": "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur",
	  		"impacto": "aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla",
	  		"avance": 33,
	  		"estado_avance": "En proceso",
	  		"meta": "Consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt",
	  		"territorio": "Nivel nacional",
	  		"ministerio": "Ministerio Secretaría General de la Presidencia",
	  		"entidad": "Unidad de Modernizacion",
	  		"presupuesto": 4.7,
	  		"plazo": "2018",
	  		"otros_actores": ["Ministerio de Economia", "Ministerio de Hacienda"],
	  		"tags": ["gobierno digital", "transparencia"],
	  		"eje": {
	  			"id": "gob",
	  			"nombre": "gobierno",
	  			"titulo": "Gobierno Digital",
	  			"descripcion": "Fortalecer un Estado abierto y transparente"
	  		},
	  		"hitos": [
	  			{"titulo": "Estudio de onsectetur adipiscing elit", "inicio": "01-2016", "termino": "06-2016", "avance": 33, "verificacion": {"url": "#", "mime": "csv"}},
	  			{"titulo": "Piloto de cillum dolore eu fugiat", "inicio": "06-2016", "termino": "09-2016", "avance": 0,"verificacion": {"url": "#", "mime": "pdf"}},
	  			{"titulo": "Firma de aute irure dolor", "inicio": "10-2016", "termino": "12-2016", "avance": 0,"verificacion": {"url": "#", "mime": "xs"}},
	  		],
	  		"mesas": [
	  			{"titulo": "Mesa de Gobierno Digital", "participantes": "Público/Privada", "sesiones": 8, "periodicidad": "Mensual"},
	  			{"titulo": "Mesa de Ciberseguridad", "participantes": "Sociedad Civil", "sesiones": 4, "periodicidad": "Semestral"}
	  		]

	  	}

	  	$scope.medida = this.medida;

	}
])