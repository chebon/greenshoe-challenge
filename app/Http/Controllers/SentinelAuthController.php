<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;
Use Cartalyst\Sentinel\Laravel\Facades\Reminder;
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

        if (!Sentinel::guest()) {
            $user = Sentinel::getUser();
            return $this->redirectUsers($user);
        }
        else{
            return view('greenshoe.auth.login');
        }

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
            return redirect('/login')->with('message', 'Username password not matching');
        }

        return $this->redirectUsers($authentication);



    }

    protected function redirectUsers($authentication){
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

        $password = $request->input('password');
        $confirm = $request->input('confirmPassword');

        if($confirm != $password){
            return redirect('/register')->withInput()->with('message', 'Password Does not match');
        }

        //register user
        $credentials = [
            'email'    => $request->input('username'),
            'first_name'    => $request->input('firstname'),
            'last_name'    => $request->input('lastname'),
            'password' => $password,
        ];

        $user = Sentinel::register($credentials);

        $this->activateUser($user, $request->input('accessControl'));

        $authentication = Sentinel::authenticate($credentials);
        return $this->redirectUsers($authentication);

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

    public function resetView(){
        return view('greenshoe.auth.pwd-reset');
    }

    public function registerView(){
        return view('greenshoe.auth.register');
    }

    public function resetPasswordView(Request $request){

        $username = $request->input('username');

        if ($request->has('ResetToken')) {
            $password = $request->input('password');
            $confirm = $request->input('confirmPassword');
            $token = $request->input('ResetToken');

            if($confirm != $password){
                $message = 'Password Does not Match';
                $reminder = ['code' => $token];
                $reminder = (object) $reminder;
                return view('greenshoe.auth.pwd-reset-form', ['username' => $username, 'reminder' => $reminder, 'message' => $message]);
            }

            return $this->resetPassword($password, $token, $username);

        } else {

            $credentials = [
                'email' => $username
            ];
            $user = Sentinel::findByCredentials($credentials);
            if ($user == null) {
                return redirect('/password/reset')->withInput()->with('message', 'No user Associated with that username');
            }
            $reminder = Reminder::create($user);
            return view('greenshoe.auth.pwd-reset-form', ['username' => $username, 'reminder' => $reminder]);
        }
    }

    protected function resetPassword($pwd, $token, $username){

        $credentials = [
            'email' => $username
        ];

        $user = Sentinel::findByCredentials($credentials);

        if ($reminder = Reminder::complete($user, $token, $pwd))
        {
            $credentials = [
                'email'    => $username,
                'password' => $pwd,
            ];

            Sentinel::authenticate($credentials);
            return redirect('/login');
        }

        return "Sorry Some anomaly occurred try again";

    }
}
