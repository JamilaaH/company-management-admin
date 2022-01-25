@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Mon Compte</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
  
              <!-- Profile Image -->
              <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                  <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle" src="https://cdn3.iconfinder.com/data/icons/vector-icons-6/96/256-512.png" alt="User profile picture">
                  </div>
  
                  <h3 class="profile-username text-center">{{Auth::user()->nom}}</h3>
  
                  <p class="text-muted text-center">Administrateur</p>
  
                  <a href="{{route('profil.edit')}}" class="btn btn-primary btn-block"><b>Edit</b></a>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
  
              <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
              <div class="card">
                <div class="card-body">
                    <div>
                      <form class="form-horizontal">
                        <div class="form-group row">
                          <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                          <div class="col-sm-10">
                            <input type="text" disabled class="form-control" id="inputName" value="{{Auth::user()->nom}}" placeholder="Name">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                          <div class="col-sm-10">
                            <input type="email" disabled class="form-control" id="inputEmail" value="{{Auth::user()->email}}" placeholder="Email">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputName2" class="col-sm-2 col-form-label">Mot de passe</label>
                          <div class="col-sm-10">
                            <input type="password" disabled class="form-control" id="inputName2"  value="{{Auth::user()->password}}"placeholder="Name">
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
