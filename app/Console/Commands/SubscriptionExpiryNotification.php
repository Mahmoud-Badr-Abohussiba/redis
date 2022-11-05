<?php

namespace App\Console\Commands;

use App\Jobs\SendSubExpMessageJob;
use App\Models\Customer;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class SubscriptionExpiryNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subs:NotifyExpired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check end of Subscription for Customers';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $expiredCustomers = Customer::query()->where('sub_end_date', '<', now())->get();

        foreach ($expiredCustomers as $customer) {
            $expireDate = Carbon::createFromFormat('Y-m-d', $customer->sub_end_date)->toDateString();
            dispatch(new SendSubExpMessageJob($customer, $expireDate))->onQueue('SubsExpiration');
        }
    }
}
