
function guardarCuenta() {
    if( validar("#form_conciliacion")){   
        $( "#cargando_pagina" ).show();
        var datastring = {
            id:document.getElementById('conciliacion_id').value,
            exp_siaf:document.getElementById('exp_siaf').value,
            oc_os:document.getElementById('oc_os').value,
            proveedor:document.getElementById('proveedor').value,
            voucher:document.getElementById('voucher').value,
            siaf:document.getElementById('siaf').value,
            registro:document.getElementById('registro').value,
            monto:document.getElementById('monto').value,
            mes:document.getElementById('mes').value,
            recibo:document.getElementById('recibo').value,
            voucher:document.getElementById('voucher').value,
        };
        var token = $("[name=_token]").val();
        var route = "/json/conciliacion/nuevo";
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
function limpiarform(){
    mes["mes"]='Selecione mes';
    document.getElementById('conciliacion_id').value="0";
    document.getElementById('exp_siaf').value="";
    document.getElementById('oc_os').value="";
    document.getElementById('proveedor').value="";
    document.getElementById('voucher').value="";
    document.getElementById('siaf').value="";
    document.getElementById('registro').value="";
    document.getElementById('monto').value="";
    document.getElementById('recibo').value="";
    document.getElementById('voucher').value="";
}
function agregar(id) {
    document.getElementById('id').value=id;
}
function modificar(id){
    $( "#cargando_pagina" ).show();
    var datastring = {
        id:id,
    };
    var token = $("[name=_token]").val();
    var route = "/json/conciliacion/buscar";
    $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type: 'POST',
        datatype: 'json',
        data: datastring,
        success: function (res) {    
        document.getElementById('conciliacion_id').value=res['id'];
        document.getElementById('exp_siaf').value=res['exp_siaf'];
        document.getElementById('oc_os').value=res['oc_os'];
        document.getElementById('proveedor').value=res['proveedor'];
        document.getElementById('voucher').value=res['voucher'];
        document.getElementById('siaf').value=res['siaf'];
        document.getElementById('registro').value=res['registro'];
        document.getElementById('monto').value=res['monto'];
        document.getElementById('mes').value=res['mes'];
        document.getElementById('recibo').value=res['recibo'];
        document.getElementById('voucher').value=res['voucher'];
        },
        error: function (error) {
            //alerta(response_helper(error),false);
            $('#cargando_pagina').hide();
        }
    });
}
function actualiarGiro(id) {
    
}
function guardarGasto() {
    if( validar("#form_gasto")){
        $( "#cargando_pagina" ).show();
        var datastring = {
            id:document.getElementById('id').value,
            nro:document.getElementById('nro').value,
            siaf:document.getElementById('siaf').value,
            periodo:document.getElementById('periodo').value,
            cheque:document.getElementById('cheque').value,
            monto:document.getElementById('monto').value,
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
                $('#modal-giro').modal('hide')
            },
            error: function (error) {
                //alerta(response_helper(error),false);
                $('#cargando_pagina').hide();
            }
        });
    }
    
}