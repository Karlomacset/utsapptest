<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
   
        $this->pageSet = [
            'pagename'=>'Dashboard',
            'menuTag'=>'Dashboard',
            'menuHead'=>'',
            'actionHed'=>'dashboard',
            'actionTyp'=>'List',
            'actionID'=>0
        ];

        // $this->middleware('permission:admin-create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:admin-edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:admin-show', ['only' => ['index']]);
        // $this->middleware('permission:admin-delete', ['only' => ['destroy']]);
        // $this->roles = Role::all();

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('dashboard', ['ps'=>$this->pageSet]);
    }
}
