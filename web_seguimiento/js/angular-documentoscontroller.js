app.controller('DocumentosController', ['$scope', '$route', '$routeParams', '$location',
	function($scope, $route, $routeParams, $location) {
	 
	 this.name = "DocumentosController";
   this.params = $routeParams;

	 this.loadOtras = function() {
	 	$scope.active = $routeParams.opt;
	 	$scope.descripcion = "<p>Desde fines de la década de los noventa, Chile ha reconocido la necesidad de impulsar una política Nacional de Desarrollo Digital como parte de su estrategia para potenciar el crecimiento económico y promover la inclusión social.</p><p>Las diferentes iniciativas impulsadas a nivel nacional en esta materia son:</p>";
 	 	$scope.titulo = "Otras Agendas"
	 	$scope.descargas = [
	 		{"titulo" : "Chile hacia la Sociedad de la Información", "descripcion": "", "archivo": "#"},
	 		{"titulo" : "Agenda Digital 2004-2006", "descripcion": "", "archivo": "#"},
	 		{"titulo" : "Estrategia Digital 2007-2012", "descripcion": "", "archivo": "#"},
	 		{"titulo" : "Agenda Imagina Chile", "descripcion": "", "archivo": "#"}
	 	]

	 }

	 this.loadDecreto = function() {
	 		$scope.active = $routeParams.opt;
	 		$scope.descripcion = "<p>El 15 de Enero de 2016 es promulgado el Decreto N°1 del 2016, del Ministerio Secretaría General de la Presidencia, mediante el cual se crea el Comité de Ministros para el Desarrollo Digital, conformando a su vez, a la Secretaría Ejecutiva y a sus integrantes.</p>";
		 	$scope.titulo = "Decreto Vigente"
		 	$scope.descargas = [
		 		{"titulo" : "Decreto Vigente", "descripcion": "Descarga el Decreto Vigente para conocer el detalle", "archivo": "#"}
		 		]
	 }

	 this.loadActas = function() {
	 		$scope.active = $routeParams.opt;
	 		$scope.descripcion = "<p>El Comité de Ministros para el Desarrollo Digital, se reunirá semestralmente para avanzar en la implementación y seguimiento de la Agenda Digital 2020.</p><p>Aquí podrás conocer los temas tratados en cada una de as sesiones del Comité</p>";
		 	$scope.titulo = "Actas del Comité"
		 	$scope.descargas = [
		 		{"titulo" : "Acta de Comité Número Uno", "descripcion": "Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam", "archivo": "#"},
		 		{"titulo" : "Acta de Comité Número Dos", "descripcion": "Fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.", "archivo": "#"},
		 		{"titulo" : "Acta de Comité Número Tres", "descripcion": "Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit", "archivo": "#"},
		 		{"titulo" : "Acta de Comité Número Cuatro", "descripcion": "Fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.", "archivo": "#"},
		 	]
	 }

	 switch(this.params.opt) {
  		case 'otras-agendas':
  			this.loadOtras();
  			break;
  		case 'decreto-vigente':
  			this.loadDecreto();
  			break;
  		case 'actas-comite':
  			this.loadActas();
  			break;
  		default:
  			this.loadOtras();
  	}  

	}

]);