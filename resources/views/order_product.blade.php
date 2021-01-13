@extends('master.admin')

@section('title','แสดงข้อมูลการสั่งซื้อสินค้า')

@section('content')
<style>
  table{
    font-size:40px;
  }
</style>
<link rel="stylesheet" type="text/css" href="{{ asset('css\order_table_scroll.css') }}">
    <div class="row">
      <div class="col-md-1"> </div>
      <div class="col-md-10 text-center bg-danger text-white border ">
        <h3>แสดงข้อมูลการสั่งซื้อสินค้า </h3>
      </div>
      <div class="col-md-1"></div>
   </div>
   <div class="row">
    <div class="col-md-1"> </div>
    <div class="col-md-10 border-left border-right  ">
      <div class="row">
        <div class="col-md-12 text-center ">
          <div class="mt-3"></div>
          <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>รหัสลูกค้า</th>
                        <th>ชื่อลูกค้า</th>
                        <th>ลำดับ</th>
                        <th>จน.รายการที่สั่ง</th>
                        <th>จน.ที่สั่ง</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach ($data as $datas) 
                  <tr onclick="get_data('{{ $datas->Order_no }}')" style="display:">
                    <td scope="col" class="key_table"  id="item_key_{{ $datas->Order_no }}">{{ $datas->Cus_id }}</td>
                    <td scope="col" >{{ $datas->Cus_name }}</td>
                    <td scope="col" class="Order_no"  id="item_Order_no_{{ $datas->Order_no }}" >{{ $datas->Order_no}}</td>
                    <td scope="col" >{{ $datas->CNT }}</td>
                    <td scope="col" >{{ $datas->AMOUNT }}</td>
                  </tr>
                  @endforeach 
                </tbody>
            </table>
        </div>
        <div class="col-md-2"></div>
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
        <div class="col-md-4 border-left border-bottom">
          <input id="id_Order"  type="hidden" value="0"  required>
          <input class="form-control text-center mb-2" style="margin-top:3%"  id="show_data_active"  type="text" value="กรุณาคลิกที่ตารางเพื่อเลือกข้อมูล"readonly required>
        </div>
        <div class="col-md-8 text-center">
            <div class="row ">
              <div class="col-md-3 mt-2"><button style="width:100%" type="button"  class="btn btn-warning text-white" onclick="edit_data()"><i class="fa fa-cogs"></i>&nbsp;แก้ไข</button></div>
              <div class="col-md-3 mt-2"><button style="width:100%" type="button"  class="btn btn-danger text-white" onclick="delete_data()"><i class="fa fa-trash"></i>&nbsp; ลบ</button></div>
              <div class="col-md-3 mt-2"><button style="width:100%" type="button" class="btn btn-success" onclick="window.location='confirm_customer'"><i class="fa fa fa-shopping-cart"></i>&nbsp;สั่งซื้อสินค้า</button></div>
              <div class="col-md-3 border-right  mt-2"><button style="width:100%" type="button" class="btn btn-primary" onclick="window.location='/'"><i class="fa fa fa-home"></i>&nbsp;เมนู</button></div>
            </div>
            <div class="row ">
              <div class="col-12 border-bottom border-right">
                <div class="mt-3"></div>
              </div>
            </div>
        </div>
      </div>
      
  </div>
  <div class="col-md-1"></div>
</div>
<script>
  function get_data(select_tr)
  {
      var item_key =  document.getElementById('item_key_'+select_tr).innerHTML;
      var item_Order_no =  document.getElementById('item_Order_no_'+select_tr).innerHTML;
      document.getElementById("show_data_active").value = 'รหัส : '+item_key+' ลำดับ : '+item_Order_no;
      document.getElementById("id_Order").value = item_Order_no;
  }
  function edit_data()
  {
    var id_Order =document.getElementById("id_Order").value;
    if(id_Order != '0')
    {
      window.location='show_order_product/'+id_Order;
    }
    else
    {
      Swal.fire({
  icon: 'error',
  title: 'ทำรายการผิดพลาด',
  text: 'กรุณาเลือกข้อมูล',
      })
    }
  }
  function delete_data()
  {
    var id_Order =document.getElementById("id_Order").value;
    if(id_Order != '0')
    {
      window.location='delete_order_product/'+id_Order;
    }
    else
    {
      Swal.fire({
  icon: 'error',
  title: 'ทำรายการผิดพลาด',
  text: 'กรุณาเลือกข้อมูล',
      })
    }

  }
</script>
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
