<?php

namespace App\Http\Controllers;

use App\Gateway;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;

class GatewayController extends Controller
{
    public function __construct()
    {
        $this->pageSet = [
            'pagename'=>'Gateways',
            'menuTag'=>'Gateways',
            'menuHead'=>'',
            'actionHed'=>'gateway',
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
        $gateways = Gateway::all();

        return view('admin.gateways.index',['ps'=>$this->pageSet,'gateways'=>$gateways]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->pageSet['actionTyp'] = 'Create';

        return view('admin.gateways.create',['ps'=>$this->pageSet]);
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

        $gateway = Gateway::create($request->all());

        if($request->has('fileAttached')){
            $gateway
                ->addMediaFromRequest('fileAttached')
                ->toMediaCollection('gateways');
        }

        activity('gateway')->log('gateway'.$request->companyName.' record was CREATED by logged-in user '.Auth::user()->name);

        return redirect()->route('gateway.index')->with(['alert-type'=>'success','message'=>'New gateway was created successfuly']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Gateway  $gateway
     * @return \Illuminate\Http\Response
     */
    public function show(Gateway $gateway)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Gateway  $gateway
     * @return \Illuminate\Http\Response
     */
    public function edit(Gateway $gateway)
    {
        $this->pageSet['actionTyp'] = 'Edit';

        return view('admin.gateways.edit',['ps'=>$this->pageSet, 'prod'=>$gateway]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Gateway  $gateway
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gateway $gateway)
    {
        $validated = $request->validate([
            'companyName'=>'required|string',
        ]);

        $gateway->update($request->all());

        if($request->has('fileAttached')){
            $gateway
                ->addMediaFromRequest('fileAttached')
                ->toMediaCollection('gateways');
        }

        activity('gateway')->log('gateway'.$request->companyName.' record was UPDATED by logged-in user '.Auth::user()->name);

        return redirect()->route('gateway.index')->with(['alert-type'=>'success','message'=>'New gateway was created successfuly']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Gateway  $gateway
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gateway $gateway)
    {
        //
    }
}
