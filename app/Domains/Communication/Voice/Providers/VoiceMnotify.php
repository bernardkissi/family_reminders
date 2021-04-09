<?php

namespace App\Domains\Communication\Voice\Providers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;


class VoiceMnotify {

	const SEND_VOICE = 'https://api.mnotify.com/api/voice/quick';

	/**
	 * Call Members
	 *  
	 * @param  array  $data [description]
	 * @return [type]       [description]
	 */
	public function call(array $numbers){

	$voice = Storage::disk('local')->path('public/voice-main-compressed.mp3');
    
	
	$response = Http::withHeaders(['Content-Type' => 'Content-Type: multipart/form-data'])
				->attach('file', file_get_contents($voice), 'voice.mp3')
				->post(self::SEND_VOICE.'?key='.config('mnotify.keys.sms_key'), 
					array_merge(['recipient' => $numbers], ['campaign' => 'Family reminders']));

	dd($response->json());
	}
}


