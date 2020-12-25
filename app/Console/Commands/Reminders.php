<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Reminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Reminders:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command sends daily reminders to members';

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
        return 0;
    }
}
