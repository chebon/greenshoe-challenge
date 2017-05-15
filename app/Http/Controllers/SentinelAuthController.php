<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

use Cartalyst\Sentinel\Laravel\Facades\Activation;

class SentinelAuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('greenshoe.auth.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $credentials = [
            'email'    => $request->input('email'),
            'password' => $request->input('password'),
        ];


        $authentication = Sentinel::authenticate($credentials);


        if(!$authentication){
            return 'autentication Failed';
        }


        if ($authentication->hasAccess(['list.export']))
        {
            return redirect('/debtors/list');
        }
        else
        {
            return redirect('/debtors/search');

        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function register(Request $request){

        //register user
        $credentials = [
            'email'    => $request->input('email'),
            'first_name'    => $request->input('firstname'),
            'last_name'    => $request->input('lastname'),
            'password' => 'foobar', //We set default password here. Users with default password will be prompt to reset their password
        ];

        $user = Sentinel::register($credentials);

        $activationResponse = $this->activateUser($user, $request->input('accessControl'));

        $message = ( $activationResponse ? 'User Created!' : 'User Not Created. Please try Again!');


        return redirect('/users/list')->with('status', $message);

        return Response()->json($user);
    }

    public function listUsers(){
        return view('greenshoe.users.manager');
    }

    protected function activateUser($user, $role){

        $activation = Activation::create($user);

        if (Activation::complete($user, $activation->code))
        {
            $this->assignUserToRole($user, $role);
            return true;
        }
        else
        {
            return false;
        }

    }

    protected function assignUserToRole($user, $role){
        $roleName = ($role == 2 ? 'user2' : 'user1');
        $role = Sentinel::findRoleByName($roleName);
        $role->users()->attach($user);
        return true;
    }

    public function logout(){
        Sentinel::logout(null, true);
        return redirect('/login');
    }
}
