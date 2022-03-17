@extends('dashboard.base')

@section('content')


<div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
                  <a href="{{ route('builder.index') }}" class="btn btn-primary m-2">Regresar</a>
              <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                      <i class="fa fa-align-justify"></i>CREAR CONSULTA </strong></div>
                    <div class="card-body">
                        <div class="row"> 
                              
                           </div>
                        <br>

                             <div class="row">
                <div class="col-md-12">
                  <div class="card">
                    <div class="card-header"><strong>Builder</strong> de Queries</div>
                    <div class="card-body">
                     {!! Form::open(['route' => 'builder.store', 'method'=>'POST']) !!}
                        <div class="form-group row">
                          <label class="col-md-3 col-form-label"></label>
                          <div class="col-md-9">
                            <p class="form-control-static"></p>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-md-3 col-form-label" for="text-input">Seleccione la Dependencia</label>
                          <div class="col-md-9">
                           
                             {!! Form::select('Dependencia',$dependence, 105 , ['class' => 'form-control ','name'=>'Dependencia','placeholder'=>'Seleccione...']) !!}    

                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-md-3 col-form-label" for="text-input">Nombre de la Consulta</label>
                          <div class="col-md-9">
                            <input class="form-control" id="text-input" type="text" name="NombreConsulta" placeholder="Digite el nombre de la consulta"><span class="help-block">This is a help text</span>
                          </div>
                        </div>
                        
                        <div class="form-group row">
                          <label class="col-md-3 col-form-label" for="textarea-input">SQL</label>
                          <div class="col-md-9">
                            <textarea class="form-control" id="textarea-input" name="Consulta" rows="9" placeholder="Copie la consulta del Query en su Excel"></textarea>
                          </div>
                        </div>
                        
                        <input type="hidden" name="User_id" id="inputUser_id" class="form-control" value="{{\Auth::id()}}">
                          <div class="card-footer">
                      <button class="btn btn-sm btn-success" type="submit"> Submit</button>
                      <button class="btn btn-sm btn-danger" type="reset"> Reset</button>
                    </div>
              
               
                    </div>
                </div>
              </div>
            </div>
            {!! Form::close() !!}   
          </div>
        </div>


@endsection


@section('javascript')

@endsection