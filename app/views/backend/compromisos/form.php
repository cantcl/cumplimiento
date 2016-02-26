<ol class="breadcrumb">
    <li><a href="<?=URL::to('backend')?>">Inicio</a></li>
    <li><a href="<?=URL::to('backend/compromisos')?>">Compromisos</a></li>
    <li class="active"><?= $compromiso->id ? 'Editar' : 'Nuevo'; ?></li>
</ol>


<form name="ajaxFormName" class="ajaxForm" method="POST" accept-charset="UTF-8" enctype="multipart/form-data" action="<?= URL::to('backend/compromisos/guardar/' . $compromiso->id); ?>">
    <fieldset>
        <legend><?= $compromiso->id ? 'Editar' : 'Nuevo'; ?> Compromiso</legend>
        <div class="validacion"></div>
        <div class="form-group col-sm-3">
            <?php if(Auth::user()->perfiles_id == 1): ?><input type="checkbox" name="display[number]" checked /><?php endif; ?>
            <label for="number" class="control-label">Número</label>
            <input type="text" class="form-control" name="number" id="number" value="<?= $compromiso->number; ?>" placeholder="Numero del compromiso"/>
        </div>
        <div class="form-group col-sm-9">
            <?php if(Auth::user()->perfiles_id == 1): ?><input type="checkbox" name="display[nombre]" checked /><?php endif; ?>
            <label for="nombre" class="control-label">Nombre</label>
            <input type="text" class="form-control" name="nombre" id="nombre" value="<?= $compromiso->nombre; ?>" placeholder="Nombre del compromiso"/>
        </div>

        <div class="form-group col-sm-12">
          <?php if(Auth::user()->perfiles_id == 1): ?><input type="checkbox" name="display[iniciativa]" checked /><?php endif; ?>
            <label for="nombre" class="control-label">Iniciativa</label>
            <input type="text" class="form-control" name="iniciativa" id="iniciativa" value="<?= $compromiso->iniciativa; ?>" placeholder="Iniciativa"/>
        </div>
        <div class="form-group col-sm-12">
            <?php if(Auth::user()->perfiles_id == 1): ?><input type="checkbox" name="display[linea_accion]" checked /><?php endif; ?>
            <label for="nombre" class="control-label">Linea de acción</label>
            <input type="text" class="form-control" name="linea_accion" id="linea_accion" value="<?= $compromiso->linea_accion; ?>" placeholder="Linea de acción"/>
        </div>
        <div class="form-group col-sm-12">
            <?php if(Auth::user()->perfiles_id == 1): ?><input type="checkbox" name="display[eje_estrategico]" checked /><?php endif; ?>
            <label for="nombre" class="control-label">Eje estrategico de la agenda</label>
            <input type="text" class="form-control" name="eje_estrategico" id="eje_estrategico" value="<?= $compromiso->eje_estrategico; ?>" placeholder="Eje estrategico de la agenda"/>
        </div>
        <div class="form-group col-sm-12">
            <?php if(Auth::user()->perfiles_id == 1): ?><input type="checkbox" name="display[prioridad]" checked /><?php endif; ?>
            <label for="nombre" class="control-label">Prioridad</label>
            <input type="text" class="form-control" name="prioridad" id="prioridad" value="<?= $compromiso->prioridad; ?>" placeholder="Priodidad"/>
        </div>

        <!--<div class="form-group">
            <label for="url" class="control-label">URL</label>
            <input type="text" class="form-control" name="url" id="url" value="<?= $compromiso->url; ?>" placeholder="URL del proyecto o información relacionada"/>
        </div>-->
        <hr />

        <div class="form-group col-sm-12">
            <?php if(Auth::user()->perfiles_id == 1): ?><input type="checkbox" name="display[tags]" checked /><?php endif; ?>
            <label for="tags" class="control-label">Etiquetas</label>
            <input type="text" class="form-control form-control-select2-tags" name="tags" data-tags='<?=json_encode($tags)?>' value="<?=implode(',',$compromiso->tags->lists('nombre'))?>" />
        </div>

        <!--<div class="row form-horizontal">-->
            <!--<div class="col-sm-6">
                <div class="form-group form-group-fuente">
                    <label for="publico" class="col-sm-3 control-label">Privacidad</label>
                    <div class="col-sm-9">
                        <select class="form-control form-control-select2" name="publico" id="publico">
                            <option value="0">Privado</option>
                            <option value="1">Público</option>
                        </select>
                    </div>

                </div>
                <div class="form-group form-group-fuente">
                    <label for="fuente" class="col-sm-3 control-label">Fuente</label>
                    <div class="col-sm-9">
                        <select class="form-control form-control-select2" name="fuente" id="area" data-placeholder="Seleccionar fuente">
                            <option></option>
                            <?php foreach($fuentes as $f): ?>
                                <option value="<?= $f->id; ?>" <?=$f->id==$compromiso->fuente_id?'selected':''?>><?= $f->nombre; ?></option>
                                <?php foreach($f->hijos as $h):?>
                                    <option value="<?= $h->id; ?>" <?=$h->id==$compromiso->fuente_id?'selected':''?>> - <?= $h->nombre; ?></option>
                                    <?php foreach($h->hijos as $n):?>
                                        <option value="<?= $n->id; ?>" <?=$n->id==$compromiso->fuente_id?'selected':''?>> -- <?= $n->nombre; ?></option>
                                    <?php endforeach ?>
                                <?php endforeach ?>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="tags" class="col-sm-3 control-label">Etiquetas</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-select2-tags" name="tags" data-tags='<?=json_encode($tags)?>' value="<?=implode(',',$compromiso->tags->lists('nombre'))?>" />
                    </div>
                </div>

            </div>-->

            <hr>

            <div class="form-group col-sm-12">
                <?php if(Auth::user()->perfiles_id == 1): ?><input type="checkbox" name="display[sectores]" checked /><?php endif; ?>
                <label for="sector" class="control-label">Territorio al que afecta</label>
                <select class="form-control form-control-select2" name="sectores[]" id="sector" data-placeholder="Chile" multiple>
                    <option></option>
                    <?php foreach($sectores as $s): ?>
                      <?php if($s->tipo == 'region'): ?>
                        <option value="<?= $s->id; ?>" <?=$compromiso->sectores->find($s->id)?'selected':''?>><?= $s->nombre; ?></option>
                        <?php foreach($s->hijos as $h): ?>
                            <option value="<?= $h->id; ?>" <?=$compromiso->sectores->find($h->id)?'selected':''?>> - Provincia de <?= $h->nombre; ?></option>
                        <?php endforeach; ?>
                      <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group col-sm-6">
                <?php if(Auth::user()->perfiles_id == 1): ?><input type="checkbox" name="display[region]" checked /><?php endif; ?><label for="sector" class="control-label">Región</label>
                <select onchange="updateComunas(this.value)" class="form-control form-control-select2" name="region" id="region">
                    <option></option>
                    <?php foreach($sectores as $s): ?>
                      <?php if($s->tipo == 'region'): ?>
                        <option value="<?= $s->id; ?>" <?=$compromiso->sectores->find($s->id)?'selected':''?>><?= $s->nombre; ?></option>
                        <?php /*foreach($s->hijos as $h): ?>
                            <option value="<?= $h->id; ?>" <?=$compromiso->sectores->find($h->id)?'selected':''?>> - Provincia de <?= $h->nombre; ?></option>
                        <?php endforeach;*/ ?>
                      <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group col-sm-6">
                <?php if(Auth::user()->perfiles_id == 1): ?><input type="checkbox" name="display[comuna]" checked /><?php endif; ?>
                <label for="sector" class="control-label">Comuna</label>
                <select class="form-control form-control-select2" name="comunas[]" id="comuna" data-placeholder="Comunas" multiple>
                  <?php foreach($sectores as $s): ?>
                      <?php foreach($s->hijos as $h): ?>
                          <?php foreach($h->hijos as $hh): ?>
                              <option region="<?php echo $s->id; ?>" value="<?= $hh->id; ?>" <?=$compromiso->sectores->find($hh->id)?'selected':''?>><?= $hh->nombre; ?></option>
                          <?php endforeach; ?>
                      <?php endforeach; ?>
                  <?php endforeach; ?>
                </select>
            </div>

            <!--<div class="col-sm-6">-->

                <!--<div class="form-group">
                    <label for="usuario" class="col-sm-3 control-label">Usuario responsable</label>
                    <div class="col-sm-9">
                        <?php if(Auth::user()->super):?>
                        <select class="form-control form-control-select2" name="usuario" id="usuario" data-placeholder="Seleccionar usuario">
                            <option></option>
                            <?php foreach($usuarios as $usuario): ?>
                                <option value="<?= $usuario->id; ?>" <?=$usuario->id==$compromiso->usuario_id?'selected':''?>><?= $usuario->nombres; ?> <?=$usuario->apellidos?></option>
                            <?php endforeach; ?>
                        </select>
                        <?php else: ?>
                        <input type="text" class="form-control" readonly value="<?=Auth::user()->nombres.' '.Auth::user()->apellidos?>" />
                        <input type="hidden" name="usuario" value="<?=Auth::user()->id?>" />
                        <?php endif ?>
                    </div>
                </div>-->

            <!--</div>-->

        <!--</div>-->

        <hr />

        <!--<div class="row form-horizontal">-->
            <!--<div class="col-sm-6">-->
              <div class="form-group col-sm-6">
                  <?php if(Auth::user()->perfiles_id == 1): ?><input type="checkbox" name="display[institucion_responsable_plan]" checked /><?php endif; ?>
                  <label for="institucion_responsable_plan" class="control-label">Ministerio Responsable</label>
                  <!--<div class="col-sm-9">-->
                      <select class="form-control form-control-select2" name="institucion_responsable_plan" id="institucion_responsable_plan" data-placeholder="Seleccionar institución">
                          <option></option>
                          <?php foreach($instituciones as $i): ?>
                              <option value="<?= $i->id; ?>" <?=$i->id==$compromiso->institucion_responsable_plan_id?'selected':''?>><?= $i->nombre; ?></option>
                              <?php foreach($i->hijos as $h): ?>
                                  <option value="<?= $h->id; ?>" <?=$h->id==$compromiso->institucion_responsable_plan_id?'selected':''?>> - <?= $h->nombre; ?></option>
                              <?php endforeach; ?>
                          <?php endforeach; ?>
                      </select>
                  <!--</div>-->
              </div>
            <!--</div>
            <div class="col-sm-6">-->
              <div class="form-group col-sm-6">
                  <?php if(Auth::user()->perfiles_id == 1): ?><input type="checkbox" name="display[institucion_responsable_implementacion]" checked /><?php endif; ?>
                  <label for="institucion_responsable_implementacion" class="control-label">Institución Responsable</label>
                  <!--<div class="col-sm-9">-->
                      <select class="form-control form-control-select2" name="institucion_responsable_implementacion" id="institucion_responsable_implementacion" data-placeholder="Seleccionar institución">
                          <option></option>
                          <?php foreach($instituciones as $i): ?>
                              <option value="<?= $i->id; ?>" <?=$i->id==$compromiso->institucion_responsable_implementacion_id?'selected':''?>><?= $i->nombre; ?></option>
                              <?php foreach($i->hijos as $h): ?>
                                  <option value="<?= $h->id; ?>" <?=$h->id==$compromiso->institucion_responsable_implementacion_id?'selected':''?>> - <?= $h->nombre; ?></option>
                              <?php endforeach; ?>
                          <?php endforeach; ?>
                      </select>
                  <!--</div>-->
              </div>
            <!--</div>-->
        <!--</div>-->

        <!--<div class="row form-horizontal">-->
            <div class="col-sm-12">
                <div class="form-group">
                    <?php if(Auth::user()->perfiles_id == 1): ?><input type="checkbox" name="display[departamento]" checked /><?php endif; ?>
                    <label for="departamento" class="control-label">Coordinación con otros Actores</label>
                    <!--<div class="col-sm-12">-->
                        <input class="form-control" type="text" name="departamento" id="departamento" value="<?=$compromiso->departamento?>" placeholder="Unidad/División/Departamento responsable" />
                    <!--</div>-->
                </div>
            </div>
        <!--</div>-->

        <div class="row form-actores">
            <div class="col-sm-12">
            <div class="col-sm-12">
                <?php if(Auth::user()->perfiles_id == 1): ?><input type="checkbox" name="display[actores]" checked /><?php endif; ?>
                <label>Otros actores involucrados</label>

                <div><button class="btn btn-default form-actores-agregar" type="button"><span class="glyphicon glyphicon-plus"></span> Agregar nuevo actor</button></div>
                <table class="table form-actores-table">
                    <thead>
                    <tr>
                        <th>Nombre</th>
                        <th style="width: 0;"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=0; foreach($compromiso->actores as $a):?>
                        <tr>
                            <td><input class="form-control" type="text" value="<?=$a->nombre?>" name="actores[<?=$i?>][nombre]" placeholder="Nombre del actor involucrado"/></td>
                            <td>
                                <button class="btn btn-danger" type="text"><span class="glyphicon glyphicon-remove"></span></button>
                            </td>
                        </tr>
                        <?php $i++; endforeach; ?>
                    </tbody>
                </table>
            </div>
            </div>
        </div>

        <hr />


        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <?php if(Auth::user()->perfiles_id == 1): ?><input type="checkbox" name="display[descripcion]" checked /><?php endif; ?>
                    <label for="descripcion">Descripción de la Medida</label>
                    <textarea class="form-control tinymce" rows="6" placeholder="Descripción sobre lo que consiste el compromiso." id="descripcion" name="descripcion"><?=$compromiso->descripcion?></textarea>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <?php if(Auth::user()->perfiles_id == 1): ?><input type="checkbox" name="display[impacto]" checked /><?php endif; ?>
                    <label for="descripcion">Impactos de la Medida</label>
                    <textarea class="form-control tinymce" rows="6" placeholder="Impacos de la medida." id="impacto" name="impacto"><?=$compromiso->impacto?></textarea>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <?php if(Auth::user()->perfiles_id == 1): ?><input type="checkbox" name="display[objetivo]" checked /><?php endif; ?>
                    <label for="objetivo">Meta de la Medida</label>
                    <textarea class="form-control tinymce" rows="6" placeholder="Descripción sobre el objetivo general del compromiso." id="objetivo" name="objetivo"><?=$compromiso->objetivo?></textarea>
                </div>
            </div>
        </div>

        <hr />

        <div class="row">
            <div class="col-sm-4">
                <label>Porcentaje de Avance de la Medida</label>
                <input type="text" class="form-control" value="<?=number_format($compromiso->avance*100,2,',','.')?> %" readonly />
                <br>
                <label>Nivel de avance</label>
                <?php
                  if( $compromiso->avance == 0){
                    $nivel_avance = 'No Iniciada';
                  }else{
                    if( $compromiso->avance == 100 ){
                      $nivel_avance = "Cumplida";
                    }else{
                      $nivel_avance = "En proceso";
                    }
                  }
                ?>
                <input type="text" class="form-control" value="<?php echo $nivel_avance; ?>" readonly />
            </div>
            <div class="col-sm-8">
                <?php if(Auth::user()->perfiles_id == 1): ?><input type="checkbox" name="display[avance_descripcion]" checked /><?php endif; ?>
                <label>Observaciones del Estado de avance de la medida</label>
                <textarea class="form-control tinymce" rows="6" name="avance_descripcion"><?=$compromiso->avance_descripcion?></textarea>
            </div>
        </div>



        <hr />

        <div class="row">
            <div class="col-sm-6">
                <?php if(Auth::user()->perfiles_id == 1): ?><input type="checkbox" name="display[plazo]" checked /><?php endif; ?>
                <label for="plazo">Plazo comprometido de la medida</label>
                <input class="form-control" type="text" id="plazo" name="plazo" value="<?=$compromiso->plazo?>"/>
            </div>
            <div class="col-sm-6">
                <?php if(Auth::user()->perfiles_id == 1): ?><input type="checkbox" name="display[presupuesto]" checked /><?php endif; ?>
                <label for="presupuesto">Presupuesto ($CLP)</label>
                <input class="form-control" type="number" step="0.01" id="presupuesto" name="presupuesto" value="<?=$compromiso->presupuesto?>" placeholder="En CLP"/>
            </div>
            <div class="col-sm-6">
                <?php if(Auth::user()->perfiles_id == 1): ?><input type="checkbox" name="display[presupuesto_publico]" checked /><?php endif; ?>
                <label for="publico">Origen del Presupuesto</label>
                <br>
                <select class="form-control form-control-select2" name="presupuesto_publico" id="presupuesto_publico">
                  <option value="0">Privado</option>
                  <option value="1">Público</option>
                </select>
            </div>
            <div class="col-sm-6">
                <?php if(Auth::user()->perfiles_id == 1): ?><input type="checkbox" name="display[porcentaje_ejec]" checked /><?php endif; ?>
                <label for="publico">% de ejecución presupuestaria</label>
                <input class="form-control" type="text" id="porcentaje_ejec" name="porcentaje_ejec" value="<?=$compromiso->porcentaje_ejec?>"/>
            </div>

        </div>
        <hr />
        <div class="row">
            <div class="col-sm-12">
                <?php if(Auth::user()->perfiles_id == 1): ?><input type="checkbox" name="display[medio_verificacion]" checked /><?php endif; ?>
                <label for="">Medio de Verificación</label>
                <?php
                  $fichero = public_path()."/uploads/".$compromiso->medio_verificacion;
                  if (file_exists($fichero) && $compromiso->medio_verificacion != '') {
                    $descargar_url = "/uploads/".$compromiso->medio_verificacion;
                    echo "<a target='_blank' href='".$descargar_url."'>Descargar</a>";
                    ?>
                    <br>
                    <input type="checkbox" name="delete_medio_verificacion"> <span style="color:red; font-size: 0.9rem">Eliminar</span>
                    <?php
                  } else {
                    echo Form::file('medio_verificacion');
                  }
                ?>
            </div>
        </div>

        <hr />

        <div class="row form-hitos">
            <div class="col-sm-12">
                <?php if(Auth::user()->perfiles_id == 1): ?><input type="checkbox" name="display[hitos]" checked /><?php endif; ?>
                <label>Hitos</label>
                <div><button class="btn btn-default form-hitos-agregar" type="button"><span class="glyphicon glyphicon-plus"></span> Agregar nuevo hito</button></div>
                <table class="table form-hitos-table">
                    <thead>
                        <tr>
                            <th>Descripción</th>
                            <th>Ponderador</th>
                            <th>Avance</th>
                            <th>Fecha Inicio</th>
                            <th>Fecha Termino</th>
                            <th>Medio de Verificación</th>
                            <th>Medio de Verificación (URL)</th>
                            <th>Adjunto</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=0; foreach($compromiso->hitos as $h):?>
                        <tr>
                            <td><input class="form-control" type="text" value="<?=$h->descripcion?>" name="hitos[<?=$i?>][descripcion]" placeholder="Descripción del hito"/></td>
                            <td><input class="form-control" type="number" min="0" max="100" value="<?=$h->ponderador*100?>" name="hitos[<?=$i?>][ponderador]" placeholder="Ponderador del hito (Valor entre 0 y 100)"/></td>
                            <td>
                              <!--<input class="form-control" type="number" min="0" max="100" value="<?=$h->avance*100?>" name="hitos[<?=$i?>][avance]" placeholder="Porcentaje de avance (Valor entre 0 y 100)"/>-->
                              <select style="width: 110px !important" class="form-control" name="hitos[<?=$i?>][avance]" placeholder="Porcentaje de avance (Valor entre 0 y 100)"/>
                                <option <?php if( ($h->avance*100) >= 0 && ($h->avance*100) < 21 ){ echo "selected"; } ?> value="10">0 a 20%</option>
                                <option <?php if( ($h->avance*100) >= 21 && ($h->avance*100) < 41 ){ echo "selected"; } ?> value="30">21 a 40%</option>
                                <option <?php if( ($h->avance*100) >= 41 && ($h->avance*100) < 61 ){ echo "selected"; } ?> value="50">41 a 60%</option>
                                <option <?php if( ($h->avance*100) >= 61 && ($h->avance*100) < 81 ){ echo "selected"; } ?> value="70">61 a 80%</option>
                                <option <?php if( ($h->avance*100) >= 81 && ($h->avance*100) <= 100  ){ echo "selected"; } ?> value="90">81 a 100%</option>
                              </select>
                            </td>
                            <td><input data-provide="datepicker" data-date-format="mm-yyyy" data-date-autoclose="true" type="text" class="form-control" value="<?=$h->fecha_inicio->format('m-Y')?>" name="hitos[<?=$i?>][fecha_inicio]" placeholder="Fecha de inicio del hito" /></td>
                            <td><input data-provide="datepicker" data-date-format="mm-yyyy" data-date-autoclose="true" type="text" class="form-control" value="<?=$h->fecha_termino->format('m-Y')?>" name="hitos[<?=$i?>][fecha_termino]" placeholder="Fecha de término del hito" /></td>
                            <td>
                              <!--<input class="form-control" type="text" value="<?=$h->verificacion_descripcion?>" name="hitos[<?=$i?>][verificacion_descripcion]" placeholder="Medio de Verificación"/>-->
                              <select class="form-control" name="hitos[<?=$i?>][verificacion_descripcion]" placeholder="Medio de Verificación">
                                <option value="Ley" <?php if( $h->verificacion_descripcion == 'Ley'){ echo "selected"; } ?>>Ley</option>
                                <option value="Resolución" <?php if( $h->verificacion_descripcion == 'Resolución'){ echo "selected"; } ?>>Resolución</option>
                                <option value="Oficio" <?php if( $h->verificacion_descripcion == 'Oficio'){ echo "selected"; } ?>>Oficio</option>
                                <option value="Norma" <?php if( $h->verificacion_descripcion == 'Norma'){ echo "selected"; } ?>>Norma</option>
                                <option value="Memo" <?php if( $h->verificacion_descripcion == 'Memo'){ echo "selected"; } ?>>Memo</option>
                                <option value="Acta" <?php if( $h->verificacion_descripcion == 'Acta'){ echo "selected"; } ?>>Acta</option>
                                <option value="Documento de trabajo" <?php if( $h->verificacion_descripcion == 'Documento de trabajo'){ echo "selected"; } ?>>Documento de trabajo</option>
                                <option value="Informe" <?php if( $h->verificacion_descripcion == 'Informe'){ echo "selected"; } ?>>Informe</option>
                                <option value="Sitio web" <?php if( $h->verificacion_descripcion == 'Sitio web'){ echo "selected"; } ?>>Sitio web</option>
                                <option value="Otro" <?php if( $h->verificacion_descripcion == 'Otro'){ echo "selected"; } ?>>Otro</option>
                              </select>
                            </td>
                            <td><input class="form-control" type="text" value="<?=$h->verificacion_url?>" name="hitos[<?=$i?>][verificacion_url]" placeholder="URL al Medio de Verificación"/></td>
                            <td>
                              <?php
                                $fichero = public_path()."/uploads/".$h->medio_verificacion;
                                if (file_exists($fichero) && $h->medio_verificacion != '') {
                                  $descargar_url = "/uploads/".$h->medio_verificacion;
                                  echo "<a target='_blank' href='".$descargar_url."'>Descargar</a>";
                                  ?>
                                  <br>
                                  <input type="hidden" name="medio_verificacion_hito_<?=$i?>" value="<?=$h->medio_verificacion?>">
                                  <input type="checkbox" name="delete_medio_verificacion_hito_<?=$i?>"> <span style="color:red; font-size: 0.9rem">Eliminar</span>
                                  <?php
                                } else {
                                  ?>
                                  <input type="file" name="medio_verificacion_hito_<?=$i?>">
                                  <?php
                                }
                              ?>
                            </td>
                            <td>
                                <button class="btn btn-danger" type="text"><span class="glyphicon glyphicon-remove"></span></button>
                            </td>
                        </tr>
                        <?php $i++; endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <hr>

        <div class="row form-mesas">
            <div class="col-sm-12">
                <?php if(Auth::user()->perfiles_id == 1): ?><input type="checkbox" name="display[mesas]" checked /><?php endif; ?>
                <label>Mesas de Trabajo</label>
                <div><button class="btn btn-default form-mesas-agregar" type="button"><span class="glyphicon glyphicon-plus"></span> Agregar nueva Mesa de Trabajo</button></div>
                <table class="table form-mesas-table">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Tema</th>
                            <th>Tipo</th>
                            <th>Sesiones de Trabajo</th>
                            <th>Medio de Verificación</th>
                            <th>Adjunto</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=0; foreach($compromiso->mesas as $m):?>
                        <tr>
                            <td><input class="form-control" type="text" value="<?=$m->nombre?>" name="mesas[<?=$i?>][nombre]" placeholder="Nombre de la mesa"/></td>
                            <td><input class="form-control" type="text" value="<?=$m->tema?>" name="mesas[<?=$i?>][tema]" placeholder="Tema de la mesa"/></td>
                            <td>
                              <!--<input class="form-control" type="text" value="<?=$m->tipo?>" name="mesas[<?=$i?>][tipo]" placeholder="Tipo de la mesa"/>-->
                              <select class="form-control" placeholder="Tipo de la mesa" name="mesas[<?=$i?>][tipo]" >
                                <option value="Público - privada" <?php if($m->tipo == 'Público - privada'){ echo "selected"; } ?>>Público - privada</option>
                                <option value="Publica" <?php if($m->tipo == 'Publica'){ echo "selected"; } ?>>Publica</option>
                                <option value="Privada" <?php if($m->tipo == 'Privada'){ echo "selected"; } ?>>Privada</option>
                                <option value="Sociedad civil" <?php if($m->tipo == 'Sociedad civil'){ echo "selected"; } ?>>Sociedad civil</option>
                                <option value="Sectorial" <?php if($m->tipo == 'Sectorial'){ echo "selected"; } ?>>Sectorial</option>
                              </select>
                            </td>
                            <td><input class="form-control" type="text" value="<?=$m->sesiones?>" name="mesas[<?=$i?>][sesiones]" placeholder="Sesiones de Trabajo"/></td>
                            <td><input class="form-control" type="text" value="<?=$m->verificacion?>" name="mesas[<?=$i?>][verificacion]" placeholder="Medio de Verificación"/></td>
                            <td>
                              <?php
                                $fichero = public_path()."/uploads/".$m->medio_verificacion;
                                if (file_exists($fichero) && $m->medio_verificacion != '') {
                                  $descargar_url = "/uploads/".$m->medio_verificacion;
                                  echo "<a target='_blank' href='".$descargar_url."'>Descargar</a>";
                                  ?>
                                  <br>
                                  <input type="hidden" name="medio_verificacion_mesa_<?=$i?>" value="<?=$m->medio_verificacion?>">
                                  <input type="checkbox" name="delete_medio_verificacion_mesa_<?=$i?>"> <span style="color:red; font-size: 0.9rem">Eliminar</span>
                                  <?php
                                } else {
                                  ?>
                                  <input type="file" name="medio_verificacion_mesa_<?=$i?>">
                                  <?php
                                }
                              ?>
                            </td>
                            <td>
                                <button class="btn btn-danger" type="text"><span class="glyphicon glyphicon-remove"></span></button>
                            </td>
                        </tr>
                        <?php $i++; endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <hr>

        <div class="row form-noticias">
            <div class="col-sm-12">
                <?php if(Auth::user()->perfiles_id == 1): ?><input type="checkbox" name="display[noticias]" checked /><?php endif; ?>
                <label>Noticias de la Medida</label>
                <div><button class="btn btn-default form-noticias-agregar" type="button"><span class="glyphicon glyphicon-plus"></span> Agregar nueva Noticia</button></div>
                <table class="table form-noticias-table">
                    <!--<thead>
                        <tr>
                            <th>Titulo</th>
                            <th>Descripción</th>
                            <th>Link institucional</th>
                            <th></th>
                        </tr>
                    </thead>-->
                    <tbody>
                        <?php $i=0; foreach($compromiso->noticias as $n):?>
                        <tr>
                          <td>
                            <table style="width: 100%">
                              <tr><td><b>Titulo</b></td></tr>
                              <tr><td><input class="form-control" type="text" value="<?=$n->titulo?>" name="noticias[<?=$i?>][titulo]" placeholder="Titulo"/></td></tr>
                              <tr><td>Descripción</td></tr>
                              <tr><td><textarea class="form-control tinymce" rows="6" placeholder="Descripción" name="noticias[<?=$i?>][descripcion]"><?=$n->descripcion?></textarea></td></tr>
                              <tr><td>Link Institucional</td></tr>
                              <tr><td><input class="form-control" type="text" value="<?=$n->link?>" name="noticias[<?=$i?>][link]" placeholder="Link Institucional"/></td></tr>
                              <tr><td>Imagen</td></tr>
                              <tr>
                                <td>
                                  <?php
                                    $fichero = public_path()."/uploads/".$n->medio_verificacion;
                                    if (file_exists($fichero) && $n->medio_verificacion != '') {
                                      $descargar_url = "/uploads/".$n->medio_verificacion;
                                      echo "<a target='_blank' href='".$descargar_url."'>Descargar</a>";
                                      ?>
                                      <br>
                                      <input type="hidden" name="medio_verificacion_noticia_<?=$i?>" value="<?=$n->medio_verificacion?>">
                                      <input type="checkbox" name="delete_medio_verificacion_noticia_<?=$i?>"> <span style="color:red; font-size: 0.9rem">Eliminar</span>
                                      <?php
                                    } else {
                                      ?>
                                      <input type="file" name="medio_verificacion_noticia_<?=$i?>">
                                      <?php
                                    }
                                  ?>
                                </td>
                              </tr>
                            </table>
                          </td>
                          <td style="text-align: right"><button class="btn btn-danger" type="text"><span class="glyphicon glyphicon-remove"></span></button></td>
                        </tr>
                        <?php $i++; endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <hr />

        <div class="form-group col-sm-12">
            <?php if(Auth::user()->perfiles_id == 1): ?><input type="checkbox" name="display[proveedores]" checked /><?php endif; ?>
            <label for="proveedores" class="control-label">Proveedores y/o Consultores Asociados.</label>
            <textarea class="form-control tinymce" rows="6" placeholder="Proveedores y/o Consultores Asociados" id="proveedores" name="proveedores"><?=$compromiso->proveedores?></textarea>
        </div>

        <hr />

        <div class="form-group col-sm-12">
            <?php if(Auth::user()->perfiles_id == 1): ?><input type="checkbox" name="display[contacto]" checked /><?php endif; ?>
            <label for="contacto" class="control-label">Jefe de Proyecto y Contacto.</label>
            <textarea class="form-control tinymce" rows="6" placeholder="Jefe de Proyecto y Contacto." id="contacto" name="contacto"><?=$compromiso->contacto?></textarea>
        </div>

        <hr />

        <div class="form-group col-sm-12">
          <?php if(Auth::user()->perfiles_id == 1): ?><input type="checkbox" name="display[asociados]" checked /><?php endif; ?>
          <label for="asociados" class="control-label">Medidas Asociadas.</label>
          <?php
            $aAsociados = array();
            foreach($compromiso->asociados as $asoc){
              array_push($aAsociados, $asoc['asociado']);
            }
          ?>
          <select class="form-control form-control-select2" name="asociados[]" id="asociados" multiple>
            <?php foreach(Compromiso::all() as $comp): ?>
              <?php if($compromiso->id != $comp->id): ?>
                <option value="<?= $comp->id; ?>" <?php if( in_array($comp->id, $aAsociados) ){ echo "selected"; } ?> ><?= $comp->number; ?> - <?= $comp->nombre; ?></option>
              <?php endif; ?>
            <?php endforeach; ?>
          </select>
        </div>


    </fieldset>
    <hr/>
    <div class="text-right">
        <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Guardar</button>
        <a href="javascript:history.back();" class="btn btn-warning"><span class="glyphicon glyphicon-ban-circle"></span> Cancelar</a>
    </div>
</form>
