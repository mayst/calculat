@component('mail::message')
# Dating Service registration

Hello, $name. Welcome to **Dating Service**. We are _glad to see_ you here!<br>
Your password: $pass

@component('mail::button', ['url' => $url])
Go to my profile
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
