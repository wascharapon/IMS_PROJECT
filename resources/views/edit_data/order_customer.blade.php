@extends('master.admin')

@section('title','การบันทึก/แก้ไข ข้อมูลสินค้า')

@section('content')
<style>

  .input-group-text{
    height:100% !important;
  }
  @media only screen and (min-width: 700px) {
    .input_nunber {
      margin-top:15%
  }
  .input_align{
    text-align:center;
  }
}
</style>
<link rel="stylesheet" type="text/css" href="{{ asset('css\table_scroll_small.css') }}">
    <div class="row">
      <div class="col-md-1"> </div>
      <div class="col-md-10 text-center bg-danger text-white border ">
        <h3>การบันทึกและแก้ไขข้อมูล</h3>
      </div>
      <div class="col-md-1"></div>
   </div>
   <div class="row">
    <div class="col-md-1"> </div>
    <div class="col-md-10 border-left border-right  ">
      <div class="row">
        <div class="col-md-12 ">
          <div class="mt-3"></div>
          <h6>สถานะ : แก้ไขส่วน Detail การรับคำสั่งซื้อสินค้า</h6>
          <div class="mt-3"></div>
          <h6>เพิ่มข้อมูล Detail</h6>
          <div class="row">
            <div class="col-md-3">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                 <h6 class="mt-2">รหัสลูกค้า &nbsp;</h6> <span class="input-group-text">{{ $Cus_id }}</span>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                 <h6 class="mt-2">ชื่อลูกค้า &nbsp;</h6> <span class="input-group-text" >{{ $Cus_name }}</span>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                 <h6 class="mt-2">วันที่สั่ง &nbsp;</h6> <span class="input-group-text">{{ $Order_Date }}</span>
                </div>
              </div>
            </div>
            <div class="col-md-2">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                 <h6 class="mt-2" style="font-size:30%">No Order &nbsp;</h6> <span class="input-group-text" >{{ $Order_no }}</span>
                </div>
              </div>
            </div>
          </div>
          
          <hr color='#dee2e6' width=100%>
          <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>รหัสสินค้า</th>
                        <th>รายละเอียด</th>
                        <th>วันกำหนดส่ง</th>
                        <th>วันที่ส่งสินค้าจริง</th>
                        <th>จำนวนสั่ง</th>
                        <th>ราคา/หน่วย</th>
                        <th>ราคารวม</th>
                        <th>แก้ไข</th>
                        <th>ลบ</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach ($data_table as $item)
                  <tr>
                    <td>{{ $item->Goods_id }}</td>
                    <td>{{ $item->Goods_name }}</td>
                    <td>{{ $item->Ord_date }}</td>
                    <td>
                    @if ($item->Fin_date=='')
                        ยังไม่ได้ลงวันที่
                    @else
                      {{ $item->Fin_date }}
                    @endif
                  </td>
                    <td>{{ number_format($item->Amount) }}</td>
                    <td>{{ number_format($item->COST_UNIT,2) }}</td>
                    <td>{{ number_format($item->TOT_PRC,2) }}</td>
                    <td> <button class="btn btn-outline-warning" onclick="window.location='../edit_product_order/{{ $item->id_d_order }}/{{ $item->Goods_id }}'" style="width: 100%"><i class="fa fa-cogs"></i></button>  </td>
                    <td> <button class="btn btn-outline-danger" onclick="window.location='../delete_product_order/{{ $item->id_d_order }}/{{ $item->Order_no }}'" style="width: 100%"><i class="fa fa-trash"></i></button>  </td>
                  </tr>
                  @endforeach
                </tbody>
            </table>
        </div>
     </div>
    </div>
   <div class="mt-3"></div>
  </div>
    <div class="col-md-1"></div>
 </div>
 <div class="row">
  <div class="col-md-1"></div>
  <div class="col-md-10">
      <div class="row">
        <div class="col-md-12 text-center">
            <div class="row ">
              <div class="col-md-8 border-left"><button style="width:100%" type="button" class="btn btn-primary" onclick="window.location='../order_product'"><i class="fa fa fa-reply"></i></button></div>
              <div class="col-md-4 border-right  "><button style="width:100%" type="button" class="btn btn-secondary text-white" onclick="window.location='../'"><i class="fa fa fa-home"></i></button></div>
            </div>
            <div class="row ">
              <div class="col-12 border-bottom border-right border-left">
                <div class="mt-3"></div>
              </div>
            </div>
        </div>
      </div>
  </div>
  <div class="col-md-1"></div>
</div>
<script type="text/javascript">
  $(function(){
   
      var objTR = $("#place_data").find("tr"); // อ้างอิง tr ใน tbody
       
      // เก็บตัวแปรค่าของข้อมูลของแถวแรก ในตารางส่วนขงอ tbody คอลัมน์ที่ 2 (ค่าในโปรแกรมเป็น 1)
      var dataTopic = objTR.eq(0).find("td:eq(1)").text();
      $("#place_show").html("Name: "+dataTopic); // แสดงค่าเริ่มต้น   
       
      // เมื่อ tbody มีการเลื่อน
      $("#place_data").scroll(function () {
          var pos_one=null; // ไว้เก็บตัวแปรตำแหน่ง tr ที่จะใช้งาน
          // วน tr ใน tbody
          objTR.each(function(i,v){
              var pos_val = objTR.eq(i).offset(); // เก็บค่าตำแหน่ง tr
              if(pos_val.top>=$("#place_data").offset().top){
                  pos_one=i; // เก็บค่า index ของ tr
                  return false; // ยกเลิกการวนลูป
              }
          });
          // เก็บค่าข้อมูลใน tr จากตำแหน่งที่ได้จากค่า pos_one โดยใช้ค่าในคอลัมน์ 2 (ในโค้ด 1)
          var dataTopic = objTR.eq(pos_one).find("td:eq(1)").text();
          $("#place_show").html("Name: "+dataTopic); // แสดงค่าข้อมูล
   
      });
       
  });
  </script>  

@stop
