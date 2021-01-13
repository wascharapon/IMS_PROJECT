@extends('master.admin')

@section('title','การบันทึก/แก้ไข ข้อมูลสินค้า')

@section('content')
    <div class="row">
      <div class="col-md-1"> </div>
      <div class="col-md-10 text-center bg-danger text-white border ">
        <h3>เพิ่มข้อมูลสินค้า</h3>
      </div>
      <div class="col-md-1"></div>
   </div>
   <div class="row">
    <div class="col-md-1"> </div>
    <div class="col-md-10 border-left border-right  ">
      <div class="row">
        <div class="col-md-10 text-center ">
          <div class="mt-3"></div>
          <form action="add_product_active" method="POST">
            @csrf
          <div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">รายละเอียดสินค้า</span>
  </div>
  <input name="product_name" type="text" class="form-control" placeholder="กรุณากรอกชื่อและรายละเอียดของสินค้า"  aria-describedby="basic-addon1" required>
</div>
<div class="input-group mb-3">
  <input name="product_price" type="text" class="form-control" placeholder="xxxxxx.xx ราคา/หน่วย" maxlength="6" aria-describedby="basic-addon2" required>
  <div class="input-group-append">
    <span class="input-group-text" id="basic-addon2">ราคา/หน่วย</span>
  </div>
</div>

        <div class="col-md-2"></div>
     </div>
    </div>
   <div class="m-2">
    @error('product_name')
    @foreach ($errors->get('product_name') as $error)
        <label class="text-danger" style="font-size:80%">► กรอกรายละเอียดสินค้าไม่ถูกต้อง เช่น (A-Z และ 1-9)</label>
    @endforeach
    @enderror
    @error('product_price')
    @foreach ($errors->get('product_price') as $error)
    @error('product_name')
    <br>
    @enderror
    <label class="text-danger" style="font-size:80%">► กรอกราคาไม่ถูกต้อง เช่น (100.99,10000.9,100000)</label>
    @endforeach
    @enderror
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
              <div class="col-2"></div>
              <div class="col-5"><button style="width:100%" type="submit" class="btn btn-success mt-3">เพิ่มข้อมูล</button></div>
            </form>
              <div class="col-5 border-right  "><button style="width:100%" type="button" class="btn btn-primary mt-3" onclick="window.location='product'">ดูข้อมูลสินค้า</button></div>
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
@stop
