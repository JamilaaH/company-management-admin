@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">{{$entreprise->nom_contact}} / {{$entreprise->nom}} </h1>
@stop

@section('content')
{{-- @dump($entreprise) --}}
    <div class="row">
        <div class="col-12">
            <div class="card card-primary card-outline direct-chat direct-chat-primary " style="height: 80vh">
                <div class="card-header">
                    <h3 class="card-title">Direct Chat</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>

                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="direct-chat-messages" style="height: 100vh">
                        @foreach ($messages as $message)
                            <div class="direct-chat-msg  {{Auth::user()->id == $message->author_id ? 'right' : 'left'}}" >
                                <div class="direct-chat-infos clearfix">
                                    <span class="direct-chat-name {{Auth::user()->id == $message->author_id ? 'float-right' : 'float-left'}}" >{{Auth::user()->id == $message->author_id ? Auth::user()->nom : $message->entreprise->nom_contact}}</span>
                                    <span class="direct-chat-timestamp {{Auth::user()->id == $message->author_id ? 'float-left' : 'float-right'}}">{{$message->created_at->format('d-m-y H:i')}}</span>
                                </div>
                                <img class="direct-chat-img" src="https://oasys.ch/wp-content/uploads/2019/03/photo-avatar-profil.png"
                                    alt="message user image">
                                <div class="direct-chat-text">
                                    {{$message->message}}
                                </div>
                            </div>
                            
                        @endforeach

                    </div>

                    <!--/.direct-chat-messages-->
                </div>
                <div class="card-footer">
                    <form action="{{route('messages.store')}}" method="post">
                        @csrf
                        <div class="input-group">
                            <input type="number" name="entreprise" value="{{$entreprise->tva}}" hidden>
                            <input type="text" name="message" placeholder="Type Message ..." class="form-control">
                            <span class="input-group-append">
                                <button type="submit" class="btn btn-primary">Send</button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        // Rajouter un zero au nombre
        function addZero(i) {
            if (i < 10) {i = "0" + i}
            return i;
            }
        let chat = document.querySelector('.direct-chat-messages');
        window.Echo.channel("chat").listen("ChatEvent", (event)=>{
            console.log(event.message);
            let division = document.createElement('div')
            division.className = "direct-chat-msg left"
            let entete = document.createElement('div')
            entete.className = "direct-chat-infos clearfix"
            let titre = document.createElement('span');
            titre.className = "direct-chat-name float-left"
            titre.innerHTML = {!! json_encode($entreprise->nom_contact) !!}
            let time = document.createElement('span')
            time.className = "direct-chat-timestamp float-right"
            let create = Date.parse(event.message.created_at)
            var d = new Date(create);

            var month = addZero(d.getMonth() + 1)
            var day = addZero(d.getDay());
            var year = d.getYear();
            var heure = addZero(d.getHours());
            var min = addZero(d.getMinutes());
            var date = month + "-" + day + "-" + year + '  ' + heure + ':'+ min;
            time.innerHTML = date
            var img = document.createElement('img'); 
            img.src = "https://oasys.ch/wp-content/uploads/2019/03/photo-avatar-profil.png";
            img.className='direct-chat-img'
            let msg = document.createElement('div')
            msg.className = 'direct-chat-text'
            msg.innerHTML = event.message.message
            entete.appendChild(titre)
            entete.appendChild(time)
            division.appendChild(entete)
            division.appendChild(img)
            division.appendChild(msg)
            chat.appendChild(division)
        });

    </script>
@stop

