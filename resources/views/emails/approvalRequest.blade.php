@component('mail::message')
# Your Approval is needed for {{$company}}

Please click on the button below to approve this new UTS Application Test Registration:

@component('mail::panel')
    Primary Contact Name: {{$fullName}}<br>
    Email Address       : {{$email}}<br>
    Telephone           : {{$telephone}}<br>
    Company             : {{$company}}<br>
@endcomponent

@component('mail::button', ['url' => $url])
Approve this Company's Trial Registration
@endcomponent

if you do not wish to approve this, just do nothing for now. 
You can further review this application by logging into UTS-GAT, under Company Menu, New Applications.

Thanks,<br><br>
{{ config('app.name') }} Automated Bot
@endcomponent
