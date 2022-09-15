@extends('layouts.plantilla')

@section('css')  
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link href="{{asset('/libs/select2/css/select2.min.css')}}" rel="stylesheet" />
@endsection
@section('jss') 
<script src="http://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script> 
<script src="{{asset('/libs/tom-select/dist/js/tom-select.base.min.js')}}"></script>

<script src="{{asset('/js/comprobante.js')}}"></script>  
<script>
  var tabla;
  var item_select;
  $(document).ready(function(){

    item_select=new TomSelect('#select-tags',{
        persist: false,
        valueField: 'nombre',
		labelField: 'nombre',
		searchField: 'nombre',
		// fetch remote data
		load: function(query, callback) {

			var url = '/json/proveedor/listar/'+ encodeURIComponent(query);
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
    /*
    new TomSelect("#select-tags",{
        create: true,        
        render:{
            option: function(data, escape) {
                return '<div>' + escape(data.text) + '</div>';
            },
            item: function(data, escape) {
                document.getElementById('proveedor_nombre').value=data.text;
                document.getElementById("proveedor_nombre").disabled=true;	
                document.getElementById('proveedor_id').value=data.value;
                document.getElementById('divRuc').style.display="none";
                return '<div>' + escape(data.text) + '</div>';
            },
            onDelete : eventHandler('onDelete')
        }
    });*/
    tabla= $('#t_comprobantes').DataTable({
          processing: true,
          serverSider: true,
          ajax:'{!!route("listaComprobantes")!!}',
        columns:[
            {data:'id'},
            {data:'siaf'},
            {data:null,"orderable": false, "searchable": false,
                render: function ( data, type, full ) {                      
                    var fecha=full.created_at; 
                    var temp=fecha.substr(0,10); 
                    return   temp;                
                }                                        
            },            
            {data:'documento_tipo'},
            {data:null,"orderable": false, "searchable": false,
                render: function ( data, type, full ) {                      
                    return full.proveedor.nombre; 
                }                                        
            },
            {data:'importe'},
            {data:null,"orderable": false, "searchable": false,
                render: function ( data, type, full ) {                       
                res ='<button class="btn btn-white btn-icon" onclick="modificar('+full.id+');" title="MODIFICAR GARANTIA"  data-bs-toggle="modal" data-bs-target="#modal-comprobante"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3"></path><path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3"></path><line x1="16" y1="5" x2="19" y2="8"></line></svg></button>'+
                    '<button class="btn btn-danger btn-icon" onclick="eliminar('+full.id+');" title="ELIMINAR"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="4" y1="7" x2="20" y2="7"></line><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path></svg></button></div>';
                    return res;
                }                                        
            } 
        ],
      });
  })
</script>

<script>
    // @formatter:on
  </script>

@endsection
@section('nombre') Comprobantes @endsection
@section('content')
<div class="col-12  py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">                
                    <div class="card">
                        <div class="card-header"><div class="col-6 col-sm-4 col-md-2 py-3">
                            <div class="btn-list">
                                <a href="#" class="btn" data-bs-toggle="modal" data-bs-target="#modal-comprobante" onclick="limpiarForm()">
                                   Nuevo comprobante
                                </a>
                            </div>
                        </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="t_comprobantes" class="table card-table table-vcenter text-nowrap datatable"style="padding-top: 20px;">
                                    <thead>
                                        <tr>
                                            <th>Nro C/P</th>
                                            <th>SIAF</th>
                                            <th>Fecha</th>
                                            <th>T/ Doc</th>
                                            <th>Proveedor</th>
                                            <th>importe</th>
                                            <th class="w-1"> Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>  
                        </div>                 
                    </div>
                </div>
            </div>
        </div>
    </div>
  <div class="modal modal-blur fade" id="modal-comprobante" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Nuevo comprobante</h5>
        </div>
        <div  id="form_gasto" class="modal-body">
          @csrf

          <div class="row">
            <div class="col-6">
                <input type="hidden" id="comprobante_id" value="0">
                <div class="form-group mb-3">
                    <label class="form-label">SIAF<span class="form-required">*</span></label>
                    <input type="text" class="form-control mayuscula" id="siaf" name="example-text-input" placeholder="">
                </div>
                <div class="form-group mb-3">
                    <label class="form-label">Tipo documento<span class="form-required">*</span></label>
                    <input type="text" class="form-control mayuscula" id="documento_tipo" name="example-text-input" placeholder="">
                </div>
                <div class="form-group mb-3">
                    <label class="form-label">Nro documento</span></label>
                    <input type="text" class="form-control mayuscula" id="nro_doc" name="example-text-input" placeholder="">
                </div>
                <div class="form-group mb-3">
                    <label class="form-label">Importe<span class="form-required">*</span></label>
                    <input type="text" class="form-control mayuscula" id="importe" name="example-text-input" placeholder="">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group mb-3">
                    <label class="form-label">Buscar proveedor</label>
                    <select type="text" class="form-select" placeholder="Ingrese proveedor" id="select-tags"  autocomplete="off">
                        
                    </select>
                    </div>
                <div class="form-group mb-3">
                    <a href="#" class="btn btn-primary ms-auto" onclick="nuevoProveedor()">
                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
                        Nuevo 
                    </a>
                </div> 
                <div class="form-group mb-3">
                    <input type="hidden" name="" id="proveedor_id" value="0">
                    <label class="form-label">Proveedor<span class="form-required">*</span></label>
                    <input type="text" class="form-control mayuscula" id="proveedor_nombre" name="example-text-input" disabled>
                </div>          
                <div class="form-group mb-3" id="divRuc" style="display:none">
                    <label class="form-label">Ruc</span></label>
                    <input type="text" class="form-control mayuscula" id="ruc" name="example-text-input">
                </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
            Cancelar
          </a>
          <a href="#" class="btn btn-primary ms-auto" onclick="guardar()">
            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
            Guardar 
          </a>
        </div>
      </div>
    </div>
  </div>
@endsection
