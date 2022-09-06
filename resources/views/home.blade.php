@extends('layouts.plantilla')

@section('css') Gastos @endsection
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">

@section('jss') 
<script src="http://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>  

   <script>
        $(document).ready(function(){
            $('#t_gastos').DataTable({
                processing: true,
                serverSider: true,
                ajax:'{!!route("listaGastos")!!}',
                columns:[
                    {data:'nro',name:'nro'},
                    {data:'siaf',name:'siaf'},
                    {data:'periodo',name:'periodo'},
                    {data:'cheque',name:'id'},
                    {data:'monto',name:'id'},
                    {data:'estado',name:'id'},
                    {data:'observacion',name:'id'},
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
                                <table id="t_gastos" class="table nowrap dataTable dtr-inline collapsed mt-4">
                                    <thead>
                                        <tr>
                                        <th>Nro C/P</th>
                                        <th>Reg. SIAF</th>
                                        <th>Periodo</th>
                                        <th>Nro Cheque</th>
                                        <th>Monto</th>
                                        <th>Estado</th>
                                        <th>Observaciòn</th>
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
          <h5 class="modal-title">New rehjkhport</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" class="form-control" name="example-text-input" placeholder="Your report name">
          </div>
          <label class="form-label">Report type</label>
          <div class="form-selectgroup-boxes row mb-3">
            <div class="col-lg-6">
              <label class="form-selectgroup-item">
                <input type="radio" name="report-type" value="1" class="form-selectgroup-input" checked>
                <span class="form-selectgroup-label d-flex align-items-center p-3">
                  <span class="me-3">
                    <span class="form-selectgroup-check"></span>
                  </span>
                  <span class="form-selectgroup-label-content">
                    <span class="form-selectgroup-title strong mb-1">Simple</span>
                    <span class="d-block text-muted">Provide only basic data needed for the report</span>
                  </span>
                </span>
              </label>
            </div>
            <div class="col-lg-6">
              <label class="form-selectgroup-item">
                <input type="radio" name="report-type" value="1" class="form-selectgroup-input">
                <span class="form-selectgroup-label d-flex align-items-center p-3">
                  <span class="me-3">
                    <span class="form-selectgroup-check"></span>
                  </span>
                  <span class="form-selectgroup-label-content">
                    <span class="form-selectgroup-title strong mb-1">Advanced</span>
                    <span class="d-block text-muted">Insert charts and additional advanced analyses to be inserted in the report</span>
                  </span>
                </span>
              </label>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-8">
              <div class="mb-3">
                <label class="form-label">Report url</label>
                <div class="input-group input-group-flat">
                  <span class="input-group-text">
                    https://tabler.io/reports/
                  </span>
                  <input type="text" class="form-control ps-0"  value="report-01" autocomplete="off">
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="mb-3">
                <label class="form-label">Visibility</label>
                <select class="form-select">
                  <option value="1" selected>Private</option>
                  <option value="2">Public</option>
                  <option value="3">Hidden</option>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
            Cancel
          </a>
          <a href="#" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
            Create new report
          </a>
        </div>
      </div>
    </div>
  </div>
@endsection
