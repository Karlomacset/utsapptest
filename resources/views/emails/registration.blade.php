@component('mail::message')
# Welcome to UTS Application System!

Dear {{$firstName}},

Your application is currently being reviewed. You should be receiving an email soon for us verify your
credentials.  Once your account is approved, an email detailing your link and login to your UTS Application instance 
 will be sent.

Should you have any questions, please do send us an email on info@utsapp.test

Sincerely,<br><br>

{{ config('app.name').' Team' }}
@endcomponent
