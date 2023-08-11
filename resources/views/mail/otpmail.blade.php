<x-mail::message>
#Your OTP Code

<x-mail::panel>
    {{ $otp }}
</x-mail::panel>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>

