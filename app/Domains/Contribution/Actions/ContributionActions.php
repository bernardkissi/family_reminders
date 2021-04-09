<?php

declare(strict_types=1);

namespace App\Domains\Contribution\Actions;

use App\Domains\Contribution\Contribution;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ContributionActions
{
    /**
     *  Create a mew contribution
     *
     * @param  array  $contribution
     * @return void
     */
    public function create(array $contribution): void
    {
        Contribution::create([

            'title' => $contribution->title,
            'description' => $contribution->description,
            'starts' => Carbon::now(),
            'banner' => $contribution->banner,
            'min' => $contribution->min,
            'expires_on' => Carbon::now()->addDays(2)
        ]);
    }

    /**
     *  Returns all contributions
     *
     * @return array
     */
    public function all(): array
    {
         return DB::table('contributions')
         ->select('id', 'title', 'description', 'starts', 'expires_on')
         ->get();
    }


    /**
     * Returns a contribution
     *
     * @param  Contribution $contribute App\Domains\Contribution\Contribution;
     * @return Contribution App\Domains\Contribution\Contribution
     */
    public function contribution(Contribution $contribute): Contribution
    {
         return Contribution::select('id', 'title', 'description', 'starts', 'banner', 'min', 'expires_on', 'min', 'expires_at')
            ->where('id', $contribute->id)->first();
    }


    /**
     * Deletes a contribution
     *
     * @param  Contribution $contribute App\Domains\Contribution\Contribution;
     * @return void
     */
    public function delete(Contribution $contribute): void
    {
        $contribute->delete();
    }


    /**
     * Updates a contribution
     *
     * @param  Contribute $contribute App\Domains\Contribution\Contribution;
     * @param  array $data
     * @return Contribution  App\Domains\Contribution\Contribution;
     */
    public function update(Contribution $contribute, $data): Contribution
    {
        $contribute->update([
            
            'title' => $data->title,
            'min' => $data->min,
            'expires' => $data->expires_on,
            'expires_at' => $data->expires_at
        ]);
    }
}
