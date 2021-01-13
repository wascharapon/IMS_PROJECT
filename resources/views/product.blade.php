@extends('master.admin')

@section('title','การบันทึก/แก้ไข ข้อมูลสินค้า')

@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('css\table_scroll.css') }}">
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
        <div class="col-md-10 text-center ">
          <div class="mt-3"></div>
          <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>รหัสสินค้า</th>
                        <th>รายละเอียด</th>
                        <th>ราคา/หน่วย</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach ($data as $datas) 
                  <tr onclick="get_data({{ $datas->Goods_id }})" style="display:">
                    <td scope="col" class="key_table"  id="item_key_{{ $datas->Goods_id }}">{{ $datas->Goods_id }}</td>
                    <td scope="col" class="name_table"  id="item_detail_{{ $datas->Goods_id }}" >{{ $datas->Goods_name }}</td>
                    <td scope="col" class="price_table" >{{ $datas->coust_unit }}</td>
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
          <input id="id_product"   type="hidden" value="0"  required>
          <input class="form-control text-center mb-3" style="margin-top:3.25%;" id="show_data_active"  type="text" value="กรุณาคลิกที่ตารางเพื่อเลือกข้อมูล"readonly required>
        </div>
        <div class="col-md-8 text-center">
            <div class="row ">
              <div class="col-4 mt-2"><button style="width:100%" type="button"  class="btn btn-warning text-white" onclick="edit_data()"><i class="fa fa fa-cogs"></i>&nbsp;แก้ไข/ลบ</button></div>
              <div class="col-5 mt-2"><button style="width:100%" type="button" class="btn btn-success" onclick="window.location='add_product'"><i class="fa fa fa-plus"></i>&nbsp;เพิ่มสินค้า</button></div>
              <div class="col-3 border-right  mt-2"><button style="width:100%" type="button" class="btn btn-primary" onclick="window.location='/'"><i class="fa fa fa-home"></i>&nbsp;เมนู</button></div>
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
