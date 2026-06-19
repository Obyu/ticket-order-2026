<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ExpireBookingsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:expire-bookings-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $total = \App\Models\Booking::query()
            ->where('status', 'pending')
            ->where('expired_at', '<=', now())
            ->update([
                'status' => 'expired',
            ]);

        $this->info(
            "{$total} booking expired."
        );

        return self::SUCCESS;
    }
}
