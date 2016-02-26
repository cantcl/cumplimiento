app.controller('NoticiasController', ['$scope', '$rootScope', '$routeParams', '$location', '$anchorScroll',
	function($scope, $rootScope, $routeParams, $location, $anchorScroll) {
  	this.name = "NoticiasController";
  	this.params = $routeParams;

  	this.goTop = function() {
  		$location.hash('top-page');
  		$anchorScroll();
  	}

		this.noticias = [
			{
				"id": 123,
				"titulo": "Valdivia lanza proyecto de Municipios Digitales 2016",
				"contenido": "Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.<br>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? <br> Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?",
				"bajada": "Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium",
				"img": "img/noticias-foto-01.png"
			},
			{
				"id": 125,
				"titulo": "Interior y Segpres alistan aplicación para atencion a Estudiantes",
				"contenido": "Perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.<br>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? <br> Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?",
				"bajada": "Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium",
				"img": "img/noticias-foto-02.png"
			},
			{
				"id": 129,
				"titulo": "Valdivia lanza proyecto de Municipios Digitales 2016",
				"contenido": "Unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.<br>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? <br> Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?",
				"bajada": "Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium",
				"img": "img/noticias-foto-01.png"
			},
			{
				"id": 133,
				"titulo": "Interior y Segpres alistan aplicación para atencion a Estudiantes",
				"contenido": "Omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.<br>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? <br> Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?",
				"bajada": "Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium",
				"img": "img/noticias-foto-02.png"
			}
		]

		if (this.params.opt) {
			var id = this.params.opt;
			console.log(id);
			var result = $.grep(this.noticias, function(e){ return e.id == id; });
			$scope.principal = result[0];
			this.goTop();
		} else {
			console.log('no id');
			$scope.principal = this.noticias[0];
		}

		$scope.otrasnoticias = this.noticias;
		// 
						
	}
]);