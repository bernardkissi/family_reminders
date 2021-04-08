<?php

namespace App\Console;

use App\Jobs\CallReminders;
use App\Jobs\MonthlyContributionJob;
use App\Jobs\SendReminders;
use App\Models\Member;
use App\Services\Reminders\Reminder;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->job(new SendReminders($this->getMembers()))->everyMinute();
        //$schedule->job(new MonthlyContributionJob($this->getMembers()))->monthlyOn(25, '10:00');
        //$schedule->job(new CallReminders($this->fetchAllMembers()))->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }

    public function getMembers(){

        return Member::reminder((new Reminder())->today());
    }
}
