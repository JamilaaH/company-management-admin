@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Boîte de réception</h1>
    <a class="btn btn-app" href="{{route('messages.create')}}">
        <i class="fas fa-plus"></i> Add
    </a>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Inbox</h3>
                    @include('layouts.flash')
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <div class="table-responsive mailbox-messages">
                        <table class="table table-hover table-striped">
                            <tbody>
                                @foreach ($entreprises as $entreprise)
                                    {{-- @dump($entreprise->messages) --}}
                                    @if ($entreprise->messages->isNotEmpty())
                                        <tr>
                                            <td>
                                                <div class="icheck-primary">
                                                    <input type="checkbox" value="" id="check1">
                                                    <label for="check1"></label>
                                                </div>
                                            </td>
                                            <td class="mailbox-name"><a href="{{route('messages.show', $entreprise->messages->last()->entreprise_id)}}">{{$entreprise->messages->last()->entreprise->nom_contact}} {{$entreprise->messages->last()->entreprise->nom}} </a></td>
                                            <td class="mailbox-subject">{{$entreprise->messages->last()->message}}
                                            </td>

                                            <td class="mailbox-date">{{$entreprise->messages->last()->created_at->diffForHumans()}}</td>
                                        </tr>
                                        
                                    @endif
                                    @empty ($entreprise->messages)
                                        @once
                                            
                                            <p>pas de messages</p>
                                        @endonce
                                    @endempty

                                    
                                @endforeach


                            </tbody>
                        </table>
                        <!-- /.table -->
                    </div>
                    <!-- /.mail-box-messages -->
                </div>
                <!-- /.card-body -->
                {{-- <div class="card-footer p-0">
                    <div class="mailbox-controls">
                        <!-- Check all button -->
                        <button type="button" class="btn btn-default btn-sm checkbox-toggle">
                            <i class="far fa-square"></i>
                        </button>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm">
                                <i class="far fa-trash-alt"></i>
                            </button>
                            <button type="button" class="btn btn-default btn-sm">
                                <i class="fas fa-reply"></i>
                            </button>
                            <button type="button" class="btn btn-default btn-sm">
                                <i class="fas fa-share"></i>
                            </button>
                        </div>
                        <!-- /.btn-group -->
                        <button type="button" class="btn btn-default btn-sm">
                            <i class="fas fa-sync-alt"></i>
                        </button>
                        <div class="float-right">
                            1-50/200
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm">
                                    <i class="fas fa-chevron-left"></i>
                                </button>
                                <button type="button" class="btn btn-default btn-sm">
                                    <i class="fas fa-chevron-right"></i>
                                </button>
                            </div>
                            <!-- /.btn-group -->
                        </div>
                        <!-- /.float-right -->
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
@stop
