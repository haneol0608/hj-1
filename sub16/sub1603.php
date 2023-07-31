<!-- header -->
<?php include "../layout/header.php"; ?>
<?php include '../include/dbcon.php'; ?>
<?php $_SESSION['NAV'] = 'sub16'; ?>
<!-- //header -->
<?php 
    $search_str = "WHERE 1 ";

    $search_error_date1 = $_GET['search_error_date1'];
    $search_error_date2 = $_GET['search_error_date2'];
    $search_errPor = $_GET['search_errPor'];
    $search_errinfo = $_GET['search_errinfo'];
    $search_errCount = $_GET['search_errCount'];

    if($search_error_date1 && $search_error_date2) { 
        $search_str .= " AND error_date BETWEEN '$search_error_date1' AND '$search_error_date2'";
    } else{
        if($search_error_date1 && !$search_error_date2) { 
            $date = date('Y-m-d');
            $search_str .= " AND error_date BETWEEN '$search_error_date1' AND '$date'";
        }
    }
    if($search_errPor) { $search_str .= " AND error_por LIKE '%$search_errPor%' "; }
    if($search_errinfo) { $search_str .= " AND error_info LIKE '%$search_errinfo%' "; }
    if($search_errCount) { $search_str .= " AND error_count LIKE '%$search_errCount%' "; }


    $search_str2 = "WHERE 1 ";

    $s_test_por = $_GET['s_test_por'];
    $s_test_seq = $_GET['s_test_seq'];
    $s_test_result = $_GET['s_test_result'];

    if($s_test_por) { 
        $search_str2 .= " AND test_por LIKE '%$s_test_por%' "; 
    }
    if($s_test_seq) { 
        $search_str2 .= " AND test_seq LIKE '%$s_test_seq%' "; 
    }
    if($s_test_result) { 
        $search_str2 .= " AND test_result LIKE '%$s_test_result%' "; 
    }


?>
<div class="content sub11">
    <div class="ct_wrap">
    <?php include "../layout/nav2.php" ?>
        <div class="container_ct">
            <div class="container sub01">
                <h3>통계적 품질정보 관리</h3>
                <div class="sub_plate">
                    <h3>제품불량 검색</h3>
                    <div class="add_code">
                        <form action="<?php $_SERVER['PHP_SELF'] . '?search_error_date1=' . $search_error_date1 . '&search_error_date2=' . $search_error_date2 . '&search_errPor=' . $search_errPor . '&search_errinfo=' . $search_errinfo . '&search_errCount=' . $search_errCount; ?>">
                            <table>
                                <tr>
                                    <td>날짜</td>
                                    <td>
                                        <input type="date" name="search_error_date1" value="<?php echo $search_error_date1; ?>">~
                                        <input type="date" name="search_error_date2" value="<?php echo $search_error_date2; ?>">
                                    </td>
                                    <td>POR 번호</td>
                                    <td><input type="text" name="search_errPor" value="<?php echo $search_errPor; ?>"></td>
                                    <td>불량정보</td>
                                    <td><input type="text" name="search_errinfo" value="<?php echo $search_errinfo; ?>"></td>
                                    <td>수량</td>
                                    <td><input type="text" name="search_errCount" value="<?php echo $search_errCount; ?>"></td>
                                    <td><input style="width: 80%; height: 50px;" type="submit" value="검색"></td>
                                </tr>
                            </table>
                        </form>
                    </div> 
                </div>
                <div class="sub_plate">
                    <h3>기간별 품질정보 리스트</h3>
                    <div class="">
                        <?php 
                            $select_table_query = "SELECT * FROM hj_table WHERE ok = 'Y' ";
                            $table_result = mysqli_query($conn, $select_table_query);
                            $table_row = mysqli_fetch_assoc($table_result);
                            $style = $table_row['style'];
                        ?>
                        <table class="<?php echo $style; ?>">
                            <thead>
                                <tr>
                                    <td>no</td>
                                    <td>날짜</td>
                                    <td>POR번호</td>
                                    <td>불량정보</td>
                                    <td>수량</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $select_query = "SELECT * FROM hj_error $search_str ";
                                $select_result = mysqli_query($conn, $select_query);
                                $i = 0;
                                while($row = mysqli_fetch_assoc($select_result)) {
                                    $i++;
                                    $no = $row['no'];
                                    $error_date = $row['error_date'];
                                    $error_por = $row['error_por'];
                                    $error_info = $row['error_info'];
                                    $error_count = $row['error_count'];
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $i; ?>
                                        <input type="hidden" name="error_no" value="<?php echo $no; ?>">
                                    </td>
                                    <td>
                                        <p><?php echo $error_date; ?></p>
                                    </td>
                                    <td>
                                        <p><?php echo $error_por; ?></p>
                                    </td>
                                    <td>
                                        <p><?php echo $error_info; ?></p>
                                    </td>
                                    <td>
                                        <p><?php echo $error_count; ?></p>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>

                        </table>
                    </div>
                </div>
                <div class="sub_plate">
                    <h3>제품검사 검색</h3>
                    <div class="add_code">
                        <form action="<?php $_SERVER['PHP_SELF'] . '?s_test_por=' . $s_test_por . '&s_test_seq=' . $s_test_seq . '&s_test_result=' . $s_test_result; ?>">
                            <table>
                                <tr>
                                    <td>POR 번호</td>
                                    <td><input type="text" name="s_test_por" value="<?php echo $s_test_por; ?>"></td>
                                    <td>SEQ 번호</td>
                                    <td><input type="text" name="s_test_seq" value="<?php echo $s_test_seq; ?>"></td>
                                    <td>검사결과</td>
                                    <td><input type="text" name="s_test_result" value="<?php echo $s_test_result; ?>"></td>
                                    <td><input style="width: 80%; height: 50px;" type="submit" value="검색"></td>
                                </tr>
                            </table>
                        </form>
                    </div> 
                </div>                    
                <div class="sub_plate">
                    <h3>제품별 품질정보 리스트</h3>
                    <div class="">
                        <?php 
                            $select_table_query = "SELECT * FROM hj_table WHERE ok = 'Y' ";
                            $table_result = mysqli_query($conn, $select_table_query);
                            $table_row = mysqli_fetch_assoc($table_result);
                            $style = $table_row['style'];
                        ?>
                        <table class="<?php echo $style; ?>">
                            <thead>
                                <tr>
                                    <td>no</td>
                                    <td>POR 번호</td>
                                    <td>SEQ 번호</td>
                                    <td>검사 결과</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $select_query = "SELECT * FROM hj_test $search_str2";
                                $select_result = mysqli_query($conn, $select_query);
                                $i = 0;
                                while($row = mysqli_fetch_assoc($select_result)) {
                                    $i++;
                                    $no = $row['no'];
                                    $test_por = $row['test_por'];
                                    $test_seq = $row['test_seq'];
                                    $test_result = $row['test_result'];
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $i; ?>
                                        <input type="hidden" name="test_no" value="<?php echo $no; ?>">
                                    </td>
                                    <td>
                                        <p><?php echo $test_por; ?></p>
                                    </td>
                                    <td>
                                        <p><?php echo $test_seq; ?></p>
                                    </td>
                                    <td>
                                        <p><?php echo $test_result; ?></p>
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
