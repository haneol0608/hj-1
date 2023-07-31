<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- style -->
<!-- <link rel="stylesheet" href="/hj/include/css/reset.css"> -->
<link rel="stylesheet" href="/hj/include/css/mes_print.css">
<link rel="stylesheet" href="/hj/include/css/style_mes.css">
<link rel="stylesheet" href="/hj/include/css/lightgallery.css">
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="/hj/include/js/common.js"></script>

<div style="display: none;">
    <?php include '../include/dbcon.php'; ?>
</div>

<div class="content sub05">
  <div class="ct_wrap">
    <div class="container_ct">
        <?php 
            $no = $_GET['no'];

            $select_query = "SELECT * FROM hj_shipment WHERE no = '$no' ";
            $select_result = mysqli_query($conn, $select_query);
            $row = mysqli_fetch_assoc($select_result);

            $account = $row['account'];
            
            $select_query2 = "SELECT * FROM hj_account WHERE name = '$account' ";
            $select_result2 = mysqli_query($conn, $select_query2) ;
            $row2 = mysqli_fetch_assoc($select_result2) ;

            $name = $row2['name'];
            $in_charge = $row2['in_charge'];
            $address = $row2['address'];
            $contact = $row2['contact'];
        ?>
        <!-- <?php echo $account ?> -->
        <!-- <p><?php echo $order_num; ?></p> -->
      <div class="container sub05">
        <div class="sub_plate">
          <div class="drawing_table">
            <table>
                <tr>
                    <td colspan="6">
                        <h1>송장증</h1>
                    </td>
                </tr>
            </table>
          </div>
          <div class="drawing_table">
            <table>
                <thead>
                    <tr>
                        <td colspan="6">인수기업 정보</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>상호</td>
                        <td><p><?php echo $name; ?></p></td>
                        <td>주소</td>
                        <td><p><?php echo $address; ?></p></td>
                        
                    </tr>
                    <tr>
                        <td>담당자</td>
                        <td><p><?php echo $in_charge; ?></p></td>
                        <td>연락처</td>
                        <td><p><?php echo $contact; ?></p></td>
                
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="drawing_table">
            <table>
                <thead>
                    <tr>
                        <td colspan="6">발송기업 정보</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>상호</td>
                        <td><p>한진기공</p></td>
                        <td>주소</td>
                        <td><p>전라남도 영암군</p></td>
                        
                    </tr>
                    <tr>
                        <td>담당자</td>
                        <td><p>조준곤 부장</p></td>
                        <td>연락처</td>
                        <td><p>010-2805-0609</p></td>
                
                    </tr>
                </tbody>
                </table>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div style="display: none;">
  <?php include "../layout/footer.php"; ?>
</div>