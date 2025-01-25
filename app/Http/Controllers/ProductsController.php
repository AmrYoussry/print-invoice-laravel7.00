<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Products;
use App\Section;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sec = Section::all();
        $pro = Products::all();
        return view('products.products',compact('sec','pro'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'product_name'=>'required|unique:products|max:255',
            'section_id'=>'required',
            'description'=>'required'
        ],[
            'product_name.required'=>'يجب ادخال اسم المنتج',
            'product_name.unique'=>'اسم المنتج مسجل مسبقا',
            'section_id.required' => ' يجب ادخال القسم',
        ]);
        products::create([
            'product_name'=>$request->product_name,
            'section_id'=>$request->section_id,
            'description'=>$request->description,

        ]);
        session()->flash('Add','تم حفظ المنتج بنجاح');
        return redirect('/products');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(Products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit(Products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $id = Section::where('section_name', $request->section_name)->first()->id;

        $Products = Products::findOrFail($request->pro_id);

        $Products->update([
            'product_name'=>$request->Product_name,
            'section_id'=>$id,
            'description'=>$request->description,
        ]);
        session()->flash('edit', 'تم تعديل المنتج بنجاح');
        return redirect('/products');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $products = Products::findOrFail($request->pro_id);
        $products->delete();
        session()->flash('delete','تم حذف المنتج بنجاح');
        return back();
    }
}
