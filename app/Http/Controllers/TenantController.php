<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use App\Tenant;
use App\User;

class TenantController extends Controller
{
    public function __construct()
    {
        $this->pageSet = [
            'pagename'=>'Tenants',
            'menuTag'=>'Tenants',
            'menuHead'=>'',
            'actionHed'=>'tenant',
            'actionTyp'=>'List',
            'actionID'=>0
        ];

        // $this->middleware('permission:admin-create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:admin-edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:admin-show', ['only' => ['index']]);
        // $this->middleware('permission:admin-delete', ['only' => ['destroy']]);
        $this->middleware(['role:administrator']);
 
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tenants = Tenant::all();

        return view('tenants.index',['ps'=>$this->pageSet,'tenants'=>$tenants]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tenants.create',['ps'=>$this->pageSet]);
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
            'name' => 'required|string|max:255',
            'subdomain'=>'required|string',
            'alias_domain'=>'required|string',
        ]);
        
        $tenant = Tenant::create($request->all());

        //create the database 
        $exitCode = Artisan::call('db:create',['dbname'=>$request->subdomain]);

        //run the artisan to create the tenant db
        $createTenant = Artisan::call('tenant:create',[
            'dbname'=>$request->subdomain,
            '--seed'=>true,
            '--force'=>true,
        ]);

        return redirect()->route('tenant.index')->with(['alert-type'=>'success','message'=>'Tenant & database was CREATED successfully']);
        
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
        $tenant = Tenant::find($id);
        $this->pageSet['actionID']= $id;
        $this->pageSet['actionTyp']= 'Edit';

        return view('tenants.edit',['tenant'=>$tenant,'ps'=>$this->pageSet]);
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
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'subdomain'=>'required|string',
            'alias_domain'=>'required|string',
        ]);

        $tenant = Tenant::find($id);
        $tenant->update($request->all());

        return redirect()->route('tenant.index')->with(['alert-type'=>'success','message'=>'Tenant & database was CREATED successfully']);
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
