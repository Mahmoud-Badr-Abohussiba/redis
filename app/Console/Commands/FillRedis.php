<?php

namespace App\Console\Commands;

use App\Models\Customer;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class FillRedis extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'redis:fillCustomers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'fill redis DB from mysql DB';

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
        $customers  = Customer::query()->select('id', 'national_id')->get();
        if (isset($customers) && !empty($customers)){
            foreach ($customers as $customer){
                Redis::set('national_id_'.$customer->national_id, $customer->id);
            }
    }
    }
}
