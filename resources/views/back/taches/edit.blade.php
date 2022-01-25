@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Modifier la tâche</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-6 offset-2">
            <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Tâche de {{$tache->entreprise->nom}}</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="post" action="{{route('tache.update', $tache->id)}}">
                    @method('PUT')
                    @csrf
                  <div class="card-body">
                    <div class="form-group">
                        <label>Nom de l'entreprise</label>
                        <select class="form-control" name="entreprise">
                            <option value="" selected disabled>Choisir le nom</option>
                            @foreach ($entreprises as $entreprise)
                                <option value="{{$entreprise->id}}" {{$tache->entreprise_id == $entreprise->id ? 'selected': ''}}>{{$entreprise->nom}}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tache</label>
                        <textarea class="form-control" rows="3"  name="text">{{$tache->text}}</textarea>
                      </div>


                  </div>
                  <!-- /.card-body -->
  
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
              </div>
        </div>
    </div>
@stop
