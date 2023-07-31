<?php include "../layout/header.php"; ?>
<?php include '../include/dbcon.php'; ?>

<?php $_SESSION['STAT'] = '라벨 마킹완료'; ?>

<div class="content sub01">
    <div class="ct_wrap">
        <?php include "../layout/nav2.php" ?>
        <div class="container_ct">
        <?php include 'product_menu.php'; ?>

            <div class="sub_plate">
                <h3>제조리드타임 검색</h3>
                <table>
                    <tr>
                        <td></td>
                    </tr>
                </table>
            </div>
            
            <div class="sub_plate">
                <h3>라벨 마킹완료</h3>
                <input type="button" onclick="label_excel();" value="엑셀 다운로드">

                <div class="draw_table">
                    <table>
                        <thead>
                            <tr>
                                <td>NO</td>
                                <td>호선</td>
                                <td>POR</td>
                                <td>SEQ</td>
                                <td>PAINT</td>
                                <td>생산수량</td>
                                <td>생산일시</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $i = 0;
                                $select_query = "SELECT ship_no, por_no, seq_no, paint_code, COUNT(ship_no) AS count FROM hj_label GROUP BY ship_no, por_no, seq_no, paint_code ORDER BY date DESC";
                                $select_result = mysqli_query($conn2, $select_query);
                                while($row = mysqli_fetch_assoc($select_result)) {
                                    $i++;
                                    $no = $row['no'];
                                    $ship_no = $row['ship_no'];
                                    $por_no = $row['por_no'];
                                    $seq_no = $row['seq_no'];
                                    $paint_code = $row['paint_code'];
                                    $count = $row['count'];
                            ?>
                            <tr>
                                <td>
                                    <?php echo $i; ?>
                                    <input type="hidden" name="no" value="<?php echo $no; ?>">
                                </td>
                                <td><p><?php echo $ship_no; ?></p></td>
                                <td><p><?php echo $por_no; ?></p></td>
                                <td><p><?php echo $seq_no; ?></p></td>
                                <td><p><?php echo $paint_code; ?></p></td>
                                <td><p><?php echo $count; ?></p></td>
                                <td>
                                    <p>
                                        <?php 
                                            $select_date_query = "SELECT * FROM hj_label WHERE ship_no = '$ship_no' AND por_no = '$por_no' AND seq_no = '$seq_no' AND paint_code = '$paint_code' "; 
                                            $select_date_result = mysqli_query($conn2, $select_date_query);
                                            $date_row = mysqli_fetch_assoc($select_date_result);
                                            echo $date = $date_row['date'];
                                        ?>
                                    </p>
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