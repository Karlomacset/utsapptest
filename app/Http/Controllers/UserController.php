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
        // $this->roles = Role::all();
        $this->middleware(['role:administrator']);

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

        $prod = User::create($request->all());
        if($request->has('role')){
            $prod->assignRole($request->role);
        }

        activity()->log('Product '.$request->title.' record was CREATED by logged-in user '.Auth::user()->name);

        return redirect()->route('product.index')->with(['alert-type'=>'success','message'=>'New Agent was created successfuly']);
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
