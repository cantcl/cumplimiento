<?php

class DisplayCompromisoSeeder extends Seeder {
    public function run(){
        
        DB::table('display_compromisos')->delete();

        $campos = '{
                    "numero": "on",
                    "nombre": "on",
                    "linea_accion": "on",
                    "fuente": "on",
                    "prioridad": "on",
                    "tags": "on",
                    "sectores": "on",
                    "institucion_responsable_plan": "on",
                    "institucion_responsable_implementacion": "on",
                    "autoridad_responsable": "on",
                    "departamento": "on",
                    "actores": "on",
                    "descripcion": "on",
                    "impacto": "on",
                    "objetivo": "on",
                    "avance_descripcion": "on",
                    "plazo": "on",
                    "presupuesto": "on",
                    "porcentaje_ejec": "on",
                    "medio_verificacion": "on",
                    "hitos": "on",
                    "mesas": "on",
                    "noticias": "on",
                    "proveedores": "on",
                    "contacto": "on",
                    "resp_comunicaciones": "on",
                    "asociados": "on"
                }';
        
        $date = new DateTime();
        $date = $date->format('Y-m-d H:i:s');

        for($i=1; $i<=60; $i++) {
            DB::table('display_compromisos')->insert(
                array(
                    'campos' => $campos,
                    'compromiso_id' => $i,
                    'created_at' => $date,
                    'updated_at' => $date
                )
            );
        }
    }
} 