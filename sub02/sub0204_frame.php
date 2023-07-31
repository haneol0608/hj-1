<?php include "../layout/header.php"; ?>
<?php include '../include/dbcon.php'; ?>

<?php
    //*********************************************************** 2022-11-30. 김한얼. 스타일 -> 배열화 ***********************************************************//
    $w = $_GET['w'];
    $p = $_GET['p'];

    $enc_lotDate = $_GET['lot_date'];
    $enc_listLot = $_GET['list_lot'];

    $lot_date = base64_decode($_GET['lot_date']);
    $list_lot = base64_decode($_GET['list_lot']);

    if($lot_date == null && $list_lot == null) {
        $lot_date = null;
        $list_lot = null;
    }

    // 1. 배열 화 -> 중복 제거
    $qtNo_arr = array();
    $select_query = "SELECT * FROM hj_lada WHERE (lot_date = '$lot_date' AND list_lot = '$list_lot') AND (w = '$w' AND p = '$p') ORDER BY qt_no * '1' ASC, qt_no ASC, seq ASC, count DESC ";
    $select_result = mysqli_query($conn, $select_query);
    while($row = mysqli_fetch_assoc($select_result)) {
        $qt_no = $row['qt_no'];
        array_push($qtNo_arr, $qt_no);
    }
    $qtNo_arr = array_unique($qtNo_arr);

    // 2. key 값 재정의
    $i = 0;
    foreach($qtNo_arr as $key => $val) {
        unset($qtNo_arr[$key]);
        $new_key = $i;
        $qtNo_arr[$new_key] = $val;

        $i++;
    }

    // 3. key 값 재정의 2
    $qtNo_arr = array_flip($qtNo_arr);
    foreach ( $qtNo_arr as $key => &$value ) {
        $value = (int)$value & 1 ? '#DCDCDC' : 'white';
    }
    // ******************************************************************************************************************************************************//
?>

<div class="content sub01">
    <div class="ct_wrap">

        <?php include "../layout/nav2.php" ?>
        <div class="container_ct">
            <div class="container sub0204">
                <div class="sub_plate">

                    <div class="flex">
                        <h3>컷팅지 상세(W - <?php echo $w; ?> / P - <?php echo $p; ?>)</h3>
                        <input type="button" onclick="history.back();" value="뒤로가기">
                    </div>

                    <input type="button" onclick="location.href='sub0204_print.php?w=<?php echo $w; ?>&p=<?php echo $p; ?>&lot_date=<?php echo $enc_lotDate; ?>&list_lot=<?php echo $enc_listLot; ?>'" value="인쇄하기">
                    <input type="button" onclick="location.href='sub0204_excel(frame).php?w=<?php echo $w; ?>&p=<?php echo $p; ?>&lot_date=<?php echo $enc_lotDate; ?>&list_lot=<?php echo $enc_listLot; ?>'" value="엑셀 다운로드">
                    <input type="button" onclick="label_wait();" value="라벨 마킹대기">

                    <div class="drawing_table">
                        <table>
                            <thead>
                                <tr>
                                    <td>
                                        <input id="all_check" type="checkbox" onclick="on_chk();">
                                    </td>
                                    <td>사상</td>
                                    <td>SEQ</td>
                                    <td>수량</td>
                                    <td colspan="5">F . B<br>(FRAME)65*9T</td>
                                    <td>U</td>
                                    <td>B</td>
                                    <td>각철<br>수량</td>
                                    <td>호선</td>
                                    <td>POR.</td>
                                    <td>비고<br>No.</td>
                                    <!-- <td>W</td> -->
                                    <!-- <td>P</td> -->
                                </tr>
                            </thead>
                            
                            <tbody>
                                <?php
                                // $select_query = "SELECT * FROM hj_prolist AS A, hj_cutting AS B WHERE ((B.w = '$w' OR B.w = '') AND (B.p= '$p' OR B.p ='')) AND (A.ho = B.ho AND A.por = B.por AND A.seq = B.seq) ORDER BY A.qt_no ASC, A.seq ASC, B.count DESC ";
                                $select_query = "SELECT * FROM hj_lada WHERE (lot_date = '$lot_date' AND list_lot = '$list_lot') AND (w = '$w' AND p= '$p') ORDER BY qt_no * '1' ASC, qt_no ASC, seq ASC, count DESC ";
                                $select_result = mysqli_query($conn, $select_query);
                                while($row = mysqli_fetch_assoc($select_result)) {
                                    $i++;
                                    $lap = $row['lap'];
                                    $seq = $row['seq'];
                                    $count = $row['count'];
                                    $fr_one = $row['fr_one'];
                                    $fr_two = $row['fr_two'];
                                    $fr_three = $row['fr_three'];
                                    $fr_four = $row['fr_four'];
                                    $fr_five = $row['fr_five'];
                                    // $W = $row['W'];
                                    // $P = $row['P'];
                                    $U = $row['U'];
                                    $B = $row['B'];
                                    $gak_count = $row['gak_count'];
                                    $ho = $row['ho'];
                                    $por = $row['por'];
                                    $qt_no = $row['qt_no'];
                                    $paint = $row['paint'];
                                    
                                    $count == 0 ? $count ='' : $count;
                                    $fr_one == 0 ? $fr_one = '' : $fr_one;
                                    $fr_two == 0 ? $fr_two = '' : $fr_two;
                                    // $fr_three == 0 ? $fr_three = '' : $fr_three;
                                    // $fr_four == 0 ? $fr_four = '' : $fr_four;
                                    $fr_five == 0 ? $fr_five = '' : $fr_five;
                                    // $pad_one == 0 ? $pad_one = '' : $pad_one;
                                    // $pad_two == 0 ? $pad_two = '' : $pad_two;
                                    // $gak_count == 0 ? $gak_count = '' : $gak_count;
                                ?>
                                <!--********* 2022.11.30. 김한얼. 스타일 추가 *********-->
                                <?php if($qtNo_arr[$qt_no] == '#DCDCDC') { ?>
                                <tr style="background-color: #DCDCDC;">
                                <?php } else { ?>
                                <tr>
                                <?php } ?>
                                    <!-- *********************************************** -->
                                    <td>
                                        <input class="sub_check" type="checkbox" name="label_seq[]" value="<?php echo $seq; ?>">
                                        <input type="hidden" name="label_paint[]" value="<?php echo $paint; ?>">
                                    </td>
                                    <td><?php echo $lap; ?></td>
                                    <td>
                                        <?php echo $seq; ?>
                                    </td>
                                    <td><?php echo $count; ?></td>
                                    <td><?php echo htmlspecialchars($fr_one); ?></td>
                                    <td><?php echo htmlspecialchars($fr_two); ?></td>
                                    <td><?php echo htmlspecialchars($fr_three); ?></td>
                                    <td><?php echo htmlspecialchars($fr_four); ?></td>
                                    <td><?php echo htmlspecialchars($fr_five); ?></td>
                                    <td><?php echo htmlspecialchars($U); ?></td>
                                    <td><?php echo htmlspecialchars($B); ?></td>
                                    <td><?php echo htmlspecialchars($gak_count); ?></td>
                                    <td>
                                        <input type="hidden" name="label_ho[]" value="<?php echo $ho; ?>">
                                        <?php echo $ho; ?>
                                    </td>
                                    <td>
                                        <input type="hidden" name="label_por[]" value="<?php echo $por; ?>">
                                        <?php echo $por; ?>
                                    </td>
                                    <td><?php echo $qt_no; ?></td>
                                    <!-- <td><?php echo $w; ?></td> -->
                                    <!-- <td><?php echo $p; ?></td> -->
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
