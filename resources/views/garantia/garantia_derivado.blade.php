@extends('layouts.plantilla')

@section('css') 
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="{{asset('/css/garantia.css')}}">
@endsection
@section('jss') 
<script src="http://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script> 
<!-- ...or, you may also directly use a CDN :-->
<!-- ...or -->
<script src="{{asset('/libs/litepicker/dist/litepicker.js')}}"></script> 

<script src="{{asset('/js/garantia_derivado.js')}}"></script> 
<script>
  var tabla;
  var user={!!Auth::user()!!};
  $(document).ready(function(){
      tabla= $('#t_gastos').DataTable({
          processing: true,
          serverSider: true,
            order: [
            [0, "desc"]
            ],
          ajax:'{!!route("listaMovimiento")!!}',
          "columns":[
            {"data":null,"orderable": false, "searchable": false,
                  render: function ( data, type, full ) {                                         
                    var fecha=full.created_at; 
                    var temp=fecha.substr(0,10); 
                    return   temp;                
                  }                                        
            },
            {"data":null,"orderable": false, "searchable": false,
                  render: function ( data, type, full ) { 
                    
                      return full.tramite.garantia.exp_siaf;                                                                                   
                  }                                          
            },
            {"data":null,"orderable": false, "searchable": false,
                  render: function ( data, type, full ) { 
                    
                      return full.tramite.garantia.oc_os;                                                 
                                          
                  }                                          
            },
            {"data":null,"orderable": false, "searchable": false,
                  render: function ( data, type, full ) { 
                    
                      return full.tramite.garantia.proveedor;                                          
                                          
                  }                                          
            },
            {"data":null,"orderable": false, "searchable": false,
                  render: function ( data, type, full ) { 
                    
                      return full.tramite.garantia.voucher;                                              
                                          
                  }                                          
            },
            {"data":null,"orderable": false, "searchable": false,
                  render: function ( data, type, full ) { 
                    
                      return full.tramite.garantia.registro;                                          
                                          
                  }                                          
            },
            {"data":null,"orderable": false, "searchable": false,
                  render: function ( data, type, full ) { 
                    if(full.tramite.tabla="Garantias")
                        return full.tramite.garantia.siaf; 
                    else
                      return "---"                                                                                 
                  }                                          
            },
            {"data":null,"orderable": false, "searchable": false,
                  render: function ( data, type, full ) {                                                           
                    var fecha=full.tramite.garantia.fecha; 
                    var temp=fecha.substr(0,10); 
                      return temp;                                       
                                          
                  }                                          
            },
            {"data":null,"orderable": false, "searchable": false,
                  render: function ( data, type, full ) { 
                    
                      return full.tramite.garantia.monto;                                           
                                          
                  }                                          
            },
            {"data":null,"orderable": false, "searchable": false,
                  render: function ( data, type, full ) { 
                    
                      return full.tramite.garantia.mes;                                               
                                          
                  }                                          
            },
            {"data":null,"orderable": false, "searchable": false,
                  render: function ( data, type, full ) { 
                    
                      return full.tramite.garantia.recibo;                                                                                 
                  }                                          
            },//0:pendiente, 1:recepcionado , 2 Derivado ,3Terminado
            {"data":null,"orderable": false, "searchable": false,
                  render: function ( data, type, full ) {                         
                    if(full.estado=="0")
                      return "<p style='color: red;'>Pendiente</p>";
                    else if(full.estado=="1")
                      return "<p style='color: green;'>Recepcionado</p>";
                    else if(full.estado=="2")
                      return "<p style='color: #a7a742;;'>Derivado</p>";
                    else if(full.estado=="3")
                      return "<p style='color: #a7a742;;'>Terminado</p>";
                  }                                          
            },
            {"data":null,"orderable": false, "searchable": false,
                  render: function ( data, type, full ) {  
                      var res ='<div class="btn-list flex-nowrap">';
                        res +='<button class="btn btn-white btn-icon" onclick="seguimiento('+full.tramite.garantia_id+');" title="Ver"  data-bs-toggle="modal" data-bs-target="#modal-seguimiento"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="12" cy="12" r="2"></circle><path d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7"></path></svg></button>'+                              
                          '<div class="nav-item dropdown">'+
                          //<button class="btn btn-white btn-icon" onclick="modificar(1);" title="MODIFICAR"></button>
                              '<a href="#" class="btn btn-white btn-icon" data-bs-toggle="dropdown" aria-label="Open user menu" aria-expanded="false">'+
                                '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-align-justified" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">'+
                                  '<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>'+
                                  '<line x1="4" y1="6" x2="20" y2="6"></line>'+
                                  '<line x1="4" y1="12" x2="20" y2="12"></line>'+
                                  '<line x1="4" y1="18" x2="16" y2="18"></line>'+
                                  '</svg>'+
                              '</a>'+
                              '<div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">';
                              if(user.oficina=="Caja"){
                                res+='<a href="javascript:void(0);" class="dropdown-item"  onclick="recepcionar('+full.id+');">Recepcionar</a>'+
                                    '<a href="javascript:void(0);" class="dropdown-item"  onclick="derivar(2,'+full.id+');">Derivar a Tributos</a>'+
                                      '<a href="javascript:void(0);" class="dropdown-item"  onclick="derivar(3,'+full.id+');">Derivar a Archivo de tesoreria</a>'+
                                    '</div>'+
                                  '</div></div>';
                              }
                              else {
                                if(user.oficina=="Tributos"){                              
                                  res+='<a href="javascript:void(0);" class="dropdown-item"  onclick="recepcionar('+full.id+');">Recepcionar</a>'+
                                      '<a href="javascript:void(0);" class="dropdown-item" onclick="derivar(1,'+full.id+');">Derivar a Caja</a>'+
                                      '<a href="javascript:void(0);" class="dropdown-item"  onclick="derivar(3,'+full.id+');">Derivar a Archivo de tesoreria</a>'+
                                    '</div>'+
                                  '</div></div>';}
                                  else{                      
                                    res+='<a href="javascript:void(0);" class="dropdown-item"  onclick="recepcionar('+full.id+');">Recepcionar</a>'+
                                      '<a href="javascript:void(0);" class="dropdown-item" onclick="derivar(1,'+full.id+');">Derivar a Caja</a>'+
                                      '<a href="javascript:void(0);" class="dropdown-item"  onclick="derivar(2,'+full.id+');">Derivar a Tributos</a>'+
                                    '</div>'+
                                  '</div></div>';
                                  }
                                }
                                return res;
                            }
                  }                                                                
          ],
          language: {
              processing:     "Traitement en cours...",
              search:         "Buscar",
              lengthMenu:     "Mostrar _MENU_ registros",
              info:           "Mostrar de _START_ a _END_ de _TOTAL_ registros",
              infoEmpty:      "0 registros",
              infoFiltered:   "(Buscado en _MAX_ Registros en total)",
              infoPostFix:    "",
              loadingRecords: "Chargement en cours...",
              zeroRecords:    "No se encontraron Registros",
              emptyTable:     "No se encontraron registros",
              paginate: {
                  first:      "Primero",
                  previous:   "Antes",
                  next:       "Siguiente",
                  last:       "Ultima"
              },
              aria: {
                  sortAscending:  ": activer pour trier la colonne par ordre croissant",
                  sortDescending: ": activer pour trier la colonne par ordre décroissant"
              }
          }
      })
  })
</script>

@endsection
@section('nombre') GARANTIAS @endsection
@section('content')
<div class="col-12  py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">                
                <div class="card">
                  @if(Auth::user()->tipo_id=="1" || Auth::user()->oficina=="Garantias")
                    <div class="card-header">
                      <div class="col-6 col-sm-4 col-md-2 py-3">
                        <div class="btn-list" style="float: left; margin-right: 10px;">
                              <a href="#" class="btn" data-bs-toggle="modal" data-bs-target="#modal-report" onclick="limpiarform()">
                                  Nueva garantia
                              </a>
                        </div>
                      </div>                     
                    </div>                     
                  @endif
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="t_gastos" class="table card-table table-vcenter text-nowrap datatable"style="padding-top: 20px;">
                            <thead>
                                <tr>
                                <th>Fecha derivado</th>
                                <th>SIAF- Ingreso</th>
                                <th>O/C- O/S</th>
                                <th>Proveedor</th>
                                <th>Voucher</th>
                                <th>Concepto de registro</th>
                                <th>Siaf- Contrato</th>
                                <th>Fecha</th>
                                <th>Monto</th>
                                <th>Mes</th>
                                <th>Recibo</th>
                                <th>Estado</th>
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
@endsection
