$('document').ready(function(){
    
    $('.formulario').on('submit', enviarCorreo);

    function enviarCorreo(evento){
        evento.preventDefault();

        //variables
        let formulario = $(this),
        datos = new FormData(formulario.get(0)),
        nombre = $('#nombre').val(),
        apellidos = $('#apellidos').val(),
        correo = $('#correo').val(),
        telefono = $('#telefono').val(),
        mensaje = $('#mensaje').val();

        //validaciones
        if(nombre === ''){
            toastr.error('Debes rellenar el campo nombre', '¡Vaya!');
            return
        }
        if(!/^([a-zA-Záéíóú]+)(\s[a-zA-Záéíóú]+)*$/.test(nombre)){
            toastr.error('Nombre no válido', '¡Vaya!');
            return
        }
        if(apellidos === ''){
            toastr.error('Debes rellenar el campo apellidos', '¡Vaya!');
            return
        }
        if(!/^([a-zA-Záéíóú]+)(\s[a-zA-Záéíóú]+)*$/.test(apellidos)){
            toastr.error('Apellidos no válidos', '¡Vaya!');
            return
        }
        if(correo === ''){
            toastr.error('Debes rellenar el campo correo electrónico', '¡Vaya!');
            return
        }
        if(!/^(([^<>()\[\]\.,;:\s@\”]+(\.[^<>()\[\]\.,;:\s@\”]+)*)|(\”.+\”))@(([^<>()[\]\.,;:\s@\”]+\.)+[^<>()[\]\.,;:\s@\”]{2,})$/.test(correo)){
            toastr.error('Correo electrónico no válido', '¡Vaya!');
            return
        }
        if(telefono != ''){
            if(!/^\d{9}$/.test(telefono)){
                toastr.error('Teléfono no válido', '¡Vaya!');
                return
            }
        }
        if(mensaje === ''){
            toastr.error('Debes rellenar el campo mensaje', '¡Vaya!');
            return
        }

        $.ajax({
            url:'contacto/contacta',
            type:'post',
            dataType:'json',
            contentType: false,
            processData: false,
            cache: false,
            data: datos,
            beforeSend: function(){
                formulario.waitMe();
            }
        }).done(function(respuesta){
            if(respuesta.estatus === 200){
                toastr.success(respuesta.mensaje, '¡Bien!');
                //reiniciar formulario
                formulario.trigger('reset');
            }else{
                toastr.error(respuesta.mensaje, '¡Vaya!');
            }
        }).fail(function(error){
            toastr.error('Hubo un error en la petición', '¡Vaya!');
        }).always(function(){
            formulario.waitMe('hide');
        })
    }
})