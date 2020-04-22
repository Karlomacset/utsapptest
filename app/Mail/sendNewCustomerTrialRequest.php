<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Company;

class sendNewCustomerTrialRequest extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(client $client)
    {
        $this->client = $client;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $fullName = $this->client->firstName.' '.$this->client->lastName;
        $url = env('APP_URL').'/vrf/';

        return $this->markdown('emails.customer.approvalRequest')
                ->subject('Your Approval is needed for UTS Application Test for '.$this->client->companyName)
                ->with([
                    'fullName'=>$fullName,
                    'client'=>$this->client->clientName,
                    'email'=>$this->client->user->email,
                    'telephone'=>$this->client->officePhone,
                    'url'=>$url.$this->client->approvalToken,
                ]);
    }
}
