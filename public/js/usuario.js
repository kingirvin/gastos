
function guardarUsuario() {
    if( validar("#form_usuari")){
        $( "#cargando_pagina" ).show();
        var datastring = {
            name:document.getElementById('nombre').value,
            email:document.getElementById('email').value,
            password:document.getElementById('password').value,
            apaterno:document.getElementById('apaterno').value,
            amaterno:document.getElementById('amaterno').value,
            telefono:document.getElementById('telefono').value,
            oficina:document.getElementById('oficina').value,
            tipo_id:document.getElementById('tipo_id').value,
        };
        var token = $("[name=_token]").val();
        var route = "/json/usuarios/nuevo";
        $.ajax({
            url: route,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type: 'POST',
            datatype: 'json',
            data: datastring,
            success: function (res) {    
                //alerta(res.message,true); 
                tabla.ajax.reload();               
                $('#cargando_pagina').hide();
                $('#modal-usuario').modal('hide')
            },
            error: function (error) {
                //alerta(response_helper(error),false);
                $('#cargando_pagina').hide();
            }
        });
    }
    
}
function estado(id) {    
    $( "#cargando_pagina" ).show();
    var datastring = {
        id:id,
    };
    var token = $("[name=_token]").val();
    var route = "/json/usuarios/estado";
    $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type: 'POST',
        datatype: 'json',
        data: datastring,
        success: function (res) {    
            //alerta(res.message,true); 
            tabla.ajax.reload();               
            $('#cargando_pagina').hide();
        },
        error: function (error) {
            //alerta(response_helper(error),false);
            $('#cargando_pagina').hide();
        }
    });
}