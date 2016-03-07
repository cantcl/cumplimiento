<?php
/**
 * Created by PhpStorm.
 * User: nsilva
 * Date: 13-05-14
 * Time: 11:23
 */

class Compromiso extends Eloquent{

    protected $fillable = array('nombre','url','descripcion','objetivo','publico','avance_descripcion','plazo','presupuesto','departamento');

    public function fuente(){
        return $this->belongsTo('Fuente');
    }

    public function usuario(){
        return $this->belongsTo('Usuario');
    }

    public function institucionResposablePlan(){
        return $this->belongsTo('Institucion','institucion_responsable_plan_id');
    }

    public function institucionResposableImplementacion(){
        return $this->belongsTo('Institucion','institucion_responsable_implementacion_id');
    }

    public function sectores(){
        return $this->belongsToMany('Sector');
    }

    public function tags(){
        return $this->belongsToMany('Tag');
    }

    public function asociados(){
        return $this->hasMany('Asociado');
    }

    public function display_compromisos(){
        return $this->hasMany('DisplayCompromiso');
    }

    public function hitos(){
        return $this->hasMany('Hito');
    }

    public function mesas(){
        return $this->hasMany('Mesa');
    }

    public function noticias(){
        return $this->hasMany('Noticia');
    }

    public function actores(){
        return $this->hasMany('Actor');
    }

    public function getOneCompromiso(){
      $c = Compromiso::where('id', $this->id)->get();
      $aCompromiso = $c->toArray();

      return $aCompromiso;
    }

    public function getMesasSimplificadas(){
      $mesas = $this->mesas;
      $mesas_simplificadas = array();
      $k = 0;
      foreach ($mesas as $key => $value) {
        $mesas_simplificadas[$k] = $value->toArray();

        $mesas_simplificadas[$k]['titulo'] = $mesas_simplificadas[$k]['nombre'];
        $mesas_simplificadas[$k]['participantes'] = $mesas_simplificadas[$k]['tipo'];
        $mesas_simplificadas[$k]['sesiones'] = $mesas_simplificadas[$k]['sesiones'];
        $mesas_simplificadas[$k]['periodicidad'] = $mesas_simplificadas[$k]['tema'];

        unset(
            $mesas_simplificadas[$k]['nombre'],
            $mesas_simplificadas[$k]['tema'],
            $mesas_simplificadas[$k]['tipo'],
            $mesas_simplificadas[$k]['verificacion'],
            $mesas_simplificadas[$k]['frecuencia'],
            $mesas_simplificadas[$k]['created_at'],
            $mesas_simplificadas[$k]['updated_at']
        );

        $k++;
      }

      return $mesas_simplificadas;
    }

    public function getHitosSimplificados(){
      $hitos = $this->hitos;
      $hitos_simplificados = array();
      $k = 0;
      foreach ($hitos as $key => $value) {
        $hitos_simplificados[$k] = $value->toArray();
        $hitos_simplificados[$k]['titulo'] = $hitos_simplificados[$k]['descripcion'];
        $fecha_inicio = '';
        $fecha_inicio = substr($hitos_simplificados[$k]['fecha_inicio'],5,2)."-".substr($hitos_simplificados[$k]['fecha_inicio'],0,4);
        $hitos_simplificados[$k]['inicio'] = $fecha_inicio;
        $fecha_termino = '';
        $fecha_termino = substr($hitos_simplificados[$k]['fecha_termino'],5,2)."-".substr($hitos_simplificados[$k]['fecha_termino'],0,4);
        $hitos_simplificados[$k]['termino'] = $fecha_termino;
        $hitos_simplificados[$k]['avance'] = $hitos_simplificados[$k]['avance'];
        $hitos_simplificados[$k]['verificacion'] = array();
          $hitos_simplificados[$k]['verificacion']['url'] = $hitos_simplificados[$k]['medio_verificacion'];
          $hitos_simplificados[$k]['verificacion']['mime'] = '';

        unset(
          $hitos_simplificados[$k]['descripcion'],
          $hitos_simplificados[$k]['fecha_inicio'],
          $hitos_simplificados[$k]['fecha_termino'],
          $hitos_simplificados[$k]['created_at'],
          $hitos_simplificados[$k]['updated_at'],
          $hitos_simplificados[$k]['verificacion_descripcion'],
          $hitos_simplificados[$k]['verificacion_url'],
          $hitos_simplificados[$k]['medio_verificacion']
        );
        $k++;
      }
      return $hitos_simplificados;
    }

    public function getHitosHome(){
      $hitos = $this->hitos;
      $hitos_home = array();
      $k = 0;
      foreach ($hitos as $key => $value) {
        $hitos_home[$k] = $value->toArray();
        unset(
          $hitos_home[$k]['fecha_inicio'],
          $hitos_home[$k]['fecha_termino'],
          $hitos_home[$k]['created_at'],
          $hitos_home[$k]['updated_at'],
          $hitos_home[$k]['verificacion_descripcion'],
          $hitos_home[$k]['verificacion_url'],
          $hitos_home[$k]['medio_verificacion']
        );
        $k++;
      }
      return $hitos_home;
    }

    public function getAvanceAttribute(){
        $avance=0;
        foreach($this->hitos as $h){
            $avance+=$h->ponderador*$h->avance;
        }
        return $avance;
    }

    /*Sumatoria de los avances de los hitos asociados a un compromiso*/
    public function getPorcentajeAvance(){
      $compromiso = Compromiso::where('id', $this->id)->get();
      $porcentaje_total = 0;
      foreach ($compromiso as $key => $value) {
        $porcentaje = number_format($value->avance*100,2,',','.');
        $porcentaje_total += $porcentaje;
      }
      return $porcentaje_total;
    }

    /*Cantidad de hitos asociados a un compromiso*/
    public function getHitosTotales(){
      return count( $this->hitos );
    }

    /*Cantidad de hitos con un 100% de avance*/
    public function getHitosCumplidos(){
      $hitos = Hito::where('compromiso_id', $this->id)->where('ponderador', '100')->get();
      return count($hitos);
    }

    public function getEstadoAvanceAttribute(){
        if($this->avance==0){
            return 'Sin comenzar';
        }else if($this->avance > 0 && $this->avance < 0.25){
            return 'Comenzando';
        }else if($this->avance >= 0.25 && $this->avance < 0.75){
            return 'En desarrollo';
        }else if($this->avance >= 0.75 && $this->avance < 1){
            return 'Finalizando';
        }else{
            return 'Completado';
        }
    }

    public static function dataForAvanceChart($ids){
        $compromisos=self::with('hitos')->whereIn('id', $ids)->get();


        $data=array();
        foreach($compromisos as $c){
            $data[$c->estado_avance]['label']=$c->estado_avance;
            $data[$c->estado_avance]['data']=5;
        }

        return array_values($data);
    }

}
