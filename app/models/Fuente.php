<?php

class Fuente extends Eloquent{

    protected $fillable=array('nombre','tipo');

    public function compromisos(){
        return $this->hasMany('Compromiso');
    }

    public function padre(){
        return $this->belongsTo('Fuente', 'fuente_padre_id', 'id');
    }

    public function hijos(){
        return $this->hasMany('Fuente', 'fuente_padre_id', 'id');
    }

    public function esHijoDe(Fuente $fuente){
        return $this->fuente_padre_id == $fuente->id;
    }

    public function tienePadre(){
        return count($this->padre) > 0;
    }

    public function tieneHijos(){
        return count($this->hijos) > 0;
    }

    public function compromisos_con_hitos(){
      $compromisos = Compromiso::where('fuente_id', $this->id)->where('publicado', 1)->get();
      $hitos = array();
      $k=0;
      foreach ($compromisos as $key => $value) {
        $aCompromiso = Compromiso::where('id', $value->id)->get()->toArray();
        $hitos[$k]['compromiso'] = $aCompromiso[0];

        $hitos[$k]['compromiso']['hitos_cumplidos'] = $value->getHitosCumplidos();
        $hitos[$k]['compromiso']['hitos_totales'] = $value->getHitosTotales();
        $hitos[$k]['compromiso']['porcentaje_avance'] = $value->getPorcentajeAvance();

        $hitos[$k]['compromiso']['hitos'] = $value->getHitosHome();

        /*quitar campos de compromiso*/
        unset(
          $hitos[$k]['compromiso']['url'],
          $hitos[$k]['compromiso']['descripcion'],
          $hitos[$k]['compromiso']['objetivo'],
          $hitos[$k]['compromiso']['publico'],
          $hitos[$k]['compromiso']['avance_descripcion'],
          $hitos[$k]['compromiso']['plazo'],
          $hitos[$k]['compromiso']['presupuesto'],
          $hitos[$k]['compromiso']['autoridad_responsable'],
          $hitos[$k]['compromiso']['institucion_responsable_plan_id'],
          $hitos[$k]['compromiso']['institucion_responsable_implementacion_id'],
          $hitos[$k]['compromiso']['usuario_id'],
          $hitos[$k]['compromiso']['fuente_id'],
          $hitos[$k]['compromiso']['created_at'],
          $hitos[$k]['compromiso']['updated_at'],
          $hitos[$k]['compromiso']['departamento'],
          $hitos[$k]['compromiso']['number'],
          $hitos[$k]['compromiso']['iniciativa'],
          $hitos[$k]['compromiso']['linea_accion'],
          $hitos[$k]['compromiso']['eje_estrategico'],
          $hitos[$k]['compromiso']['prioridad'],
          $hitos[$k]['compromiso']['presupuesto_publico'],
          $hitos[$k]['compromiso']['impacto'],
          $hitos[$k]['compromiso']['medio_verificacion'],
          $hitos[$k]['compromiso']['proveedores'],
          $hitos[$k]['compromiso']['contacto'],
          $hitos[$k]['compromiso']['publicado'],
          $hitos[$k]['compromiso']['resp_comunicaciones']
        );

        $k++;
      }

      return $hitos;
    }

    /*Cantidad de medidas*/
    public function cantidadMedidas(){
        return count( Compromiso::where('fuente_id', $this->id)->get() );
    }
    /*Cantidad de medidas de desarrollo < 100 or >0*/
    public function cantidadMedidasDesarrollo(){
      $compromisos = Compromiso::where('fuente_id', $this->id)->get();
      $cantidad = 0;
      foreach ($compromisos as $key => $value) {
        $porcentaje = number_format($value->avance*100,2,',','.');
        if( $porcentaje > 0 && $porcentaje < 100){
          $cantidad++;
        }
      }
      return $cantidad;
    }
    /*Cantidad de medidas nuevas = 0%*/
    public function cantidadMedidasNuevas(){
      $compromisos = Compromiso::where('fuente_id', $this->id)->get();
      $cantidad = 0;
      foreach ($compromisos as $key => $value) {
        $porcentaje = number_format($value->avance*100,2,',','.');
        if( $porcentaje < 1){
          $cantidad++;
        }
      }
      return $cantidad;
    }
    /*Porcentaje Total*/
    public function porcentajeTotal(){
      $compromisos = Compromiso::where('fuente_id', $this->id)->get();
      $porcentaje_total = 0;
      foreach ($compromisos as $key => $value) {
        $porcentaje = number_format($value->avance*100,2,',','.');
        $porcentaje_total += $porcentaje;
      }
      return $porcentaje_total;
    }

}
