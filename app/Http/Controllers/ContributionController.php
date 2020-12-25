<?php

namespace App\Http\Controllers;

use App\Models\Contribution;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ContributionController extends Controller
{

    public function __construct(){

    	$this->middleware('contribute')->only('index');
    	// $this->middleware('throttle:6,1')->only('create', 'index');
    }


    /**
     *  Create contribution page
     * 
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function create(Request $request){

    	$contribute = Contribution::create([

    		'title' => $request->title,
    		'description' => $request->description,
    		'starts' => Carbon::now(),
    		'banner' => $request->banner,
    		'min' => $request->min,
    		'expires_on' => Carbon::now()->addDays(2)
    	]);

    	return response()->json(['message' => 'Contribution has been created'], 200);
    }


    /**
     * Get a contribution
     * @param  Contribution $contribute [description]
     * @return [type]                   [description]
     */
    public function index(Contribution $contribute){
    	return response()->json($contribute);
    } 

    /**
     *  Delete a contribution
     * 
     * @param  Contribution $contribute [description]
     * @return [type]                   [description]
     */
    public function delete(Contribution $contribute){
    	$contribute->delete();
    	return response()->json(['message' => 'Contribution has been deleted']);
    }

    /**
     * Update a contribution
     * 
     * @param  Contribution $contribute [description]
     * @return [type]                   [description]
     */
    public function update(Contribution $contribute){
    	$contribute->update([
    		'min' => $request->value, 
    		'expires' => $request->expires_on,
    		'expires_at' => null
    	]);
    	return response()->json(['message' => 'Contribution has been updated']);
    }
}
