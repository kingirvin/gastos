var html="";
function seguimiento(id) { 
    html="";
    $('#div_seguimiento').empty();
    temp=$('#div_seguimiento');
    var route = "/json/movimiento/seguimiento/"+id;
        $.ajax({
            url: route,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type: 'GET',
            datatype: 'json',
            success: function (res) {
                primero=res['primero'];
                    html+='<div class="primero">'+
                            '<div class="card s_box">'+ 
                                '<div class="card-body">'+
                                    '<div class="row align-items-center">'+
                                        '<div class="col-auto">'+                                         
                                            '<span class="bg-blue-lt avatar" title="INICIO DE TRÁMITE">'+
                                                '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M11.5 21h-4.5a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v5m-5 6h7m-3 -3l3 3l-3 3" /></svg>'+
                                            '</span>'+
                                        '</div>'+
                                        '<div class="col">'+
                                            '<div class="font-weight-medium lh-1 text-truncate" title="'+primero["origen"] +'">'+primero["origen"] +'</div>'+
                                            '<small class="text-muted text-truncate" title="Derivado">Derivado</small>'+
                                        '</div>'+
                                    '</div>'+           
                                '</div>'+                   
                            '</div>'+
                        '</div>'+
                        '<div class="siguientes">'+
                            '<div class="cv_linea"></div>';
                            ordenado=res['ordenado'];
                            ordenado.forEach(element => {
                                arbol(element);
                            });
                        html+='</div>';
                //alert(html);
                temp.append(html);
            },
            error: function (error) {
                //alerta(response_helper(error),false);
                $('#cargando_pagina').hide();
            }
        });
  //  each('garantia.movimiento', '{!!$ordenado!!}', 'item');
}
function arbol(item) {   
linea = '';
if(item.total > 1){
    if(item.numero == 0)
        linea = 'izquierda';
    else if(item.numero + 1 == item.total)
        linea = 'derecha';
    else
        linea = 'centro';
}  
fecha=item.created_at;
html+='<div class="paso '+ linea +'">'+    
        '<div class="primero">'+
            '<div class="cv_linea"></div>'+
            '<div class="card s_box">'+  
                '<div class="card-body">'+
                    '<div class="row align-items-center">'+                        
                        '<div class="col">'+
                        //0:pendiente, 1:recepcionado , 2 Derivado
                            '<div class="font-weight-medium lh-1 text-truncate" title="'+ item.destino +'">'+ item.destino +' </div>';                        
                                if(item.estado == 0)
                                html+='<small class="text-muted text-truncate" title=" Pendiente"> Pendiente</small>';
                                else if(item.estado == 1)
                                html+='<small class="text-muted text-truncate" title=" Recepcionado"> Recepcionado</small>';
                                else
                                html+='<small class="text-muted text-truncate" title=" Derivado"> Derivado</small>';
                        html+='<div class="text-body lh-1">'+ fecha.substring(0,10)+'</div>'+  
                        '</div>'+
                    '</div>'+           
                '</div>'+
            '</div>'+
        '</div>';
    if((item.despues).length>0){
        despues=item.despues;
        html+='<div class="siguientes">'+    
                '<div class="cv_linea"></div>';
                despues.forEach(element => {
                    arbol(element)
                });
            html+='</div>';
    }
html+='</div>';
}
function derivarTramite(estado,item,id) {
    var destino="";
    if (item==1) {
        destino="Caja";        
    } 
    else {
        if (item==2) {
            destino="Tributos";            
        } 
        else {
            destino="Archivo tesoreria";                        
        }
        
    }

    if(estado!=3){
        var confirmacion = confirm("Esta seguro de derivar a "+ destino+"?");
        if(confirmacion){
            var datastring = {
                id:id,
                destino:destino,
            };
            var route = "/json/tramite/nuevo";
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
    else
    alert("no se puede derivar una garantian Pendiente");

}
function derivar(item,id) {
    var destino="";
    if (item==1) {
        destino="Caja";        
    } 
    else {
        if (item==2) {
            destino="Tributos";            
        } 
        else {
            destino="Archivo tesoreria";                        
        }
        
    }
    var confirmacion = confirm("Esta seguro de derivar a "+ destino+"?");
    if(confirmacion){
        var datastring = {
            id:id,
            destino:destino,
        };
        var route = "/json/movimiento/nuevo";
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
function recepcionar(id) {
    var confirmacion = confirm("Esta seguro de Recepcionar?");
    if(confirmacion){
        var route = "/json/movimiento/recepcinar/"+id;
        $.ajax({
            url: route,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type: 'GET',
            datatype: 'json',
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