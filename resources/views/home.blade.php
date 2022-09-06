@extends('layouts.plantilla')

@section('css') Gastos @endsection
@section('jss') 
    <script src="{{ asset('/libs/js/tabler.min.js') }}"></script>
    <script src="{{ asset('/libs/js/demo.min.js') }}"></script>
    <script src="{{ asset('/js/cuentas.js') }}"></script>
@endsection
@section('nombre') Gastos @endsection
@section('content')

<div class="col-12  py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">                
                    <div class="card">
                        <div class="card-header"><div class="col-6 col-sm-4 col-md-2 py-3">
                        <a href="#" class="btn" data-bs-toggle="modal" data-bs-target="#modal-report">
                            Nuevo
                        </a>
                        </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="t_gastos" class="table table-vcenter card-table">
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
@endsection
