@component('mail::message')
# Introduction
Voici la nouvelle tache à réaliser

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
