<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
     /**
     * Where to redirect users after registration.
     *
     * @var string
     */
     protected $redirectTo = '/users';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::latest('updated_at', 'asc')->paginate(3);
        $usersCount = User::Count();
        return view('dash.uzers.index', compact('users', 'usersCount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dash.uzers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*$this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'firstname' => 'required',
            'lastname' => 'required'
            ]);*/
        //$user = new User;
        //$user->name = $request->name;
        //$user->email = $request->email;
        //$user->password = bcrypt($request->password);
        //$user->firstname = $request->firstname;
        //$user->lastname = $request->lastname;
        //$user->save();
        //$request->session()->flash('msg-success', 'User has been added successful');
        //return redirect('/users');

            $this->validateInput($request);
            User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => bcrypt($request['password']),
                'firstname' => $request['firstname'],
                'lastname' => $request['lastname']
                ]);
            $request->session()->flash('msg-success', 'User has been added successful');

            return redirect()->intended('/users')->with('msg-success', 'User successful added');
        }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $user = User::findOrFail($user->id);
        return view ('dash.uzers.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $user = User::findOrFail($user->id);
        // Redirect to user list if updating user wasn't existed
        if ($user == null || count($user) == 0) {
            return redirect()->intended('/users');
        }

        return view ('dash.uzers.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       /*$this->validate($request, [
        'name' => 'required',
        'email' => 'required',
        'password' => 'required',
        'firstname' => 'required',
        'lastname' => 'required'
        ]);
       $user->name = $request->name;
       $user->email = $request->email;
       $user->password = bcrypt($request->password);
       $user->firstname = $request->firstname;
       $user->lastname = $request->lastname;
       $user->save();
       $request->session()->flash('msg-success', 'User has been updated successful');
       return redirect('/users');*/

       $user = User::findOrFail($id);
       $constraints = [
       'name' => 'required|max:20',
       'firstname'=> 'required|max:60',
       'lastname' => 'required|max:60'
       ];
       $input = [
       'name' => $request['name'],
       'firstname' => $request['firstname'],
       'lastname' => $request['lastname']
       ];
       if ($request['password'] != null && strlen($request['password']) > 0) {
        $constraints['password'] = 'required|min:6|confirmed';
        $input['password'] =  bcrypt($request['password']);
    }
    $this->validate($request, $constraints);
    User::where('id', $id)
    ->update($input);
    $request->session()->flash('msg-success', 'User has been updated successful');

    return redirect()->intended('/users');

}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, User $user)
    {
        $user = User::findOrFail($user->id);
        $user->delete();
        $request->session()->flash('msg-success', 'User has been deleted successful');
        return back();
    }

    public function is_admin(Request $request, User $user)
    {
        $user = User::findOrFail($user->id);
        if($user->is_admin == false){
            $user->is_admin = true;
            $user->updated_at = Carbon::now();
            $user->save();
            $request->session()->flash('msg-success', 'Admin');
            return back();
        }else{
            $user->is_admin = false;
            $user->updated_at = Carbon::now();
            $user->save();
            $request->session()->flash('msg-success', 'Normal User');
            return back();
        }
    }


    private function validateInput($request) {
        $this->validate($request, [
            'name' => 'required|max:20',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'firstname' => 'required|max:60',
            'lastname' => 'required|max:60'
            ]);
    }

    public function search(Request $request) {
        $constraints = [
        'name' => $request['name'],
        'firstname' => $request['firstname'],
        'lastname' => $request['lastname']
        ];

        $users = $this->doSearchingQuery($constraints);
        return view('dash.uzers.index', ['users' => $users, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints) {
        $query = User::query();
        $fields = array_keys($constraints);
        $index = 0;
        foreach ($constraints as $constraint) {
            if ($constraint != null) {
                $query = $query->where( $fields[$index], 'like', '%'.$constraint.'%');
            }

            $index++;
        }
        return $query->paginate(5);
    }

    public function not_found()
    {
        return view('not-defined.not-defined');
    }
}
