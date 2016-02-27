<aside>
    <form action="<?= URL::to('backend/compromisos'); ?>" method="get">
        <div class="panel panel-default">
            <div class="panel-heading">
                <button type="submit" class="btn btn-xs btn-primary pull-right"><i class="glyphicon glyphicon-search"></i> Filtrar</button>
                <span>Busqueda</span>
            </div>
            <div class="panel-body">
                <input type="text" class="form-control" name="q" id="q-filtros" value="<?= isset($q)?strip_tags($q):''; ?>"/>
            </div>

            <div class="panel-heading">Ejes estratégicos</div>
            <div class="panel-body panel-filtro-anidado">
                <div class="checkbox">
                    <ul>
                    <?php foreach($fuentes as $fuente): ?>
                        <li <?= in_array($fuente->id, $filtros['fuente']) ? 'class="active"' : ''; ?>>
                            <label>
                                <input name="fuentes[]" <?= in_array($fuente->id, $input['fuentes']) ? 'checked' : ''; ?> value="<?= $fuente->id; ?>" type="checkbox"/>
                                <?= $fuente->nombre; ?>
                                <?php if(isset($filtros_count['fuente'][$fuente->id])): ?>
                                    <span class="badge"><?= array_get($filtros_count['fuente'],$fuente->id); ?></span>
                                <?php endif ?>
                            </label>
                            <ul>
                            <?php foreach($fuente->hijos as $h): ?>
                                <li <?= in_array($h->id, $filtros['fuente']) ? 'class="active"' : ''; ?>>
                                    <label>
                                        <input name="fuentes[]" <?= in_array($h->id, $input['fuentes']) ? 'checked' : ''; ?> value="<?= $h->id; ?>" type="checkbox"/>
                                        <?= $h->nombre; ?>
                                        <?php if(isset($filtros_count['fuente'][$h->id])): ?>
                                            <span class="badge"><?= array_get($filtros_count['fuente'],$h->id); ?></span>
                                        <?php endif ?>
                                    </label>
                                    <ul>
                                        <?php foreach($h->hijos as $n): ?>
                                            <li <?= in_array($n->id, $filtros['fuente']) ? 'class="active"' : ''; ?>>
                                                <label>
                                                    <input name="fuentes[]" <?= in_array($n->id, $input['fuentes']) ? 'checked' : ''; ?> value="<?= $n->id; ?>" type="checkbox"/>
                                                    <?= $n->nombre; ?>
                                                    <?php if(isset($filtros_count['fuente'][$n->id])): ?>
                                                        <span class="badge"><?= array_get($filtros_count['fuente'],$n->id); ?></span>
                                                    <?php endif ?>
                                                </label>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                        </li>
                    <?php endforeach; ?>
                    </ul>
                </div>
            </div>

            <?php if(!empty($filtros['tag'])):?>
            <div class="panel-heading ">Tags</div>
            <div class="panel-body panel-filtro-anidado ">
                <div class="checkbox">
                    <ul>
                        <?php foreach($tags as $usuario): ?>
                            <li <?= in_array($usuario->id, $filtros['tag']) ? 'class="active"' : ''; ?>>
                                <label>
                                    <input name="tags[]" <?= in_array($usuario->id, $input['tags']) ? 'checked' : ''; ?> value="<?= $usuario->id; ?>" type="checkbox"/>
                                    <?= $usuario->nombre; ?>
                                    <?php if(isset($filtros_count['tag'][$usuario->id])): ?>
                                        <span class="badge"><?= array_get($filtros_count['tag'],$usuario->id); ?></span>
                                    <?php endif ?>
                                </label>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <?php endif ?>

            <?php if(!empty($filtros['linea_accion'])):?>
            <div class="panel-heading ">Líneas de acción</div>
            <div class="panel-body panel-filtro-anidado ">
                <div class="checkbox">
                    <ul>
                        <?php foreach($tags as $usuario): ?>
                            <li <?= in_array($usuario->id, $filtros['linea_accion']) ? 'class="active"' : ''; ?>>
                                <label>
                                    <input name="lineas_accion" <?= $input['lineas_accion'] ? 'checked' : ''; ?> value="<?= $usuario->id; ?>" type="checkbox"/>
                                    <?= $usuario->nombre; ?>
                                    <?php if(isset($filtros_count['linea_accion'][$usuario->id])): ?>
                                        <span class="badge"><?= array_get($filtros_count['linea_accion'],$usuario->id); ?></span>
                                    <?php endif ?>
                                </label>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <?php endif ?>
           
            <div class="panel-heading">Institución responsable</div>
            <div class="panel-body panel-filtro-anidado">
                <div class="checkbox">
                    <ul>
                        <?php foreach($instituciones as $usuario): ?>
                            <li <?= in_array($usuario->id, $filtros['institucion']) ? 'class="active"' : ''; ?>>
                                <label>
                                    <input name="instituciones[]" <?= in_array($usuario->id, $input['instituciones']) ? 'checked' : ''; ?> value="<?= $usuario->id; ?>" type="checkbox"/>
                                    <?= $usuario->nombre; ?>
                                    <?php if(isset($filtros_count['institucion'][$usuario->id])): ?>
                                        <span class="badge"><?= array_get($filtros_count['institucion'],$usuario->id); ?></span>
                                    <?php endif ?>
                                </label>
                                <ul>
                                <?php foreach($usuario->hijos as $sectorHijo): ?>
                                    <li <?= in_array($sectorHijo->id, $filtros['institucion']) ? 'class="active"' : ''; ?>>
                                        <label>
                                            <input name="instituciones[]" <?= in_array($sectorHijo->id, $input['instituciones']) ? 'checked' : ''; ?> value="<?= $sectorHijo->id; ?>" type="checkbox"/>
                                            <?= $sectorHijo->nombre; ?>
                                            <?php if(isset($filtros_count['institucion'][$sectorHijo->id])): ?>
                                                <span class="badge"><?= array_get($filtros_count['institucion'],$sectorHijo->id); ?></span>
                                            <?php endif ?>
                                        </label>
                                    </li>
                                <?php endforeach; ?>
                                </ul>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>


        </div>
    </form>
</aside>