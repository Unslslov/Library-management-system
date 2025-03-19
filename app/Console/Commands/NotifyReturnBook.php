<?php

namespace App\Console\Commands;

use App\Models\Rent;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;

class NotifyReturnBook extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:notify-return-book';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notify return-book';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::has('rents')->get();

        foreach($users as $user)
        {
            $rents = $user->rents()->whereDate('due_date', Carbon::tomorrow())->get();
            if($rents->isNotEmpty())
            {
                foreach($rents as $rent)
                {
                    \App\Jobs\NotifyReturnBook::dispatch($rent);
                }
            }
        }

//        $rents = $user->rents()->get();
//        \App\Jobs\NotifyReturnBook::dispatch($rents);

        $this->info('Notifications have been dispatched for books due tomorrow.');
    }

}
