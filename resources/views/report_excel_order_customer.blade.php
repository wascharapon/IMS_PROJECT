<?php
@$act=$_GET['act'];
if($act=='excel'){
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=export.xls");
header("Pragma: no-cache");
header("Expires: 0");
}
?>
<!DOCTYPE html>
<html>
	<body>
					<h4  align="center">รายงานแสดงข้อมูลที่ครบกำหนดส่งสินค้าแล้วยังไม่ได้ส่งสินค้า</h4>
                    <table border="1"   align="center">
                        <thead>
                            <tr>
                                <th align="center">ลำดับ</th>
                                <th align="center">รายละเอียดลูกค้า</th>
                                <th align="center">รายละเอียดสินค้า</th>
                                <th align="center">วันที่สั่ง</th>
                                <th align="center">เลขที่สัง</th>
                                <th align="center">วันกำหนดส่ง</th>
                                <th align="center">จำนวน</th>
                                <th align="center">ราคา/หน่วย</th>
                                <th align="center">ราคารวม</th>
                            </tr>
                        </thead>
                        <tbody>
                         @foreach ($table_data as $item)
                         <tr>
                          <td align="center">{{ ++$count }}</td>
                          <td align="center">{{ $item->Goods_name }}</td>
                          <td align="center">{{ $item->Cus_name }}</td>
                          <td align="center">{{ $item->Order_Date }}</td>
                          <td align="center">{{ $item->Order_no }}</td>
                          <td align="center">{{ $item->Ord_date }}</td>
                          <td align="center">{{ number_format($item->Amount) }}</td>
                          <td align="center">{{ number_format($item->COST_UNIT,2) }}</td>
                          <td align="center">{{ number_format($item->TOT_PRC,2) }}</td>
                        </tr>
                         @endforeach
                         <tr style="font-size:120%">
                          <td align="center">รวม</td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td align="center">รวมจำนวนทั้งหมด</td>
                          <td align="center" class="text-danger">{{ number_format($total_Amount) }}</td>
                          <td align="center">รวมราคาทั้งหมด</td>
                          <td align="center" class="text-danger">{{ number_format($total_TOT_PRC,2) }}</td>
                        </tr>
                        </tbody>
                    </table>

	</body>
</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('body').hide();
        setTimeout(function() {
        window.close();
        }, 1000);
        window.location='?act=excel';

    });
 </script>