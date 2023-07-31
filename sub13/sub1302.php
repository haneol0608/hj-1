<?php include "../layout/header.php"; ?>
<?php include '../include/dbcon.php'; ?>
<?php $_SESSION['NAV'] = 'sub13'; ?>
<?php $_SESSION['page'] = 'sub0101'; ?>

<?php
    $search_str = "AND 1 ";

    $search_ho = $_GET['search_ho'];
    $search_por = $_GET['search_por'];
    $search_date1 = $_GET['search_date1'];
    $search_date2 = $_GET['search_date2'];

    if($search_ho) { $search_str .= " AND ho LIKE '%$search_ho%' "; }
    if($search_por) { $search_str .= " AND por LIKE '%$search_por%' "; }
    if($search_date1 && $search_date2) { $search_str .= " AND upload_day BETWEEN '$search_date1' AND '$search_date2'  "; }
?>


<div class="content sub01">
  <div class="ct_wrap">
    <?php include "../layout/nav2.php" ?>
    <div class="container_ct">

      <div class="container sub1">
        <div class="sub_plate">
          <h3>도면 검색</h3>
          <div class="add_code">
            <form action="<?php echo $_SERVER['PHP_SELF'] . '?search_ho=' . $search_ho . '&search_por=' . $search_por . '&search_date1=' . $search_date1 . '&search_date2=' . $search_date2; ?>" method="get">
                <table>
                    <tr>
                        <td>호선</td>
                        <td><input type="text" name="search_ho" placeholder="호선 입력해주세요." value="<?php echo $search_ho ?>" ></td>
                        <td>POR</td>
                        <td><input type="text" name="search_por" placeholder="POR을 입력해주세요." value="<?php echo $search_por ?>" ></td>
                        <td>등록일</td>
                        <td>
                            <input type="date" name="search_date1" value="<?php echo $search_date1; ?>" >~
                            <input type="date" name="search_date2" value="<?php echo $search_date2; ?>">
                        </td>
                        <td><input type="submit" onclick="logData(this, '가공/생산 지시서 조회', '<?php echo substr(date('Y-m-d h:i:s.u'), 0, 21); ?>', '<?php echo $_COOKIE['HPID']; ?>');" value="검색"></td>
                    </tr>
                </table>  
            </form>
          </div>
        </div>
      </div>

      <div class="container sub01">
        <div class="sub_plate">
          <h3>도면 리스트</h3>
        
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
                  <td>PDF 도면</td>
                  <td>처리</td>
                </tr>
              </thead>

              <tbody>
                <?php
                  $i = 0;
                  $page_search = "&search_ho=" . $search_ho . "&search_por=" . "$search_por" . "&search_date1=" . $search_date1 . "&search_date2=" . $search_date2;
                  $page_query = "SELECT * FROM hj_draw WHERE STAT = '생산대기' $search_str ORDER BY no DESC";
                  
                  //************************************** 2022.09.02. KHO. 페이지 수 계산 **************************************//
                  // 1. 반드시 아래 SELECT 쿼리 문에 LIMIT $page_start, $list를 추가해야 함!!!
                  include "../include/lib/pagination/pagination3.php";
                  //************************************************************************************************************//

                  $select_query = "SELECT * FROM hj_draw WHERE STAT = '생산대기' $search_str ORDER BY no DESC LIMIT $page_start, $list ";

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
                    <form action="/hj/include/query.php" method="post" enctype="multipart/form-data">
                        <input type="file" name="draw_file2"">
                        <input type="hidden" name="draw_ho" value="<?php echo $ho; ?>">
                        <input type="hidden" name="draw_por" value="<?php echo $por ?>">
                        <input type="submit" onclick="logData(this, '도면 등록', '<?php echo substr(date('Y-m-d h:i:s.u'), 0, 21); ?>', '<?php echo $_COOKIE['HPID']; ?>');" value="도면 등록">
                        <?php if($draw_file != '' OR $draw_file != null) { ?>
                        <input type="button" onclick="show_draw('<?php echo $ho; ?>', '<?php echo $por; ?>', '<?php echo base64_encode($draw_file); ?>'); logData(this, '도면 조회', '<?php echo substr(date('Y-m-d h:i:s.u'), 0, 21); ?>', '<?php echo $_COOKIE['HPID']; ?>');" value="도면 조회(<?php echo $draw_file != null ? $draw_file : "미등록"; ?>)" >
                        <?php } ?>
                    </form>
                  </td>
                  <td>
                    <input type="button" onclick="draw_delete(this); logData(this, '도면 삭제', '<?php echo substr(date('Y-m-d h:i:s.u'), 0, 21); ?>', '<?php echo $_COOKIE['HPID']; ?>');" value="도면 삭제">
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
