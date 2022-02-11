@component('mail::message')
# Introduction

Liste de taches non faites = 
@foreach ($taches as $tache)
    <li>{{$tache->text}}</li>
@endforeach

@component('mail::button', ['url' => 'http://127.0.0.1:8080/dashboard'])
Dashboard
@endcomponent

Thanks,<br>
Admin
@endcomponent
