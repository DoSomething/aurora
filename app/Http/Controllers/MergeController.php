<?php

namespace Aurora\Http\Controllers;

use Illuminate\Http\Request;
use DoSomething\Gateway\Resources\NorthstarUser;

class MergeController extends Controller
{
    /**
     * Create a MergeController.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin,staff');
    }

    /**
     * Show the form for merging two accounts.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(NorthstarUser $user, Request $request)
    {
        $mergeEndpoint = 'v1/users/'.$user->id.'/merge?pretend=true';

        $response = gateway('northstar')->post($mergeEndpoint, ['id' => $request->query('id')]);
        $mergedUser = new NorthstarUser($response['data']);

        // - Should we be deleting the merged account?
        // - merging can be somewhat inelegant unless *no* fields overlap

        return view('users.merge.create', compact('user', 'mergedUser'));
    }

    /**
     * Complete the merge action.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return redirect()->back()->with('flash_message', ['class' => 'messages', 'text' => 'Not yet implemented.']);
    }
}
