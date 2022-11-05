<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendSubExpMessageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $customer;
    private $expireDate;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($customer, $expireDate)
    {
        $this->customer = $customer;
        $this->expireDate = $expireDate;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $data = (array) $this->customer;
        sendMail('emails.subscriptionExpiration', $this->customer->mail ,'Your Subscription Has been Expired', $data);
    }
}
