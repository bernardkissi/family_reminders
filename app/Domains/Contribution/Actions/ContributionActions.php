<?php

declare(strict_types=1);

namespace App\Domains\Contribution\Actions;

use App\Domains\Contribution\Contribution;
use Carbon\Carbon;
use Illuminate\Http\Request;
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
    public function create(Request $contribution): void
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
     * @return Illuminate\Support\Collection
     */
    public function contributions(): Collection
    {
         $filter = 'notExpired';

         return Contribution::query()
         ->select('id', 'title', 'description', 'starts', 'expires_on', 'expired_at', 'starts')
         ->{$filter}()
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
         return Contribution::select('id', 'title', 'description', 'starts', 'banner', 'min', 'expires_on', 'min', 'expired_at')
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
            'description' => $data->description,
            'banner' => $data->banner,
            'min' => $data->min,
            'starts' => $data->starts,
            'expires_on' => $data->expires_on,
        ]);

        return $contribute;
    }
}
