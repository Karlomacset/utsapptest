<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Client;

class sendNewCustomerTrialRequest extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Client $client)
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

        return $this->markdown('emails.approvalRequest')
                ->subject('Your Approval is needed for UTS Application Test for '.$this->client->companyName)
                ->with([
                    'fullName'=>$this->client->fullname(),
                    'client'=>$this->client->companyName,
                    'email'=>$this->client->userName,
                    'telephone'=>'',
                    'url'=>$url.$this->client->approvalToken,
                ]);
    }
}
