
function guardarGasto() {
    if( validar("#form_gasto")){
        $( "#cargando_pagina" ).show();
        var datastring = {
            nro:document.getElementById('nro').value,
            siaf:document.getElementById('siaf').value,
            periodo:document.getElementById('periodo').value,
            cheque:document.getElementById('cheque').value,
            monto:document.getElementById('monto').value,
            estado:document.getElementById('estado').value,
            observacion:document.getElementById('observacion').value,
        };
        var token = $("[name=_token]").val();
        var route = "/json/giro/nuevo";
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
                $('#modal-report').modal('hide')
            },
            error: function (error) {
                //alerta(response_helper(error),false);
                $('#cargando_pagina').hide();
            }
        });
    }
    
}