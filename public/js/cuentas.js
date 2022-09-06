var tabla;
var editItem = 0;


$( document ).ready(function() {

    tabla = $("#t_gastos").DataTable({
        "processing": true,
        "serverSide": true,
        "pageLength": 50,
        "order": [],
        "ajax": {
            "url":  "/json/gastos/listar",
            "type": "POST",
            "data": function ( d ) { },
            //"error": default_error_handler        
        },
        "columns": [
            { "data": "nro", "searchable": true },
            { "data": "siaf", className: "w-1" },  
            { "data": "periodo", className: "w-1" }, 
            { "data": "cheque", className: "w-1" }, 
            { "data": "monto", className: "w-1" }, 
            { "data": "observacion", className: "w-1" }, 
            { "data": "estado", "searchable": false, "orderable": false, className: "w-1 text-center",
                render: function ( data, type, full ) {                      
                    if(data == 1){
                        return '<button  style ="color: #74b816;"  onclick="estado('+full.id+')" class="btn btn-white btn-icon"  title="Habilitado"><svg xmlns="http://www.w3.org/2000/svg" class="icon " width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="16" cy="12" r="2" /><rect   x="2" y="6" width="20" height="12" rx="6" /></svg></button>';
                    }
                    else{
                        return '<button  style ="color: #f7061d;"  onclick="estado('+full.id+')" class="btn btn-white btn-icon"  title="Habilitado"><svg xmlns="http://www.w3.org/2000/svg" class="icon " width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="16" cy="12" r="2" /><rect   x="2" y="6" width="20" height="12" rx="6" /></svg></button>';
                    }
                }        
            },  
            { 
                "data": null,
                "searchable": false, "orderable": false, className: "w-1",
                    render: function ( data, type, full ) {   
                    var res = '<div class="btn-list flex-nowrap">'+
                                '<a  href="/admin/productos/modificar/'+full.id+'"  class="btn btn-white btn-icon" onclick="modificar('+full.id+');" title="MODIFICAR">'+
                                    '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" /><path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" /><line x1="16" y1="5" x2="19" y2="8" /></svg>'+
                                '</a>'+
                                '<button class="btn btn-danger btn-icon" onclick="eliminar('+full.id+');" title="ELIMINAR">'+
                                    '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="4" y1="7" x2="20" y2="7" /><line x1="10" y1="11" x2="10" y2="17" /><line x1="14" y1="11" x2="14" y2="17" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>'+
                                '</button>'+                                
                            '</div>';
                    return res;
                }
            }
        ],
        "dom": default_datatable_dom,
        "language": default_datatable_language,
        "initComplete" : default_datatable_buttons
    }); 
});


function estado(idp) {
    $("#cargando_pagina").show();
    $.ajax({
        type: "POST",
        url: default_server+"/json/empresa/producto/"+idp+"/estado",        
        success: function(result){  
            $("#cargando_pagina").hide();
            alerta(result.message, true); 
            tabla.ajax.reload();
        },
        error: function(error) {   
            $("#cargando_pagina").hide();             
            alerta(response_helper(error), false);      
        }
    });    
}

function eliminar(idp) {
    if(confirm("Esta seguro que desea eliminar?")){
        $("#cargando_pagina").show();
        $.ajax({
            type: "POST",
            url: default_server+"/json/empresa/producto/"+idp+"/eliminar",        
            success: function(result){  
                $("#cargando_pagina").hide();
                alerta(result.message, true); 
                tabla.ajax.reload();
            },
            error: function(error) {   
                $("#cargando_pagina").hide();             
                alerta(response_helper(error), false);      
            }
        });    
    }    
}
function destacado(idp) {
    if( validar("#form_password")){
        $( "#cargando_pagina" ).show();
        var datastring = {
            id: idp,
        };
        var token = $("[name=_token]").val();
        var route = "/json/empresa/producto/"+idp+"/destacado";
        $.ajax({
            url: route,
            headers: { 'x-CSRF-TOKEN': token },
            type: 'POST',
            datatype: 'json',
            data: datastring,
            success: function (res) {    
                alerta(res.message,true); 
                tabla.ajax.reload();               
                $('#cargando_pagina').hide();

            },
            error: function (error) {
                alerta(response_helper(error),false);
                $('#cargando_pagina').hide();
            }
        });
    }
    
}