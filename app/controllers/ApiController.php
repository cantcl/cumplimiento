<?php

class ApiController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		die("aqui");
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

			return Response::json($aCompromiso[0]);
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
		}else{
			$noticia = Noticia::get();
		}

		return Response::json(
			$noticia->toArray()
		);
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
