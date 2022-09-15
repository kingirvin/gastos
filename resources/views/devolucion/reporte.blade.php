@extends('layouts.plantilla')

@section('css') 
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="{{asset('/css/garantia.css')}}">
@endsection
@section('jss') 
<script src="http://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script> 
<script src="{{asset('/libs/litepicker/dist/litepicker.js')}}"></script> 
<script src="{{asset('/js/reprote.js')}}"></script>  
<script>
    // @formatter:off
    document.addEventListener("DOMContentLoaded", function () {
    	window.Litepicker && (new Litepicker({
    		element: document.getElementById('datepicker-inicio'),
    		buttonText: {
    			previousMonth: `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-left -->
    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="15 6 9 12 15 18" /></svg>`,
    			nextMonth: `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-right -->
    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="9 6 15 12 9 18" /></svg>`,
    		},
    	}));
    });
    // @formatter:on
</script>
<script>
    // @formatter:off
    document.addEventListener("DOMContentLoaded", function () {
    	window.Litepicker && (new Litepicker({
    		element: document.getElementById('datepicker-fin'),
    		buttonText: {
    			previousMonth: `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-left -->
    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="15 6 9 12 15 18" /></svg>`,
    			nextMonth: `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-right -->
    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="9 6 15 12 9 18" /></svg>`,
    		},
    	}));
    });
    // @formatter:on
  </script>
<script>
  var tabla;
  var user={!!Auth::user()!!};
  var reporte='{!!$menu!!}'
  $(document).ready(function(){
    
    var datastring = {
        inicio:document.getElementById('datepicker-inicio').value,
        fin:document.getElementById('datepicker-fin').value,
        };
      tabla= $('#t_gastos').DataTable({
        //serverSide: true,
          processing: true,
          serverSider: true,
          ajax: {
            url:  reporte=="Reporte garantia" ? "/json/garantias/reporteBuscar": "/json/devolucion/reporteBuscar",
            type: 'POST',
            data: datastring,     
            },
            "columns":[
                {"data":null,"orderable": false, "searchable": false,
                    render: function ( data, type, full ) {                      
                        var fecha=full.created_at; 
                        var temp=fecha.substr(0,10); 
                        return   temp;                
                    }                                        
                },
                
              {"data":'nro'},
              {"data":'reg_siaf'},
              {"data":'periodo'},
              {"data":'cheque'},
              {"data":'monto'},
              {"data":'observacion'},
            ],
            language: {
              processing:     "Traitement en cours...",
              search:         "Buscar",
              lengthMenu:     "Mostrar _MENU_ registros",
              info:           "Mostrar de _START_ a _END_ de _TOTAL_ registros",
              infoEmpty:      "sds de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
              infoFiltered:   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
              infoPostFix:    "",
              loadingRecords: "Chargement en cours...",
              zeroRecords:    "Aucun &eacute;l&eacute;ment &agrave; afficher",
              emptyTable:     "Aucune donnée disponible dans le tableau",
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
                    <div class="card-body">                       
                        <div class="row">   
                            <div class="col-12">
                                <div class="btn-list" style="float: left; margin-right: 10px;">
                                    <a href="javascript:void(0)" class="btn" onclick="verPdf(1);">
                                        Ver pdf
                                    </a>
                                </div>
                            </div> 
                            <div class="col-12"> 
                                <div class="row">
                                    <div class="col-4">           
                                        <div class="mb-3">
                                            <label class="form-label">Inicio</label>                                
                                            <div class="input-icon">
                                                <span class="input-icon-addon"><!-- Download SVG icon from http://tabler-icons.io/i/calendar -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="4" y="5" width="16" height="16" rx="2" /><line x1="16" y1="3" x2="16" y2="7" /><line x1="8" y1="3" x2="8" y2="7" /><line x1="4" y1="11" x2="20" y2="11" /><line x1="11" y1="15" x2="12" y2="15" /><line x1="12" y1="15" x2="12" y2="18" /></svg>
                                                </span>
                                                <input class="form-control" placeholder="Select a date" id="datepicker-inicio" value="{{$year}}-01-01"/>
                                            </div>
                                        </div>  

                                    </div>              
                                    <div class="col-4">            
                                        <div class="mb-3">
                                            <label class="form-label">Fin</label>                                
                                            <div class="input-icon">
                                                <span class="input-icon-addon"><!-- Download SVG icon from http://tabler-icons.io/i/calendar -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="4" y="5" width="16" height="16" rx="2" /><line x1="16" y1="3" x2="16" y2="7" /><line x1="8" y1="3" x2="8" y2="7" /><line x1="4" y1="11" x2="20" y2="11" /><line x1="11" y1="15" x2="12" y2="15" /><line x1="12" y1="15" x2="12" y2="18" /></svg>
                                                </span>
                                                <input class="form-control" placeholder="Select a date" id="datepicker-fin" value="{{$hoy}}"/>
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="col-2" style="padding-top: 1.7rem !important;">
                                        <a href="javascript:void(0)" class="btn btn-outline-success w-100" onclick="actualizarTabla()">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-search" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="10" cy="10" r="7"></circle><line x1="21" y1="21" x2="15" y2="15"></line></svg>
                                            Buscar
                                        </a>
                                    </div>
                                    <div class="col-2" style="padding-top: 1.7rem !important;">
                                        <a href="#" class="btn btn-outline-danger w-100" onclick="restaurar()">
                                            Limpiar
                                        </a>
                                    </div>
                                </div>
                            </div>       
                        </div>                          
                    </div>                
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="t_gastos" class="table card-table table-vcenter text-nowrap datatable"style="padding-top: 20px;">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Nro C/P</th>
                                    <th>Reg. SIAF</th>
                                    <th>Periodo</th>
                                    <th>Nro Cheque</th>
                                    <th>Monto</th>
                                    <th>Observaciòn</th>
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
