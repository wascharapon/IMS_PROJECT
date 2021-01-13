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
          <h5>สถานะ : เพิ่มรายการส่วน Detail การรับคำสั่งซื้อสินค้า</h5>
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
          <form action="../add_product_order" method="POST">
            @csrf
          <div class="row">
            <div class="col-md-4">
              <div class="input-group mb-3">
                <h6 class="mt-2">รหัสสินค้า &nbsp;</h6><input name="product_id" type="text" value="{{ $Goods_id }}" id="search_product" class="form-control"  maxlength="10"  minlength="10" required>
                <div class="input-group-append">
                  <button class="btn btn-outline-secondary" type="button" onclick="Search()">
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
                      <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
                    </svg>
                  </button>
                  <script>
                    function Search(){
                      if(document.getElementById("search_product").value=='')
                      document.getElementById("search_product").value='-';
                      window.location='../insert_product_order/'+document.getElementById("search_product").value;
                    }
                  </script>
                </div>
              </div>
              <div class="input-group mb-3">
                <h6 class="mt-1">วันที่สั่งสินค้า:&nbsp;&nbsp;&nbsp;&nbsp;</h6> 
                <input type="datetime-local" maxlength="16" minlength="16"  name="product_Ord_date" value="{{ date("Y-m-d").'T00:00' }}"  class="form-control" aria-describedby="button-addon2"required>
              </div>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">ราคา/หน่วย</span>
                </div>
                <input  type="hidden" id="product_price" value="{{ $coust_unit }}">
                <input type="text" class="form-control input_align" value="{{ number_format($coust_unit,2)  }}" readonly>
                <div class="input-group-append">
                  <span class="input-group-text">บาท</span>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">ชื่อสินค้า</span>
                </div>
                <input  type="text" class="form-control input_align text-danger" value="{{ $Goods_name }}" readonly>
              </div>
              <div class="input-group mb-3">
                <h6 class="mt-1">วันที่ส่งสินค้าจริง:&nbsp;&nbsp;&nbsp;&nbsp;</h6> <input type="datetime-local" maxlength="16" minlength="16"  name="product_Fin_date"   class="form-control" aria-describedby="button-addon2">
              </div>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">ราคารวม</span>
                </div>
                <input type="text" class="form-control input_align" id="total_price_order" value="{{ $coust_unit }}" readonly>
                <div class="input-group-append">
                  <span class="input-group-text">บาท</span>
                </div>
              </div>

            </div>
            <div class="col-md-4">
              <div class="input-group mb-3 input_nunber">
                <h6 class="mt-2">จำนวนสั่ง &nbsp;</h6><input  name="product_Amount" type="text"  id="number_product_order" onchange="change_input_number()" value="1" class="form-control input_align" maxlength="10"  minlength="1" required>
                <div class="input-group-append">
                  <span class="input-group-text">ชิ้น</span>
                </div>
                <input id="save_product_order" style="width:100%" type="hidden" class="btn btn-success mt-3" value="บันทึกรายการ">
              </div>
            </div>
          </div>
        </form>
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
                    <td>{{ number_format($item->Amount,2) }}</td>
                    <td>{{ number_format($item->COST_UNIT,2) }}</td>
                    <td>{{ number_format($item->TOT_PRC,2) }}</td>
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
              <div class="col-md-8 border-left"><button style="width:100%" type="button" class="btn btn-primary" onclick="window.location='../order_product'"><i class="fa fa fa-reply">&nbsp;</i>กลับไปยังหน้าจอแสดงรายการสินค้า</button></div>
              <div class="col-md-4 border-right  "><button style="width:100%" type="button" class="btn btn-secondary text-white" onclick="window.location='/'"><i class="fa fa fa-home">&nbsp;</i>เมนู</button></div>
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
  <input id="bt_save_data" type="hidden" value="{{ $check_product }}">
  <script>
    change_input_number();
    bt_save();
      function bt_save()
      {
        if(document.getElementById('bt_save_data').value==1)
        {
          document.getElementById('save_product_order').type = 'submit';
        }
        else
        {
          document.getElementById('save_product_order').type = 'hidden';
        }
      }
      function change_input_number()
      {
        price = document.getElementById("product_price").value;
        number = document.getElementById("number_product_order").value;
        total = (price * number).toFixed(2);
        document.getElementById("total_price_order").value=commaSeparateNumber(total);
      }  
      function commaSeparateNumber(val){
        while (/(\d+)(\d{3})/.test(val.toString())){
      val = val.toString().replace(/(\d+)(\d{3})/, '$1'+','+'$2');
    }
    return val;
  }
  </script>  
@stop
