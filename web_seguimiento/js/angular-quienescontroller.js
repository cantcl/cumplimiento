app.controller('QuienesController', ['$scope', '$routeParams', '$location', '$anchorScroll',
		function($scope, $routeParams, $location, $anchorScroll) {

	  	this.name = "QuienesController";
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
	  		{"nombre": "Pedro Huinchalaf Roa", "role": "miembro", "img": "http://www.gob.cl/wp-content/uploads/2014/03/SUBSE_Pedro-Huichalaf1.jpg", "cargo": "Subsecretario de Telecomunicaciones", "bio": "#"}
	  	]


	  	this.goTop = function() {
	  		$location.hash('top-page');
	  		$anchorScroll();
	  	}

			this.loadComite = function() {
				$scope.active = $routeParams.opt;
				$scope.members = this.comite;
				$scope.template = 'include_comite.html';
				$scope.detalle = $scope.members[0];
				// {
				// 	"nombre": $scope.members[0].nombre,
				// 	"cargo": $scope.members[0].cargo,
				// 	"img":  $scope.members[0].img
				// };
	  		$scope.titulo = "Comité de Ministros";
	  		$scope.selected = -1;
	  		this.goTop()
	  	}

	  	this.loadSecretaria = function() {
	  		$scope.active = $routeParams.opt;
	  		$scope.members = this.secretaria;
	  		$scope.detalle = $scope.members[0]
	  	// 	$scope.detalle = {
				// 	"nombre": $scope.members[0].nombre,
				// 	"cargo": $scope.members[0].cargo,
				// 	"img":  $scope.members[0].img
				// 	"bio":  $scope.members[0].img
				// };
				$scope.template = 'include_secretaria.html';
	  		$scope.titulo = "Secretaría Ejecutiva";
	  		$scope.selected = -1;
	  		this.goTop();
	  	}

	  	$scope.loadMember = function(m,$index) {
	  		$scope.detalle = m;
	  		$scope.selected = $index;
	  		console.log($scope.selected);
	  	}

	  	console.log(this.params);

	  	switch(this.params.opt) {
	  		case 'comite':
	  			this.loadComite();
	  			break;
	  		case 'secretaria':
	  			this.loadSecretaria();
	  			break;
	  		default:
	  			this.loadComite();
	  	}

	  	

	}])