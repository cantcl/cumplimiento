<?php

use Modernizacion\Helpers\SphinxHelper;

class CompromisosController extends BaseController {

	protected $layout='backend/template';


    public function getIndex($extension='.html'){
        $q=Input::get('q');
        $input = Input::all();
        unset($input['q']);

        $data['compromisos'] = $data['compromisos_chart'] = $data['fuentes'] = $data['instituciones'] = $data['tags'] = $data['usuarios'] = $data['sectores'] = $data['tipos'] = $data['avances'] = array();
        $data['input'] = array_merge(array('instituciones' => array(),'tags'=>array(), 'usuarios'=>array(), 'sectores' => array(), 'fuentes' => array(), 'tipos' => array(), 'avances'=> array(), 'lineas_accion' => array()), $input);

        if(!Auth::user()->super)
            $data['input']['usuarios']=array(Auth::user()->id);


        $sphinxHelper=new SphinxHelper(new \Scalia\SphinxSearch\SphinxSearch());
        $result = $sphinxHelper->search($q, $data['input']);
        $ids = $result['ids'];
        if($ids){
            $data['filtros'] = $data['filtros_count'] = array();
            foreach($result['filters'] as $name => $filter){
                $filters_id = array_flatten($filter);
                $data['filtros'][$name] = array_unique($filters_id);
                $data['filtros_count'][$name] = array_count_values($filters_id);
            }

            $compromisos = Compromiso::whereIn('id', $ids)->with('hitos','institucionResposablePlan','usuario','sectores');
            if($q)
                $compromisos->orderByRaw('FIELD(id,'.implode(',',$ids).')');
            else
                $compromisos->orderBy('id','desc');

            $data['compromisos_chart']=Compromiso::dataForAvanceChart($ids);
            $data['fuentes'] = Fuente::with('hijos', 'hijos.hijos')->whereNull('fuente_padre_id')->get();
            $data['instituciones'] = Institucion::with('hijos')->whereNull('institucion_padre_id')->get();
            $data['sectores'] = Sector::with('hijos.hijos')->whereNull('sector_padre_id')->get();
            $data['tags'] = Tag::all();
            $data['usuarios'] = Usuario::all();
            // $data['lineas_accion'] = Compromiso::select(DB::raw('count(*) as medidas, linea_accion'))->distinct()-get();
        }


        if($extension=='.html'){
            $data['compromisos']=isset($compromisos)?$compromisos->paginate(50):null;
            $this->layout->busqueda = $data['q'] = $q;
            $this->layout->title='Buscar';
            $this->layout->sidebar = View::make('backend/compromisos/sidebar_search', $data);
            $this->layout->content= View::make('backend/compromisos/index', $data);
        }else if($extension=='.pdf'){
            $data['compromisos']=isset($compromisos)?$compromisos->get():null;
            return PDF::load(View::make('backend/compromisos/index_pdf',$data), 'letter', 'portrait')->show();
        }else if($extension=='.xls'){
            Excel::create('compromisos', function($excel) use ($compromisos) {
                $excel->sheet('Sheetname', function($sheet) use ($compromisos) {
                    $compromisos=$compromisos->get();

                    $array=array();
                    foreach($compromisos as $c){
                        $row['id']=$c->id;
                        $row['nombre']=$c->nombre;
                        $row['descripcion']=$c->descripcion;
                        $row['institucion_responsable_plan']=$c->institucionResposablePlan->nombre;
                        $row['institucion_responsable_implementacion']=$c->institucionResposableImplementacion->nombre;
                        $row['publico']=$c->publico?'Sí':'No';
                        $row['sectorialista']=$c->usuario->nombres.' '.$c->usuario->apellidos;
                        $row['fuente']=$c->fuente->nombre;
                        $row['tipo']=$c->tipo;
                        $row['avance']=$c->avance;
                        $row['avance_descripcion']=$c->avance_descripcion;
                        $row['beneficios']=$c->beneficios;
                        $row['metas']=$c->metas;
                        $row['sectores']=$c->sectores->implode('nombre',', ');

                        $array[]=$row;
                    }

                    $sheet->fromArray($array);

                });
            })->export('xls');
        }
    }
/*
	public function getIndex()
	{
        $offset = Input::get('offset', 0);
        $limit = Input::get('limit', 10);

        $compromisos = Compromiso::limit($limit)->offset($offset)->get();

        $this->layout->title='Inicio';
        $this->layout->sidebar=View::make('backend/compromisos/sidebar',array('item_menu'=>'compromisos'));
		$this->layout->content=View::make('backend/compromisos/index', array('compromisos' => $compromisos));
	}
*/
    public function getVer($compromiso_id){
        $compromiso=Compromiso::find($compromiso_id);

        if(!Auth::user()->super && $compromiso->usuario_id!=Auth::user()->id)
            App::abort(403, 'Unauthorized action.');

        $this->layout->title = 'Compromiso';
        $this->layout->sidebar=View::make('backend/compromisos/sidebar',array('item_menu'=>'compromisos'));
        $this->layout->content = View::make('backend/compromisos/view', array('compromiso' => $compromiso));
    }

    public function getNuevo(){
        $data['compromiso'] = new Compromiso();
        $data['instituciones'] = Institucion::whereNull('institucion_padre_id')->get();
        $data['sectores'] = Sector::whereNull('sector_padre_id')->get();
        $data['fuentes'] = Fuente::whereNull('fuente_padre_id')->get();
        $data['usuarios'] = Usuario::all();
        $data['tags']=Tag::all()->lists('nombre');;

        $this->layout->title = 'Compromiso';
        $this->layout->sidebar=View::make('backend/compromisos/sidebar',array('item_menu'=>'compromisos'));
        $this->layout->content = View::make('backend/compromisos/form', $data);
    }

    public function getEditar($compromiso_id){
        $compromiso=Compromiso::find($compromiso_id);

        if(!Auth::user()->super && $compromiso->usuario_id!=Auth::user()->id)
            App::abort(403, 'Unauthorized action.');

        $ministerios = [2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,387]; // no todos los que son padres son ministerios

        $data['compromiso'] = $compromiso;
        $data['instituciones'] = Institucion::whereIn('id',$ministerios)->get();
        $data['sectores'] = Sector::whereNull('sector_padre_id')->get();
        	$data['comunas'] = Sector::whereNull('sector_padre_id')->get();
        $data['fuentes'] = Fuente::whereNull('fuente_padre_id')->get();
        $data['usuarios'] = Usuario::all();
        $data['tags']=Tag::all()->lists('nombre');

        $this->layout->title = 'Compromiso';
        $this->layout->sidebar=View::make('backend/compromisos/sidebar',array('item_menu'=>'compromisos'));
        $this->layout->content = View::make('backend/compromisos/form', $data);
    }

    public function postGuardar($compromiso_id = null){

				/*Informar por email modificaciones hechas por el Jefe de proyectos*/
				

        $input = Input::all();
        $rules = array(
            'numero' => 'required',
            'nombre' => 'required',
            'autoridad_responsable' => 'required',
            'fuente' => 'required',
            'institucion_responsable_plan' => 'required',
            'institucion_responsable_implementacion' => 'required',
            'url'=>'url',
            'presupuesto_publico' => 'required'
        );
        $messages = array(
            'numero.required' => '<strong>Número de la medida</strong> es obligatorio',
            'numero.number' => '<strong>Número de la medida</strong> debe ser un avalor numérico',
            'nombre.required' => '<strong>Nombre de la medida</strong> es obligatorio',
            'autoridad_responsable.required' => '<strong>Autoridad responsable</strong> es obligatorio',
            'fuente.required' => '<strong>Eje estratégico</strong> es obligatorio',
            'institucion_responsable_plan.required' => '<strong>Ministerio responsable</strong> es obligatorio',
            'institucion_responsable_implementacion.required' => '<strong>Institución responsable</strong> es obligatorio',
            'presupuesto_publico.required' => '<strong>Presupuesto ($CLP)</strong> es obligatorio y debe ser un valor numérico'
        );

				$input['iniciativa'] = '-';
				$input['eje_estrategico'] = '-';

        $validator = Validator::make($input, $rules, $messages);

        $json = new stdClass();
        if($validator->passes()){
            DB::connection()->getPdo()->beginTransaction();

            // $compromiso = $compromiso_id ? Compromiso::find($compromiso_id) : new Compromiso();
            if (isset($compromiso_id)) {
                $compromiso = Compromiso::find($compromiso_id);
                $done_label = 'actualizado';
            } else {
                $compromiso = new Compromiso();
                $done_label = 'creado';
            }

						$compromiso->iniciativa = $input['iniciativa'];
						$compromiso->eje_estrategico = $input['eje_estrategico'];

            $compromiso->number = Input::get('numero');
            $compromiso->nombre = Input::get('nombre');
						$compromiso->contacto = Input::get('contacto');
            $compromiso->autoridad_responsable = Input::get('autoridad_responsable');
            $compromiso->linea_accion = Input::get('linea_accion');
            $compromiso->prioridad = Input::get('prioridad');
            $compromiso->fuente_id = Input::get('fuente');
            $compromiso->url = Input::get('url','-');
            $compromiso->descripcion = Input::get('descripcion','');
            $compromiso->impacto = Input::get('impacto','');
            $compromiso->objetivo = Input::get('objetivo','');
            $compromiso->publico=Input::get('publico',1);
            $compromiso->avance_descripcion=Input::get('avance_descripcion');
            $compromiso->plazo=Input::get('plazo');
            $compromiso->presupuesto_publico=Input::get('presupuesto_publico');
            $compromiso->institucionResposablePlan()->associate(Institucion::find(Input::get('institucion_responsable_plan')));
            $compromiso->institucionResposableImplementacion()->associate(Institucion::find(Input::get('institucion_responsable_implementacion')));
            $compromiso->departamento=Input::get('departamento');
            /*$compromiso->fuente()->associate(Fuente::find(Input::get('fuente')));*/
            /*$compromiso->usuario()->associate(Usuario::find(Input::get('usuario')));*/

            $compromiso->fuente()->associate(Fuente::find(1));
            $compromiso->usuario()->associate(Usuario::find(1));
            $compromiso->porcentaje_ejec=Input::get('porcentaje_ejec');


						$compromiso->resp_comunicaciones=Input::get('resp_comunicaciones');
						$compromiso->publicado=Input::get('publicado',0);

            /* ini: save asociados */
            $compromiso->asociados()->delete();
            $asociados=Input::get('asociados',array());
            foreach($asociados as $a){
                $new_asociado=new Asociado();
                $new_asociado->asociado = $a;
                $compromiso->asociados()->save($new_asociado);
            }
			/* fin: save asociados */

			/*UPLOAD FILES*/
				/* ini: Archivo medio_verificacion */
				if (Input::hasFile('medio_verificacion')){
				    $file = Input::file('medio_verificacion');
						$new_name = time()."_".$file->getClientOriginalName();
				    $file->move('uploads', $new_name);
						$compromiso->medio_verificacion = $new_name;
				}else{
					if(Input::get('delete_medio_verificacion')){
						$compromiso->medio_verificacion = '';
					}
				}
				/* end: Archivo medio_verificacion */

            if(!Auth::user()->super && $compromiso->usuario_id!=Auth::user()->id)
                App::abort(403, 'Unauthorized action.');

            $compromiso->save();

            $tag_arr=Input::get('tags')?explode(',',Input::get('tags')):array();
            $tag_ids=array();
            foreach($tag_arr as $t){
                $tag=Tag::firstOrNew(array('nombre'=>$t));
                $tag->save();
                $tag_ids[]=$tag->id;
            }
            $compromiso->tags()->sync($tag_ids);

            $compromiso->sectores()->sync(Input::get('sectores',array()));
            /*Guardar las comunas*/

            $compromiso->hitos()->delete();
            $hitos=Input::get('hitos',array());
			$count_hitos = 0;
			foreach($hitos as $h){
                $new_hito=new Hito();
                $new_hito->descripcion=$h['descripcion'];
                $new_hito->ponderador=$h['ponderador']/100;
                $new_hito->avance=$h['avance']/100;

				$h['fecha_inicio']	= "01-".$h['fecha_inicio'];
				$h['fecha_termino']	= "28-".$h['fecha_termino'];

                $new_hito->fecha_inicio=\Carbon\Carbon::parse($h['fecha_inicio']);
                $new_hito->fecha_termino=\Carbon\Carbon::parse($h['fecha_termino']);
                $new_hito->verificacion_descripcion=$h['verificacion_descripcion'];
                $new_hito->verificacion_url=$h['verificacion_url'];

				$new_hito->medio_verificacion = '';
				/*UPLOAD FILES*/
					/* ini: Archivo medio_verificacion */
					if( Input::hasFile('medio_verificacion_hito_'.$count_hitos) ){
					    $file = Input::file('medio_verificacion_hito_'.$count_hitos);
							$new_name = time()."_".$file->getClientOriginalName();
					    $file->move('uploads', $new_name);
							$new_hito->medio_verificacion = $new_name;
					}else{
						if(Input::get('delete_medio_verificacion_hito_'.$count_hitos)){
							$new_hito->medio_verificacion = '';
						}else{
							$new_hito->medio_verificacion = Input::get('medio_verificacion_hito_'.$count_hitos);
						}
					}
					/* end: Archivo medio_verificacion */

                $compromiso->hitos()->save($new_hito);
				$count_hitos++;
            }

            /*ingresar mesas*/
            $compromiso->mesas()->delete();
            $mesas=Input::get('mesas',array());
            $count_mesas = 0;
            foreach($mesas as $m){
                $new_mesa=new Mesa();
								if( isset($m['nombre']) ){
									$new_mesa->nombre=$m['nombre'];
								}else{
									$new_mesa->nombre=$m['descripcion'];
								}
                $new_mesa->tema='-';//$m['tema'];
                $new_mesa->tipo=$m['tipo'];
                $new_mesa->sesiones=$m['sesiones'];
                $new_mesa->verificacion=$m['verificacion'];
                $new_mesa->frecuencia='-';//$m['frecuencia'];

    			$new_mesa->medio_verificacion = '';
			    /*UPLOAD FILES*/
				/* ini: Archivo medio_verificacion */
				if( Input::hasFile('medio_verificacion_mesa_'.$count_mesas) ){
				    $file = Input::file('medio_verificacion_mesa_'.$count_mesas);
						$new_name = time()."_".$file->getClientOriginalName();
				    $file->move('uploads', $new_name);
						$new_mesa->medio_verificacion = $new_name;
				}else{
					if(Input::get('delete_medio_verificacion_mesa_'.$count_mesas)){
						$new_mesa->medio_verificacion = '';
					}else{
						$new_mesa->medio_verificacion = Input::get('medio_verificacion_mesa_'.$count_mesas);
					}
				}
				/* end: Archivo medio_verificacion */

                $compromiso->mesas()->save($new_mesa);
				$count_mesas++;
            }

			/*ingresar noticias*/
			$compromiso->noticias()->delete();
			$noticias=Input::get('noticias',array());
			$count_noticias = 0;
            foreach($noticias as $n){
                $new_noticia=new Noticia();
								$new_noticia->titulo=$n['titulo'];
								$new_noticia->descripcion=$n['descripcion'];
								$new_noticia->link=$n['link'];

								$new_noticia->medio_verificacion = '';
								/*UPLOAD FILES*/
									/* ini: Archivo medio_verificacion */
									if( Input::hasFile('medio_verificacion_noticia_'.$count_noticias) ){
									    $file = Input::file('medio_verificacion_noticia_'.$count_noticias);
											$new_name = time()."_".$file->getClientOriginalName();
									    $file->move('uploads', $new_name);
											$new_noticia->medio_verificacion = $new_name;
									}else{
										if(Input::get('delete_medio_verificacion_noticia_'.$count_noticias)){
											$new_noticia->medio_verificacion = '';
										}else{
											$new_noticia->medio_verificacion = Input::get('medio_verificacion_noticia_'.$count_noticias);
										}
									}
									/* end: Archivo medio_verificacion */

                $compromiso->noticias()->save($new_noticia);
								$count_noticias++;
            }

            $compromiso->actores()->delete();
            $actores=Input::get('actores',array());
            foreach($actores as $h){
                $new_actor=new Actor();
                $new_actor->nombre=$h['nombre'];
                $compromiso->actores()->save($new_actor);
            }

						/*GUARDAR CAMPOS ADMIN*/
						if( Auth::user()->super ){
							$compromiso->display_compromisos()->delete();
							$display = json_encode(Input::get('display'));
							$display_compromisos = new DisplayCompromiso();
							$display_compromisos->campos=$display;
							$compromiso->display_compromisos()->save($display_compromisos);
						}

            DB::connection()->getPdo()->commit();
            exec('killall searchd && cd '.base_path().'/sphinx && searchd && indexer --rotate --all');
            sleep(2); //Tiempo para que el indexador termine.

            $json->errors = array();
            $json->redirect = URL::to('backend/compromisos');

            Session::flash('messages', array('success' => 'El compromiso "'. $compromiso->nombre .'" ha sido '.$done_label.'.'));

            $response = Response::json($json, 200);
        } else {
            $json->errors = $validator->messages()->all();
            $response = Response::json($json, 400);
        }

        return $response;
    }

		public function getComunas(){
			$region_id = $_GET['region_id'];
			$json = Sector::with('hijos.hijos')->where('sector_padre_id', $region_id)->get();

			$response = Response::json($json);
			return $response;
		}

    public function getEliminar($compromiso_id){
        $compromiso = Compromiso::find($compromiso_id);

        if(!Auth::user()->super && $compromiso->usuario_id!=Auth::user()->id)
            App::abort(403, 'Unauthorized action.');

        $this->layout = View::make('backend/ajax_template');
        $this->layout->title = 'Eliminar Compromiso';
        $this->layout->content = View::make('backend/compromisos/delete', array('compromiso' => $compromiso));
    }

    public function deleteEliminar($compromiso_id){
        $compromiso=Compromiso::find($compromiso_id);

        if(!Auth::user()->super && $compromiso->usuario_id!=Auth::user()->id)
            App::abort(403, 'Unauthorized action.');

        $compromiso->delete();

        exec('cd '.base_path().'/sphinx; searchd; indexer --rotate --all');
        sleep(1); //Tiempo para que el indexador termine.

        return Redirect::to('backend/compromisos')->with('messages', array('success' => 'El compromiso ' . $compromiso->nombre . ' ha sido eliminada.'));
    }
}
