<?php include "../layout/header.php"; ?>
<?php include '../include/dbcon.php'; ?>
<?php $_SESSION['NAV'] = 'sub21'; ?>
<?php $_SESSION['page'] = 'sub2101'; ?>

<?php 
    $search_str = "WHERE 1 ";

    $search_date1 = $_GET['search_date1'];
    $search_date2 = $_GET['search_date2'];
    if($search_date1 && $search_date2) {
        $search_str .= " AND DATE_FORMAT(date, '%Y-%m-%d') BETWEEN '$search_date1' AND '$search_date2' ";
    } else {
        if($search_date1) {
            $date = date("Y-m-d");
            $search_str .= " AND DATE_FORMAT(date, '%Y-%m-%d') BETWEEN '$search_date1' AND '$date' ";
        }
    }

    $pro_date1 = $_GET['pro_date1'];
    $pro_date2 = $_GET['pro_date2'];
    if($pro_date1 && $pro_date1) {
        $search_str2 .= " AND DATE_FORMAT(quantity_ok, '%Y-%m-%d') BETWEEN '$pro_date1' AND '$pro_date2' ";
    } else {
        if($pro_date1) {
            $date = date("Y-m-d");
            $search_str2 .= " AND DATE_FORMAT(quantity_ok, '%Y-%m-%d') BETWEEN '$pro_date1' AND '$date' ";
        }
    }

    $search_ship_no = $_GET['search_ship_no'];
    if($search_ship_no) {
        $search_str .= " AND ship_no = '$search_ship_no' ";
    }

    $search_por_no = $_GET['search_por_no'];
    if($search_por_no) {
        $search_str .= " AND por_no = '$search_por_no' ";
    }

    $search_seq_no = $_GET['search_seq_no'];
    if($search_seq_no) {
        $search_str .= " AND seq_no = '$search_seq_no' ";
    }

    $search_paint_code = $_GET['search_paint_code'];
    if($search_paint_code) {
        $search_str .= " AND paint_code = '$search_paint_code' ";
    }
?>

<div class="content sub01">
    <div class="ct_wrap">
        <?php include "../layout/nav2.php" ?>
        <div class="container_ct">
            <div class="container sub2101">
                <div class="sub_plate_union">
                    <div class="sub_plate">
                        <h3>꼬리표 검색</h3>
                        <form action="<?php echo "/hj/sub21/sub2102.php" . '?search_date1=' . $search_date1 . '&search_date2=' . $search_date2 . '&pro_date1=' . $pro_date1 . '&pro_date2=' . $pro_date2 . '&ship_no=' . $ship_no . '&por_no=' . $por_no . '&seq_no=' . $seq_no . '&paint_code=' . $paint_code; ?>" method="get">
                            <table class="KPI_table">
                                <tr>
                                    <td>지시일자</td>
                                    <td><input type="date" name="pro_date1" value="<?php echo $pro_date1; ?>"> ~ <input type="date" name="pro_date2" value="<?php echo $pro_date2; ?>"></td>
                                    <td>제조일자</td>
                                    <td ><input type="date" name="search_date1" value="<?php echo $search_date1; ?>"> ~ <input type="date" name="search_date2" value="<?php echo $search_date2; ?>"></td>
                                    <td rowspan="4"><input style="width:100%; height:50px;" type="submit" value="검색"></td>
                                </tr>         
                                <tr>
                                    <td>호선</td>
                                    <td><input type="text" name="search_ship_no" value="<?php echo $search_ship_no; ?>"></td>
                                    <td>POR</td>
                                    <td><input type="text" name="search_por_no" value="<?php echo $search_por_no; ?>"></td>
                                </tr>
                                <tr>
                                    <td>SEQ</td>
                                    <td><input type="text" name="search_seq_no" value="<?php echo $search_seq_no; ?>"></td>
                                    <td>PAINT</td>
                                    <td><input type="text" name="search_paint_code" value="<?php echo $search_paint_code; ?>"></td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>


<?php include "../layout/footer.php"; ?>
