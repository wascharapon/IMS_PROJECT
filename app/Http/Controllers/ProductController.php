<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
        try {
            $data = request()->validate([
                'product_name' =>['required','max:30','regex:/([A-Za-z0-9ก-ฮ])+/'],
                'product_price' =>['required','max:8','regex:/^-?[0-9]+(?:\.[0-9]{1,2})?$/']
                ]);
            $Product = new Product();
            $Product->Goods_name = $request->product_name;
            $Product->coust_unit = number_format($request->product_price, 2, '.', '');
            $Product->save();
            return redirect('product');
         } catch (Exception $e)
            {
               return redirect()->back();
            }
    
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,Request $request)
    {
 

        try {
            $data = request()->validate([
                'id' =>['max:10','min:10','regex:/([0-9 ])+/']
                ]);
                $Product = new Product();
                $select_Product = $Product->where('Goods_id', $id)->get();
                if($select_Product->count())
                {
                return view('edit_data.product',['data'=>$select_Product]);
                }
                else
                {
                    return redirect('product');
                }
         } catch (Exception $e)
            {
               return redirect()->back();
            }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
        $data = request()->validate([
            'product_id' =>['required','max:10','regex:/^-?[0-9]+(?:\.[0-9]{1,2})?$/'],
            'product_name' =>['required','max:30','regex:/([A-Za-z0-9ก-ฮ])+/'],
            'product_price' =>['required','max:8','regex:/^-?[0-9]+(?:\.[0-9]{1,2})?$/']
            ]);
        $Product = new Product();
        $DBdata=$Product->where('Goods_id',$data['product_id'])->update(['Goods_name' => $data['product_name'],'coust_unit'=> $data['product_price']]);
        if($DBdata)
        {
            return redirect()->back();
        }
        else
        {
            return redirect()->back();
        }
     } catch (Exception $e)
        {
           return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $data = request()->validate([
                'id' =>['max:10','min:10','regex:/([0-9 ])+/']
                ]);
                $Product = new Product();
                if($select_Product = $Product->where('Goods_id', $id)->delete())
                {
                return redirect('product');
                }
                else
                {
                    return redirect()->back();
                }
         } catch (Exception $e)
            {
               return redirect()->back();
            }
    }
}
