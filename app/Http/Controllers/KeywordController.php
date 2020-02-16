<?php

namespace App\Http\Controllers;

use App\Keyword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class KeywordController extends Controller
{
    public function __construct()
    {
        $this->pageSet = [
            'pagename'=>'Keywords',
            'menuTag'=>'Keywords',
            'menuHead'=>'',
            'actionHed'=>'keyword',
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
        $keywords = Keyword::all();

        return view('admin.keywords.index',['ps'=>$this->pageSet, 'keywords'=>$keywords]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->pageSet['actionTyp'] = 'Create';
        return view('admin.keywords.create',['ps'=>$this->pageSet]);
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
            'filter'=>'required|string',
            'title'=>'required',
        ]);

        $keyword = Keyword::create($request->all());

        if($request->has('fileAttached')){
            $keyword
                ->addMediaFromRequest('fileAttached')
                ->toMediaCollection('keywords');
        }

        activity('keyword')->log('keyword'.$request->companyName.' record was CREATED by logged-in user '.Auth::user()->name);

        return redirect()->route('keyword.index')->with(['alert-type'=>'success','message'=>'New keyword was created successfuly']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Keyword  $keyword
     * @return \Illuminate\Http\Response
     */
    public function show(Keyword $keyword)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Keyword  $keyword
     * @return \Illuminate\Http\Response
     */
    public function edit(Keyword $keyword)
    {
        $this->pageSet['actionTyp']='Edit';

        return view('admin.keywords.edit',['ps'=>$this->pageSet,'prod'=>$keyword]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Keyword  $keyword
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Keyword $keyword)
    {
        $validated = $request->validate([
            'filter'=>'required|string',
            'title'=>'required',
        ]);

        $keyword->update($request->all());

        if($request->has('fileAttached')){
            $keyword
                ->addMediaFromRequest('fileAttached')
                ->toMediaCollection('keywords');
        }

        activity('keyword')->log('keyword'.$request->companyName.' record was CREATED by logged-in user '.Auth::user()->name);

        return redirect()->route('keyword.index')->with(['alert-type'=>'success','message'=>'New keyword was created successfuly']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Keyword  $keyword
     * @return \Illuminate\Http\Response
     */
    public function destroy(Keyword $keyword)
    {
        //
    }
}
