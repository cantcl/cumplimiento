app.controller('AgendaController', ['$scope', '$rootScope', '$routeParams', '$location', '$anchorScroll', '$http',
		function($scope, $rootScope, $routeParams, $location, $anchorScroll, $http) {
	  	this.name = "AgendaController";
	  	this.params = $routeParams;
	  	
			this.goTop = function() {
	  		$location.hash('top-page');
	  		$anchorScroll();
	  	}

			this.loadQue = function() {
				$scope.active = 'que';
				$scope.titulo = "¿Que es la Agenda?";
				$scope.template = 'include_que.html';
	  		this.goTop()
	  	}

	  	this.loadComo = function() {
				$scope.active = $routeParams.opt;
				$scope.titulo = "Cómo se Construyó la Agenda";
	  		$scope.template = 'include_como.html';
	  		this.goTop()
	  	}

	  	this.loadCaracteriticas = function() {
				$scope.active = $routeParams.opt;
				$scope.titulo = "Caraterísticas de la Agenda";
				$scope.template = 'include_caracteristicas.html';
	  		this.goTop()
	  	}

	  	this.loadContenido = function() {
				$scope.active = $routeParams.opt;
				$scope.titulo = "Contenido de la Agenda";
				$scope.template = 'include_contenido.html';
	  		console.log($location.hash())
	  		$location.hash();
	  		$anchorScroll();
	  	}

	  	switch(this.params.opt) {
	  		case 'que':
	  			this.loadQue();
	  			break;
	  		case 'como':
	  			this.loadComo();
	  			break;
	  		case 'caracteristicas':
	  			this.loadCaracteriticas();
	  			break;
	  		case 'contenido':
	  			this.loadContenido();
	  			break;
	  		default:
	  			this.loadQue();
	  	}

	}])