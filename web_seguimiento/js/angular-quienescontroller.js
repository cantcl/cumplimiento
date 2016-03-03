app.controller('QuienesController', ['$scope', '$routeParams', '$location', '$anchorScroll',
		function($scope, $routeParams, $location, $anchorScroll) {

	  	this.name = "QuienesController";
	  	this.params = $routeParams;

	  	this.comite = [
	  		{"nombre": "Nicolás Eyzaguirre Guzmán", "role": "principal", "img": "http://www.gob.cl/wp-content/uploads/2014/03/Eyzaguirre.jpg"},
	  		{"nombre": "Jorge Burgos Varela", "role": "miembro", "img": "http://www.gob.cl/wp-content/uploads/2014/03/Burgos.jpg"},
	  		{"nombre": "Rodrigo Valdés Púlido", "role": "miembro", "img": "http://www.gob.cl/wp-content/uploads/2014/03/IMG_7600_gob.jpg"},
	  		{"nombre": "Luis Felipe Céspedes Cifuentes", "role": "miembro", "img": "http://www.gob.cl/wp-content/uploads/2014/03/Cespedes.jpg"},
	  		{"nombre": "Adriana Delpiano", "role": "miembro", "img": "http://www.gob.cl/wp-content/uploads/2014/03/delpiano.png"},
	  		{"nombre": "Carmen Castillo Taucher", "role": "miembro", "img": "http://www.gob.cl/wp-content/uploads/2014/03/Foto-Oficial-Ministra-de-Salud_GOB.CL-11.jpg"},
	  		{"nombre": "Andrés Gómez-Lobo", "role": "miembro", "img": "http://www.gob.cl/wp-content/uploads/2014/03/Gomez-Lobo.jpg"}
	  	]

	  	this.secretaria = [
	  		{"nombre": "Patricia Silva Meléndez", "role": "principal", "img": "http://www.gob.cl/wp-content/uploads/2014/03/SUBSE_patricia-silva-melendez1.jpg"},
	  		{"nombre": "Alejandro Micco Aguayo", "role": "miembro", "img": "http://www.gob.cl/wp-content/uploads/2014/03/SUBSE_Alejandro-Micco1.jpg"},
	  		{"nombre": "Natalia Piergentili Domenech", "role": "miembro", "img": "http://www.economia.gob.cl/wp-content/uploads/2014/03/Subsecretaria-de-Economia-Natalia-Piergentili.png"},
	  		{"nombre": "Pedro Huinchalaf Roa", "role": "miembro", "img": "http://www.gob.cl/wp-content/uploads/2014/03/SUBSE_Pedro-Huichalaf1.jpg"}
	  	]


	  	this.goTop = function() {
	  		$location.hash('top-page');
	  		$anchorScroll();
	  	}

			this.loadComite = function() {
				$scope.active = $routeParams.opt;
				$scope.members = this.comite;
				$scope.template = 'include_comite.html';
				$scope.detalle = {
					"nombre": $scope.members[0].nombre,
					"img":  $scope.members[0].img
				};
	  		$scope.titulo = "Comité de Ministros";
	  		$scope.selected = -1;
	  		this.goTop()
	  	}

	  	this.loadSecretaria = function() {
	  		$scope.active = $routeParams.opt;
	  		$scope.members = this.secretaria;
	  		$scope.detalle = {
					"nombre": $scope.members[0].nombre,
					"img":  $scope.members[0].img
				};
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