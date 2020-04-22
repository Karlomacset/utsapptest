<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->pageSet = [
            'pagename'=>'Clients',
            'menuTag'=>'Clients',
            'menuHead'=>'',
            'actionHed'=>'client',
            'actionTyp'=>'List',
            'actionID'=>0
        ];

        // $this->middleware('permission:admin-create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:admin-edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:admin-show', ['only' => ['index']]);
        // $this->middleware('permission:admin-delete', ['only' => ['destroy']]);
        // $this->roles = Role::all();
        $this->middleware(['role:administrator|user|supervisor']);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::all();

        return view('clients.index',['ps'=>$this->pageSet, 'clients'=>$clients]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('clients.create',['ps'=>$this->pageSet]);
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

        $prod = Client::create($request->all());
        if($request->has('fileAttached')){
            $prod
                ->addMediaFromRequest('fileAttached')
                ->toMediaCollection('clients');
        }

        activity()->log('Client '.$request->companyName.' record was CREATED by logged-in user '.Auth::user()->name);

        return redirect()->route('client.index')->with(['alert-type'=>'success','message'=>'New Agent was created successfuly']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        return view('clients.edit',['ps'=>$this->pageSet,'client'=>$client]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        $validated = $request->validate([
            'companyName'=>'required|string',
        ]);

        $client->update($request->all());
        if($request->has('fileAttached')){
            $client
                ->addMediaFromRequest('fileAttached')
                ->toMediaCollection('clients');
        }

        activity()->log('Client '.$request->companyName.' record was UPDATED by logged-in user '.Auth::user()->name);

        return redirect()->route('client.index')->with(['alert-type'=>'success','message'=>'New Agent was UPDATED successfuly']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        //
    }
}
