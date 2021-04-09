God is about to do something great with this family in times like this. 
You are the one God wants to use to do this.
support this family in whatever way way you can to make Gods Dream for us come true.

//members controller
public $reminder;
    public $request;

    public function __construct(Request $request, Reminder $reminder)
    {
        $this->reminder = $reminder;
        $this->request = $request;
    }
    /**
     *  Retrieve all members
     *
     * @return [type] [description]
     */
    public function index()
    {
        return DB::table('members')->select('id', 'name', 'mobile', 'email')->get();
    }

     /**
     *  Retrieve all members to reminded tomorrow
     *
     * @return [type] [description]
     */
    public function nextToBeReminded()
    {
        return Member::reminder($this->reminder->nextDue());
    }

    /**
     *  Retrieve all members to be reminded today
     *
     * @return [type] [description]
     */
    public function remindedToday()
    {
        return Member::reminder($this->reminder->today());
    }

    /**
     *  Add new members to family
     */
    public function add()
    {

        $user = Member::create([
            'name' => $this->request->name,
            'mobile' => $this->request->mobile,
            //'email' => $this->request->email,
            'day_to_call' => $this->request->day,
        ]);
    }

    /**
     *  Update member
     *
     * @param  Member $member [description]
     * @return [type]         [description]
     */
    public function update(Member $member)
    {

        $member->update([
            'name' => $this->request->name,
            'mobile' => $this->request->mobile,
            //'email' =>  $this->request->email,
            'day_to_call' => $this->request->day,
        ]);

        return $member;
    }


    /**
     *  Update multiple contacts
     *
     * @return [type] [description]
     */
    public function updateMultiple()
    {
        DB::table('members')
                    ->whereIn('id', $this->request->ids)
                    ->update(['day_to_call' => $this->request->day]);
    }


    /**
     *  Delete multiple contacts
     *
     * @return [type] [description]
     */
    public function deleteMultiple()
    {
        DB::table('members')
                    ->whereIn('id', $this->request->ids)
                    ->delete();
    }

    /**
     *  Delete member
     *
     * @param  Member $member [description]
     * @return [type]         [description]
     */
    public function delete(Member $member)
    {
        $member->delete();
    }





    messages
        /**
     *  Retrieve all messages
     *
     * @return [type] [description]
     */
    public function index()
    {
        return Message::where('default', true)->first()['message'];
    }


    /**
     * [send description]
     * @param  Request $request [description]
     * @param  Mnotify $sms     [description]
     * @return [type]           [description]
     */
    public function sendMessage(Request $request, Mnotify $sms)
    {
        return $sms->send($this->retrieveMembers($request));
    }

    /**
     *  Add new members
     */
    public function add(Request $request)
    {

        $message = Message::create([
            'message' => $request->message,
            'default' => true
        ]);
    }


    /**
     *  Update member
     *
     * @param  Member $member [description]
     * @return [type]         [description]
     */
    public function update(Request $request, Message $message)
    {
        $message->update(['message' => $request->message, 'default' => $message->default]);
    }


    /**
     *  Update member
     *
     * @param  Member $member [description]
     * @return [type]         [description]
     */
    public function setDefault(Request $request, Message $message)
    {
        $message->update(['default' => true]);
    }


    /**
     *  Delete member
     *
     * @param  Member $member [description]
     * @return [type]         [description]
     */
    public function delete(Message $message)
    {
        $message->delete();
    }


    /**
     *  Get members whose calling is due
     *
     * @return [type] [description]
     */
    protected function retrieveMembers($request)
    {

        $members = Member::select('mobile')->get();
        $numbers = collect($members)->map(function ($member) {
            return $member->mobile;
        })->toArray();

        return [

            'recipient' => $numbers,
            'sender' => 'kissiFamily',
            'message' => $request->message
        ];
    }


    contribution
    
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