<?php

namespace App\Http\Controllers\API;

use App\Jobs\SendReminders;
use App\Models\Member;
use App\Services\Reminders\Reminder;
use App\Services\SmsGateways\Mnotify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MembersController extends Controller
{

    
}
