@extends('layouts.plantilla')

@section('css') 
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="{{asset('/css/garantia.css')}}">
@endsection
@section('jss') 
<script src="http://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>  
<script src="{{asset('/js/garantia.js')}}"></script>  
<script>
  var tabla;
  var user={!!Auth::user()!!};
  $(document).ready(function(){
      tabla= $('#t_gastos').DataTable({
          processing: true,
          serverSider: true,
          ajax:'{!!route("listagarantia")!!}',
          "columns":[
            {"data":null,"orderable": false, "searchable": false,
                  render: function ( data, type, full ) {                                         
                    var fecha=full.created_at; 
                    var temp=fecha.substr(0,10); 
                    return   temp;                
                  }                                        
            },{"data":'exp_siaf'},
            {"data":'oc_os'},
            {"data":'proveedor'},
            {"data":'voucher'},
            {"data":'siaf'},
            {"data":'registro'},
            {"data":'monto'},
            {"data":'mes'},
            {"data":'recibo'},
            {"data":null,"orderable": false, "searchable": false,
                  render: function ( data, type, full ) {                         
                    if(full.estado=="1")
                      return "<p style='color: green;'>Ingreso</p>";
                    else
                      return "<p style='color: red;'>Devuelto</p>";
                  }                                        
            },
            {"data":null,"orderable": false, "searchable": false,
                  render: function ( data, type, full ) {     
                    if(user['tipo_id']=="1"){ 
                      var res ='<div class="btn-list flex-nowrap">';
                      if(full.estado=="0"){
                        res +='<button class="btn btn-white btn-icon" onclick="modificar('+full.id+');" title="MODIFICAR GARANTIA"  data-bs-toggle="modal" data-bs-target="#modal-report"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3"></path><path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3"></path><line x1="16" y1="5" x2="19" y2="8"></line></svg></button>'+
                        '<button class="btn btn-white btn-icon" onclick="modificarDevolucion('+full.devoluciones[0].id+');" title="Ver"  data-bs-toggle="modal" data-bs-target="#modal-devolucion"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="12" cy="12" r="2"></circle><path d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7"></path></svg></button></div>';
                        //'<button class="btn btn-danger btn-icon" onclick="eliminar('+full.id+');" title="ELIMINAR"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="4" y1="7" x2="20" y2="7"></line><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path></svg></button></div>';
                      }   
                      else{                                 
                          res +='<button class="btn btn-white btn-icon" onclick="modificar('+full.id+');" title="MODIFICAR GARANTIA"  data-bs-toggle="modal" data-bs-target="#modal-report"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3"></path><path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3"></path><line x1="16" y1="5" x2="19" y2="8"></line></svg></button>'+
                          '<button class="btn btn-green btn-icon" onclick="agregar('+full.id+');" title="AGREGAR GIRO" data-bs-toggle="modal" data-bs-target="#modal-devolucion" ><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-align-justified" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="4" y1="6" x2="20" y2="6"></line><line x1="4" y1="12" x2="20" y2="12"></line><line x1="4" y1="18" x2="16" y2="18"></line></svg></button>'+
                          '<button class="btn btn-danger btn-icon" onclick="eliminar('+full.id+');" title="ELIMINAR"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="4" y1="7" x2="20" y2="7"></line><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path></svg></button></div>';
                      }
                      return res;

                    } 
                    else{ //return "usuario";                      
                      if(user['oficina']=="Devoluciones"){                    
                        var res ='<div class="btn-list flex-nowrap">';
                          if(full.estado=="0"){
                            res +='<div class="btn-list flex-nowrap">'+
                            '<button class="btn btn-white btn-icon" onclick="modificarDevolucion('+full.devoluciones[0].id+');" title="MODIFICAR"  data-bs-toggle="modal" data-bs-target="#modal-devolucion"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3"></path><path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3"></path><line x1="16" y1="5" x2="19" y2="8"></line></svg></button></div>';
                            //'<button class="btn btn-danger btn-icon" onclick="eliminar('+full.id+');" title="ELIMINAR"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="4" y1="7" x2="20" y2="7"></line><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path></svg></button></div>';
                          }   
                          else{                                 
                            res +='<div class="btn-list flex-nowrap">'+
                              //'<button class="btn btn-white btn-icon" onclick="modificar('+full.id+');" title="MODIFICAR"  data-bs-toggle="modal" data-bs-target="#modal-report"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3"></path><path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3"></path><line x1="16" y1="5" x2="19" y2="8"></line></svg></button>'+
                              '<button class="btn btn-green btn-icon" onclick="agregar('+full.id+');" title="AGREGAR" data-bs-toggle="modal" data-bs-target="#modal-devolucion" ><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-align-justified" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="4" y1="6" x2="20" y2="6"></line><line x1="4" y1="12" x2="20" y2="12"></line><line x1="4" y1="18" x2="16" y2="18"></line></svg></button></div>';
                              //'<button class="btn btn-danger btn-icon" onclick="eliminar('+full.id+');" title="ELIMINAR"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="4" y1="7" x2="20" y2="7"></line><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path></svg></button></div>';
                          }

                          //'<button class="btn btn-white btn-icon" onclick="modificar('+full.id+');" title="MODIFICAR"  data-bs-toggle="modal" data-bs-target="#modal-report"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3"></path><path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3"></path><line x1="16" y1="5" x2="19" y2="8"></line></svg></button>'+
                          //'<button class="btn btn-green btn-icon" onclick="agregar('+full.id+');" title="AGREGAR" data-bs-toggle="modal" data-bs-target="#modal-devolucion" ><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-align-justified" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="4" y1="6" x2="20" y2="6"></line><line x1="4" y1="12" x2="20" y2="12"></line><line x1="4" y1="18" x2="16" y2="18"></line></svg></button>';
                          //'<button class="btn btn-danger btn-icon" onclick="eliminar('+full.id+');" title="ELIMINAR"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="4" y1="7" x2="20" y2="7"></line><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path></svg></button></div>';
                        return res;
                      }
                      else{
                        var res ='<div class="btn-list flex-nowrap">';
                        if(full.estado=="0"){                        
                          res+='<button class="btn btn-white btn-icon" onclick="modificar('+full.id+');" title="MODIFICAR"  data-bs-toggle="modal" data-bs-target="#modal-report"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3"></path><path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3"></path><line x1="16" y1="5" x2="19" y2="8"></line></svg></button>'+
                          '<button class="btn btn-white btn-icon" onclick="modificarDevolucion('+full.devoluciones[0].id+');" title="Ver"  data-bs-toggle="modal" data-bs-target="#modal-devolucion"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="12" cy="12" r="2"></circle><path d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7"></path></svg></button></div>';
                          //'<button class="btn btn-danger btn-icon" onclick="eliminar('+full.id+');" title="ELIMINAR"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="4" y1="7" x2="20" y2="7"></line><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path></svg></button></div>';
                        }   
                        else{                                 
                          res +='<div class="btn-list flex-nowrap">'+
                            '<button class="btn btn-white btn-icon" onclick="modificar('+full.id+');" title="MODIFICAR"  data-bs-toggle="modal" data-bs-target="#modal-report"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3"></path><path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3"></path><line x1="16" y1="5" x2="19" y2="8"></line></svg></button>'+
                            //'<button class="btn btn-green btn-icon" onclick="agregar('+full.id+');" title="AGREGAR" data-bs-toggle="modal" data-bs-target="#modal-devolucion" ><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-align-justified" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="4" y1="6" x2="20" y2="6"></line><line x1="4" y1="12" x2="20" y2="12"></line><line x1="4" y1="18" x2="16" y2="18"></line></svg></button>'+
                            '<button class="btn btn-danger btn-icon" onclick="eliminar('+full.id+');" title="ELIMINAR"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="4" y1="7" x2="20" y2="7"></line><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path></svg></button></div>';
                        }
                        return res;
                      }
                    } 
                  }                                        
            }             
          ],
          language: {
              processing:     "Traitement en cours...",
              search:         "Buscar",
              lengthMenu:     "Mostrar _MENU_ registros",
              info:           "Mostrar de _START_ a _END_ de _TOTAL_ registros",
              infoEmpty:      "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
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
                                <th>Fecha</th>
                                <th>Exp. SIAF</th>
                                <th>O/C- O/S</th>
                                <th>Proveedor</th>
                                <th>Voucher</th>
                                <th>Exp. SIAF</th>
                                <th>Concepto de registro</th>
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
  <div class="modal modal-blur fade" id="modal-devolucion" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Devolución</h5>
        </div>
        <div  id="form_gasto" class="modal-body" >
          @csrf
          <input type="hidden" id="garantia_id">
          <input type="hidden" id="id">
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group mb-3">
                <label class="form-label">Nro<span id="mensajeSiaf" class="form-required"></span><span class="form-required">*</span></label>
                <input type="text" class="form-control mayuscula" id="nro" name="example-text-input" placeholder="" disabled>
              </div>
              <div class="form-group mb-3">
                <label class="form-label">Reg. SIAF<span class="form-required">*</span></label>
                <input type="text" class="form-control mayuscula" id="siafDevolucion" name="example-text-input" placeholder="" >
              </div>
              <div class="form-group mb-3">
                <label class="form-label">Periodo<span class="form-required">*</span></label>
                <input type="text" class="form-control mayuscula" id="periodo" name="example-text-input" placeholder="">
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group mb-3">
                <label class="form-label">Nro Cheque<span class="form-required">*</span></label>
                <input type="text" class="form-control mayuscula" id="cheque" name="example-text-input" placeholder="">
              </div>
              <div class="form-group mb-3">
                <label class="form-label">Monto<span class="form-required">*</span></label>
                <input type="text" class="form-control mayuscula" id="montoDevolucion" name="example-text-input" placeholder="">
              </div>
              <div class="form-group mb-3">
                <label class="form-label">Observacion</label>
                <textarea  class="form-control mayuscula"name="observacion" id="observacion" cols="30" rows="4"></textarea>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
            Cancelar
          </a>
          @if(Auth::user()->tipo_id == '1' || Auth::user()->oficina == 'Devoluciones')
            <a href="#" class="btn btn-primary ms-auto" id="btnActualizarDevolucion"  onclick="activarForm()">
              <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
              Actualizar
            </a>
            <a href="#" class="btn btn-primary ms-auto" onclick="guardarDevolucion()" id="btnGuardarDevolucion" style="display:none">
              <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
              Guardar 
            </a>          
          @endif          
        </div>
      </div>
    </div>
  </div>
  <div class="modal modal-blur fade" id="modal-report" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Nueva/Actualizar garantia</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div  id="form_garantia" class="modal-body">
          @csrf
          <div class="row">
            <div class="col lg-6">
              <div class="form-group mb-3">
                <label class="form-label">Exp. SiAF</span></label>
                <input type="text" class="form-control mayuscula" id="exp_siaf" name="example-text-input" placeholder="" >
              </div>
              <div class="form-group mb-3">
                <label class="form-label">O/C - O/S<span class="form-required">*</span></label>
                <input type="text" class="form-control mayuscula" id="oc_os" name="example-text-input" placeholder="">
              </div>
              <div class="form-group mb-3">
                <label class="form-label">Proveerdor<span class="form-required">*</span></label>
                <input type="text" class="form-control mayuscula" id="proveedor" name="example-text-input" placeholder="">
              </div>
              <div class="form-group mb-3">
                <label class="form-label">Nro Voucher<span class="form-required">*</span></label>
                <input type="text" class="form-control mayuscula" id="voucher" name="example-text-input" placeholder="">
              </div>
              <div class="form-group mb-3">
                <label class="form-label">Recibo<span class="form-required">*</span></label>
                <input type="text" class="form-control mayuscula" id="recibo" name="example-text-input" placeholder="">
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group mb-3">
                <label class="form-label">Exp. SIAF<span class="form-required">*</span></label>
                <input type="text" class="form-control mayuscula" id="siaf" name="example-text-input" placeholder="">
              </div>
              <div class="form-group mb-3">
                <label class="form-label">Concepto de registro<span class="form-required">*</span></label>
                <input type="text" class="form-control mayuscula" id="registro" name="example-text-input" placeholder="">
              </div>
              <div class="form-group mb-3">
                <label class="form-label">Monto<span class="form-required">*</span></label>
                <input type="text" class="form-control mayuscula" id="monto" name="example-text-input" placeholder="">
              </div>
              <div class="form-group mb-3">
                <label class="form-label">Mes</label>
                <select id="mes" class="form-control">
                  <option value="0">Selecione mes</option>
                  <option value="Enero">Enero</option>
                  <option value="Febreo">Febreo</option>
                  <option value="Marzo">Marzo</option>
                  <option value="Abril">Abril</option>
                  <option value="Mayo">Mayo</option>
                  <option value="Junio">Junio</option>
                  <option value="Julio">Julio</option>
                  <option value="Agosto">Agosto</option>
                  <option value="Setiembre">Setiembre</option>
                  <option value="Octubre">Octubre</option>
                  <option value="Noviembre">Noviembre</option>
                  <option value="Diciembre">Diciembre</option>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
            Cancelar
          </a>
          <a href="#" class="btn btn-primary ms-auto" onclick="guardarCuenta()">
            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
            Guardar
          </a>
        </div>
      </div>
    </div>
  </div>
@endsection
