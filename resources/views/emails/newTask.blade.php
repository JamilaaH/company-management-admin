@component('mail::message')
# Introduction
Voici la nouvelle tache à réaliser :
{{$tache->text}}

@component('mail::button', ['url' => 'http://127.0.0.1:8080/dashboard'])
Dashboard
@endcomponent

Thanks,<br>
Admin
@endcomponent
