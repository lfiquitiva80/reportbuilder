@extends('dashboard.base')

@section('content')


 <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
                  <a href="{{ route('builder.create') }}" class="btn btn-primary m-2">Crear Consulta Personalizada</a>
              <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                      <i class="fa fa-align-justify"></i>QUERY PERSONALIZADOS </strong></div>
                    <div class="card-body">
                        <div class="row"> 
                              
                          <!-- <a href="{{ route('query.create') }}" class="btn btn-primary m-2">{{ __('Add Note') }}</a> -->
                        </div>
                        <br>

                  
                        <table class="table table-responsive-sm table-striped">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Dependencia</th>
                            <th>Consulta</th>
                            <th>Nombre de la Consulta</th>
                            <th>Usuario</th>                            
                            <th>Creado en:</th>
                            <th>Modificado en:</th>
                            <th>Descargar en Excel</th>
                            <th></th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($builders as $query)
                            <tr>
                              <td>{{ $query->id }}</td>
                              <td>{{ $query->Dependencia }}</td>
                              <td>{{ $query->Consulta }}</td>
                              <td>{{ $query->NombreConsulta }}</td>
                              <td>{{ $query->User_id }}</td>
                              <td>{{ $query->created_at }}</td>
                              <td>{{ $query->updated_at }}</td>

                         
                                
                              
                              <td>
                                <a href="{{ route('consultaexcel', [$query->id]) }}" class="btn btn-success">Excel</a>
                              </td>
                              
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
               
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>

@endsection


@section('javascript')

@endsection