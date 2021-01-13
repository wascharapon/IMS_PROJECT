@extends('master.admin')

@section('title','แก้ไข/ลบ ข้อมูลสินค้า')

@section('content')
    <div class="row">
      <div class="col-md-1"> </div>
      <div class="col-md-10 text-center bg-danger text-white border ">
        <h3>แก้ไขและลบสินค้า</h3>
      </div>
      <div class="col-md-1"></div>
   </div>
   <div class="row">
    <div class="col-md-1"> </div>
    <div class="col-md-10 border-left border-right  ">
      <div class="row">
        <div class="col-md-10 text-center ">
          <div class="mt-3"></div>
          <form action="../edit_product_active" method="POST">
            @csrf
            @foreach ($data as $datas)
                  <div >
                    <input name="product_id"  type="hidden" value="{{ $datas->Goods_id }}"readonly required>
                    <input class="form-control text-center" style="margin-top:3.25%;"  type="text" value="รหัสสินค้า:{{ $datas->Goods_id }}"readonly required>
                    <div class="mt-3"></div>
                  </div>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon1">รายละเอียดสินค้า</span>
                    </div>
                    <input name="product_name" value="{{ $datas->Goods_name }}" type="text" class="form-control" placeholder=""  aria-describedby="basic-addon1" required>
                  </div>
                  <div class="input-group mb-3">
                    <input name="product_price" value="{{ $datas->coust_unit }}" type="text" class="form-control" placeholder="" maxlength="6" aria-describedby="basic-addon2" required>
                    <div class="input-group-append">
                      <span class="input-group-text" id="basic-addon2">ราคา/หน่วย</span>
                    </div>
                  </div>
            @endforeach
           

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
              <div class="col-md-4 mt-3"><button style="width:100%" type="submit"  class="btn btn-success text-white">แก้ไข</button></div>
              <div class="col-md-4 mt-3"><button style="width:100%" type="button" class="btn btn-danger" onclick="window.location='../delete_product/{{ $datas->Goods_id }}'">ลบ</button></div>
              <div class="col-md-4 mt-3 border-right  "><button style="width:100%" type="button" class="btn btn-primary" onclick="window.location='product'">กลับ</button></div>
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
