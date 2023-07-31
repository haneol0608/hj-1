<?php include "../layout/header.php"; ?>
<?php include '../include/dbcon.php'; ?>
<?php $_SESSION['NAV'] = 'sub12'; ?>
<?php $_SESSION['page'] = 'sub1201'; ?>
<?php
    $search_ho = $_GET['search_ho'];
    $search_por = $_GET['search_por'];
    $search_file = $_GET['search_file'];
    $search_upload_day1 = $_GET['search_upload_day1'];
    $search_upload_day2 = $_GET['search_upload_day2'];

    $search_str = "WHERE 1 ";

    if($search_ho) {
        $search_str .= " AND ho LIKE '%$search_ho%' ";
    }
    if($search_por) {
        $search_str .= " AND por LIKE '%$search_por%' ";
    }
    if($search_file) {
        $search_str .= " AND file_name LIKE '%$search_file%' ";
    }
    if($search_upload_day1 && $search_upload_day2) {
        $search_str .= " AND upload_day BETWEEN '$search_upload_day1' AND '$search_upload_day2' ";
    }
?>
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
        <div class="sub_plate">
          <h3>수주 등록</h3>
          <div class="upload_box">
            <form action="/hj/include/query.php" method="post" enctype="multipart/form-data">
              <input type="file" name="draw_file[]" multiple>
              <input type="submit" onclick="logData(this, '컷팅지 등록', '<?php echo substr(date('Y-m-d h:i:s.u'), 0, 21); ?>', '<?php echo $_COOKIE['HPID']; ?>');" value="도면 업로드">
            </form>
          </div>
        </div>
      </div>
    
      <div class="container sub1">
        <div class="sub_plate">
          <h3>수주 검색</h3>
          <div class="add_code">
            <form action="<?php echo $_SERVER['PHP_SELF'] . '?search_ho=' . $search_ho . '&search_por=' . $search_por . '&search_file=' . $search_file . '&search_upload_day1=' . $search_upload_day1 . '&search_upload_day2=' . $search_upload_day2 ?>" method="get">
                <table>
                    <tr>
                        <td>호선</td>
                        <td><input type="text" name="search_ho" placeholder="(검색어)호선" value="<?php echo $search_ho ?>" ></td>
                        <td>POR</td>
                        <td><input type="text" name="search_por" placeholder="(검색어)POR" value="<?php echo $search_por ?>" ></td>
                        <td>파일명</td>
                        <td><input type="text" name="search_file" placeholder="(검색어)파일명" value="<?php echo $search_file ?>" ></td>
                        <td>등록일</td>
                        <td>
                            <input type="date" name="search_upload_day1" value="<?php echo $search_upload_day1 ?>" >~
                            <input type="date" name="search_upload_day2" value="<?php echo $search_upload_day2 ?>" >
                        </td>
                        <td><input style="width: 100%; height: 50px;" type="submit" value="검색"></td>
                    </tr>
                </table>
            </form>
          </div>
        </div>
      </div>

      <div class="container sub01">
        <div class="sub_plate">
          <h3>수주 리스트</h3>
        
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
                  <td>NO</td>
                  <td colspan="2">POR번호(호선 + POR)</td>
                  <td>파일명</td>
                  <td>등록일</td>
                  <td>개정도</td>
                  <td>상세조회</td>
                  <td>처리</td>
                </tr>
              </thead>

              <tbody>
                <?php
                  $page_search = "&search_ho=" . $search_ho . "&search_por=" . $search_por . "&search_file=" . $search_file . "&search_upload_day1=" . $search_upload_day1 . "&search_upload_day2=" . $search_upload_day2;
                  $page_query = "SELECT * FROM hj_draw $search_str AND STAT = '생산대기' ";

                  include "../include/lib/pagination/pagination3.php";
                  
                  $i = 0;
                  $select_query = "SELECT * FROM hj_draw $search_str AND STAT = '생산대기' ORDER BY no DESC LIMIT $page_start, $list ";
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
                    <input style="width: 40px;" type="text" name="draw_revision" value="<?php echo $revision; ?>">
                    <input type="button" onclick="version_update(this);" value="수정" >
                  </td>
                  <td>
                    <input type="button" onclick="location.href='sub1202.php?por_no=<?php echo $por_no; ?>'" value="상세조회">
                  </td>
                  <td>
                    <input type="button" onclick="draw_delete(this);" value="리스트 삭제">
                    <!-- <input type="button" onclick="pro_start(this)" value="생산지시"> -->
                  </td>
                </tr>
                <?php } ?>
              </tbody>

            </table>
            <?php
              //************************************** 2022.09.02. KHO. 페이지 네비게이션 추가 **************************************//
              include "../include/lib/pagination/page_show3.php";
              //************************************************************************************************************//
            ?>
          </div>

        </div>
      </div>

    </div>
  </div>
</div>


<?php include "../layout/footer.php"; ?>
