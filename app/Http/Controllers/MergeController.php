<?php

namespace Aurora\Http\Controllers;

use DoSomething\Gateway\Resources\NorthstarUser;
use Illuminate\Http\Request;

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
    $duplicateId = $request->query('id');

    $mergedUser = gateway('northstar')->mergeUsers(
      $user->id,
      $duplicateId,
      true
    );

    return view(
      'users.merge.create',
      compact('user', 'mergedUser', 'duplicateId')
    );
  }

  /**
   * Complete the merge action.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(NorthstarUser $user, Request $request)
  {
    $message = null;

    try {
      $reponse = gateway('northstar')->mergeUsers(
        $user->id,
        $request->input('merge_id')
      );
    } catch (\Exception $exception) {
      $message = 'Merge Unsuccessful. Error: ' . $exception->getMessage();
    }

    $message = $message ?: 'Users successfully merged. You\'re a star!';

    return redirect()
      ->route('users.show', [$user->id])
      ->with('flash_message', [
        'class' => 'messages',
        'text' => $message,
      ]);
  }
}
