<div style="display: none;">
<?php include "../layout/header.php"; ?>
<?php include '../include/dbcon.php'; ?>
</div>

<?php 
    $emg_input_ho = json_decode($_GET['emg_input_ho']);
    $emg_input_por = json_decode($_GET['emg_input_por']);
    $emg_input_seq = json_decode($_GET['emg_input_seq']);
    $emg_input_qt_no = json_decode($_GET['emg_input_qt_no']);

    // print_r($emg_input_ho);
?>

<div class="content sub01">
  <div class="ct_wrap">
    <div class="container_ct">

        <div class="container sub1">
            <div class="sub_plate">
                <h3>긴급 공정리스트 선택</h3>
                <div class="drawing_table">
                    <table>
                        <thead>
                            <tr>
                                <td>공정리스트 제목</td>
                                <td>긴급 등록</td>
                            </tr>
                        </thead>

                        <tbody>
                            <?php 
                                $select_prolist_query = "SELECT list_title, lot_date, list_lot FROM hj_prolist WHERE list_title IS NOT NULL GROUP BY list_title, lot_date, list_lot ORDER BY lot_date DESC";
                                $select_prolist_result = mysqli_query($conn, $select_prolist_query);
                                while($prolist_row = mysqli_fetch_assoc($select_prolist_result)) {
                                    $list_title = $prolist_row['list_title'];
                                    $lot_date = $prolist_row['lot_date'];
                                    $list_lot = $prolist_row['list_lot'];
                            ?>
                            <tr>
                                <td><?php echo $list_title; ?></td>
                                <td>
                                    <input type="hidden" name="emg_input_ho" value="<?php echo $emg_input_ho; ?>">
                                    <input type="hidden" name="emg_input_por" value="<?php echo $emg_input_por; ?>">
                                    <input type="hidden" name="emg_input_seq" value="<?php echo $emg_input_seq; ?>">
                                    <input type="hidden" name="emg_input_qt_no" value="<?php echo $emg_input_qt_no; ?>">
                                    <input type="hidden" name="emg_list_lot" value="<?php echo $list_lot; ?>">
                                    <input type="hidden" name="emg_lot_datet" value="<?php echo $lot_date; ?>">
                                    <input type="hidden" name="emg_list_lot" value="<?php echo $list_lot; ?>">
                                    <input type="button" onclick="" value="등록">
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


<div style="display: none;">
<?php include "../layout/footer.php"; ?>
</div>