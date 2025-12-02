<x-mail::message>
# Welcome to {{ config('app.name') }}!

Hello {{ $userName }},

Thank you for signing up! To complete your registration, please verify your email address by clicking the button below.

<x-mail::button :url="$verificationUrl">
Verify Email Address
</x-mail::button>

If you did not create this account, no further action is required.

This verification link will expire in 60 minutes.

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
