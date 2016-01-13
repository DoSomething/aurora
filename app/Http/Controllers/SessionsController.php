<?php

namespace Aurora\Http\Controllers;

class SessionsController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (\Auth::check()) {
            // Already loged in.
        }

        return \View::make('sessions.login');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $input = \Input::only('email', 'password');
        // Try to log the user in with Northstar.
        try {
            $northstar = new \Aurora\Services\Northstar;
            $response = $northstar->login($input);
            $user = $this->mapToUser($response);
            \Auth::login($user);

            return \Redirect::route('users.index');
        } catch (\Exception $e) {
            dd($e);

            return \Redirect::back()->with('trigger_modal', ['class' => 'messages -error', 'text' => 'Login Failed']);
        }
    }

    public function mapToUser($response)
    {
        $user = \Aurora\Models\User::firstOrCreate(['_id' => $response['_id']]);

        return $user;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id = null)
    {
        \Auth::logout();

        return \Redirect::to('/')->with('flash_message', ['text' => 'You have been logged out!', 'class' => 'messages']);
    }

    public function unauthorized()
    {
        $gifs = ['yPBHuNVGsrrxK', 'DKclRd6n3KGD6', '777J8bECVBEOs', 'FYy4Efj2hyZBm', 'EMxy32NDE3Mac', '9LkjuISavFFXG'];
        $gif = $gifs[rand(0, count($gifs) - 1)];

        return \View::make('sessions.unauthorized')->with(compact('gif'));
    }
}
