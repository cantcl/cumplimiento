app.controller('AgendaController', ['$scope', '$rootScope', '$routeParams', '$location', '$anchorScroll', '$http',
		function($scope, $rootScope, $routeParams, $location, $anchorScroll, $http) {
	  	this.name = "AgendaController";
	  	this.params = $routeParams;

	  	this.comite = [
	  		{"nombre": "Nicolás Eyzaguirre Guzmán", "role": "principal", "img": "http://www.gob.cl/wp-content/uploads/2014/03/Eyzaguirre.jpg", "cargo": "Ministro Secretario General de la Presidencia", "bio": "#"},
	  		{"nombre": "Jorge Burgos Varela", "role": "miembro", "img": "http://www.gob.cl/wp-content/uploads/2014/03/Burgos.jpg", "cargo": "Ministro del Interior y Seguridad Pública", "bio": "#"},
	  		{"nombre": "Rodrigo Valdés Púlido", "role": "miembro", "img": "http://www.gob.cl/wp-content/uploads/2014/03/IMG_7600_gob.jpg", "cargo": "Ministro de Hacienda", "bio": "#"},
	  		{"nombre": "Luis Felipe Céspedes Cifuentes", "role": "miembro", "img": "http://www.gob.cl/wp-content/uploads/2014/03/Cespedes.jpg", "cargo": "Ministro de Economía, Fomento y Turismo", "bio": "#"},
	  		{"nombre": "Adriana Delpiano", "role": "miembro", "img": "http://www.gob.cl/wp-content/uploads/2014/03/delpiano.png", "cargo": "Ministra de Educación", "bio": "#"},
	  		{"nombre": "Carmen Castillo Taucher", "role": "miembro", "img": "http://www.gob.cl/wp-content/uploads/2014/03/Foto-Oficial-Ministra-de-Salud_GOB.CL-11.jpg", "cargo": "Ministra de Salud", "bio": "#"},
	  		{"nombre": "Andrés Gómez-Lobo", "role": "miembro", "img": "http://www.gob.cl/wp-content/uploads/2014/03/Gomez-Lobo.jpg", "cargo": "Ministro de Transporte y Telecomunicaciones", "bio": "#"}
	  	]

	  	this.secretaria = [
	  		{"nombre": "Patricia Silva Meléndez", "role": "principal", "img": "http://www.gob.cl/wp-content/uploads/2014/03/SUBSE_patricia-silva-melendez1.jpg", "cargo": "Subsecretaria General de la Presidencia", "bio": "#"},
	  		{"nombre": "Alejandro Micco Aguayo", "role": "miembro", "img": "http://www.gob.cl/wp-content/uploads/2014/03/SUBSE_Alejandro-Micco1.jpg", "cargo": "Subsecretario de Hacienda", "bio": "#"},
	  		{"nombre": "Natalia Piergentili Domenech", "role": "miembro", "img": "http://www.economia.gob.cl/wp-content/uploads/2014/03/Subsecretaria-de-Economia-Natalia-Piergentili.png", "cargo": "Subsecretaria de Economía y Empresas de Menor Tamaño", "bio": "#"},
	  		{"nombre": "Pedro Huichalaf Roa", "role": "miembro", "img": "http://www.gob.cl/wp-content/uploads/2014/03/SUBSE_Pedro-Huichalaf1.jpg", "cargo": "Subsecretario de Telecomunicaciones", "bio": "#"}
	  	]
	  	
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
	  			if (document.getElementById('top-page').offsetWidth < 768) {
		  			$scope.members = this.comite;
	  				$scope.detalle = $scope.members[0]
		  			$scope.secretaria = this.secretaria;
	  				$scope.detalle_secretaria = $scope.secretaria[0];
	  			}
	  			this.loadQue();
	  			break;
	  		case 'como':
		  		if(document.getElementById('top-page').offsetWidth < 768) {
		  			$('#headingTwo').find('h4').find('a').attr('aria-expanded',true);
		  			$('#headingOne').find('h4').find('a').attr('aria-expanded',false);
		  			$('#collapseTwo').addClass('in');
		  			$('#collapseTwo').attr('aria-expanded', true);
		  			$('#collapseOne').removeClass('in');
		  			$('#collapseOne').attr('aria-expanded', false);
		  			$scope.members = this.comite;
	  				$scope.detalle = $scope.members[0]
		  			$scope.secretaria = this.secretaria;
	  				$scope.detalle_secretaria = $scope.secretaria[0];
	  			}
	  			else
	  				this.loadComo();
	  			break;
	  		case 'caracteristicas':
	  			if(document.getElementById('top-page').offsetWidth < 768) {
		  			$('#headingFour').find('h4').find('a').attr('aria-expanded',true);
		  			$('#headingOne').find('h4').find('a').attr('aria-expanded',false);
		  			$('#collapseFour').addClass('in');
		  			$('#collapseFour').attr('aria-expanded', true);
		  			$('#collapseOne').removeClass('in');
		  			$('#collapseOne').attr('aria-expanded', false);
		  			$scope.members = this.comite;
	  				$scope.detalle = $scope.members[0]
		  			$scope.secretaria = this.secretaria;
	  				$scope.detalle_secretaria = $scope.secretaria[0];
	  			}
	  			else
	  				this.loadCaracteriticas();
	  			break;
	  		case 'contenido':
	  			if(document.getElementById('top-page').offsetWidth < 768) {
		  			$('#headingThree').find('h4').find('a').attr('aria-expanded',true);
		  			$('#headingOne').find('h4').find('a').attr('aria-expanded',false);
		  			$('#collapseThree').addClass('in');
		  			$('#collapseThree').attr('aria-expanded', true);
		  			$('#collapseOne').removeClass('in');
		  			$('#collapseOne').attr('aria-expanded', false);
		  			$scope.members = this.comite;
	  				$scope.detalle = $scope.members[0]
		  			$scope.secretaria = this.secretaria;
	  				$scope.detalle_secretaria = $scope.secretaria[0];
	  			}
	  			else
	  			this.loadContenido();
	  			break;
	  		default:
	  			this.loadQue();
	  	}

	}])