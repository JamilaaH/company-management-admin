@component('mail::message')
# Introduction
Bienvenue {{$user->nom}}

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
