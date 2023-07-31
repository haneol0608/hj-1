<?php include "../layout/header.php"; ?>
<?php include '../include/dbcon.php'; ?>

<?php $_SESSION['STAT'] = '라벨 마킹대기'; ?>

<div class="content sub01">
    <div class="ct_wrap">
        <?php include "../layout/nav2.php" ?>
        <div class="container_ct">
            <?php include 'product_menu.php'; ?>
            
            <div class="sub_plate">
                <h3>라벨 마킹대기</h3>
                <input type="button" onclick="labelWait_excel();" value="엑셀 다운로드">
                <!-- <input type="button" onclick="labelWait_up();" value="전체 저장"> -->

                <div class="draw_table">
                    <table>
                        <thead>
                            <tr>
                                <!-- <td>
                                    <input id="all_check" type="checkbox" onclick="on_chk();">
                                </td> -->
                                <td>No</td>
                                <td>호선</td>
                                <td>POR</td>
                                <td>SEQ</td>
                                <td>BLOCK</td>
                                <td>피스번호</td>
                                <td>페인트코드</td>
                                <td>Lot 번호</td>
                                <td>수량</td>
                                <td>처리</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $select_query = "SELECT * FROM hj_label WHERE stat = '마킹대기' ";
                                $select_result = mysqli_query($conn, $select_query);
                                while($row = mysqli_fetch_assoc($select_result)) {
                                    $la_no = $row['la_no'];
                                    $no = $row['no'];
                                    $ho = $row['ho'];
                                    $por = $row['por'];
                                    $seq = $row['seq'];
                                    $block = $row['block'];
                                    $pcs = $row['pcs'];
                                    $paint = $row['paint'];
                                    $lot = $row['lot'];
                                    $other = $row['other'];
                                    $count = $row['count'];
                            ?>
                            <tr>
                                <!-- <td>
                                    <input class="sub_check" type="checkbox" name="label_no[]" value="<?php echo $no; ?>">
                                </td> -->
                                <td>
                                    <!-- <?php echo $la_no; ?> -->
                                    <input style="width: 30px;" type="text" name="la_no" value="<?php echo $la_no; ?>">
                                </td>
                                <td><?php echo $ho; ?></td>
                                <td><?php echo $por; ?></td>
                                <td><?php echo $seq; ?></td>
                                <td><?php echo $block; ?></td>
                                <td><?php echo $pcs; ?></td>
                                <td><?php echo $paint; ?></td>
                                <td><?php echo $lot; ?></td>
                                <td>
                                    <input type="text" name="count" value="<?php echo $count; ?>">
                                </td>
                                <td>
                                    <input type="button" onclick="labelWait_up(<?php echo $no; ?>);" value="저장">
                                    <input type="button" onclick="label_start(this, <?php echo $no; ?>);" value="라벨 등록">
                                    <input type="button" onclick="labelWait_del(this, <?php echo $no; ?>);" value="삭제">
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

<?php include "../layout/footer.php"; ?>