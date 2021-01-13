<?php

namespace App\Http\Controllers;
use App\Models\Customer;
use App\Models\H_order;
use App\Models\D_order;
use App\Models\Product;
use Illuminate\Http\Request;
$data=5;
class CostomerController extends Controller
{
 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       try {
        $data = request()->validate([
            'customer_id' =>['required','max:5','min:5','regex:/([A-Za-z0-9])+/'],
            'customer_date' =>['required','max:16','min:16','regex:/([A-Za-z0-9])+/']
            ]);
            $Customer = new Customer();
            $SelectCustomer = $Customer->where('Cus_id',$data['customer_id'])->get();
            if($SelectCustomer->count())
            {
                
                $H_order = new H_order();
                $H_order->Cus_id=$data['customer_id'];
                $H_order->Order_Date =$data['customer_date'];
                $H_order->save();
                $Select_H_order=$H_order
                ->join('cus_name', 'cus_name.Cus_id', '=', 'H_order.Cus_id')
                ->select('*')
                ->where('H_order.Cus_id',$data['customer_id'])
                ->where('H_order.Order_Date',$data['customer_date'])
                ->orderBy('Order_no', 'DESC')
                ->first();
                 $request->session()->put('Cus_name',$Select_H_order->Cus_name);
                 $request->session()->put('Order_no',$Select_H_order->Order_no);
                 $request->session()->put('Cus_id',$Select_H_order->Cus_id);
                 $request->session()->put('Order_Date',$Select_H_order->Order_Date);
                 return redirect('insert_product_order/-');
            }
            else
            {
                return view('confirm_customer',['error_customer_id'=>'NOT']);
            }
     } catch (Exception $e)
        {
           return redirect()->back();
        }
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $Product = new Product();
        $Order_no = $request->session()->get('Order_no');
        $Cus_id = $request->session()->get('Cus_id');
        $Order_Date = $request->session()->get('Order_Date');
        $Cus_name = $request->session()->get('Cus_name');
        $selectProduct = $Product->where('Goods_id',$id)->get();
        if($selectProduct->count())
        {
            foreach($selectProduct as $Products)
            {
                $Goods_id = $Products->Goods_id;
                $Goods_name = $Products->Goods_name;
                $coust_unit = $Products->coust_unit;
            }
            $check_product = true;
        }
        else
        {
            $Goods_id = '';
            $Goods_name = 'ยังไม่พบสินค้าที่ทำรายการ';
            $coust_unit = 0;
            $check_product = false;
        }

        try{
            $D_order = new D_order();
            $Select_D_order = $D_order
           ->join('goods_name', 'd_order.Goods_id', '=', 'goods_name.Goods_id')
           ->where('Order_no',$Order_no)
           ->get();
       
        } catch (Exception $e){
            return redirect()->back();
         }
        return view('add_data.add_order_customer',
        ['Order_no'=>$Order_no
        ,'Cus_id'=>$Cus_id
        ,'Order_Date'=>$Order_Date
        ,'Cus_name'=>$Cus_name
        ,'Goods_id'=>$Goods_id
        ,'Goods_name'=>$Goods_name
        ,'coust_unit'=>$coust_unit
        ,'check_product'=>$check_product
        ,'data_table'=>$Select_D_order
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
