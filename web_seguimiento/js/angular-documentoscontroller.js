app.controller('DocumentosController', ['$scope', '$route', '$routeParams', '$location',
	function($scope, $route, $routeParams, $location) {
	 
	 this.name = "DocumentosController";
   this.params = $routeParams;

	 this.loadOtras = function() {
	 	$scope.active = $routeParams.opt;
	 	$scope.descripcion = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";
 	 	$scope.titulo = "Otras Agendas"
	 	$scope.descargas = [
	 		{"titulo" : "Agenda Número Uno", "descripcion": "Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam", "archivo": "#"},
	 		{"titulo" : "Agenda Número Dos", "descripcion": "Fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.", "archivo": "#"},
	 		{"titulo" : "Agenda Número Tres", "descripcion": "Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit", "archivo": "#"}
	 	]

	 }

	 this.loadDecreto = function() {
	 		$scope.active = $routeParams.opt;
	 		$scope.descripcion = "Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus";
		 	$scope.titulo = "Decreto Vigente"
		 	$scope.descargas = [
		 		{"titulo" : "Decreto Vigente", "descripcion": "Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam", "archivo": "#"},
		 		{"titulo" : "Decreto Vigente", "descripcion": "Fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.", "archivo": "#"}
		 	]
	 }

	 this.loadActas = function() {
	 		$scope.active = $routeParams.opt;
	 		$scope.descripcion = "At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi";
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