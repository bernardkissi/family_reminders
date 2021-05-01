<?php

namespace Database\Seeders;

use App\Domains\Member\Member;
use App\Domains\Message\Message;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Member::factory(15)->create();
        Message::factory(15)->create();
    }
}
