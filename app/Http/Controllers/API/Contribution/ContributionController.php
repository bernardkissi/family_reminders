<?php

namespace App\Http\Controllers\API\Contribution;

use App\Domains\Contribution\Actions\ContributionActions;
use App\Domains\Contribution\Contribution;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContributionController extends Controller
{

    public function __construct(public ContributionActions $contribution)
    {
    }

    /**
     * Create Contribution
     *
     * @param Illuminate\Http\Request; $request
     * @return object
     */
    public function create(Request $request)
    {
        $this->contribution->create($request);

        return response()->json(['message' => 'Contribution has been created']);
    }


    /**
     * Returns all contributions
     *
     * @return [type] [description]
     */
    public function contributions()
    {
        return $this->contribution->contributions();
    }


    /**
     * Returns a contribution
     *
     * @param  App\Domains\Contribution\Contribution;
     * @return App\Domains\Contribution\Contribution;
     */
    public function contribution(Contribution $contribute)
    {
        return $this->contribution->contribution($contribute);
    }


    /**
     * Removes a contribution
     *
     * @param  Contribution $contribute [description]
     * @return void
     */
    public function delete(Contribution $contribute)
    {
        $this->contribution->delete($contribute);

        return response()->json(['message' => 'Contribution has been deleted']);
    }


    /**
     * Updates a contribution
     *
     * @param  Contribution $contribute [description]
     * @param  Request      $request    [description]
     * @return [type]                   [description]
     */
    public function update(Contribution $contribute, Request $request)
    {
        $this->contribution->update($contribute, $request);

        return response()->json(['message' => 'Contribution has been updated', 'data' => $contribute]);
    }
}
