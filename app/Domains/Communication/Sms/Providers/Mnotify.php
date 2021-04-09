<?php

namespace App\Domains\Communication\Sms\Providers;

use Illuminate\Support\Facades\Http;

class Mnotify {

	const SEND_SMS = 'https://api.mnotify.com/api/sms/quick';

	/**
	 *	Send SMS to members
	 * 
	 * @return [type] [description]
	 */
	public function send(array $data){

		$response = Http::asForm()
			->post(self::SEND_SMS.'?key='.config('mnotify.keys.sms_key'), $data);
		dd($response->json());
	}


}