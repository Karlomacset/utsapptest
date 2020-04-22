@component('mail::message')
# Your Trial for UTS Application Test has been APPROVED! 

The details of your trial are as follows:

@component('mail::panel')
    Primary Contact Name: {{$fullname}}<br>
    Email Address       : {{$email}}<br>
    Company             : {{$client}}<br>
    Trial Link          : {{$url}}<br>
    Expiry (30 days)    : {{$expireDate}}<br> 
@endcomponent

You may click on the button below to open a new browser tab for your trial link to get started.
Please use the above User name and Temporary Password to access the site - you will be asked to change
your password from your initial login.

@component('mail::button', ['url' => $url])
UTS Application Test
@endcomponent

We trust that you will require assistance during the period of your trial.  Please do not hesitate to contact us on
support@continusys.com for any questions you may have or give us a call on :  999-9999


Sincerely,<br><br>

UTS Application Team 
@endcomponent
