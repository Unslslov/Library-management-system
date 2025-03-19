<?php

namespace App\Jobs;

use App\Models\Rent;
use App\Notifications\ReturnBookNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Notification;

class NotifyReturnBook implements ShouldQueue
{
    use Queueable;

    protected $rent;

    /**
     * Create a new job instance.
     */
    public function __construct(Rent $rent)
    {
        $this->rent = $rent;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Notification::send($this->rent->user, new ReturnBookNotification($this->rent));
    }
}
