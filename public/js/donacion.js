var proveedor_id="0";
function iniciar() {
	document.getElementById("comprobante_id").value="0";	
		
}
function nuevoProveedor() {
	proveedor_id="0";
	document.getElementById("select-tags").value="Selecione proveedor";	
	document.getElementById("proveedor_nombre").disabled=false;	
	document.getElementById("proveedor_nombre").value="";	
	document.getElementById("proveedor_id").value="0";	
	document.getElementById("divRuc").style.display="block";	
}
function limpiarForm() {
	
	document.getElementById('comprobante_id').value="0";
	document.getElementById('siaf').value="";
	document.getElementById('documento_tipo').value="";
	document.getElementById('nro_doc').value="";
	document.getElementById('importe').value="";
	document.getElementById('proveedor_id').value="0";
	document.getElementById('proveedor_nombre').value="";
	document.getElementById('ruc').value="";
	
	item_select.clear();
}
function guardar() {
    if( validar("#form_gasto")){
        $( "#cargando_pagina" ).show();
        var datastring = {
            comprobante_id:document.getElementById('comprobante_id').value,
            siaf:document.getElementById('siaf').value,
            documento_tipo:document.getElementById('documento_tipo').value,
            nro_doc:document.getElementById('nro_doc').value,
            importe:document.getElementById('importe').value,
            proveedor_id:document.getElementById('proveedor_id').value,
            proveedor_nombre:document.getElementById('proveedor_nombre').value,
            ruc:document.getElementById('ruc').value,
        };
        var route = "/json/donacion/nuevo";
        $.ajax({
            url: route,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type: 'POST',
            datatype: 'json',
            data: datastring,
            success: function (res) {    
                tabla.ajax.reload();               
                $('#cargando_pagina').hide();
                $('#modal-comprobante').modal('hide')
            },
            error: function (error) {
                //alerta(response_helper(error),false);
                $('#cargando_pagina').hide();
            }
        });
    }
    
}
function modificar(id) {
	var datastring = {
		id:id,
	};
	var route = "/json/donacion/buscar";
	$.ajax({
		url: route,
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		type: 'POST',
		datatype: 'json',
		data: datastring,
		success: function (res) { 
			proveedor_id=res["proveedor_id"];;
			document.getElementById("proveedor_nombre").disabled=true;	
			document.getElementById("proveedor_nombre").value=res["proveedor"]["nombre"];;	
			document.getElementById("proveedor_id").value=res["proveedor_id"];	
			document.getElementById("comprobante_id").value=res["id"];	
			document.getElementById("divRuc").style.display="none";

			document.getElementById('siaf').value=res["siaf"]
			document.getElementById('documento_tipo').value=res["documento_tipo"]
			document.getElementById('nro_doc').value=res["nro_doc"]
			document.getElementById('importe').value=res["importe"]
		},
		error: function (error) {
			//alerta(response_helper(error),false);
			$('#cargando_pagina').hide();
		}
	});		
	
}
function eliminar(id) {
	
var confirmacion = confirm("Esta seguro de anular el comprobante?");
	if(confirmacion){
		var datastring = {
			id:id,
		};
		var route = "/json/donacion/eliminar";
		$.ajax({
			url: route,
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			type: 'POST',
			datatype: 'json',
			data: datastring,
			success: function (res) { 
				tabla.ajax.reload();               
				$('#cargando_pagina').hide();
				$('#modal-comprobante').modal('hide')
			},
			error: function (error) {
				//alerta(response_helper(error),false);
				$('#cargando_pagina').hide();
			}
		});	
	} 	
}
function deshacer(id) {
	var confirmacion = confirm("Esta seguro de desea restaurar el comprobante?");
	if(confirmacion){
		var datastring = {
			id:id,
		};
		var route = "/json/donacion/deshacer";
		$.ajax({
			url: route,
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			type: 'POST',
			datatype: 'json',
			data: datastring,
			success: function (res) { 
				tabla.ajax.reload();               
				$('#cargando_pagina').hide();
				$('#modal-comprobante').modal('hide')
			},
			error: function (error) {
				//alerta(response_helper(error),false);
				$('#cargando_pagina').hide();
			}
		});	
	} 	
}
function combo() {
	new TomSelect('#select-tags',{
        persist: false,
        valueField: 'nombre',
		labelField: 'nombre',
		searchField: 'nombre',
		// fetch remote data
		load: function(query, callback) {

			var url = '/json/proveedor/listar/';
			fetch(url)
				.then(response => response.json())
				.then(json => {
					callback(json.data);
				}).catch(()=>{
					callback();
				});

		},
		// custom rendering functions for options and items
		render: {
			option: function(item, escape) {
				return `<div class="py-2 d-flex">
							<div>
								<div class="mb-1" style="margin-bottom: 0px !important;">
									<span class="h4">
										${ escape(item.nombre) }
									</span>
								</div>
						 		<div class="description" style="font-size: 11px;">RUC: ${ escape(item.ruc) }</div>
							</div>
						</div>`;
			},
			item: function(item, escape) {
                
                document.getElementById('proveedor_nombre').value=item.nombre;
                document.getElementById("proveedor_nombre").disabled=true;	
                document.getElementById('proveedor_id').value=item.id;
                document.getElementById('divRuc').style.display="none";
				return `<div class="py-2 d-flex">
							<div>
								<div class="mb-1" style="margin-bottom: 0px !important;">
									<span class="h4">
										${ escape(item.nombre) }
									</span>
								</div>
						 		<div class="description" style="font-size: 11px;"> RUC: ${ escape(item.ruc) }</div>
							</div>
						</div>`;
			}
		},
	});
	
}