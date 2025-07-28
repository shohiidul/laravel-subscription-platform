<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\ProcessSubscriptionEmailJob;

class DispatchSubscriptionEmailJobCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscription-email:dispatch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send subscription email';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        ProcessSubscriptionEmailJob::dispatch();

        $this->info('Subscription email has been dispatched!');

        return Command::SUCCESS;
    }
}
