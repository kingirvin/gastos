@extends('layouts.plantilla')

@section('css') Gastos @endsection
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">

@section('jss') 
<script src="http://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>  
<script src="{{asset('/js/gasto.js')}}"></script>  
<script>
  var tabla;
  $(document).ready(function(){
      tabla= $('#t_gastos').DataTable({
          processing: true,
          serverSider: true,
          ajax:'{!!route("listaGastos")!!}',
          columns:[
              {data:'nro',name:'nro'},
              {data:'siaf',name:'siaf'},
              {data:'periodo',name:'periodo'},
              {data:'cheque',name:'cheque'},
              {data:'monto',name:'monto'},
              {data:'estado',name:'estado'},
              {data:'observacion',name:'observacion'},
          ]
      })
  })
</script>

@endsection
@section('nombre') Gastos @endsection
@section('content')
<div class="col-12  py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">                
                    <div class="card">
                        <div class="card-header"><div class="col-6 col-sm-4 col-md-2 py-3">
                            <div class="btn-list">
                                <a href="#" class="btn" data-bs-toggle="modal" data-bs-target="#modal-report">
                                   Nuevo Gasto
                                </a>
                            </div>
                        </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="t_gastos" class="table card-table table-vcenter text-nowrap datatable"style="padding-top: 20px;">
                                    <thead>
                                        <tr>
                                        <th>Nro C/P</th>
                                        <th>Reg. SIAF</th>
                                        <th>Periodo</th>
                                        <th>Nro Cheque</th>
                                        <th>Monto</th>
                                        <th>Estado</th>
                                        <th>Observaci??n</th>
                                        <th class="w-1"></th>
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
  <div class="modal modal-blur fade" id="modal-report" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Nuevo gasto</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div  id="form_gasto" class="modal-body">
          @csrf

          <div class="form-group mb-3">
            <label class="form-label">Nro<span class="form-required">*</span></label>
            <input type="text" class="form-control mayuscula" id="nro" name="example-text-input" placeholder="">
          </div>
          <div class="form-group mb-3">
            <label class="form-label">Reg. SIAF<span class="form-required">*</span></label>
            <input type="text" class="form-control mayuscula" id="siaf" name="example-text-input" placeholder="">
          </div>
          <div class="form-group mb-3">
            <label class="form-label">Periodo<span class="form-required">*</span></label>
            <input type="text" class="form-control mayuscula" id="periodo" name="example-text-input" placeholder="">
          </div>
          <div class="form-group mb-3">
            <label class="form-label">Nro Cheque<span class="form-required">*</span></label>
            <input type="text" class="form-control mayuscula" id="cheque" name="example-text-input" placeholder="">
          </div>
          <div class="form-group mb-3">
            <label class="form-label">Monto<span class="form-required">*</span></label>
            <input type="text" class="form-control mayuscula" id="monto" name="example-text-input" placeholder="">
          </div>
          <div class="form-group mb-3">
            <label class="form-label">Observacion</label>
            <textarea  class="form-control mayuscula"name="observacion" id="observacion" cols="30" rows="4"></textarea>
          </div>
          <div class="form-group mb-3">
            <label class="form-label">Estado</label>
            <select id="estado" class="form-control">
              <option value="">Indique estado</option>
              <option value="0">estado uno</option>
              <option value="1">estado dos</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
            Cancelar
          </a>
          <a href="#" class="btn btn-primary ms-auto" onclick="guardarGasto()">
            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
            Guardar gasto
          </a>
        </div>
      </div>
    </div>
  </div>
@endsection
