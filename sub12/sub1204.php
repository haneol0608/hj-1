<!-- header -->
<?php include "../layout/header.php"; ?>
<?php include '../include/dbcon.php'; ?>
<?php $_SESSION['NAV'] = 'sub12'; ?>
<!-- //header -->
<?php
    $s_cut_name = $_GET['s_cut_name'];
    $s_cut_order = $_GET['s_cut_order'];
    $s_cut_addr = $_GET['s_cut_addr'];
    $s_cut_phone = $_GET['s_cut_phone'];

    $search_str = "WHERE 1 ";

    if($s_cut_name) {
        $search_str .= "AND cut_name LIKE '%$s_cut_name%'";
    }
    if($s_cut_order) {
        $search_str .= "AND cut_order LIKE '%$s_cut_order%'";
    }
    if($s_cut_addr) {
        $search_str .= "AND cut_addr LIKE '%$s_cut_addr%'";
    }
    if($s_cut_phone) {
        $search_str .= "AND cut_phone LIKE '%$s_cut_phone%'";
    }
?>
<div class="content sub11">
    <div class="ct_wrap">
    <?php include "../layout/nav2.php" ?>
        <div class="container_ct">
            <div class="container sub01">
                <div class="sub_plate">
                    <h3>완제품 등록</h3>
                    <div class="add_user">
                        <ul>
                            <li>완료제품 명<span><input type="text" name="cut_name"></span></li>
                            <li>담당자<span><input type="text" name="cut_order"></span></li>
                            <li>주소<span><input type="text" name="cut_addr"></span></li>
                            <li>연락처<span><input type="text" name="cut_phone"></span></li>
                        </ul>
                        <ul>
                            <li><input type="button" onclick="add_cutok(this); logData(this, '수주완료 등록', '<?php echo substr(date('Y-m-d h:i:s.u'), 0, 21); ?>', '<?php echo $_COOKIE['HPID']; ?>');" value="등록"></li>
                        </ul>
                    </div>
                </div>
                <div class="sub_plate">
                    <h3>완제품 검색</h3>
                    <div class="add_code">
                        <form action="<?php echo $_SERVER['PHP_SELF'] . '?s_cut_name=' . $s_cut_name . '&s_cut_order=' . $s_cut_order . '&s_cut_addr=' . $s_cut_addr . '&s_cut_phone=' . $s_cut_phone ?>" method="get">
                            <table>
                                <tr>
                                    <td>완료제품명</td>
                                    <td><input type="text" name="s_cut_name" value="<?php echo $s_cut_name; ?>"></td>
                                    <td>담당자</td>
                                    <td><input type="text" name="s_cut_order" value="<?php echo $s_cut_order; ?>"></td>
                                    <td>주소</td>
                                    <td><input type="text" name="s_cut_addr" value="<?php echo $s_cut_addr; ?>"></td>
                                    <td>연락처</td>
                                    <td><input type="text" name="s_cut_phone" value="<?php echo $s_cut_phone; ?>"></td>
                                    <td><input style="width: 100%; height: 50px;" type="submit" value="검색"></td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>

                <div class="sub_plate">
                    
                    <h3>완제품 리스트</h3>
                    <div class="drawing_table">
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
                                    <td>완제품 명</td>
                                    <td>담당자</td>
                                    <td>주소</td>
                                    <td>연락처</td>
                                    <td>삭제</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $select_query = "SELECT * FROM hj_cutok $search_str";
                                $select_result = mysqli_query($conn, $select_query);
                                $i = 0;
                                while($row = mysqli_fetch_assoc($select_result)) {
                                    $i++;
                                    $no = $row['no'];
                                    $cut_name = $row['cut_name'];
                                    $cut_order = $row['cut_order'];
                                    $cut_addr = $row['cut_addr'];
                                    $cut_phone = $row['cut_phone'];
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $i; ?>
                                    </td>
                                    <td>
                                        <p><?php echo $cut_name; ?></p>
                                    </td>
                                    <td style="text-align: center;">
                                        <p><?php echo $cut_order; ?></p>
                                    </td>
                                    <td>
                                        <p><?php echo $cut_addr; ?></p>
                                    </td>
                                    <td>
                                        <p><?php echo $cut_phone; ?></p>
                                    </td>
                                    <td>
                                        <input type="button" onclick="cutok_del('<?php echo $no; ?>'); logData(this, '수주완료 삭제', '<?php echo substr(date('Y-m-d h:i:s.u'), 0, 21); ?>', '<?php echo $_COOKIE['HPID']; ?>');" value="삭제">
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
