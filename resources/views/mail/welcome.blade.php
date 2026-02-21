<x-mail::message>
# Welcome, {{ $user->name }}!

Welcome to Career 180 LMS! We are thrilled to have you join our learning community.

Explore our courses and start your journey today.

<x-mail::button :url="route('dashboard')">
Go to Dashboard
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
