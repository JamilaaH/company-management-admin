@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Modifier le profil</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 offset-md-2">
              <div class="card">
                <div class="card-body">
                    <div>
                      <form class="form-horizontal" action="{{route('profil.update')}}" method="POST">
                          @method('PUT')
                          @csrf
                        <div class="form-group row">
                          <label for="inputName" class="col-sm-2 col-form-label">Nom</label>
                          <div class="col-sm-10">
                            <input type="text" name="nom" class="form-control" id="inputName" value="{{Auth::user()->nom}}" >
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                          <div class="col-sm-10">
                            <input type="email" name="email" class="form-control" id="inputEmail" value="{{Auth::user()->email}}" >
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputName2" class="col-sm-2 col-form-label">Mot de passe</label>
                          <div class="col-sm-10">
                            <input type="password" name="password" class="form-control" id="inputName2"  value="{{Auth::user()->password}} ">
                          </div>
                        </div>

                        <div class="form-group row">
                          <div class="offset-sm-2 col-sm-10">
                            <button type="submit" class="btn btn-danger">Submit</button>
                          </div>
                        </div>
                      </form>
                    </div>
                    <!-- /.tab-pane -->
                  </div>
                  <!-- /.tab-content -->
                </div>
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
    </div>
@stop
