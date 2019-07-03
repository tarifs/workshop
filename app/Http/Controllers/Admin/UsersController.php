<?php

namespace App\Http\Controllers\Admin;
use Session;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.users.index')
                ->with('users', User::orderBy('name')->get());
    }

    public function jsonIndex()
    {
        return response()->json(User::orderBy('name')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create')
                ->with('user', new User());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'rule' => ['required'],
        ]);
            
        $request['is_admin'] = $request->rule;
        $request['password'] = bcrypt($request->password);

        if(User::create($request->all())){
            return redirect()->route('admin.users.index')->with('message','User Created Successfully.');
        }
        return redirect()->back();
        
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
    public function edit(User $user)
    {
        return view('admin.users.edit')
                ->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request,[
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'password' => ['nullable','string', 'min:8', 'confirmed'],
        ]);
        if($request->rule){
            $request['is_admin'] = $request->rule;
        }
        if($request->password == null){
            $request['password'] = $user->password;
        }else{
            $request['password'] = bcrypt($request->password);
        }

        if($user->update($request->all())){
            return redirect()->route('admin.users.index')->with('message','User Update Successfully');
        }

        return redirect()->back();
    }
    public function reverseRule(User $user)
    {
        $user->is_admin = !$user->is_admin;
        if($user->save()){
            Session::flash('success','User rule has been changed successfully');
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if($user->delete()){
            return redirect()->route('admin.users.index')->with('message','User Delete Successfully');
        }

        return redirect()->back();
    }
}
