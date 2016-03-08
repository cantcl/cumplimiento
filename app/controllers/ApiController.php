<?php

class ApiController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		die("?");
	}

	public function getAllCategories(){
		$fuentes = Fuente::with('hijos', 'hijos.hijos')->whereNull('fuente_padre_id')->get();
		return Response::json(array(
			'error' => false,
			'data' => $fuentes->toArray()),
			200
		);
	}

	/*category <- Eje*/
	public function getCompromisos($compromiso_id = null){
		if( $compromiso_id != null){
			$compromiso = Compromiso::where('id', $compromiso_id)->get();
			$aCompromiso = $compromiso->toArray();
			$aComp = $aCompromiso[0];

			$aComp['titulo'] = $aComp['nombre'];
			$aComp['avance'] = number_format($compromiso[0]->avance*100,2,',','.');
			if( $compromiso[0]->avance == 0){
				$aComp['estado_avance'] = 'No Iniciada';
			}else{
				if( $compromiso[0]->avance == 100 ){
					$aComp['estado_avance'] = "Cumplida";
				}else{
					$aComp['estado_avance'] = "En proceso";
				}
			}
			$aComp['meta'] = $aComp['objetivo'];

			$sectores = '';
			foreach ($compromiso[0]->sectores as $key => $value) {
				$sectores += $value.' ';
			}
			$aComp['territorio'] = $sectores;

			$aComp['ministerio'] = $compromiso[0]->institucionResposablePlan->nombre;
			$aComp['entidad'] = $compromiso[0]->institucionResposableImplementacion->nombre;

			$otros_actores = array();
			foreach ($compromiso[0]->actores as $key => $value) {
				array_push($otros_actores, $value->nombre);
			}
			$aComp['otros_actores'] = $otros_actores;

			$tags = array();
			foreach ($compromiso[0]->tags as $key => $value) {
				array_push($tags, $value->nombre);
			}
			$aComp['tags'] = $tags;
			$aComp['hitos'] = $compromiso[0]->getHitosSimplificados();
			$aComp['mesas'] = $compromiso[0]->getMesasSimplificadas();

			unset(
				$aComp['nombre']
			);

			return Response::json($aComp);
		}else{
			$fuentes = Fuente::with('hijos', 'hijos.hijos')->whereNull('fuente_padre_id')->get();
			foreach ($fuentes as $key => $value) {
				$fuentes[$key]['codigo'] = strtolower(substr($fuentes[$key]['nombre'],0,3));
				$fuentes[$key]['porcentaje_total'] = $value->porcentajeTotal();
				$fuentes[$key]['total_medidas'] = $value->cantidadMedidas();
				$fuentes[$key]['medidas_desarrollo'] = $value->cantidadMedidasDesarrollo();
				$fuentes[$key]['medidas_nuevas'] = $value->cantidadMedidasNuevas();
				$fuentes[$key]['compromisos'] = $value->compromisos_con_hitos();
				/*eliminar data extra*/
				unset(
					$fuentes[$key]['tipo'],
					$fuentes[$key]['fuente_padre_id'],
					$fuentes[$key]['created_at'],
					$fuentes[$key]['updated_at']
				);
			}

			return Response::json(array(
				'ejes' => $fuentes->toArray())
			);
		}
	}

	/*Show notice by id*/
	public function getNoticias($new_id = null) {
		if( $new_id != null ){
			$noticia = Noticia::where('id',$new_id)->get();
			$noticia = $noticia->toArray();
			$noticia = $noticia[0];
		}else{
			$noticia = array();
			$noticias = Noticia::orderBy('id','desc')->get();
			$noticias = $noticias->toArray();
			$k = 0;
			foreach ($noticias as $key => $value) {
				$c = Compromiso::where('id', $value['compromiso_id'])->get();
				if( $c[0]->publicado == 1 ){
					array_push($noticia, $value);
					$k++;
					if($k==3){
						break;
					}
				}
			}
		}

		return Response::json( $noticia );
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
