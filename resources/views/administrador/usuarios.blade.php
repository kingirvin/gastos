@extends('layouts.plantilla')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
@endsection
@section('jss') 
<script src="http://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>  
<script src="{{asset('/js/usuario.js')}}"></script>  
<script>
  var tabla;
  $(document).ready(function(){
      tabla= $('#t_usuario').DataTable({
          processing: true,
          serverSider: true,
          ajax:'{!!route("listaUsuarios")!!}', 
          columns:[
              {data:'name'},
              {data:'apaterno'},
              {data:'oficina'},
              {"data":null,"orderable": false, "searchable": false,
                  render: function ( data, type, full ) {                         
                    if(full.estado=="1"){
                      var res ='<div class="btn-list flex-nowrap">'+
                        '<a style="color: green;" onclick="estado('+full.id+');" title="CAMBIAR"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-toggle-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="8" cy="12" r="2"></circle><rect x="2" y="6" width="20" height="12" rx="6"></rect></svg></a>';
                      return res;
                    }
                    else{
                      var res ='<div class="btn-list flex-nowrap">'+
                        '<a style="color: red;" onclick="estado('+full.id+');" title="CAMBIAR"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-toggle-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="8" cy="12" r="2"></circle><rect x="2" y="6" width="20" height="12" rx="6"></rect></svg></a>';
                    return res;
                    }
                  }                                        
              },
            {"data":null,"orderable": false, "searchable": false,
                  render: function ( data, type, full ) {                        
                      var res ='<div class="btn-list flex-nowrap">'+
                        '<button class="btn btn-white btn-icon" onclick="modificar('+full.id+');" title="MODIFICAR"  data-bs-toggle="modal" data-bs-target="#modal-report"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3"></path><path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3"></path><line x1="16" y1="5" x2="19" y2="8"></line></svg></button>'+
                        '<button class="btn btn-danger btn-icon" onclick="eliminar('+full.id+');" title="ELIMINAR"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="4" y1="7" x2="20" y2="7"></line><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path></svg></button></div>';
                      return res;                             
              }  
            }
          ],
          language: {
              processing:     "Traitement en cours...",
              search:         "Buscar",
              lengthMenu:     "Mostrar _MENU_ usuarios",
              info:           "Mostrar de _START_ a _END_ de _TOTAL_ usuarios",
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
@section('nombre') Usuarios @endsection
@section('content')
<div class="col-12  py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">                
                    <div class="card">
                        <div class="card-header"><div class="col-6 col-sm-4 col-md-2 py-3">
                            <div class="btn-list">
                                <a href="#" class="btn" data-bs-toggle="modal" data-bs-target="#modal-usuario">
                                   Nuevo usuario
                                </a>
                            </div>
                        </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="t_usuario" class="table card-table table-vcenter text-nowrap datatable"style="padding-top: 20px;">
                                    <thead>
                                        <tr>
                                        <th>Nombre</th>
                                        <th>Apellidos</th>
                                        <th>Oficina</th>
                                        <th>Estado</th>
                                        <th class="w-1">Opciones</th>
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

  <div class="modal modal-blur fade" id="modal-usuario" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Nuevo Usuario</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div  id="form_usuario" class="modal-body">
          @csrf
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group mb-3">
                <label class="form-label">Nombre<span class="form-required">*</span></label>
                <input type="text" class="form-control mayuscula" id="nombre" name="example-text-input" placeholder="">
              </div>
              <div class="form-group mb-3">
                <label class="form-label">Apellido paterno<span class="form-required">*</span></label>
                <input type="text" class="form-control mayuscula" id="apaterno" name="example-text-input" placeholder="">
              </div>
              <div class="form-group mb-3">
                <label class="form-label">Apellido materno<span class="form-required">*</span></label>
                <input type="text" class="form-control mayuscula" id="amaterno" name="example-text-input" placeholder="">
              </div>
              <div class="form-group mb-3">
                <label class="form-label">Telefono<span class="form-required">*</span></label>
                <input type="text" class="form-control mayuscula" id="telefono" name="example-text-input" placeholder="">
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group mb-3">
                <label class="form-label">Oficina</label>
                <select id="oficina" class="form-control">
                  <option value="">Selecione oficina</option>
                  <option value="Garantias">Garantias</option>
                  <option value="Devoluciones">Devoluciones</option>
                </select>
              </div>
              <div class="form-group mb-3">
                <label class="form-label">Tipo usuario</label>
                <select id="tipo_id" class="form-control">
                  <option value="">Selecione </option>
                  <option value="1">Administrador</option>
                  <option value="2">Usuario</option>
                </select>
              </div>
              <div class="form-group mb-3">
                <label class="form-label">Correo electronico<span class="form-required">*</span></label>
                <input type="text" class="form-control" id="email" placeholder="">
              </div>
              <div class="form-group mb-3">
                  <label class="form-label">Contraseña <span class="form-required">*</span></label>
                  <input id="password" type="password" class="form-control validar_minimo:8">
              </div>             
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
            Cancelar
          </a>
          <a href="#" class="btn btn-primary ms-auto" onclick="guardarUsuario()">
            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
            Guardar
          </a>
        </div>
      </div>
    </div>
  </div>
@endsection
