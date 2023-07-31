<!-- header -->
<?php include "../layout/header.php"; ?>
<?php include '../include/dbcon.php'; ?>
<?php $_SESSION['NAV'] = 'sub11'; ?>
<!-- //header -->

<?php 
    $search_str = "WHERE 1 ";

    $search_name = $_GET['search_name'];
    $search_inCharge = $_GET['search_inCharge'];
    $search_addr = $_GET['search_addr'];
    $search_contact = $_GET['search_contact'];
    $search_business = $_GET['search_business'];
    $search_email = $_GET['search_email'];

    if($search_name) { $search_str .= " AND name LIKE '%$search_name%' "; }
    if($search_inCharge) { $search_str .= " AND in_charge LIKE '%$search_inCharge%' "; }
    if($search_addr) { $search_str .= " AND address LIKE '%$search_addr%' "; }
    if($search_contact) { $search_str .= " AND contact LIKE '%$search_contact%' "; }
    if($search_business) { $search_str .= " AND business LIKE '%$search_business%' "; }
    if($search_email) { $search_str .= " AND email LIKE '%$search_email%' "; }
?>

<div class="content sub11">
    <div class="ct_wrap">
    <?php include "../layout/nav2.php" ?>
        <div class="container_ct">

            <div class="container sub11">
                <!--***************** 20232-03-28. 김한얼 팀장. 시정조치 보완요청 사항 반엉 *****************-->
                <div class="sub_plate">
                    <h3>사업장정보 검색</h3>
                    <form action="<?php $_SERVER['PHP_SELF'] . '?search_name=' . $search_name . '&search_inCharge=' . $search_inCharge . '&search_addr=' . $search_addr . '&search_contact=' . $search_contact; ?>">
                        <table>
                            <tr>
                                <td>회사명</td>
                                <td><input style="width: 90%;" type="text" name="search_name" value="<?php echo $search_name; ?>"></td>
                                <td>대표이사</td>
                                <td><input style="width: 90%;" type="text" name="search_inCharge" value="<?php echo $search_inCharge; ?>"></td>
                                <td>주소</td>
                                <td><input style="width: 90%;" type="text" name="search_addr" value="<?php echo $search_addr; ?>"></td>
                                <td rowspan="2"><input style="width: 100%; height: 50px;" type="submit" value="검색"></td>
                            </tr>
                            <tr>
                                <td>업태/종목</td>
                                <td><input style="width: 90%;" type="text" name="search_business" value="<?php echo $search_business; ?>"></td>
                                <td>전화번호/FAX번호</td>
                                <td><input style="width: 90%;" type="text" name="search_contact" value="<?php echo $search_contact; ?>"></td>
                                <td>E-mail</td>
                                <td><input style="width: 90%;" type="text" name="search_email" value="<?php echo $search_email; ?>"></td>
                            </tr>
                        </table>
                    </form>
                </div>
                <!-- ************************************************************************************ -->

                <div class="sub_plate">
                    <!-- <h3>사업장 정보관리</h3>
                    <div class="company_show">
                        <table>
                            <?php 
                                $select_query = "SELECT * FROM hj_company";
                                $select_result = mysqli_query($conn, $select_query);
                                $row = mysqli_fetch_assoc($select_result);

                                $no = htmlspecialchars($row['no']);
                                $name = htmlspecialchars($row['name']);
                                $man = htmlspecialchars($row['man']);
                                $addr = htmlspecialchars($row['addr']);
                                $business = htmlspecialchars($row['business']);
                                $phone = htmlspecialchars($row['phone']);
                                $email = htmlspecialchars($row['email']);
                            ?>
                            <tr>
                                <td>회사명</td>
                                <td><input type="text" name="company_name" value="<?php echo $name; ?>"></td>
                            </tr>
                            <tr>
                                <td>대표이사</td>
                                <td><input type="text" name="man" value="<?php echo $man; ?>"></td>
                            </tr>
                            <tr>
                                <td>주소</td>
                                <td><input type="text" name="addr" value="<?php echo $addr; ?>"></td>
                            </tr>
                            <tr>
                                <td>업태, 종목</td>
                                <td><input type="text" name="business" value="<?php echo $business; ?>"></td>
                            </tr>
                            <tr>
                                <td>전화번호/FAX번호</td>
                                <td><input type="text" name="phone" value="<?php echo $phone; ?>"></td>
                            </tr>
                            <tr>
                                <td>E-mail</td>
                                <td><input type="text" name="email" value="<?php echo $email; ?>"></td>
                            </tr>
                        </table>
                    </div> -->

                    <div class="company_btn">
                        <?php if(!isset($no)) { ?>
                        <input type="button" onclick="insert_company(); logData(this, '사업장 정보 등록', '<?php echo substr(date('Y-m-d h:i:s.u'), 0, 21); ?>', '<?php echo $_COOKIE['HPID']; ?>');" value="등록">
                        <?php } else { ?>
                        <input type="button" onclick="update_company(<?php echo $no; ?>); logData(this, '사업장 정보 수정', '<?php echo substr(date('Y-m-d h:i:s.u'), 0, 21); ?>', '<?php echo $_COOKIE['HPID']; ?>');" value="수정">
                        <?php } ?>
                    </div>

                    <?php 
                        $select_query = "SELECT * FROM hj_account $search_str ORDER BY no DESC ";
                        $select_result = mysqli_query($conn, $select_query);
                        while($row = mysqli_fetch_assoc($select_result)) {
                            $no = $row['no'];
                            $name = $row['name'];
                            $in_charge = $row['in_charge'];
                            $address = $row['address'];
                            $business = $row['business'];
                            $contact = $row['contact'];
                            $email = $row['email'];
                    ?>
                    <div class="company_show">
                        <table class="">
                            <input type="hidden" name="order_no2" value="<?php echo $no; ?>">
                            <tr>
                                <td>회사명</td>
                                <td><input type="text" name="name2" value="<?php echo $name; ?>"></td>
                            </tr>
                            <tr>
                                <td>대표이사/담당자</td>
                                <td><input type="text" name="in_charge2" value="<?php echo $in_charge; ?>"></td>
                            </tr>
                            <tr>
                                <td>주소</td>
                                <td><input type="text" name="address2" value="<?php echo $address; ?>"></td>
                            </tr>
                            <tr>
                                <td>업태, 종목</td>
                                <td><input type="text" name="business2" value="<?php echo $business; ?>"></td>
                            </tr>
                            <tr>
                                <td>전화번호/FAX번호</td>
                                <td><input type="text" name="contact2" value="<?php echo $contact; ?>"></td>
                            </tr>
                            <tr>
                                <td>E-mail</td>
                                <td><input type="text" name="email2" value="<?php echo $email; ?>"></td>
                            </tr>
                            <tr>
                                <td>수정</td>
                                <td><input style="text-align: center; width: 5%;" type="button" onclick="edit_account2(this)" value="수정"></td>
                            </tr>
                        </table>
                    </div>

                    <div class="company_btn">
                    </div>

                    <br>
                    <?php } ?>
                </div>
            </div>

        </div>
    </div>
</div>

<?php include "../layout/footer.php"; ?>
<!-- <script type="text/javascript" src="/jd/include/js/script.js"></script> -->
