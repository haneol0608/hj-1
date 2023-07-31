<?php include "../layout/header.php"; ?>
<?php include '../include/dbcon.php'; ?>
<?php $_SESSION['STAT'] = '물량 산출'; ?>
<?php $_SESSION['NAV'] = 'sub2'; ?>
<?php $_SESSION['page'] = 'sub0202'; ?>

<style>
    .loader_div p{
        position:absolute;
        top: 60%;
        left: 50%;
        transform: translate(-60%, -50%);
        font-weight: bold;
        font-size: 1.2em;
    }
    .loader {
        position: absolute;
        left: 50%;
        top: 50%;
        z-index: 1;
        width: 150px;
        height: 150px;
        margin: -75px 0 0 -75px;
        border: 16px solid #f3f3f3;
        border-radius: 50%;
        border-top: 16px solid #3498db;
        width: 120px;
        height: 120px;
        -webkit-animation: spin 2s linear infinite;
        animation: spin 2s linear infinite;
    }

  @-webkit-keyframes spin {
      0% { -webkit-transform: rotate(0deg); }
      100% { -webkit-transform: rotate(360deg); }
  }

  @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
  }
</style>

<div class="loader_div" style="display: none;">
    <p>로딩중...</p>
    <div class="loader">
    </div>
</div>

<div id="show" class="content sub01">
    <div class="ct_wrap">
        <?php include "../layout/nav2.php" ?>
        <div class="container_ct">
            <div class="container sub0202">
                <?php include 'product_menu.php'; ?>
                <div class="sub_plate">
                    <div class="flex">
                        <h3>물량 조회</h3>
                        <input type="button" onclick="history.back();" value="뒤로가기">
                    </div>
                    <?php if($_COOKIE['HPLEVEL'] == "관리") { ?>
                    <input type="button" onclick="quantity_delete2();" value="선택물량 취소">
                    <input type="button" onclick="other_update3();" value="전체 저장">
                    <input type="button" onclick="input_prolist2(); logData(this, '공정리스트 등록', '<?php echo substr(date('Y-m-d h:i:s.u'), 0, 21); ?>', '<?php echo $_COOKIE['HPID']; ?>');" value="공정 리스트 등록">
                    <?php } ?>

                    <?php if($_COOKIE['HPLEVEL'] == "관리") { ?>
                        <div>
                            <select name="emg_list_title">
                                <?php 
                                $select_prolist_query = "SELECT list_title, lot_date, list_lot FROM hj_lada WHERE list_title IS NOT NULL GROUP BY list_title, lot_date, list_lot ORDER BY lot_date DESC";
                                $select_prolist_result = mysqli_query($conn, $select_prolist_query);
                                while($prolist_row = mysqli_fetch_assoc($select_prolist_result)) {
                                    $list_title = $prolist_row['list_title'];
                                    $lot_date = $prolist_row['lot_date'];
                                    $list_lot = $prolist_row['list_lot'];
                                ?>
                                <option value="<?php echo $list_title; ?>"><?php echo $list_title; ?></option>
                                <?php } ?>
                            </select>
                            <input type="button" onclick="emg_prolist2(); logData(this, '긴급 공정리스트 등록', '<?php echo substr(date('Y-m-d h:i:s.u'), 0, 21); ?>', '<?php echo $_COOKIE['HPID']; ?>');" value="긴급 공정리스트 추가">
                        </div>
                    <?php } ?>
                    <div class="drawing_table">
                        <table>
                            <thead>
                                <tr>
                                    <?php if($_COOKIE['HPLEVEL'] == "관리") { ?>
                                    <td>
                                        <input id="all_check" type="checkbox" onclick="on_chk();">
                                    </td>
                                    <?php } ?>

                                    <td>NO</td>
                                    <td colspan="2">POR 번호</td>
                                    <td>SEQ</td>
                                    <td>계약량</td>
                                    <td>총중량</td>
                                    <td>계약금액</td>
                                    <td>품명/재질/규격</td>
                                    <td>제작납기</td>
                                    <td>MP납기</td>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $select_query = "SELECT * FROM hj_lada WHERE qt_no IS NOT NULL AND count != 0 AND quantity_ok IS NULL ORDER BY qt_no * '+1' ASC, qt_no ASC, seq * '+1' ";
                                
                                $select_result = mysqli_query($conn, $select_query);
                                while($row = mysqli_fetch_assoc($select_result)) {
                                    $no = $row['no'];
                                    $qt_no = $row['qt_no'];
                                    $ho = $row['ho'];
                                    $por = $row['por'];
                                    $seq = $row['seq'];
                                    $count = $row['count'];
                                    $weight = $row['weight'];
                                    $money = $row['money'];
                                    $ohter = $row['other'];
                                    $pro_date = $row['pro_date'];
                                    $mp_date = $row['mp_date'];
                                ?>
                                <tr>
                                    <?php if($_COOKIE['HPLEVEL'] == "관리") { ?>
                                    <td>
                                        <input class="sub_check" type="checkbox" name="quantity_no[]" value="<?php echo $no; ?>">
                                        <input type="hidden" name="input_qt_no[]" value="<?php echo $qt_no; ?>">
                                    </td>
                                    <?php } ?>

                                    <td>
                                        <input type="hidden" name="no[]" value="<?php echo $no; ?>">
                                        <?php echo $qt_no; ?>
                                    </td>
                                    <td>
                                        <input type="hidden" name="input_ho[]" value="<?php echo $ho; ?>">
                                        <?php echo $ho; ?>
                                    </td>
                                    <td>
                                        <input type="hidden" name="input_por[]" value="<?php echo $por; ?>">
                                        <?php echo $por; ?>
                                    </td>
                                    <td>
                                        <input type="hidden" name="input_seq[]" value="<?php echo $seq; ?>">
                                        <?php echo $seq; ?>
                                    </td>
                                    <td><?php echo $count; ?></td>
                                    <td><?php echo $weight; ?></td>
                                    <td>
                                        <?php if($_COOKIE['HPLEVEL'] == "관리") { ?>
                                            <input type="text" name="money[]" placeholder="금액을 입력하세요." value="<?php echo number_format($money); ?>" onkeyup="inputNumberFormat(this);">
                                        <?php } else { ?>
                                            <?php echo $money; ?>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php if($_COOKIE['HPLEVEL'] == "관리") { ?>
                                            <textarea name="other[]" rows="2" cols="30" placeholder="품명/재질/규격을 입력해주세요."><?php echo $ohter; ?></textarea>
                                        <?php } else { ?>
                                            <?php echo $ohter; ?>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php if($_COOKIE['HPLEVEL'] == "관리") { ?>
                                            <input type="date" name="pro_date[]" value="<?php echo $pro_date; ?>">
                                        <?php } else { ?>
                                            <?php echo $pro_date; ?>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php if($_COOKIE['HPLEVEL'] == "관리") { ?>
                                            <input type="date" name="mp_date[]" value="<?php echo $mp_date; ?>">
                                        <?php } else { ?>
                                            <?php echo $mp_date; ?>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "../layout/footer.php"; ?>
