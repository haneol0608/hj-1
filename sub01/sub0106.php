<?php include "../layout/header.php"; ?>
<?php include '../include/dbcon.php'; ?>

<?php $_SESSION['STAT'] = '라벨 마킹'; ?>

<div class="content sub01">
    <div class="ct_wrap">
        <?php include "../layout/nav2.php" ?>
        <div class="container_ct">
            <?php include 'product_menu.php'; ?>
            
            <div class="sub_plate">
                <h3>라벨 마킹(개발중 - 1일 단위 초기화)</h3>
                <input type="button" onclick="label_excel();" value="엑셀 다운로드">

                <div class="draw_table">
                    <table>
                        <thead>
                            <tr>
                                <td>마킹순서</td>
                                <td>호선</td>
                                <td>POR</td>
                                <td>SEQ</td>
                                <td>PAINT</td>
                                <td>기타(블록 등)</td>
                                <td>라벨 수량</td>
                                <td>처리</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $date = date("Y-m-d");
                                // $select_query = "SELECT * FROM hj_label WHERE stat = '마킹' AND date = '$date' ORDER BY la_no ASC";
                                $select_query = "SELECT * FROM hj_label WHERE stat = '마킹' ORDER BY la_no ASC";
                                $select_result = mysqli_query($conn, $select_query);
                                while($row = mysqli_fetch_assoc($select_result)) {
                                    $no = $row['no'];
                                    $la_no = $row['la_no'];
                                    $ho = $row['ho'];
                                    $por = $row['por'];
                                    $seq = $row['seq'];
                                    $paint = $row['paint'];
                                    $other = $row['other'];
                                    $count = $row['count'];
                            ?>
                            <tr>
                                <td><?php echo $la_no; ?></td>
                                <td><?php echo $ho; ?></td>
                                <td><?php echo $por; ?></td>
                                <td><?php echo $seq; ?></td>
                                <td><?php echo $paint; ?></td>
                                <td><?php echo $other; ?></td>
                                <td><?php echo $count . " 개"; ?></td>
                                <td>
                                    <input type="button" onclick="label_cancle(<?php echo $no; ?>);" value="라벨 취소">
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