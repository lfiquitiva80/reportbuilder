@extends('dashboard.base')

@section('content')

        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                      <i class="fa fa-align-justify"></i>QUERIES DE DUQUESA | Total de Vistas | (<strong>{{$queries->count()}}</strong>)</div>
                    <div class="card-body">
                        <div class="row"> 
                              
                          <!-- <a href="{{ route('query.create') }}" class="btn btn-primary m-2">{{ __('Add Note') }}</a> -->
                        </div>
                        <br>

                          {!! Form::open(['route' => 'query.index', 'method'=>'GET', 'Class'=>'form-inline ']) !!}
            <!--<form class="navbar-form navbar-right" role="search">-->
                <div class="form-group">
                    <input type="text"  placeholder="Search" name="nombre" id="nombre">
                </div>&nbsp&nbsp
                <button type="submit" class="btn btn-info m-2"><i class="fas fa-search"></i> Consultar por Vista</button>
                {!! Form::close() !!}
                       
                        <table class="table table-responsive-sm table-striped">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Nombre de la Vista</th>
                            <th>Tipo</th>
                            <th>Creado en:</th>
                            <th>Modificado en:</th>
                            <th>Descargar en Excel</th>
                            <th></th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($queries as $query)
                            <tr>
                              <td><strong>{{ $query->object_id }}</strong></td>
                              <td><strong>{{ $query->name }}</strong></td>
                              <td><strong>{{ $query->type_desc }}</strong></td>
                              <td><strong>{{ $query->create_date }}</strong></td>
                              <td><strong>{{ $query->modify_date }}</strong></td>
                              

                         
                                
                              
                              <td>
                                <a href="{{ route('exportexcel', ['vista'=>$query->name]) }}" class="btn btn-success">Excel</a>
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
