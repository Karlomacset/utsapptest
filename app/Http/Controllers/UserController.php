<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    public function __construct()
    {
        $this->pageSet = [
            'pagename'=>'Web Users',
            'menuTag'=>'Web Users',
            'menuHead'=>'',
            'actionHed'=>'user',
            'actionTyp'=>'List',
            'actionID'=>0
        ];

        // $this->middleware('permission:admin-create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:admin-edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:admin-show', ['only' => ['index']]);
        // $this->middleware('permission:admin-delete', ['only' => ['destroy']]);
        $this->middleware(['permission:edit|update','role:administrator|supervisor']);
        $this->roles = Role::all();
        

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return view('admin.users.index',['ps'=>$this->pageSet,'users'=>$users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create',['ps'=>$this->pageSet,'roles'=>$this->roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'name'=>'required|string',
            'password'=>'confirmed',
        ]);

        $user = User::create($request->all());
        $user->password = bcrypt($request->password);
        $user->save();

        if($request->has('role')){
            $user->assignRole($request->role);
        }

        if($request->has('fileAttached')){
            $user
                ->addMediaFromRequest('fileAttached')
                ->toMediaCollection('profile');
        }

        activity()->log('web user '.$request->name.' record was CREATED by logged-in user '.Auth::user()->name);

        return redirect()->route('user.index')->with(['alert-type'=>'success','message'=>'New User was created successfuly']);
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
        $roles = Role::all();

        return view('admin.users.edit',['ps'=>$this->pageSet,'roles'=>$roles, 'prod'=>$user]);
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
        $validated = $request->validate([
            'name'=>'required|string',
            'email'=>'required'
        ]);
        
        if($request->has('role')){
            $user->assignRole($request->role);
        }
        if($request->password != null){
            $user->update($request->all());
        }else{
            $user->password = bcrypt($request->password);
            $user->save();
        }

        if($request->has('fileAttached')){
            $user
                ->addMediaFromRequest('fileAttached')
                ->toMediaCollection('profile');
        }

        activity()->log('user '.$request->name.' record was UPDATED by logged-in user '.Auth::user()->name);

        return redirect()->route('user.index')->with(['alert-type'=>'success','message'=>'New User was UPDATED successfuly']);
    
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
}
