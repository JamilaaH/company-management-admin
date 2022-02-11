@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Listes des entreprises</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">

            <div class="card">
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0" style="height: 90%;">
                  <table class="table table-head-fixed">
                    <thead>
                      <tr>
                        <th>TVA</th>
                        <th>Nom</th>
                        <th>Activité</th>
                        <th>Ville</th>
                        <th>Pays</th>
                        <th>Personne de contact</th>
                        <th>Email de contact</th>
                        <th>Numero de contact</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($entreprises as $entreprise)
                        <tr>
                          <td>{{$entreprise->tva}}</td>
                          <td>{{$entreprise->nom}}</td>
                          <td>{{$entreprise->activite}}</td>
                          <td>{{$entreprise->code_postal}} {{$entreprise->ville}} </td>
                          <td>{{$entreprise->pays}} </td>
                          <td>{{$entreprise->nom_contact}} </td>
                          <td>{{$entreprise->email}} </td>
                          <td>0{{$entreprise->numero_contact}} </td>
                        </tr>
                            
                        @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                    <ul class="pagination pagination-sm m-0 float-right">
                        {{$entreprises->links('pagination::bootstrap-4')}}
                    </ul>
                  </div>
              </div>
        </div>
    </div>
@stop
