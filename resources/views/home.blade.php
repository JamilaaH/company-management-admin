@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Dashboard</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-4">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $nbreEntreprise }}</h3>

                    <p>Entreprise{{$nbreEntreprise >1 ? 's' : ''}}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-warehouse"></i>
                </div>
                <a href="{{ route('entreprise.index') }}" class="small-box-footer">Voir détails <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-4">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ Auth::user()->unreadNotifications->count() }}</h3>

                    <p>Message{{Auth::user()->unreadNotifications->count() >1 ? 's' : ''}}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-inbox"></i>
                </div>
                <a href="{{ route('messages.index') }}" class="small-box-footer">Voir détails <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-4">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $taches }}</h3>

                    <p>Tâche{{$taches >1 ? 's' : ''}} créée{{$taches >1 ? 's' : ''}}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-tasks"></i>
                </div>
                <a href="{{ route('tache.index') }}" class="small-box-footer">Voir détails <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
    @dump(Auth::user()->unreadNotifications->count())
@stop
