<!-- header -->
<?php include "../layout/header.php"; ?>
<?php include '../include/dbcon.php'; ?>
<?php $_SESSION['NAV'] = 'sub11'; ?>
<!-- //header -->
<?php
    $s_name = $_GET['s_name'];
    $s_in_charge = $_GET['s_in_charge'];
    $s_address = $_GET['s_address'];
    $s_business = $_GET['s_business'];
    $s_contact = $_GET['s_contact'];
    $s_email = $_GET['s_email'];

    $search_str = "WHERE 1";
    
    if($s_name){
        $search_str .= " AND name LIKE '%$s_name%' ";
    }
    if($s_in_charge){
        $search_str .= " AND in_charge LIKE '%$s_in_charge%' ";
    }
    if($s_address){
        $search_str .= " AND address LIKE '%$s_address%' ";
    }
    if($s_business){
        $search_str .= " AND business LIKE '%$s_business%' ";
    }
    if($s_contact){
        $search_str .= " AND contact LIKE '%$s_contact%' ";
    }
    if($s_email){
        $search_str .= " AND email LIKE '%$s_email%' ";
    }
?>

<div class="content sub11">
    <div class="ct_wrap">
    <?php include "../layout/nav2.php" ?>
        <div class="container_ct">
            <div class="container sub01">
                <div class="sub_plate">
                    <h3>거래처 추가</h3>
                    <div class="add_user">
                        <ul>
                            <li>회사명<span><input type="text" name="name"></span></li>
                            <li>대표이사/담당자<span><input type="text" name="in_charge"></span></li>
                            <li>주소<span><input type="text" name="address"></span></li>
                            <li>업태/종목<span><input type="text" name="business"></span></li>
                            <li>전화번호/FAX번호<span><input type="text" name="contact"></span></li>
                            <li>E-mail<span><input type="text" name="email"></span></li>
                        </ul>
                        <ul>
                            <li><input type="button" onclick="add_account(this);" value="등록"></li>
                        </ul>
                    </div>
                </div>
                <div class="sub_plate">
                    <h3>거래처 검색</h3>
                    <div class="add_code">
                        <form action="<?php echo $_SERVER['PHP_SELF'] . '?s_name=' . $s_name . '&s_in_charge=' . $s_in_charge . '&s_address=' . $s_address . '&s_contact=' . $s_contact . '&s_business=' . $s_business . '&s_contact=' . $s_contact . '&s_email=' . $s_email; ?>" method="get">
                            <table>
                                <tr>
                                    <td>회사명</td>
                                    <td><input type="text" name="s_name" placeholder="(검색어)회사명" value="<?php echo $s_name?>"></td>
                                    <td>대표이사/담당자</td>
                                    <td><input type="text" name="s_in_charge" placeholder="(검색어)대표이사/담당자" value="<?php echo $s_in_charge?>"></td>
                                    <td>주소</td>
                                    <td><input type="text" name="s_address" placeholder="(검색어)주소" value="<?php echo $s_address?>"></td>
                                    <td rowspan="2"><input style="width: 100%; height: 50px;" type="submit" value="검색"></td>
                                </tr>
                                <tr>
                                    <td>업태, 종목</td>
                                    <td><input type="text" name="s_business" placeholder="(검색어)업태, 종목" value="<?php echo $s_business?>"></td>
                                    <td>전화번호/FAX번호</td>
                                    <td><input type="text" name="s_contact" placeholder="(검색어)전화번호/FAX번호" value="<?php echo $s_contact?>"></td>
                                    <td>E-mail</td>
                                    <td><input type="text" name="s_email" placeholder="(검색어)E-mail" value="<?php echo $s_email?>"></td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
                <div class="sub_plate">
                    <?php 
                        $select_table_query = "SELECT * FROM hj_table WHERE ok = 'Y' ";
                        $table_result = mysqli_query($conn, $select_table_query);
                        $table_row = mysqli_fetch_assoc($table_result);
                        $style = $table_row['style'];
                    ?>
                    <h3>거래처 리스트</h3>
                    <div class="drawing_table">
                        <table class="<?php echo $style; ?>">
                            <!-- <caption style="text-align:right"><input type="button" value="출력"></caption> -->
                            <thead>
                                <tr>
                                <td>no</td>
                                <td>회사명</td>
                                <td>대표이사/담당자</td>
                                <td>주소</td>
                                <td>업태, 종목</td>
                                <td>전화번호/FAX번호</td>
                                <td>E-mail</td>
                                <td>처리</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                
                                $select_query = "SELECT * FROM hj_account $search_str ORDER BY no DESC ";
                                $select_result = mysqli_query($conn, $select_query);
                                $i = 0;
                                while($row = mysqli_fetch_assoc($select_result)) {
                                    $i++;
                                    $no = $row['no'];
                                    $name = $row['name'];
                                    $in_charge = $row['in_charge'];
                                    $address = $row['address'];
                                    $business = $row['business'];
                                    $contact = $row['contact'];
                                    $email = $row['email'];
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $i; ?>
                                        <input type="hidden" name="order_no2" value="<?php echo $no; ?>">
                                    </td>
                                    <td style="text-align: left;" onclick="user_click(this)">
                                        <p><?php echo $name; ?></p>
                                        <input style="display:none;" type="text" name="name2" value="<?php echo $name; ?>">
                                    </td>
                                    <td style="text-align: left;" onclick="user_click(this)">
                                        <p><?php echo $in_charge; ?></p>
                                        <input style="display:none;" type="text" name="in_charge2" value="<?php echo $in_charge; ?>">
                                    </td>
                                    <td style="text-align: left;" onclick="user_click(this)">
                                        <p><?php echo $address; ?></p>
                                        <input style="display:none;" type="text" name="adress2" value="<?php echo $address; ?>">
                                    </td>
                                    <td style="text-align: left;" onclick="user_click(this)">
                                        <p><?php echo $business; ?></p>
                                        <input style="display:none;" type="text" name="business2" value="<?php echo $business; ?>">
                                    </td>
                                    <td style="text-align: left;" onclick="user_click(this)">
                                        <p><?php echo $contact; ?></p>
                                        <input style="display:none;" type="text" name="contact2" value="<?php echo $contact; ?>">
                                    </td>
                                    <td style="text-align: left;" onclick="user_click(this)">
                                        <p><?php echo $email; ?></p>
                                        <input style="display:none;" type="text" name="email2" value="<?php echo $email; ?>">
                                    </td>
                                    <td>
                                        <input type="button" onclick="edit_account(this);" value="수정">
                                        <input type="button" onclick="delete_account(this);" value="삭제">
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
