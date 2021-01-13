@extends('master.admin')

@section('title','การบันทึก/แก้ไข ข้อมูลสินค้า')

@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('css\table_scroll_small.css') }}">
    <div class="row">
      <div class="col-md-1"> </div>
      <div class="col-md-10 text-center bg-danger text-white border">
        <h3>รายงานแสดงข้อมูลที่ครบกำหนดส่งสินค้าแล้วยังไม่ได้ส่งสินค้า</h3>
      </div>
      <div class="col-md-1"></div>
   </div>
   <div class="row">
    <div class="col-md-1"> </div>
    <div class="col-md-10 border-left border-right  ">
      <div class="row">
        <div class="col-md-12 text-center ">
          <div class="row">
            <div class="col-md-6 text-center ">
                   <div class="mt-3"></div>
                   <form action="get_report_order_customer" method="POST">
                    @csrf
                  <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1">วันที่กำหนดส่งตามแผน  :</span>
                </div>
                <input type="datetime-local" maxlength="16" minlength="16" id="gdoc_date1"   name="gdoc_date1" value="{{ $gdoc_date1 }}"  class="form-control" aria-describedby="button-addon2"required>
              </div>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1">ถึงวันที่  :</span>
                </div>
                <input type="datetime-local" maxlength="16" minlength="16" id="gdoc_date2"  name="gdoc_date2" value="{{ $gdoc_date2 }}"  class="form-control" aria-describedby="button-addon2"required>
              </div>
         </div>
         <div class="col-md-3">
          <button style="width:100%;height:50%;font-size:140%" type="submit" class="btn btn-success mt-4"><label><i class="fa fa fa-search">&nbsp;</i>แสดงข้อมูล</label></button>
         </div>
        </form>
         <div class="col-md-3"></div>
        </div>
     </div>
    </div>
            <div class="m-2">
              @error('product_name')
              @foreach ($errors->get('gdoc_date1') as $error)
                  <label class="text-danger" style="font-size:80%">► กรอกเวลาวันกำหนดส่งตามแผนไม่ถูกต้อง</label>
              @endforeach
              @enderror
              @error('product_price')
              @foreach ($errors->get('gdoc_date2') as $error)
              @error('product_name')
              <br>
              @enderror
              <label class="text-danger" style="font-size:80%">► กรอกเวลาถึงวันที่ไม่ถูกต้อง</label>
              @endforeach
              @enderror
            </div>
            <hr color='#dee2e6' width=100%>
            <div class="table-wrapper">
              <table>
                  <thead>
                      <tr>
                          <th>ลำดับ</th>
                          <th>รายละเอียดลูกค้า</th>
                          <th>รายละเอียดสินค้า</th>
                          <th>วันที่สั่ง</th>
                          <th>เลขที่สัง</th>
                          <th>วันกำหนดส่ง</th>
                          <th>จำนวน</th>
                          <th>ราคา/หน่วย</th>
                          <th>ราคารวม</th>
                      </tr>
                  </thead>
                  <tbody>
                   @foreach ($table_data as $item)
                   <tr>
                    <td>{{ ++$count }}</td>
                    <td>{{ $item->Goods_name }}</td>
                    <td>{{ $item->Cus_name }}</td>
                    <td>{{ $item->Order_Date }}</td>
                    <td>{{ $item->Order_no }}</td>
                    <td>{{ $item->Ord_date }}</td>
                    <td>{{ number_format($item->Amount) }}</td>
                    <td>{{ number_format($item->COST_UNIT,2) }}</td>
                    <td>{{ number_format($item->TOT_PRC,2) }}</td>
                  </tr>
                   @endforeach
                   <tr style="font-size:120%">
                    <td>รวม</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>รวมจำนวนทั้งหมด</td>
                    <td class="text-danger">{{ number_format($total_Amount) }}</td>
                    <td>รวมราคาทั้งหมด</td>
                    <td class="text-danger">{{ number_format($total_TOT_PRC,2) }}</td>
                  </tr>
                  </tbody>
              </table>
          </div>
  </div>
    <div class="col-md-1"></div>
 </div>
 <div class="row">
  <div class="col-md-1"></div>
  <div class="col-md-10">
      <div class="row">
        <div class="col-md-4 border-left border-bottom">
        </div>
        <div class="col-md-8 text-center">
            <div class="row ">
              <div class="col-md-4  "><button style="width:100%" type="button" class="btn btn-success mt-3" onclick="report_excel()"><i class="fa fa fa-file-excel-o"></i></button></div>
              <div class="col-md-4  "><button style="width:100%" type="button" class="btn btn-primary mt-3" onclick="window.print();"><i class="fa fa fa-print"></i></button></div>
              <div class="col-md-4 border-right  "><button style="width:100%" type="button" class="btn btn-dark mt-3" onclick="window.location='/'"><i class="fa fa fa-reply"></i></button></div>
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
    function report_excel()
    {
      gdoc_date1 = document.getElementById('gdoc_date1').value;
      gdoc_date2 = document.getElementById('gdoc_date2').value;
      window.open('/excel_report_order_customer/'+gdoc_date1+'/'+gdoc_date2,'_blank');
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
