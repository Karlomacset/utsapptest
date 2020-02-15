<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->pageSet = [
            'pagename'=>'Products',
            'menuTag'=>'Products',
            'menuHead'=>'',
            'actionHed'=>'product',
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
        $allprod = Product::all();

        return view('admin.products.index',['ps'=>$this->pageSet,'products'=>$allprod]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->pageSet['actionTyp'] = 'Create';
        return view('admin.products.create',['ps'=>$this->pageSet]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
