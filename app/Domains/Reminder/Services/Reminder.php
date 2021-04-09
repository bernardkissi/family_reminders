<?php


namespace App\Domains\Reminder\Services;

use Carbon\Carbon;
use Cron\CronExpression;


class Reminder {

	/**
	 *	Get current day
	 * 
	 * @return [type] [description]
	 */
	public function today(){
		return Carbon::now()->englishDayOfWeek;
	}


	/**
	 *  Get the days before reminders
	 * 
	 * @return [type] [description]
	 */
	public function remindNextDay(){
		return Carbon::now()->addDays(2)->englishDayOfWeek;
	}


	/**
	 *  Next Due date
	 * 
	 * @return [type] [description]
	 */
	public function nextDue(){
       $carbon = Carbon::instance(CronExpression::factory('0 0 * * *')->getNextRunDate());
       return $carbon->englishDayOfWeek;
    }
}