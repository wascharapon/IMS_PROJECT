@extends('master.admin')

@section('title','IMS')

@section('content')
    <div class="row">
      <div class="col-md-1"> </div>
      <div class="col-md-10">
        <table style="width: 100%" border="1" >
            <thead>
              <tr>
                <td class="text-center text-white" style="background-color:#CF4F23;" colspan="4"><h3>ระบบโปรแกรมบริหารจัดการสินค้าคงคลัง</h3></td>
              </tr>
            </thead>
            <tbody >
              <tr>
                <th><h5><a href="#" class="text-dark">&nbsp;1. ฐานข้อมูลอ้างอิง</a></h5></th>
                <td><h5><a href="#" class="text-dark">&nbsp;2. การทำงานประจำวัน</a></h5></td>
                <td><h5><a href="#" class="text-dark">&nbsp;3. รายงาน</a></h5></td>
                <td><h5><a href="#" class="text-dark">&nbsp;4. ออกจากระบบ</a></h5></td>
              </tr>
              <tr>
                <th ><h5><a href="#" class="text-dark">&nbsp;1.1 บันทึก/แก้ไข ข้อมูลลูกค้า</a></h5></th>
                <th ><h5><a href="order_product" class="text-dark">&nbsp;2.1 บันทึก/แก้ไข การสั่งซื้อสินค้า</a></h5></th>
                <th ><h5><a href="report_order_customer" class="text-dark">&nbsp;3.1  รายงานกำหนดส่งสินค้า</a></h5></th>
                <th ><h5><a href="logout" class="text-dark">&nbsp;4.1 ออกจากระบบโปรแกรม</a></h5></th>
              </tr>
              <tr class="border-white">
                <td class="border-dark"><h5><a href="product" class="text-dark">&nbsp;1.2 บันทึก/แก้ไข ข้อมูลสินค้า</a></h5></td>
                <td class="border-dark"><h5><a href="process_order_customer"class="text-dark">&nbsp;2.2 การประมวลผลข้อมูลการสั่งสินค้า</a></h5></td>
                <td colspan="2" class="border-white"></td>
              </tr>
              <tr >
                <th colspan="4" ><br><br><br><br><br><br></th></th>
              </tr>
          
            </tbody>
          </table>
          <table style="width:100%" class="border-left border-buttom border-right border-dark">
           
              <tr>
                <td class="text-center" style="background-color:#CF4F23;" colspan="4">&nbsp;</td>
              </tr>
          
            </tbody>
          </table>
      </div>
      <div class="col-md-1"></div>
   </div>
@stop
