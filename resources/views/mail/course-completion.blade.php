<x-mail::message>
# Congratulations, {{ $user->name }}!

You have successfully completed the course **{{ $course->title }}**.

We are proud of your achievement! Keep up the great work and continue learning.

<x-mail::button :url="url('/')">
Browse More Courses
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
