@component('mail::message')
# Dating Service contact send

Hello, I`m **{{ $name }}**. I want to contact to you.<br>
My number: **{{ $number }}**<br>
My email: {{ $email }}<br>
My question:<br>
{{ $msg }}
Thanks,<br>
{{ config('app.name') }}
@endcomponent