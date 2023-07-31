<?php include "../layout/header.php"; ?>

<?php include '../include/dbcon.php'; ?>

<?php $_SESSION['STAT'] = '컷팅지 등록'; ?>
<?php $_SESSION['NAV'] = 'sub2'; ?>
<?php $_SESSION['page'] = 'sub0201'; ?>



<div class="content sub01">
    <div class="ct_wrap">
        <?php include "../layout/nav2.php" ?>
        <div class="container_ct">

            <!-- *******************************2022-11-17. KHO. 도면 리스트 수종 등록******************************* -->

            <!-- <div class="container sub01">

                <div class="sub_plate">

                <h3>도면 등록</h3>

                    

                <div class="upload_box">

                    <input type="text" name="POR_NO" placeholder="POR 번호를 입력해주세요." >

                    <input type="button" onclick="draw_upload(this);" value="도면 등록">

                </div>

                

                </div>

            </div> -->

            <!-- *************************************************************************************************** -->

            <div class="container sub01">

                <?php include 'product_menu.php'; ?>

                <?php if($_COOKIE['HPLEVEL'] == "관리") { ?>

                    <div class="sub_plate">
                        <h3>도면 등록</h3>

                        <div class="upload_box">
                            <form action="/hj/include/query2.php" method="post" enctype="multipart/form-data">
                                <input type="file" name="draw_file[]" multiple>
                                <input type="submit" onclick="logData(this, '컷팅지 등록', '<?php echo substr(date('Y-m-d h:i:s.u'), 0, 21); ?>', '<?php echo $_COOKIE['HPID']; ?>');" value="도면 업로드">
                            </form>

                        </div>

                    </div>

                <?php } ?>

                <div class="sub_plate">

                    <h3>도면 검색</h3>

                    <div class="search_box">

                        <form action="<?php echo $_SERVER['PHP_SELF'] . '?search_ho=' . $search_ho . '&search_por=' . $search_por ?>" method="get">

                            호선 : <input type="text" name="search_ho" placeholder="호선 입력해주세요." value="<?php echo $search_ho ?>" >

                            POR : <input type="text" name="search_por" placeholder="POR을 입력해주세요." value="<?php echo $search_por ?>" >

                            <input type="submit" value="검색">

                        </form>

                    </div>

                </div>



                <div class="sub_plate">

                    <div class="flex">

                        <h3>도면 리스트(라다 공정 프로그램)</h3>

                        <input type="button" onclick="history.back();" value="뒤로가기">

                    </div>



                    <div class="drawing_table">

                        <table>

                            <thead>

                                <tr>

                                    <td>NO</td>

                                    <td colspan="2">POR번호(호선 + POR)</td>

                                    <td>파일명</td>

                                    <td>등록일</td>

                                    <td>PDF 도면</td>

                                    <td>개정도</td>

                                    <td>상세조회</td>

                                    <?php if($_COOKIE['HPLEVEL'] == "관리") { ?>

                                    <td>등록된 공정리스트</td>

                                    <td>처리</td>

                                    <?php } ?>

                                </tr>

                            </thead>

                            

                            <tbody>

                                <?php

                                $search_ho = $_GET['search_ho'];

                                $search_por = $_GET['search_por'];



                                //************************************** 2022.09.02. KHO. 페이지 수 계산 **************************************//

                                // 1. 반드시 아래 SELECT 쿼리 문에 LIMIT $page_start, $list를 추가해야 함!!!

                                include "../include/lib/pagination/pagination.php";

                                //************************************************************************************************************//

                                

                                $i = 0;

                                if($search_ho || $search_por) {

                                    $select_query = "SELECT * FROM hj_draw WHERE (ho LIKE '%$search_ho%' AND por LIKE '%$search_por%') AND STAT = '생산대기' LIMIT $page_start, $list ";

                                } else {

                                    $select_query = "SELECT * FROM hj_draw WHERE STAT = '생산대기' ORDER BY no DESC LIMIT $page_start, $list ";

                                }



                                $select_result = mysqli_query($conn, $select_query);

                                while($row = mysqli_fetch_assoc($select_result)) {

                                    $i++;

                                    $no = htmlspecialchars($row['no']);

                                    $por = htmlspecialchars($row['por']);

                                    $ho = htmlspecialchars($row['ho']);

                                    $file_name = htmlspecialchars($row['file_name']);

                                    $por_no = $ho . $por;

                                    $upload_day = htmlspecialchars($row['upload_day']);

                                    $draw_file = htmlspecialchars($row['draw_file']);

                                    $revision = htmlspecialchars($row['revision']);

                                ?>

                                <tr>

                                    <td>

                                        <?php echo $i; ?>

                                        <input type="hidden" name="draw_no" value="<?php echo $no; ?>">

                                        <input type="hidden" name="por_no" value="<?php echo $por_no; ?>">

                                    </td>

                                    <td><?php echo $ho; ?></td>

                                    <td><?php echo $por; ?></td>

                                    <td><?php echo $file_name; ?></td>

                                    <td><?php echo $upload_day; ?></td>

                                    <td>

                                        <?php if($_COOKIE['HPLEVEL'] == "관리") { ?>

                                        <form action="/hj/include/query.php" method="post" enctype="multipart/form-data">

                                            <input type="file" name="draw_file2"">

                                            <input type="hidden" name="draw_ho" value="<?php echo $ho; ?>">

                                            <input type="hidden" name="draw_por" value="<?php echo $por ?>">

                                            <input type="submit" onclick="logData(this, '도면 등록', '<?php echo substr(date('Y-m-d h:i:s.u'), 0, 21); ?>', '<?php echo $_COOKIE['HPID']; ?>', '<?php echo $_COOKIE['HPNAME']; ?>', '<?php echo $_SERVER['PHP_SELF']; ?>', '<?php echo $ho; ?>', '<?php echo $por; ?>', '<?php echo $seq; ?>', '<?php echo $qt_no; ?>');" value="도면 등록">

                                            <?php if($draw_file != '' OR $draw_file != null) { ?>

                                            <input type="button" onclick="show_draw('<?php echo $ho; ?>', '<?php echo $por; ?>', '<?php echo base64_encode($draw_file); ?>');" value="도면 조회(<?php echo $draw_file != null ? $draw_file : "미등록"; ?>)" >

                                            <?php } ?>

                                        </form>

                                        <?php } else { ?>

                                            <input type="button" onclick="show_draw('<?php echo $ho; ?>', '<?php echo $por; ?>', '<?php echo base64_encode($draw_file); ?>');" value="도면 조회(<?php echo $draw_file != null ? $draw_file : "미등록"; ?>)" >

                                        <?php } ?>

                                    </td>

                                    <td>

                                        <?php if($_COOKIE['HPLEVEL'] == "관리") { ?>

                                        <input style="width: 40px;" type="text" name="draw_revision" value="<?php echo $revision; ?>">

                                        <input type="button" onclick="logData(this, '도면 개정 변경', '<?php echo substr(date('Y-m-d h:i:s.u'), 0, 21); ?>', '<?php echo $_COOKIE['HPID']; ?>', '<?php echo $_COOKIE['HPNAME']; ?>', '<?php echo $_SERVER['PHP_SELF']; ?>', '<?php echo $ho; ?>', '<?php echo $por; ?>', '<?php echo $seq; ?>', '<?php echo $qt_no; ?>'); revision_update(this, '<?php echo $_GET['page']; ?>', '<?php echo $_GET['search_ho']; ?>', '<?php echo $_GET['search_por']; ?>');" value="수정" >

                                        <?php } else { ?>

                                            <?php echo $revision; ?>

                                        <?php } ?>

                                    </td>

                                    <td>

                                        <input type="button" onclick="location.href='sub0201_detail.php?por_no=<?php echo $por_no; ?>'" value="상세조회">

                                    </td>

                                    <?php if($_COOKIE['HPLEVEL'] == "관리") { ?>

                                    <td>

                                        <?php 

                                            $select_query2 = "SELECT list_title FROM hj_lada WHERE ho = '$ho' AND por = '$por' AND (list_title IS NOT NULL OR list_title != '') GROUP BY list_title ";

                                            $select_result2 = mysqli_query($conn, $select_query2);

                                            while($row2 = mysqli_fetch_assoc($select_result2)) {

                                                echo "<p style='color: red; font-weight: bold;'>" . $list_title = $row2['list_title'] . "</p>";

                                            }

                                        ?>

                                    </td>

                                    <td>

                                        <?php

                                            $select_query2 = "SELECT list_title FROM hj_lada WHERE ho = '$ho' AND por = '$por' AND (list_title IS NOT NULL OR list_title != '') GROUP BY list_title ";

                                            $select_result2 = mysqli_query($conn, $select_query2);

                                            $row2 = mysqli_fetch_assoc($select_result2);

                                            $list_title = $row2['list_title'];



                                            if(!isset($list_title)) {

                                        ?>

                                            <input type="button" onclick="draw_delete2(this);" value="리스트 삭제">

                                        <?php } else { ?>

                                            <input type="button" value="리스트 삭제" disabled>

                                        <?php } ?>

                                        <!-- <input type="button" onclick="pro_start(this)" value="생산지시"> -->

                                    </td>

                                    <?php } ?>

                                </tr>

                                <?php } ?>

                            </tbody>            

                        </table>

                        <?php

                        //************************************** 2022.09.02. KHO. 페이지 네비게이션 추가 **************************************//

                        include "../include/lib/pagination/page_show2.php";

                        //************************************************************************************************************//

                        ?>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>





<?php include "../layout/footer.php"; ?>

