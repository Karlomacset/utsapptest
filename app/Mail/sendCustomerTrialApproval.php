<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Tenant;

class sendCustomerTrialApproval extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(tenant $tenant)
    {
        $this->tenant = $tenant;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.customer.trialApproval')
                ->subject('You Trial for ContinuSYS BCMS was Approved!')
                ->with([
                    'fullname'=>$this->tenant->client->fullname(),
                    'client'=>$this->tenant->client->companyName,
                    'email'=>$this->tenant->email,
                    'url'=>'https://'.strtolower($this->tenant->alias_domain),
                    'expireDate'=>now()->addDays(30)->format('d M Y'),
                    ]);
    }
}
