//lo necesario al momento de cargar
$(document).ready(function(){
    var widgetId;
    //Toastr -> notificaciones
    //toastr.warning('My name is Inigo Montoya. You killed my father, prepare to die!')

    //Waitme -> agrega iconos de carga de página
    /*$('body').waitMe({
        effect : 'bounce',
        text : 'Cargando',
        maxSize : '',
        waitTime : -1,
        textPos : 'vertical',
        fontSize : '',
        source : '',
        onClose : function() {}
        });*/


    function selecionarFecha(){
        date = new Date($('#calendario').val());
        fecha = date.getFullYear() + '-' + ('0' + (date.getMonth()+1)).slice(-2) + '-' + ('0' + date.getDate()).slice(-2);
        return fecha;
    }

    $('.agregarMovimiento').on('submit', agregarMovimiento);

    //Agregar un movimiento
    function agregarMovimiento(event){
        event.preventDefault();
        //variables
        var formulario = $('.agregarMovimiento'),
            validacion = '7jT@wq23_hzpML(?Jm',
            accion = 'agregar',
            //[0] -> elige ese formulario en concreto
            datos = new FormData(formulario.get(0)),
            tipo = $('#tipo').val(),
            descripcion = $('#descripcion').val(),
            cantidad = $('#cantidad').val()
            fecha = selecionarFecha(),
            calendario = $('#calendario');
            
            //valores que se pasan
            datos.append('validacion', validacion);
            datos.append('accion', accion);
            datos.append('fecha', fecha);

        //Validar que esté seleccionada una opcion
        if(tipo === 'ninguno'){
            toastr.error('Selecciona un tipo', '¡Vaya!');
            return;
        }
        //Validar descripción
        if(descripcion === '' || descripcion.length < 5){
            toastr.error('Introduce una descripción válida', '¡Vaya!');
            return;
        }

        //Validar cantidad
        var valoresAceptados = /^[0-9.,]+$/;
        if(cantidad === '' || cantidad <=0 || !cantidad.match(valoresAceptados)){
            toastr.error('Introduce una cantidad válida', '¡Vaya!');
            return;
        }

        //Ajax
        $.ajax({
            //controlador:ajax, método:agregarMovimiento
            url:'ajax/agregarMovimiento',
            type:'post',
            dataType:'json',
            contentType: false,
            processData:false,
            cache:false,
            data:datos,
            beforeSend: function(){
                formulario.waitMe();
            }
        }).done(function(respuesta){
            if(respuesta.estatus === 201){
                //se guardó el registro en la BD
                toastr.success(respuesta.mensaje, '¡Bien!');
                //reiniciar formulario
                formulario.trigger('reset');
                mostrarMovimientos();
                calendario.val('');
              
            }else{
                toastr.error(respuesta.mensaje, '¡Vaya!');
            }
        }).fail(function(error){
            toastr.error('Hubo un error en la petición', '¡Vaya!');
        }).always(function(){
            //cuando termine la petición se oculte
            formulario.waitMe('hide');
            resetAgregar();
        })
    }

    //Cargar movimientos
    $('#calendario').on('change', cambiarFecha);

    function cambiarFecha(){
        var movimientos = $('.movimientos'),
            validacion = '7jT@wq23_hzpML(?Jm',
            accion = 'cargar',
            fecha = selecionarFecha();

        //ajax
        $.ajax({
            url:'ajax/cambiarFecha', 
            type:'POST',
            dataType: 'json',
            cache:false,
            data:{
                validacion, accion, fecha
            },
            beforeSend: function(){
                movimientos.waitMe();
            }
        }).done(function(respuesta){
            if(respuesta.estatus === 200 && respuesta.datos !=false){
                movimientos.html(respuesta.datos);
            }else if(respuesta.estatus === 200 && respuesta.datos === false){
                movimientos.html('<div class="d-flex justify-content-center mt-5"><p class="lead movimientos">No hay movimientos en esta fecha</p></div>');
            }else{
                toastr.error(respuesta.mensaje, '¡Vaya!');
                movimientos.html('');
            }
        }).fail(function(error){
            toastr.error('Hubo un error en la petición', '¡Vaya!');
            movimientos.html('');
        }).always(function(){
            movimientos.waitMe('hide');
        })
    }

    mostrarMovimientos();
    function mostrarMovimientos(){
        var movimientos = $('.movimientos'),
            validacion = '7jT@wq23_hzpML(?Jm',
            accion = 'cargar';

        //ajax
        $.ajax({
            url:'ajax/mostrarMovimientos', 
            type:'POST',
            dataType: 'json',
            cache:false,
            data:{
                validacion, accion
            },
            beforeSend: function(){
                movimientos.waitMe();
            }
        }).done(function(respuesta){
            if(respuesta.estatus === 200 && respuesta.datos !=false){
                movimientos.html(respuesta.datos);
            }else if(respuesta.estatus === 200 && respuesta.datos.movimientos === false){
                movimientos.html(respuesta.datos);
            }else{
                toastr.error(respuesta.mensaje, '¡Vaya!');
                movimientos.html('');
            }
        }).fail(function(error){
            toastr.error('Hubo un error en la petición', '¡Vaya!');
            movimientos.html('');
        }).always(function(){
            movimientos.waitMe('hide');
        })

    }

    //Actualizar un movimiento
    $('body').on('click', '.botonEditar', mostrarMovimiento);
    function mostrarMovimiento(evento){
        var botonEditar = $(this),
            id = botonEditar.data('id'),
            validacion = '7jT@wq23_hzpML(?Jm',
            accion = 'obtener',
            formularioAnadir = $('.agregarMovimiento');
            formularioActualizar = $('.movimientosActualizar')
            tituloFormulario = $('.tituloForm');
        
        //Ajax
        $.ajax({
            url:'ajax/mostrarMovimiento', 
            type:'POST',
            dataType: 'json',
            cache:false,
            data:{
                validacion, accion, id
            },
            beforeSend: function(){
                formularioActualizar.waitMe();
            }
        }).done(function(respuesta){
            if(respuesta.estatus === 200){
                //carga los datos en el formulario de actualizar y oculta el de añadir
                formularioActualizar.html(respuesta.datos);
                tituloFormulario.html('Actualizar movimiento');
                formularioAnadir.hide();
                formularioActualizar.show();
                captchaActualizar();
            }else{
                toastr.error(respuesta.mensaje, '¡Vaya!');
            }
        }).fail(function(error){
            toastr.error('Hubo un error en la petición', '¡Vaya!');
        }).always(function(){
            formularioActualizar.waitMe('hide');
        })
    }

      //Actualizar un movimiento
      $('body').on('submit', '.actualizarMovimiento', actualizarMovimiento);
      function actualizarMovimiento(evento){
        evento.preventDefault();
        //variables
        var formulario = $('.actualizarMovimiento'),
            formularioAnadir = $('.agregarMovimiento');
            validacion = '7jT@wq23_hzpML(?Jm',
            accion = 'actualizar',
            //[0] -> elige ese formulario en concreto
            datos = new FormData(formulario.get(0)),
            //se pone el selector así para que coja este formualario y no lo confunda con el de crear
            tipo = $('select[name="tipo"]', formulario).val(),
            descripcion = $('input[name="descripcion"]', formulario).val(),
            cantidad = $('input[name="cantidad"]', formulario).val(),
            fecha = selecionarFecha(),
            calendario = $('#calendario');

            //valores que se pasan
            datos.append('validacion', validacion);
            datos.append('accion', accion);
            datos.append('fecha', fecha);

            //Validar que esté seleccionada una opcion
            if(tipo === 'ninguno'){
                toastr.error('Selecciona un tipo', '¡Vaya!');
                return;
            }
            //Validar descripción
            if(descripcion === '' || descripcion.length < 5){
                toastr.error('Introduce una descripción válida', '¡Vaya!');
                return;
            }

            //Validar cantidad
            var valoresAceptados = /^[0-9.,]+$/;
            if(cantidad === '' || cantidad <=0 || !cantidad.match(valoresAceptados)){
                toastr.error('Introduce una cantidad válida', '¡Vaya!');
                return;
            }

            //Ajax
            $.ajax({
                //controlador:ajax, método:actualizarMovimiento
                url:'ajax/actualizarMovimiento',
                type:'post',
                dataType:'json',
                contentType: false,
                processData:false,
                cache:false,
                data:datos,
                beforeSend: function(){
                    formulario.waitMe();
                }
            }).done(function(respuesta){
                if(respuesta.estatus === 200){
                    //se guardó el registro en la BD
                    toastr.success(respuesta.mensaje, '¡Bien!');
                    //reiniciar formulario
                    formulario.trigger('reset');
                    //borra del DOM
                    formulario.remove();
                    formularioAnadir.show();
                    mostrarMovimientos();
                    calendario.val('');
                }else{
                    toastr.error(respuesta.mensaje, '¡Vaya!');
                }
            }).fail(function(error){
                toastr.error('Hubo un error en la petición', '¡Vaya!');
            }).always(function(){
                //cuando termine la petición se oculte
                formulario.waitMe('hide');
            })
      }

$('body').on('click','.botonCancelar', volver);

function volver(evento){
    var botonCancelar = $(this),
        formularioActualizar = $('.movimientosActualizar'),
        formularioAnadir = $('.agregarMovimiento'),
        tituloFormulario = $('.tituloForm');

        formularioActualizar.hide();
        formularioAnadir.show();
        tituloFormulario.html('Agregar nuevo movimiento');
}

    //Borrar un movimiento
    //se pone body porque no está preparado al cargar el DOM sino que se genera posteriormente
    $('body').on('click', '.botonBorrar', borrarMovimiento);

    function borrarMovimiento(evento){
        var botonBorrar = $(this),
            id = botonBorrar.data('id'),
            validacion = '7jT@wq23_hzpML(?Jm',
            accion = 'borrar',
            movimientos = $('.movimientos'),
            calendario = $('#calendario');
        
        if(!confirm('¿Seguró que quieres borrarlo?')) return false;
        //ajax
        $.ajax({
            url:'ajax/borrarMovimiento', 
            type:'POST',
            dataType: 'json',
            cache:false,
            data:{
                validacion, accion, id
            },
            beforeSend: function(){
                movimientos.waitMe();
            }
        }).done(function(respuesta){
            if(respuesta.estatus === 200){
                toastr.success(respuesta.mensaje, '¡Bien!');
                mostrarMovimientos();
                calendario.val("");
            }else{
                toastr.error(respuesta.mensaje, '¡Vaya!');
            }
        }).fail(function(error){
            toastr.error('Hubo un error en la petición', '¡Vaya!');
        }).always(function(){
            movimientos.waitMe('hide');
        })
    }


    //Guardar o actualizar opciones
    $('#opciones').on('submit', opciones);

    function opciones(evento){
        evento.preventDefault();

        var formularioOpciones = $('#opciones'),
            datos = new FormData(formularioOpciones.get(0)),
            validacion = '7jT@wq23_hzpML(?Jm',
            accion = 'agregar',
            impuestos = $('#impuestos').val(),
            tipoMoneda = $('.tipoMoneda'),
            calendario = $('#calendario');

            datos.append('validacion', validacion);
            datos.append('accion', accion);

            //Validar cantidad
            impuestos = impuestos.trim();
            var valoresAceptados = /^[0-9.,]+$/;
            if(impuestos === '' || impuestos < 0 || !impuestos.match(valoresAceptados)){
                toastr.error('Introduce un porcentaje válido', '¡Vaya!');
                return;
            }

            //Ajax
            $.ajax({
                //controlador:ajax, método:opciones
                url:'ajax/opciones',
                type:'post',
                dataType:'json',
                contentType: false,
                processData:false,
                cache:false,
                data:datos,
                beforeSend: function(){
                    formularioOpciones.waitMe();
                }
            }).done(function(respuesta){
                if(respuesta.estatus === 200 || respuesta.estatus === 201){
                    //se guardó el registro en la BD
                    toastr.success(respuesta.mensaje, '¡Bien!');
                    //reiniciar formulario
                    mostrarMovimientos();
                    console.log(respuesta);
                    tipoMoneda.html(respuesta.datos);
                    calendario.val('');
                }else{
                    toastr.error(respuesta.mensaje, '¡Vaya!');
                }
            }).fail(function(error){
                toastr.error('Hubo un error en la petición', '¡Vaya!');
            }).always(function(){
                //cuando termine la petición se oculte
                formularioOpciones.waitMe('hide');
                resetOpciones();
            })
    }


function captchaOpciones(){

        var parametros = {
            sitekey: '32caa3a1-7e05-4b47-8cee-b14bcc22228d'
        }
            
        widgetId2 = hcaptcha.render('opcapguar', parametros);
    }
function captchaAgregar(){

        var parametros = {
            sitekey: '1609275f-8661-4dbc-b636-eeaa36d39b86'
        }
            
        widgetId = hcaptcha.render('movcapagr', parametros);
    }


function captchaActualizar(){

        var parametros = {
            sitekey: '3a207611-e241-4389-bf30-693e0875dda9'
        }
            
        widgetId3 = hcaptcha.render('movcapact', parametros);
    }

    function resetOpciones() {
        hcaptcha.reset(widgetId2);
    }
    function resetAgregar() {
        hcaptcha.reset(widgetId);
    }
    function resetActualizar() {
        hcaptcha.reset(widgetId3);
    }
captchaOpciones(); 
captchaAgregar();


});

