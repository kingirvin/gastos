let myNumericInput = new AutoNumeric('#monto',{decimalPlaces: 2});

document.querySelector('#monto').addEventListener('keyup',() =>{
  console.log(myNumericInput.getNumber())
})
let myNumericInputDe = new AutoNumeric('#montoDevolucion',{decimalPlaces: 2});

document.querySelector('#monto').addEventListener('keyup',() =>{
  console.log(myNumericInputDe.getNumber())
})
function guardarCuenta() {
    if( validar("#form_garantia")){   
        $( "#cargando_pagina" ).show();
        var datastring = {
            id:document.getElementById('garantia_id').value,
            exp_siaf:document.getElementById('exp_siaf').value,
            proveedor:document.getElementById('proveedor').value,
            voucher:document.getElementById('voucher').value,
            registro:document.getElementById('registro').value,
            fecha:document.getElementById('fecha').value,
            monto:document.getElementById('monto').value,
            mes:document.getElementById('mes').value,
            recibo:document.getElementById('recibo').value,
            voucher:document.getElementById('voucher').value,
        };
        var token = $("[name=_token]").val();
        var route = "/json/garantiasForestal/nuevo";
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
    document.getElementById('garantia_id').value="0";
    document.getElementById('exp_siaf').value="";
    document.getElementById('proveedor').value="";
    document.getElementById('voucher').value="";
    document.getElementById('registro').value="";
    document.getElementById('monto').value="";
    document.getElementById('recibo').value="";
    document.getElementById('voucher').value="";

    document.getElementById('mensajeSiaf').innerHTML=""
    
    document.getElementById('id').value="0"
    document.getElementById('nro').value=""
    document.getElementById('fecha').value=""
    document.getElementById('siafDevolucion').value=""
    document.getElementById('periodo').value=""
    document.getElementById('cheque').value=""
    document.getElementById('montoDevolucion').value=""
    document.getElementById('observacion').value=""

    document.getElementById('nro').disabled=false;

}
//agrega el Devolucion a la garantia
function agregar(id) {
    document.getElementById('nro').disabled=true;

    limpiarform();
    activarForm();
    // crea un nuevo objeto `Date`
    var today = new Date();                    
    // `getDate()` devuelve el d??a del mes (del 1 al 31)
    var day = today.getDate();                      
    // `getMonth()` devuelve el mes (de 0 a 11)
    var month = today.getMonth() + 1;                      
    // `getFullYear()` devuelve el a??o completo
    var year = today.getFullYear();
    var actual=year+'-'+month+'-'+day;
    var actual_temp=new Date(actual);
    var dias= 1000*60*60*24;   
    
    var datastring = {
        id:id,
    };
    var token = $("[name=_token]").val();
    var route = "/json/garantiasForestal/buscar";
    $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type: 'POST',
        datatype: 'json',
        data: datastring,
        success: function (res) {  
            var fecha=res['created_at']; 
            var temp=fecha.substr(0,10); 
            var fecha_temp=new Date(temp); 
            var tiempo=(actual_temp-fecha_temp)/dias
            if(tiempo > 365){
                document.getElementById('nro').disabled=false;
                document.getElementById('mensajeSiaf').innerHTML=" El periodo exedio el limite"
            }
            else{
                document.getElementById('nro').disabled=true;
                document.getElementById('mensajeSiaf').innerHTML=""
            }

            document.getElementById('nro').value=res['exp_siaf'];
        },
        error: function (error) {
            //alerta(response_helper(error),false);
            $('#cargando_pagina').hide();
        }
    });
    document.getElementById('garantia_id').value=id;    
}
function modificar(id){
    limpiarform();
    $( "#cargando_pagina" ).show();
    var datastring = {
        id:id,
    };
    var token = $("[name=_token]").val();
    var route = "/json/garantiasForestal/buscar";
    $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type: 'POST',
        datatype: 'json',
        data: datastring,
        success: function (res) {    
        document.getElementById('garantia_id').value=res['id'];
        document.getElementById('exp_siaf').value=res['exp_siaf'];
        document.getElementById('proveedor').value=res['proveedor'];
        document.getElementById('voucher').value=res['voucher'];
        document.getElementById('registro').value=res['registro'];
        document.getElementById('monto').value=res['monto'];
        document.getElementById('fecha').value=res['fecha'];
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
function actualiarDevolucion(id) {
    
}
function guardarDevolucion() {
    if( validar("#form_gasto")){
        $( "#cargando_pagina" ).show();
        var datastring = {
            id:document.getElementById('id').value,
            nro:document.getElementById('nro').value,
            siaf:document.getElementById('siafDevolucion').value,
            periodo:document.getElementById('periodo').value,
            cheque:document.getElementById('cheque').value,
            monto:document.getElementById('montoDevolucion').value,
            observacion:document.getElementById('observacion').value,
            garantia_id:document.getElementById('garantia_id').value,
        };
        var token = $("[name=_token]").val();
        var route = "/json/devolucionForestal/nuevo";
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
                $('#modal-devolucion').modal('hide')
            },
            error: function (error) {
                //alerta(response_helper(error),false);
                $('#cargando_pagina').hide();
            }
        });
    }
    
}
function modificarDevolucion(id){    
    document.getElementById("id").value ="0";    
    document.getElementById("form_gasto").style.pointerEvents = "none";    
    if(user['tipo_id']=="1" || user['oficina']=='Devolucions'){
        document.getElementById("btnGuardarDevolucion").style.display = "none";
        document.getElementById("btnActualizarDevolucion").style.display = "block";
    }
    var datastring = {
        id:id,
    };
    var token = $("[name=_token]").val();
    var route = "/json/devolucionForestal/buscar";
    $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type: 'POST',
        datatype: 'json',
        data: datastring,
        success: function (res) {               
            document.getElementById('id').value=res['id'];
            document.getElementById('nro').value=res['nro'];
            document.getElementById('siafDevolucion').value=res['reg_siaf'];
            document.getElementById('periodo').value=res['periodo'];
            document.getElementById('cheque').value=res['cheque'];
            document.getElementById('montoDevolucion').value=res['monto'];
            document.getElementById('observacion').value=res['observacion'];
            document.getElementById('garantia_id').value=res['garantia_id'];

            //$('#modal-Devolucion').modal('hide')
        },
        error: function (error) {
            //alerta(response_helper(error),false);
            $('#cargando_pagina').hide();
        }
    });
    
}
function activarForm() {
    document.getElementById("form_gasto").style.pointerEvents = "auto";
    document.getElementById("btnActualizarDevolucion").style.display = "none";
    document.getElementById("btnGuardarDevolucion").style.display = "block";
        
}
/*
estado 1: */
function eliminar(id) {    	
    var confirmacion = confirm("Esta seguro de eliminar?");
    if(confirmacion){
        var datastring = {
            id:id,
        };
        var route = "/json/garantiasForestal/eliminar";
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
        
}
function restablecer(id) {    	
    var confirmacion = confirm("Esta seguro de restablecer?");
    if(confirmacion){
        var datastring = {
            id:id,
        };
        var route = "/json/garantiasForestal/restablecer";
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
        
}