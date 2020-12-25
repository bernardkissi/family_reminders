<?php

namespace App\Traits;


trait RetrieveMembers{


	public function getNumbers($members){

		return collect($this->members)->map(function ($member){
            return $member->mobile;
        })->toArray();

	}
}