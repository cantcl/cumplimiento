/**
 * Created by nsilva on 13-05-14.
 */

$(document).ready(function(){

    initPlugins();

    initAjaxForm();

    initFormUsuario();

    initFormCompromisosHitos();
    initFormCompromisosMesas();
    initFormCompromisosNoticias();

    initFormCompromisosActores();

    initFiltrosBusqueda();

    modalEvents();

    initCharts();

    initMoment();


});

function modalEvents() {
    /* Vuelve el modal a su estado original cada vez que se cierra */
    $(document).on('hidden.bs.modal', '#modal-backend', function(e){
        var modal = $(this);
        modal.removeData('bs.modal');
        tinymce.remove('#modal-backend .tinymce');
    });
    $(document).on('shown.bs.modal', '#modal-backend', function(){
        initPlugins($('#modal-backend'));
    });
}

function initPlugins(c) {
    var container = c || $(document);

    container.find(".form-control-select2").each(function(i,el){
        $(el).select2();
    });

    container.find(".form-control-select2-tags").each(function(i,el){
        var tags=$(el).data("tags");
        $(el).select2({
            tags: tags
        });
    });



    var maskedInput = container.find('[data-mask]');
    if(maskedInput.length){
        maskedInput.each(function(i, e){
            var elem = $(this);
            elem.mask(elem.data('mask'));
        });
    }

    var tinymceSelector = (c ? c.selector + " " : "") + ".tinymce";
    if($(tinymceSelector).length){
    tinymce.init({
        selector: tinymceSelector,
        menubar:false,
        statusbar: false,
        plugins: [
            "link,image"
        ],
        toolbar: "undo redo | bold italic | link image | bullist numlist"
    });
    }
}

function initAjaxForm(){
    $('#rut').Rut();
    $(".ajaxForm :submit").attr("disabled",false);
    $(document).on("submit",".ajaxForm",function(){
        var form=this;
        if(!form.submitting){
            form.submitting=true;
            $(form).find(":submit").attr("disabled",true);
            //$(form).append("<div class='ajaxLoader'>Cargando</div>");
            //var ajaxLoader=$(form).find(".ajaxLoader");
            //$(ajaxLoader).css({
            //    left: ($(form).width()/2 - $(ajaxLoader).width()/2)+"px",
            //    top: ($(form).height()/2 - $(ajaxLoader).height()/2)+"px"
            //});
            var formu = document.forms.namedItem("userForm"); // high importance!, here you need change "yourformname" with the name of your form
            var formdata = new FormData(formu); // high importance!

            $.ajax({
                url: form.action,
                /*data: $(form).serialize(),*/
                type: form.method,
                data: formdata, // high importance!
                contentType: false, // high importance!
                async: true,
                processData: false, // high importance!
                dataType: "json",
                success: function(response){
                    if(response.redirect){
                        window.location=response.redirect;
                    }else{
                        var f=window[$(form).data("onsuccess")];
                        $(form).data('response-data', response);
                        f(form);
                    }

                },
                error: function(response){
                    form.submitting=false;
                    //$(ajaxLoader).remove();
                    $(form).find(":submit").attr("disabled",false);

                    var html="";
                    for(var i in response.responseJSON.errors)
                        html+="<div class='alert alert-danger'>"+response.responseJSON.errors[i]+"</div>";

                    $(form).find(".validacion").html(html);
                    if(!$(form).parents('.modal').length){
                        $('html, body').animate({
                            scrollTop: $(".validacion").offset().top-10
                        });
                    }
                }
            });
        }
        return false;
    });
}

function initFormUsuario(){
    var formUsuario = $('.form-usuario');
    if(formUsuario.length){
        formUsuario.find('.btn-cambiar-password').on('click', function (e){
            var btn = $(this),
                disabled = btn.data('disabled'),
                contPassword = $('.cont-password'),
                contCambiarPassword = $('.cont-cambiar-password');

            disabled = !disabled;

            contCambiarPassword.css('display', disabled ? 'none' : 'block');
            contCambiarPassword.find('#password').attr('disabled', disabled);
            contCambiarPassword.find('#password_confirmation').attr('disabled', disabled);
            contPassword.css('display', disabled ? 'block' : 'none');
        });
    }
}

function initFormCompromisosHitos(){
    $('.form-hitos').each(function(i,el){
        $(el).find('.form-hitos-table tbody tr').length?$(el).find('.form-hitos-table').show():$(el).find('.form-hitos-table').hide();
        var maxid=$(el).find('.form-hitos-table tbody tr').length;
        $(el).find('.form-hitos-agregar').on('click',function(){
            var row='<tr>' +
                '<td><input class="form-control" type="text" name="hitos['+maxid+'][descripcion]" value="" placeholder="Descripción del hito"/></td>' +
                '<td><input class="form-control" type="number" min="0" max="100" name="hitos['+maxid+'][ponderador]" value="" placeholder="Ponderador del hito (Valor entre 0 y 100)"/></td>' +
                /*'<td><input class="form-control" type="number" min="0" max="100" name="hitos['+maxid+'][avance]" value="" placeholder="Porcentaje de avance del hito (Valor entre 0 y 100)"/></td>' +*/
                '<td><select style="width: 110px !important" class="form-control" name="hitos['+maxid+'][avance]" placeholder="Porcentaje de avance (Valor entre 0 y 100)"><option value="10">0 a 20%</option><option value="30">21 a 40%</option><option value="50">41 a 60%</option><option value="70">61 a 80%</option><option value="90">81 a 100%</option></select></td>'+
                '<td><input data-provide="datepicker" data-date-format="mm-yyyy" data-date-autoclose="true" class="form-control" type="text" name="hitos['+maxid+'][fecha_inicio]" value="" placeholder="Fecha de inicio del hito"/></td>' +
                '<td><input data-provide="datepicker" data-date-format="mm-yyyy" data-date-autoclose="true" class="form-control" type="text" name="hitos['+maxid+'][fecha_termino]" value="" placeholder="Fecha de término del hito"/></td>' +
                '<td><select class="form-control" name="hitos['+maxid+'][verificacion_descripcion]" placeholder="Medio de Verificación"><option value="Ley">Ley</option><option value="Resolución">Resolución</option><option value="Oficio">Oficio</option><option value="Norma">Norma</option><option value="Memo">Memo</option><option value="Acta">Acta</option><option value="Documento de trabajo">Documento de trabajo</option><option value="Informe">Informe</option><option value="Sitio web">Sitio web</option><option value="Otro">Otro</option></select></td>' +
                '<td><input class="form-control" type="text" name="hitos['+maxid+'][verificacion_url]" value="" placeholder="URL al Medio de Verificación"/></td>' +
                '<td><input type="file" name="medio_verificacion_hito_'+maxid+'"><td>' +
                '<button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>' +
                '</td>' +
                '</tr>';
            $(el).find('.form-hitos-table').append(row);
            ++maxid;
            $(el).find('.form-hitos-table tbody tr').length?$(el).find('.form-hitos-table').show():$(el).find('.form-hitos-table').hide();
        });
        $(el).find('.form-hitos-table').on('click','button',function(){
            $(this).closest('tr').remove();
            $(el).find('.form-hitos-table tbody tr').length?$(el).find('.form-hitos-table').show():$(el).find('.form-hitos-table').hide();
        });
    });

}

function initFormCompromisosMesas(){
    $('.form-mesas').each(function(i,el){
        $(el).find('.form-mesas-table tbody tr').length?$(el).find('.form-mesas-table').show():$(el).find('.form-mesas-table').hide();
        var maxid=$(el).find('.form-mesas-table tbody tr').length;
        $(el).find('.form-mesas-agregar').on('click',function(){
            var row='<tr>' +
                '<td><input class="form-control" type="text" name="mesas['+maxid+'][descripcion]" value="" placeholder="Nombre de la mesa"/></td>' +
                '<td><input class="form-control" type="text" name="mesas['+maxid+'][tema]" value="" placeholder="Frecuencia de sesiones"/></td>' +
                '<td><select class="form-control" placeholder="Tipo de la mesa" name="mesas['+maxid+'][tipo]" ><option value="Público - privada">Público - privada</option><option value="Publica">Publica</option><option value="Privada">Privada</option><option value="Sociedad civil">Sociedad civil</option><option value="Sectorial">Sectorial</option></select></td>' +
                '<td><input class="form-control" type="text" name="mesas['+maxid+'][sesiones]" value="" placeholder="Sesiones de Trabajo"/></td>' +
                '<td><input class="form-control" type="text" name="mesas['+maxid+'][verificacion]" value="" placeholder="Medio de Verificación"/></td>' +
                '<td><input type="file" name="medio_verificacion_mesa_'+maxid+'"><td>' +
                '<td><button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button></td>' +
                '</tr>';
            $(el).find('.form-mesas-table').append(row);
            ++maxid;
            $(el).find('.form-mesas-table tbody tr').length?$(el).find('.form-mesas-table').show():$(el).find('.form-mesas-table').hide();
        });
        $(el).find('.form-mesas-table').on('click','button',function(){
            $(this).closest('tr').remove();
            $(el).find('.form-mesas-table tbody tr').length?$(el).find('.form-mesas-table').show():$(el).find('.form-mesas-table').hide();
        });
    });
}

function initFormCompromisosNoticias(){
    $('.form-noticias').each(function(i,el){
        $(el).find('.form-noticias-table tbody tr').length?$(el).find('.form-noticias-table').show():$(el).find('.form-noticias-table').hide();
        var maxid=$(el).find('.form-noticias-table tbody tr').length;
        $(el).find('.form-noticias-agregar').on('click',function(){
            var row='<tr>'+
                      '<td>'+
                        '<table style="width: 100%">'+
                          '<tr>'+
                            '<td>Titulo</td>'+
                          '</tr><tr>'+
                            '<td><input class="form-control" type="text" name="noticias['+maxid+'][titulo]" value="" placeholder="Titulo"/></td>' +
                          '</tr><tr>'+
                            '<td>Descripción</td>'+
                          '</tr><tr>'+
                            '<td>'+
                            '<textarea class="form-control tinymce" rows="6" placeholder="Descripción" name="noticias['+maxid+'][descripcion]"></textarea>'+
                            '</td>'+
                          '</tr><tr>'+
                            '<td>Link Institucional</td>'+
                          '</tr><tr>'+
                            '<td><input class="form-control" type="text" name="noticias['+maxid+'][link]" value="" placeholder="Link Institucional"/></td>' +
                          '</tr><tr>'+
                            '<td>Imagen</td>'+
                          '</tr><tr>'+
                            '<td><input type="file" name="medio_verificacion_noticia_'+maxid+'"><td>' +
                          '</tr>'+
                        '</table>'+
                      '</td>'+
                      '<td style="width: 60px; text-align: right"><button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button></td>' +
                    '</tr>';
            $(el).find('.form-noticias-table').append(row);
            ++maxid;
            $(el).find('.form-noticias-table tbody tr').length?$(el).find('.form-noticias-table').show():$(el).find('.form-noticias-table').hide();
        });
        $(el).find('.form-noticias-table').on('click','button',function(){
            $(this).closest('tr').remove();
            $(this).closest('tr').remove();
            $(this).closest('tr').remove();
            $(el).find('.form-noticias-table tbody tr').length?$(el).find('.form-noticias-table').show():$(el).find('.form-noticias-table').hide();
        });
    });
}

function initFormCompromisosActores(){
    $('.form-actores').each(function(i,el){
        $(el).find('.form-actores-table tbody tr').length?$(el).find('.form-actores-table').show():$(el).find('.form-actores-table').hide();
        var maxid=$(el).find('.form-actores-table tbody tr').length;
        $(el).find('.form-actores-agregar').on('click',function(){
            var row='<tr>' +
                '<td><input class="form-control" type="text" name="actores['+maxid+'][nombre]" value="" placeholder="Nombre del actor involucrado"/></td>' +
                '<td>' +
                '<button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>' +
                '</td>' +
                '</tr>';
            $(el).find('.form-actores-table').append(row);
            ++maxid;
            $(el).find('.form-actores-table tbody tr').length?$(el).find('.form-actores-table').show():$(el).find('.form-actores-table').hide();
        });
        $(el).find('.form-actores-table').on('click','button',function(){
            $(this).closest('tr').remove();
            $(el).find('.form-actores-table tbody tr').length?$(el).find('.form-actores-table').show():$(el).find('.form-actores-table').hide();
        });
    });

}

function actualizaEntidades (form) {
    var $form = $(form),
        inputEntidades = $('#entidades_de_ley'),
        dataEntidad = $form.data('response-data').entidad,
        currentValues = inputEntidades.val() || [];

    if(dataEntidad.numero_boletin)
        dataEntidad.nombre += ' (N° Boletín: ' + dataEntidad.numero_boletin + ')';

    var optionHtml = '<option value="'+dataEntidad.id+'">'+dataEntidad.nombre+'</option>';

    var oldOption=inputEntidades.find("option[value="+dataEntidad.id+"]");
    if(oldOption.length)
        oldOption.replaceWith(optionHtml);
    else
        inputEntidades.append(optionHtml);

    currentValues.push(dataEntidad.id);
    inputEntidades.val(currentValues).trigger('change');

    $('#modal-backend').modal('hide');
}

function initFiltrosBusqueda(){
    var filtrosAnidados = $('.panel-filtro-anidado');
    filtrosAnidados.find('li.active').parents('li').addClass('active');

    filtrosAnidados.find(':checkbox').change(function(){
        if($(this).prop("checked"))
            $(this).parents('li').find(':checkbox').prop("checked",true);
    });
}

function initCharts(){
    $(".chart.pie").each(function(i,el){

        var data=$(el).data("data");

        var options= {
            series: {
                pie: {
                    show: true,
                    radius: 1,
                    label: {
                        show: true,
                        radius: 3/4,
                        formatter: labelFormatter,
                        background: {
                            opacity: 0.5
                        }
                    }
                }
            },
            legend: {
                show: false
            }
        };

        $.plot($(el), data, options);
        window.onresize = function(event) {
            $.plot($(el), data, options);
        }
        $('a[data-toggle="tab"]').on('shown.bs.tab', function (event) {
            $.plot($(el), data, options);
        })

    });

    function labelFormatter(label, series) {
        return "<div style='font-size:12px; text-align:center; padding:2px; color:white;'>" + label + "<br/>" + Math.round(series.percent) + "%</div>";
    }

}

function initMoment(){
    moment.lang("es");
    $("time").each(function(i,el){
        var time=moment($(el).text());
        $(el).text(time.fromNow());
    });
}

/*Actualiza comunas en base a filtro de regiones*/
function updateComunas(region_id){
  //limpiar select
  $("#comuna").empty();
  select = document.getElementById('comuna');
  //cargar las comunas de la region indicada por region_id
  $.ajax({
      url: '/backend/compromisos/comunas',
      data: { region_id : region_id },
      type: 'GET',
      dataType: "json",
      success: function(response){
        $.each(response, function(i,resp) {
          /*console.log(resp.id+" "+resp.nombre)*/
          var opt = document.createElement('option');
          opt.value = resp.id;
          opt.innerHTML = resp.nombre;
          select.appendChild(opt);
        });
      }
    });

}
