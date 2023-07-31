<!-- header -->
<?php include "../layout/header.php"; ?>
<?php include '../include/dbcon.php'; ?>
<?php $_SESSION['NAV'] = 'sub16'; ?>
<!-- //header -->
<?php 
    $search_str = "WHERE 1 ";

    $s_test_por = $_GET['s_test_por'];
    $s_test_seq = $_GET['s_test_seq'];
    $s_test_result = $_GET['s_test_result'];

    if($s_test_por) { 
        $search_str .= " AND test_por LIKE '%$s_test_por%' "; 
    }
    if($s_test_seq) { 
        $search_str .= " AND test_seq LIKE '%$s_test_seq%' "; 
    }
    if($s_test_result) { 
        $search_str .= " AND test_result LIKE '%$s_test_result%' "; 
    }
?>

<div class="content sub11">
    <div class="ct_wrap">
    <?php include "../layout/nav2.php" ?>
        <div class="container_ct">
            <div class="container sub01">
                <div class="sub_plate">
                    <h3>제품검사 추가</h3>
                    <div class="add_user">
                        <ul>
                            <li>POR 번호<span><input type="text" name="test_por"></span></li>
                            <li>SEQ 번호<span><input type="text" name="test_seq"></span></li>
                            <li>검사 결과<span><input type="text" name="test_result"></span></li>
                        </ul>
                        <ul>
                            <li><input type="button" onclick="add_test(this);" value="등록"></li>
                        </ul>
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
                    <h3>제품검사 리스트</h3>
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
                                    <td>처리</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $select_query = "SELECT * FROM hj_test $search_str";
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
                                    <td>
                                        <input type="button" onclick="delete_test(this);" value="삭제">
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
