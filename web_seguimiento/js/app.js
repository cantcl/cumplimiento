var app =	angular.module('app', ['ngRoute', 'ngSanitize'])

app.config(['$routeProvider', '$locationProvider',
	  function($routeProvider, $locationProvider) {
	    $routeProvider
	      .when('/', {
	        templateUrl: 'home.html',
	        controller: 'HomeController',
	        controllerAs: 'home'
	      })
	      .when('/agenda', {
	        templateUrl: 'contenido.html',
	        controller: 'AgendaController',
	        controllerAs: 'agenda'
	      })
	      .when('/quienes-somos/:opt?', {
	        templateUrl: 'quienes.html',
	        controller: 'QuienesController',
	        controllerAs: 'quienes'
	      })
	      .when('/agenda/:opt?', {
	        templateUrl: 'contenido.html',
	        controller: 'AgendaController',
	        controllerAs: 'agenda'
	      })
	      .when('/documentos/:opt?', {
	        templateUrl: 'documentos.html',
	        controller: 'DocumentosController',
	        controllerAs: 'documentos'
	      })
	      .when('/noticias/:opt?', {
	        templateUrl: 'noticias.html',
	        controller: 'NoticiasController',
	        controllerAs: 'noticias'
	      })
	      .when('/seguimiento/medida/:opt?', {
	        templateUrl: 'detalle.html',
	        controller: 'DetalleController',
	        controllerAs: 'detalle'
	      })
	      .when('/seguimiento/:opt?', {
	        templateUrl: 'seguimiento.html',
	        controller: 'SeguimientoController',
	        controllerAs: 'seguimiento'
	      })
	      .otherwise({ redirectTo: '/' });

}])

app.controller('IncludeController', ['$timeout',
	function($timeout) {
		$timeout(function(){twttr.widgets.load();}, 500);
}]);


