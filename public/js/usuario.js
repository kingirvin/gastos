
function guardarUsuario() {
    if( validar("#form_usuario")){
        $( "#cargando_pagina" ).show();
        var datastring = {
            id:document.getElementById('usuario_id').value,
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
function modificar(id) {  
    $( "#cargando_pagina" ).show();
    var datastring = {
        id:id,
    };
    var token = $("[name=_token]").val();
    var route = "/json/usuarios/buscar";
    $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type: 'POST',
        datatype: 'json',
        data: datastring,
        success: function (res) {    
            document.getElementById('divPassword').style.display="none";

            document.getElementById('usuario_id').value=res["id"];
            document.getElementById('nombre').value=res["name"];
            document.getElementById('email').value=res["email"];
            document.getElementById('apaterno').value=res["apaterno"];
            document.getElementById('amaterno').value=res["amaterno"];
            document.getElementById('telefono').value=res["telefono"];
            document.getElementById('oficina').value=res["oficina"];
            document.getElementById('tipo_id').value=res["tipo_id"];
        },
        error: function (error) {
            //alerta(response_helper(error),false);
            $('#cargando_pagina').hide();
        }
    });
    
}
function limpiarForm() {    
    document.getElementById('divPassword').style.display="block";
    document.getElementById('usuario_id').value="0";
    document.getElementById('nombre').value="";
    document.getElementById('email').value="";
    document.getElementById('password').value="";
    document.getElementById('apaterno').value="";
    document.getElementById('amaterno').value="";
    document.getElementById('telefono').value="";
}
function guardarContraseña() {    
    $( "#cargando_pagina" ).show();
    var datastring = {
        id:document.getElementById('usuario_id').value,
        password:document.getElementById('password_').value,
    };
    var token = $("[name=_token]").val();
    var route = "/json/usuarios/password";
    $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type: 'POST',
        datatype: 'json',
        data: datastring,
        success: function (res) {    
            tabla.ajax.reload();               
                $('#modal-password').modal('hide')
                $('#cargando_pagina').hide();
        },
        error: function (error) {
            //alerta(response_helper(error),false);
            $('#cargando_pagina').hide();
        }
    });
}
function password(id) {      
    $( "#cargando_pagina" ).show();
    var datastring = {
        id:id,
    };
    var token = $("[name=_token]").val();
    var route = "/json/usuarios/buscar";
    $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type: 'POST',
        datatype: 'json',
        data: datastring,
        success: function (res) {    
            document.getElementById('usuario_id').value=res["id"];
        },
        error: function (error) {
            //alerta(response_helper(error),false);
            $('#cargando_pagina').hide();
        }
    });
}