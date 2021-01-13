<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\D_order;
use App\Models\H_order;
use App\Models\M_order;
use App\Models\Product;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        $H_order = new H_order();
        $Select_H_order = $H_order 
        ->join('d_order', 'h_order.Order_no', '=', 'd_order.Order_no')
        ->join('cus_name', 'h_order.Cus_id', '=', 'cus_name.Cus_id')
        ->select('d_order.*','h_order.*','cus_name.*',DB::raw('count(*) as CNT'),DB::raw('SUM(d_order.Amount) as AMOUNT'))
        ->groupBy('d_order.Order_no')
        ->get();

        return view('order_product',['data'=>$Select_H_order]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data = request()->validate([
            'product_id' =>['required','max:10','min:10','regex:/([0-9])+/'],
            'product_Ord_date' =>['required','date','max:16','min:16','regex:/([A-Za-z0-9])+/'],
            'product_Fin_date' =>['nullable','date'],
            'product_Amount' =>['required','max:10','regex:/([0-9])+/']
            ]);
         if($data)
         {
             $Product = new Product();
             if($Select_product=$Product->where('Goods_id',$data['product_id'])->get())
             {
                foreach($Select_product as $product)
                {
                    $Goods_id = $product->Goods_id;
                    $COST_UNIT = $product->coust_unit;
                }
                $Order_no = $request->session()->get('Order_no');
                $Ord_date = $data['product_Ord_date'];
                $Fin_date = $data['product_Fin_date'];
                $Amount = $data['product_Amount'];
                $TOT_PRC = $Amount*$COST_UNIT;
                try{   
                    $D_order = new D_order();
                    $D_order->Order_no = $Order_no;
                    $D_order->Goods_id = $Goods_id;
                    $D_order->Ord_date = $Ord_date;
                    $D_order->Fin_date = $Fin_date;
                    $D_order->Amount = $Amount;
                    $D_order->COST_UNIT = $COST_UNIT;
                    $D_order->TOT_PRC = $TOT_PRC;
                   if( $D_order->save())
                    return redirect('insert_product_order/');
                    else 
                    return redirect()->back();
                } catch (Exception $e){
                   return redirect()->back();
                }
             }
 
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
      $H_order = new H_order();
      $Select_H_order = $H_order 
      ->join('d_order', 'h_order.Order_no', '=', 'd_order.Order_no')
      ->join('cus_name', 'h_order.Cus_id', '=', 'cus_name.Cus_id')
      ->join('goods_name', 'goods_name.Goods_id', '=', 'd_order.Goods_id')
      ->select('*')
      ->where('d_order.Order_no',$id)
      ->get();
      if($Select_H_order->count()>0)
      {
        foreach($Select_H_order as $item)
        {
            $Order_no = $item->Order_no;
            $Cus_id = $item->Cus_id;
            $Order_Date = $item->Order_Date;
            $Cus_name = $item->Cus_name;
        }
        
       return view('edit_data.order_customer',
       ['Order_no'=>$Order_no
       ,'Cus_id'=>$Cus_id
       ,'Order_Date'=>$Order_Date
       ,'Cus_name'=>$Cus_name
       ,'data_table'=>$Select_H_order
       ]);
      }
      else {
        return redirect('order_product');
      }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id,$id_product)
    {
        $D_order = new D_order();
        $Select_D_order = $D_order
        ->join('goods_name', 'goods_name.Goods_id', '=', 'd_order.Goods_id')
        ->join('h_order', 'h_order.Order_no', '=', 'd_order.Order_no')
        ->join('cus_name', 'cus_name.Cus_id', '=', 'h_order.Cus_id')
        ->select('*')
        ->where('d_order.id_d_order',$id)->first();
        $Order_no = $Select_D_order->Order_no;
        $Cus_id = $Select_D_order->Cus_id;
        $Order_Date = $Select_D_order->Order_Date;
        $Cus_name = $Select_D_order->Cus_name;
        $Ord_date = substr($Select_D_order->Ord_date,0,10).'T00:00';
        $Product = new Product();
        $Select_Product = $Product
        ->select('*')
        ->where('Goods_id',$id_product)->get();
        if($Select_Product->count())
        {
            foreach($Select_Product as $Products)
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
        $Amount = $Select_D_order->Amount;
        return view('edit_data.order_product',
        ['Order_no'=>$Order_no
        ,'Cus_id'=>$Cus_id
        ,'Order_Date'=>$Order_Date
        ,'Cus_name'=>$Cus_name
        ,'Goods_id'=>$Goods_id
        ,'Goods_name'=>$Goods_name
        ,'Amount'=>$Amount
        ,'coust_unit'=>$coust_unit
        ,'check_product'=>true
        ,'id_d_order'=>$id
        ,'Ord_date'=>$Ord_date
        ]);
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
         $id=$request->id_d_order;
         $D_order = new D_order();
         $Select_D_order = $D_order
         ->join('goods_name', 'goods_name.Goods_id', '=', 'd_order.Goods_id')
        ->select('*')
        ->where('d_order.id_d_order',$id)->first();
        
        $Goods_id = $request->product_id;
        $Ord_date = $request->product_Ord_date;
        $Fin_date = $request->product_Fin_date;
        $Amount = $request->product_Amount;
        $COST_UNIT = $Select_D_order->coust_unit;
        $TOT_PRC = $COST_UNIT*$Amount;
        
        $update_D_order = $D_order->where('id_D_order',$id)->update(
        [
         'Goods_id' => $Goods_id
        ,'Ord_date' => $Ord_date
        ,'Fin_date' => $Fin_date
        ,'Amount' => $Amount
        ,'COST_UNIT' => $COST_UNIT
        ,'TOT_PRC' => $TOT_PRC
        ]);
        return redirect('edit_product_order/'.$id.'/'.$Goods_id);
        
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,$Order_no)
    {
        
        $D_order = new D_order();
        $H_order = new H_order();
        $Select_D_order = $D_order
       ->select('*')
       ->where('Order_no',$Order_no)->get();

        if($Select_D_order->count()==1)
        {
            $Select_D_order = $D_order
            ->select('*')
            ->where('id_d_order',$id)->delete();   

            $Select_H_order = $H_order
            ->select('*')
            ->where('Order_no',$Order_no)->delete();   
            return redirect('order_product');

        }
        else {
            $Select_D_order = $D_order
            ->select('*')
            ->where('id_d_order',$id)->delete();   
            return redirect('show_order_product/'.$Order_no);
        }
    }


    public function destroy_Order($Order_no)
    {
        $H_order = new H_order();
        $D_order = new D_order();
        $Select_H_order = $H_order
        ->select('*')
        ->where('Order_no',$Order_no)->get();

        if($Select_H_order->count()>0)
        {
            $Select_D_order = $D_order
            ->select('*')
            ->where('Order_no',$Order_no)->delete();
            $Select_H_order = $H_order
            ->select('*')
            ->where('Order_no',$Order_no)->delete();
            return redirect('order_product');
        }
        else
        {
            return redirect('order_product');
        }
    }


    public function report_order_customer(Request $request)
    {

        $gdoc_date1 = '';
        $gdoc_date2 = '';
        $D_order = new D_order();
        $Select_D_order = $D_order
        ->join('goods_name', 'goods_name.Goods_id', '=', 'd_order.Goods_id')
        ->join('h_order', 'h_order.Order_no', '=', 'd_order.Order_no')
        ->join('cus_name', 'cus_name.Cus_id', '=', 'h_order.Cus_id')
        ->select('*')
        ->havingRaw('Ord_date >= ?',[$gdoc_date1])
        ->havingRaw('Ord_date <= ?',[$gdoc_date2])
        ->whereNull('Fin_date')
         ->get();
         $total_Amount = 0;
         $total_TOT_PRC = 0;
        foreach($Select_D_order as $item)
        {
            $total_Amount +=$item->Amount;
            $total_TOT_PRC +=$item->TOT_PRC;
        }
            return view('report_order_customer',
            ['table_data'=>$Select_D_order
            ,'count'=>0
            ,'total_Amount'=>$total_Amount
            ,'total_TOT_PRC'=>$total_TOT_PRC
            ,'gdoc_date1'=>$gdoc_date2
            ,'gdoc_date2'=>$gdoc_date2
            ]);
        
      }
    public function get_report_order_customer(Request $request)
    {
        $data = request()->validate([
            'gdoc_date1' =>['required','max:16','min:16','regex:/([A-Za-z0-9])+/'],
            'gdoc_date2' =>['required','max:16','min:16','regex:/([A-Za-z0-9])+/']
            ]);
        $gdoc_date1 = $data['gdoc_date1'];
        $gdoc_date2 = $data['gdoc_date2'];
        $D_order = new D_order();
        $Select_D_order = $D_order
        ->join('goods_name', 'goods_name.Goods_id', '=', 'd_order.Goods_id')
        ->join('h_order', 'h_order.Order_no', '=', 'd_order.Order_no')
        ->join('cus_name', 'cus_name.Cus_id', '=', 'h_order.Cus_id')
        ->select('*')
        ->havingRaw('Ord_date >= ?',[$gdoc_date1])
        ->havingRaw('Ord_date <= ?',[$gdoc_date2])
        ->whereNull('Fin_date')
         ->get();
         $total_Amount = 0;
         $total_TOT_PRC = 0;
        foreach($Select_D_order as $item)
        {
            $total_Amount +=$item->Amount;
            $total_TOT_PRC +=$item->TOT_PRC;
        }
            return view('report_order_customer',
            ['table_data'=>$Select_D_order
            ,'count'=>0
            ,'total_Amount'=>$total_Amount
            ,'total_TOT_PRC'=>$total_TOT_PRC
            ,'gdoc_date1'=>$gdoc_date1
            ,'gdoc_date2'=>$gdoc_date2
            ]);
        
      }
      public function excel_report_order_customer(Request $request,$gdoc_date1,$gdoc_date2)
      {

          $D_order = new D_order();
          $Select_D_order = $D_order
          ->join('goods_name', 'goods_name.Goods_id', '=', 'd_order.Goods_id')
          ->join('h_order', 'h_order.Order_no', '=', 'd_order.Order_no')
          ->join('cus_name', 'cus_name.Cus_id', '=', 'h_order.Cus_id')
          ->select('*')
          ->havingRaw('Ord_date >= ?',[$gdoc_date1])
          ->havingRaw('Ord_date <= ?',[$gdoc_date2])
          ->whereNull('Fin_date')
           ->get();
           $total_Amount = 0;
           $total_TOT_PRC = 0;
          foreach($Select_D_order as $item)
          {
              $total_Amount +=$item->Amount;
              $total_TOT_PRC +=$item->TOT_PRC;
          }
              return view('report_excel_order_customer',
              ['table_data'=>$Select_D_order
              ,'count'=>0
              ,'total_Amount'=>$total_Amount
              ,'total_TOT_PRC'=>$total_TOT_PRC
              ,'gdoc_date1'=>$gdoc_date1
              ,'gdoc_date2'=>$gdoc_date2
              ]);
          
        }

        public function process_order_customer(Request $request)
    {
        $gdoc_date1 = '';
        $gdoc_date2 = '';
        $D_order = new D_order();
        $Select_D_order = $D_order
        ->join('goods_name', 'goods_name.Goods_id', '=', 'd_order.Goods_id')
        ->join('h_order', 'h_order.Order_no', '=', 'd_order.Order_no')
        ->join('cus_name', 'cus_name.Cus_id', '=', 'h_order.Cus_id')
        ->select('*')
        ->havingRaw('Ord_date >= ?',[$gdoc_date1])
        ->havingRaw('Ord_date <= ?',[$gdoc_date2])
         ->get();
         $total_Amount = 0;
         $total_TOT_PRC = 0;
        foreach($Select_D_order as $item)
        {
            $total_Amount +=$item->Amount;
            $total_TOT_PRC +=$item->TOT_PRC;
        }
            return view('process_order_customer',
            ['table_data'=>$Select_D_order
            ,'count'=>0
            ,'total_Amount'=>$total_Amount
            ,'total_TOT_PRC'=>$total_TOT_PRC
            ,'gdoc_date1'=>$gdoc_date2
            ,'gdoc_date2'=>$gdoc_date2
            ]);
        
      }
      public function process_report_order_customer(Request $request)
      {
          $data = request()->validate([
              'gdoc_date1' =>['required','max:16','min:16','regex:/([A-Za-z0-9])+/'],
              'gdoc_date2' =>['required','max:16','min:16','regex:/([A-Za-z0-9])+/']
              ]);
          $gdoc_date1 = $data['gdoc_date1'];
          $gdoc_date2 = $data['gdoc_date2'];
          $D_order = new D_order();
          $Select_D_order = $D_order
          ->join('goods_name', 'goods_name.Goods_id', '=', 'd_order.Goods_id')
          ->join('h_order', 'h_order.Order_no', '=', 'd_order.Order_no')
          ->join('cus_name', 'cus_name.Cus_id', '=', 'h_order.Cus_id')
          ->select('*')
          ->havingRaw('Ord_date >= ?',[$gdoc_date1])
          ->havingRaw('Ord_date <= ?',[$gdoc_date2])
           ->get();
           $total_Amount = 0;
           $total_TOT_PRC = 0;
          foreach($Select_D_order as $item)
          {
              $total_Amount +=$item->Amount;
              $total_TOT_PRC +=$item->TOT_PRC;
          }
              return view('process_order_customer',
              ['table_data'=>$Select_D_order
              ,'count'=>0
              ,'total_Amount'=>$total_Amount
              ,'total_TOT_PRC'=>$total_TOT_PRC
              ,'gdoc_date1'=>$gdoc_date1
              ,'gdoc_date2'=>$gdoc_date2
              ]);
        }

        public function process_report_order_customer_active(Request $request,$gdoc_date1,$gdoc_date2)
      {
          $H_order = new H_order();
          $D_order = new D_order();
          $M_order = new M_order();
          $Select_D_order = $D_order
          ->join('goods_name', 'goods_name.Goods_id', '=', 'd_order.Goods_id')
          ->join('h_order', 'h_order.Order_no', '=', 'd_order.Order_no')
          ->join('cus_name', 'cus_name.Cus_id', '=', 'h_order.Cus_id')
          ->select('*')
          ->havingRaw('Ord_date >= ?',[$gdoc_date1])
          ->havingRaw('Ord_date <= ?',[$gdoc_date2])
           ->get();
        foreach($Select_D_order as $item)
        {
            $Cus_id = $item->Cus_id;
            $Good_id = $item->Goods_id;
            $Doc_date = $item->Order_Date;
            $Ord_date = $item->Ord_date;
            $Order_no = $item->Order_no;
            if( $item->Fin_date==null)
            {
                $Fin_date = date("Y-m-d").'T00:00';
            }
            else
            {
                $Fin_date = $item->Fin_date;
            } 
            $Amount = $item->Amount;
            $cost_tot = $item->COST_UNIT;
           
            $Select_D_order = $D_order
            ->select('*')
             ->where('Order_no',$Order_no)->delete();
             
            $Select_H_order = $H_order
             ->select('*')
             ->where('Order_no',$Order_no)->delete();
             
            $M_order->insert([
                ['Cus_id' => $Cus_id
                , 'Good_id' => $Good_id
                , 'Doc_date' => $Doc_date
                , 'Ord_date' => $Ord_date
                , 'Fin_date' => $Fin_date
                , 'Amount' => $Amount
                , 'Sys_date' => date("Y-m-d")
                , 'cost_tot' => $cost_tot  
               ]
            ]);
            
        }
        
        $total_Amount = 0;
        $total_TOT_PRC = 0;
        $Select_D_order = $D_order
        ->join('goods_name', 'goods_name.Goods_id', '=', 'd_order.Goods_id')
        ->join('h_order', 'h_order.Order_no', '=', 'd_order.Order_no')
        ->join('cus_name', 'cus_name.Cus_id', '=', 'h_order.Cus_id')
        ->select('*')
        ->havingRaw('Ord_date >= ?',[$gdoc_date1])
        ->havingRaw('Ord_date <= ?',[$gdoc_date2])
         ->get();
        return view('process_order_customer',
        ['table_data'=>$Select_D_order
        ,'count'=>0
        ,'total_Amount'=>$total_Amount
        ,'total_TOT_PRC'=>$total_TOT_PRC
        ,'gdoc_date1'=>$gdoc_date1
        ,'gdoc_date2'=>$gdoc_date2
        ]);
    }
}

