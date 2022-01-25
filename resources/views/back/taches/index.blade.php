@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Listes des tâches</h1>
    <a class="btn btn-app" href="{{route('tache.create')}}">
        <i class="fas fa-plus"></i> Add
      </a>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    @include('layouts.flash')
                  </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0" style="height: 90%;">
                  <table class="table table-head-fixed">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Entreprise</th>
                        <th>Tache</th>
                        <th>Statut</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @forelse ($taches as $tache)
                        <tr>
                          <td>{{$loop->iteration}}</td>
                          <td>{{$tache->entreprise->nom}}</td>
                          <td>{{$tache->text}}</td>
                          <td>{{$tache->etat == 0 ? "Non fait": "fait"}} </td>
                          <td class="text-left align-middle">
                              <div class="flex">
                                  <button class="btn btn-info" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal{{$tache->id}}"><i class="fas fa-eye"></i></button>
                                  <form action="{{route('tache.destroy', $tache->id)}}" method="post" class="mt-1  w-25 m-0">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                    
                                </form>
                                
                            </div>
                        </td>
                        @include('back.modal.modal')
  
                        </tr>
                        @empty 
                        <tr>
                            <td>Pas de tâches créées </td>
                        </tr>
                        @endforelse
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
        </div>
    </div>
@stop
