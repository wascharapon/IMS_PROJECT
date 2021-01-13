@extends('master.admin')

@section('title','การบันทึก/แก้ไข การสั่งซื้อสินค้า')

@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('css\order_table_scroll.css') }}">
    <div class="row">
      <div class="col-md-1"> </div>
      <div class="col-md-10 text-center bg-danger text-white border ">
        <h3>การบันทึก/แก้ไข การสั่งซื้อสินค้า</h3>
      </div>
      <div class="col-md-1"></div>
   </div>
   <div class="row">
    <div class="col-md-1"> </div>
    <div class="col-md-10 border-left border-right  ">
      <div class="row">
        <div class="col-md-12">
          <div class="mt-3"></div>
          <h5>สถานะ : เพิ่มรายการส่วน Hedader การรับคำสั่งซื้อสินค้า</h5>
          <div class="mt-5"></div>
          <div class="row">
              <div class="col-md-2"></div>
              <div class="col-md-8">
                <h5>เพิ่มข้อมูลสินค้า</h5>
                <div class="mt-3"></div>
                <form action="check_customer" method="POST">
                  @csrf
                  <div class="input-group mb-3">
                    <h6 class="mt-1">รหัสลูกค้า:&nbsp;&nbsp;&nbsp;&nbsp;</h6> <input type="text" maxlength="5" minlength="5" name="customer_id" class="form-control" placeholder="ตัวอย่างเช่น ABC12" aria-label="Recipient's username" aria-describedby="button-addon2" required>
                    <div class="input-group-append">
                   <!-- <button class="btn btn-outline-secondary" type="button" id="button-addon2">ตรวจสอบ</button> -->
                    </div>
                  </div>
                  <div class="input-group mb-3">
                    <h6 class="mt-1">วันที่สั่งสินค้า:&nbsp;&nbsp;&nbsp;&nbsp;</h6> <input type="datetime-local" maxlength="16" minlength="16"  name="customer_date" value="{{ date("Y-m-d").'T00:00' }}"  class="form-control" aria-describedby="button-addon2"required>
                  </div>
                  @isset($error_customer_id)
                  @if ($error_customer_id=="NOT")
                  <label class="text-danger" style="font-size:65%">►ไม่พบข้อมูลลูกค้ากรุณาลองใหม่อีกครั้ง</label>
                  @endif
              @endisset
              </div>
              <div class="col-md-2"></div>
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
        <div class="col-md-2 border-left border-bottom">
          <!--<input id="id_product"   type="hidden" value="0"  required>
          <input class="form-control text-center" style="margin-top:3.25%;" id="show_data_active"  type="text" value="กรุณาคลิกที่ตารางเพื่อเลือกข้อมูล"readonly required>
          <div class="mt-3"></div> -->
        </div>
        <div class="col-md-10 text-center">
            <div class="row ">
              <div class="col-md-7 mt-3"><button style="width:100%" type="summit"  class="btn btn-success text-white" onclick="edit_data()">บันทึกและเพิ่มรายการสินค้าต่อ</button></div>
              <div class="col-md-4 mt-3"><button style="width:100%" type="button" class="btn btn-primary" onclick="window.location='order_product'">ยกเลิก</button></div>
              <div class="col-md-1 border-right  ">
                <!-- <button style="width:100%" type="button" class="btn btn-primary" onclick="window.location='/'">เมนู</button> -->
              </div>
            </div>
          </form>
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
      var item_detail =  document.getElementById('item_detail_'+select_tr).innerHTML;
      document.getElementById("show_data_active").value = 'รหัส : '+item_key+' รายละเอียด : '+item_detail;
      document.getElementById("id_product").value = item_key;
  }
  function edit_data()
  {
    var id_product =document.getElementById("id_product").value;
    if(id_product != '0')
    {
      window.location="edit_product/"+id_product;
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
