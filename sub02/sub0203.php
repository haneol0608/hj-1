<?php include "../layout/header.php"; ?>
<?php include '../include/dbcon.php'; ?>

<?php $_SESSION['STAT'] = '공정리스트 조회'; ?>

<style>
    .loader_div p {
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

<div class="loader_div">
    <p>로딩중...</p>
    <div class="loader">
    </div>
</div>


<div id="show" style="display: none;" class="content sub01">
    <div class="ct_wrap">
        <?php include "../layout/nav2.php" ?>
            <div class="container_ct">
                <div class="container sub1_prolist">
                    <?php include 'product_menu.php'; ?>
                    <div class="sub_plate">
            
                        <div class="flex">
                            <h3>공정리스트</h3>
                            <input type="button" onclick="history.back();" value="뒤로가기">
                        </div>

                        <div class="draw_table">
                            <table>
                                <thead>
                                    <tr>
                                        <td>No</td>
                                        <td>공정리스트 제목</td>
                                        <td>LOT 번호</td>
                                        <td>처리</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $i = 0;
                                        $select_query = "SELECT list_title, lot_date, list_lot FROM hj_lada WHERE (lot_date != '') AND (list_lot != '' OR list_lot IS NOT NULL) AND (list_title != '' OR list_lot IS NOT NULL) GROUP BY lot_date, list_lot, list_title";
                                        $select_result = mysqli_query($conn, $select_query);
                                        while($row = mysqli_fetch_assoc($select_result)) {
                                            $i++;
                                            $lot_date = $row["lot_date"];
                                            $list_lot = $row["list_lot"];
                                            $list_title = $row["list_title"];
                                            
                                            $enc_lotDate = base64_encode($lot_date);
                                            $enc_listLot = base64_encode($list_lot);
                                            
                                            $year = substr($lot_date, 0, 4);
                                            $month = substr($lot_date, 5, 2);
                                            
                                            $select_date_query = "SELECT MIN(pro_date) AS min_proDate, MAX(pro_date) AS max_proDate, MAX(mp_date) AS max_mpDate FROM hj_lada WHERE lot_date = '$lot_date' AND list_lot = '$list_lot' GROUP BY lot_date, list_lot";
                                            $select_date_result = mysqli_query($conn, $select_date_query);
                                            $date_row = mysqli_fetch_assoc($select_date_result);
                                            $min_proDate = $date_row['min_proDate'];
                                            $max_proDate = $date_row['max_proDate'];
                                            $max_mpDate = $date_row['max_mpDate'];

                                            if($min_proDate == '') {
                                                $min_proDate = $max_proDate;
                                            }
                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td>
                                            <?php if($_COOKIE['HPLEVEL'] == "관리") { ?>
                                                <input type="text" name="list_title" value="<?php echo $list_title; ?>">
                                                <input type="button" onclick="prolist_titUp2(this, '<?php echo $lot_date ?>', '<?php echo $list_lot; ?>')" value="제목 수정">
                                            <?php } else { ?>
                                                <?php echo $list_title; ?>
                                            <?php } ?>
                                        </td>
                                        <td><?php echo htmlspecialchars($lot_date . "_" . $list_lot); ?></td>
                                        <td>
                                            <input type="button" onclick="select_prolist3('<?php echo $enc_lotDate; ?>', '<?php echo $enc_listLot; ?>');" value="상세조회">
                                            <input type="button" onclick="prolist_print2('<?php echo $enc_lotDate; ?>', '<?php echo $enc_listLot; ?>');" value="공정리스트 인쇄">
                                            <input type="button" onclick="cut_print3('<?php echo $enc_lotDate; ?>', '<?php echo $enc_listLot; ?>');" value="컷팅지 인쇄">
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                
                    <div class="sub_plate">
                        <h3>공정리스트 조회</h3>
                        <?php
                            //**************************************공정 리스트 - LOT 번호 조회 변경**************************************//
                            // 2022-12-08. 김한얼. 암호화 LOT 번호 -> 암호화 GET 선언
                            $get_lotDate = $_GET['lot_date'];
                            $get_listLot = $_GET['list_lot'];

                            $order = $_GET['order'];

                            // 2022-12-08. 김한얼. 암호화 LOT 번호 -> 검색 기능 반영
                            // 이전 코드 //
                            // $url = $_SERVER['PHP_SELF'] . "?";

                            if($get_lotDate !== null && $get_listLot !== null) {
                                $url = $_SERVER['PHP_SELF'] . "?lot_date=$get_lotDate&list_lot=$get_listLot&";
                            } else {
                                $url = $_SERVER['PHP_SELF'] . "?";
                            }
                            //*******************************************************************************************************//

                            $by = $_GET['by'];

                            if ($by == "" || $by == "DESC") {
                                $order_by = "ORDER BY " . $order . " DESC";
                                $by = "ASC";
                            } else if ($by == "ASC") {
                                $order_by = "ORDER BY " . $order . " ASC";
                                $by = "DESC";
                            }

                            //**************************************공정 리스트 - 문자열 정렬 / 역정렬**************************************//
                            // 2022-12-13. 김한얼. 문자형 -> 숫자 처럼 정렬 / 역정렬
                            if($order == "qt_no") {
                            if($by == "ASC") {
                                // $order_by = "ORDER BY A.qt_no * '1' ";
                                $order_by = "ORDER BY qt_no * 1 ASC, qt_no ASC";
                            } else if($by == "DESC") {
                                // $order_by = "ORDER BY LENGTH(A.qt_no) DESC, A.qt_no DESC";
                                $order_by = "ORDER BY qt_no * 1 DESC, qt_no ASC ";
                            }
                            }
                            //*******************************************************************************************************//
                        ?>
                        <input type="button" onclick="sub_excel2('<?php echo $get_lotDate; ?>', '<?php echo $get_listLot; ?>');" value="엑셀 출력하기">

                        <?php if($_COOKIE['HPLEVEL'] == "관리") { ?>
                            <input type="button" onclick="other_update4();" value="전체 저장">
                            <input type="button" onclick="prolist_delete2();" value="선택공정 취소">
                        <?php } ?>
                        <?php if(!isset($get_lotDate)) { ?>
                            <?php if($_COOKIE['HPLEVEL'] == "관리") { ?>
                            <input type="button" onclick="insert_proList2();" value="공정리스트 확정">
                            <?php } ?>
                        <?php } ?>
                        <div class="sub0203_table">
                            <table>
                                <thead>
                                    <tr>
                                    <?php if($_COOKIE['HPLEVEL'] == "관리") { ?>
                                    <td>
                                        <input id="all_check" type="checkbox" onclick="on_chk();">
                                    </td>
                                    <?php } ?>

                                    <td><a href="<?php echo $url . "order=qt_no&by=$by"; ?>">NO</a></td>
                                    <td><a href="<?php echo $url . "order=ho&by=$by"; ?>">호선</a></td>
                                    <td><a href="<?php echo $url . "order=por&by=$by"; ?>">POR</a></td>
                                    <td style="width: 100px;">SEQ</td>
                                    <td><a href="<?php echo $url . "order=count&by=$by"; ?>">수량</a></td>
                                    <td><a href="<?php echo $url . "order=weight&by=$by"; ?>">중량</a></td>
                                    <td><a href="<?php echo $url . "order=money&by=$by"; ?>">금액</a></td>
                                    <td><a href="<?php echo $url . "order=pro_date&by=$by"; ?>">제작납기</a></td>
                                    <td><a href="<?php echo $url . "order=mp_date&by=$by"; ?>">MP납기</a></td>
                                    <td>시리즈</td>
                                    <td>사상</td>
                                    <td style="width: 130px;">PAINT</td>
                                    <td>특수자재</td>
                                    <td style="width: 30px;">개정도</td>

                                    <?php if($_COOKIE['HPLEVEL'] == "관리") { ?>
                                    <td>NO 변경</td>
                                    <?php } ?>
                                    <!-- <td>처리</td> -->
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    $paint_arr = array();

                                    //**************************************공정 리스트 - LOT 번호 조회 변경**************************************//
                                    // 2022-12-07. 김한얼. LOT번호 추가로 조회 조건 변경
                                    // 2022-12-08. 김한얼. 암호화, 복호화 추가
                                    // 이전 코드 //
                                    // $select_query = "SELECT A.ho AS ho, A.por AS por, A.qt_no AS qt_no, SUM(B.count) AS count, SUM(B.weight) AS weight, SUM(money) AS money, MIN(B.pro_date) AS pro_date, MIN(B.mp_date) AS mp_date,
                                    // A.series AS series, A.revision AS revision, A.sp AS sp FROM hj_prolist AS A
                                    // INNER JOIN hj_quantity AS B ON A.ho = B.ho AND A.por = B.por AND A.qt_no = B.qt_no AND A.seq = B.seq GROUP BY A.ho, A.por, A.qt_no, A.series, A.revision, A.sp ";

                                    $get_lotDate = base64_decode($_GET['lot_date']);
                                    $get_listLot = base64_decode($_GET['list_lot']);

                                    if($get_lotDate != null && $get_listLot != null) {
                                        // $select_query = "SELECT A.ho AS ho, A.por AS por, A.qt_no AS qt_no, SUM(B.count) AS count, SUM(B.weight) AS weight, SUM(money) AS money, MIN(B.pro_date) AS pro_date, MIN(B.mp_date) AS mp_date, A.series AS series, A.revision AS revision, A.sp AS sp, A.lot_date, A.list_lot
                                        // FROM hj_prolist AS A INNER JOIN hj_quantity AS B ON A.ho = B.ho AND A.por = B.por AND A.qt_no = B.qt_no AND A.seq = B.seq
                                        // WHERE lot_date = '$get_lotDate' AND list_lot = '$get_listLot'
                                        // GROUP BY A.ho, A.por, A.qt_no, A.series, A.revision, A.sp, A.lot_date, A.list_lot ";

                                        $select_query = "SELECT ho, por, qt_no, SUM(count) AS count, SUM(weight) AS weight, SUM(money) AS money, MIN(pro_date) AS pro_date, MIN(mp_date) AS mp_date, series, revision, sp, lot_date, list_lot
                                        FROM hj_lada
                                        WHERE lot_date = '$get_lotDate' AND list_lot = '$get_listLot' AND qt_no IS NOT NULL AND DATE_FORMAT(quantity_ok, '%Y-%m-%d') IS NOT NULL  
                                        GROUP BY ho, por, qt_no, series, revision, sp, lot_date, list_lot ";
                                    } else {
                                        $select_query = "SELECT ho, por, qt_no, SUM(count) AS count, SUM(weight) AS weight, SUM(money) AS money, MIN(pro_date) AS pro_date, MIN(mp_date) AS mp_date, series, revision, sp, lot_date, list_lot
                                        FROM hj_lada
                                        WHERE (lot_date = '' OR lot_date IS NULL) AND (list_lot = '' OR list_lot IS NULL) AND (qt_no != '' OR qt_no IS NOT NULL) AND DATE_FORMAT(quantity_ok, '%Y-%m-%d') IS NOT NULL 
                                        GROUP BY ho, por, qt_no, series, revision, sp, lot_date, list_lot ";
                                    }
                                    //*******************************************************************************************************//
                                    
                                    if(!$order) {
                                        $select_query = $select_query . "ORDER BY qt_no * '1' ASC, qt_no ASC ";
                                    } else {
                                        $select_query = $select_query . $order_by;
                                    }

                                    include 'sub0203/sub0203_func.php';
                                    
                                    $select_result = mysqli_query($conn, $select_query);
                                    while($row = mysqli_fetch_assoc($select_result)) {
                                        $ho = $row['ho'];
                                        $por = $row['por'];
                                        $qt_no = $row['qt_no'];
                                        $count = $row['count'];
                                        $weight = $row['weight'];
                                        $money = $row['money'];
                                        $pro_date = $row['pro_date'];
                                        $mp_date = $row['mp_date'];
                                        $series = $row['series'];
                                        $revision = $row['revision'];
                                        $sp = $row['sp'];
                                    ?>
                                    <tr>
                                        <?php if($_COOKIE['HPLEVEL'] == "관리") { ?>
                                        <td>
                                            <input class="sub_check" type="checkbox" name="prolist_no[]" value="<?php echo $qt_no; ?>">
                                        </td>
                                        <?php } ?>

                                        <td>
                                            <?php if($_COOKIE['HPLEVEL'] == "관리") { ?>
                                                <input class="qtNo" type="text" name="update_qtNo" value="<?php echo $qt_no; ?>">
                                            <?php } else { ?>
                                                <?php echo $qt_no; ?>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <input type="hidden" name="prolist_ho[]" value="<?php echo $ho; ?>">
                                            <?php echo $ho; ?>
                                        </td>
                                        <td>
                                            <input type="hidden" name="prolist_por[]" value="<?php echo $por; ?>">
                                            <?php echo $por; ?>
                                        </td>
                                        <td>
                                            <?php
                                                seq($conn, $ho, $por, $qt_no);
                                            ?>
                                        </td>
                                        <td><?php echo number_format($count); ?></td>
                                        <td><?php echo $weight; ?></td>
                                        <td><?php echo number_format($money); ?></td>
                                        <td onchange="proDate_up2(this, '<?php echo $ho; ?>', '<?php echo $por; ?>', '<?php echo $qt_no; ?>');">
                                            <?php if($_COOKIE['HPLEVEL'] == "관리") { ?>
                                                <input type="date" name="input_pro_date[]" value="<?php echo $pro_date; ?>">
                                            <?php } else { ?>
                                                <?php echo $pro_date; ?>
                                            <?php } ?>
                                        </td>
                                        <td onchange="mpDate_up2(this, '<?php echo $ho; ?>', '<?php echo $por; ?>', '<?php echo $qt_no; ?>');">
                                            <?php if($_COOKIE['HPLEVEL'] == "관리") { ?>
                                                <input type="date" name="input_mp_date[]" value="<?php echo $mp_date; ?>">
                                            <?php } else { ?>
                                                <?php echo $mp_date; ?>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <?php if($_COOKIE['HPLEVEL'] == "관리") { ?>
                                                <input style="width: 50px;" type="text" name="input_series[]" value="<?php echo $series; ?>">
                                            <?php } else { ?>
                                                <?php echo $series; ?>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <?php
                                                lap($conn, $ho, $por, $qt_no, $count);
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                paint($conn, $ho, $por, $qt_no);
                                            ?>
                                        </td>
                                        <td>
                                            <?php if($_COOKIE['HPLEVEL'] == "관리") { ?>
                                                <textarea name="input_sp[]" rows="2" cols="20"><?php echo $sp; ?></textarea>
                                            <?php } else { ?>
                                                <span style="white-space: nowrap;"><?php echo nl2br($sp); ?></span>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <?php
                                                revision($conn, $ho, $por);
                                            ?>
                                        </td>
                                        <?php if($_COOKIE['HPLEVEL'] == "관리") { ?>
                                        <td>
                                            <input type="button" name="add_prolist" onclick="add_prolist2(this);" value="변경">
                                        </td>
                                        <?php } ?>
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
</div>

<script>
    var loader = $("div.loader_div");
    var container = $("div#show");

    window.onload = function () {
        loader.css("display","none");
        container.css("display","block");
    }
</script>

<?php include "../layout/footer.php"; ?>
