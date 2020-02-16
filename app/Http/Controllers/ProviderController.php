<?php

namespace App\Http\Controllers;

use App\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class ProviderController extends Controller
{
    public function __construct()
    {
        $this->pageSet = [
            'pagename'=>'Providers',
            'menuTag'=>'Providers',
            'menuHead'=>'',
            'actionHed'=>'provider',
            'actionTyp'=>'List',
            'actionID'=>0
        ];

        // $this->middleware('permission:admin-create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:admin-edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:admin-show', ['only' => ['index']]);
        // $this->middleware('permission:admin-delete', ['only' => ['destroy']]);
        // $this->roles = Role::all();
        $this->middleware('auth');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $providers = Provider::all();

        return view('admin.providers.index',['ps'=>$this->pageSet,'providers'=>$providers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->pageSet['actionTyp'] = 'Create';

        return view('admin.providers.create',['ps'=>$this->pageSet]);
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
            'companyName'=>'required|string',
        ]);

        $provider = Provider::create($request->all());

        if($request->has('fileAttached')){
            $provider
                ->addMediaFromRequest('fileAttached')
                ->toMediaCollection('providers');
        }

        activity()->log('Provider'.$request->companyName.' record was CREATED by logged-in user '.Auth::user()->name);

        return redirect()->route('provider.index')->with(['alert-type'=>'success','message'=>'New Provider was created successfuly']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function show(Provider $provider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function edit(Provider $provider)
    {
        $this->pageSet['actionTyp'] = 'Edit';

        return view('admin.providers.edit',['ps'=>$this->pageSet,'prod'=>$provider]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Provider $provider)
    {
        $validated = $request->validate([
            'companyName'=>'required|string',
        ]);

        $provider->update($request->all());
        if($request->has('fileAttached')){
            $provider
                ->addMediaFromRequest('fileAttached')
                ->toMediaCollection('providers');
        }

        activity()->log('Provider'.$request->companyName.' record was UPDATED by logged-in user '.Auth::user()->name);

        return redirect()->route('provider.index')->with(['alert-type'=>'success','message'=>'A Provider was UPDATED successfuly']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Provider $provider)
    {
        //
    }
}
