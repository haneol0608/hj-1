<!-- header -->
<?php include "../layout/header.php"; ?>
<?php include '../include/dbcon.php'; ?>
<?php $_SESSION['NAV'] = 'mes5_4'; ?>
<!-- //header -->
<?php
  $search_str = "WHERE 1 ";

  $s_title = $_GET['s_title'];
  $s_writer = $_GET['s_writer'];
  $s_date1 = $_GET['s_date1'];
  $s_date2 = $_GET['s_date2'];
  $date = date('Y-m-d');

  if($s_title) { 
    $search_str .= " AND title LIKE '%$s_title%' "; 
  }
  if($s_writer) { 
    $search_str .= " AND writer LIKE '%$s_writer%' "; 
  }
  if($s_date1 && $s_date2) { 
    $search_str .= " AND date BETWEEN '$s_date1' AND '$s_date2'"; 
  } else {
    if($s_date1 && !$s_date2){
        $search_str .= " AND date BETWEEN '$s_date1' AND '$date'"; 
    }
  }
  

?>
<div class="content mes5_4">
  <div class="ct_wrap">
    <?php include "../layout/nav2.php" ?>
    <div class="container_ct">
      <div class="container mes5_4">

        <!--***************** 20232-03-28. 김한얼 팀장. 시정조치 보완요청 사항 반엉 *****************-->
        <div class="sub_plate">
            <h3>공지사항 검색</h3>
            <form action="<?php echo $_SERVER['PHP_SELF'] . '?s_title=' . $s_title . '&s_writer=' . $s_writer . '&s_date1=' . $s_date1 . '&s_date2=' . $s_date2; ?>">
                <table>
                    <tr>
                        <td>글제목</td>
                        <td><input style="width: 90%;" type="text" name="s_title" placeholder="(검색어)글제목" value="<?php echo $s_title; ?>"></td>
                        <td>작성자</td>
                        <td><input type="text" name="s_writer" placeholder="(검색어)작성자" value="<?php echo $s_writer; ?>"></td>
                        <td>작성일</td>
                        <td>
                            <input type="date" name="s_date1" value="<?php echo $s_date1; ?>">~
                            <input type="date" name="s_date2" value="<?php echo $s_date2; ?>">
                        </td>
                        <td rowspan="2"><input style="width: 100%; height: 50px;" type="submit" value="검색"></td>
                    </tr>
                </table>
            </form>
        </div>
        <!-- ************************************************************************************ -->

        <div class="sub_plate">
          <h2>공지사항</h2>
          <div class="write_post">
            <button onclick = "location.href='sub1706_detail.php' ">게시물작성</button>
          </div>
          
          <div class="notice">
            <?php
              $select_query = "SELECT * FROM sbl_table WHERE ok = 'Y' ";
              $select_result = mysqli_query($conn, $select_query);
              $row = mysqli_fetch_assoc($select_result);
              $style = $row['style'];
            ?>
            <table class="<?php echo $style; ?>">
              <thead>
                <tr>
                  <th>순차</th>
                  <th>글제목</th>
                  <th>작성자</th>
                  <th>작성일</th>
                </tr>
              </thead>
              <tbody>
                <?php
                    $i = 0;
                    $select_query = "SELECT * FROM hj_notice $search_str";
                    $select_result = mysqli_query($conn, $select_query);
                    while($row = mysqli_fetch_assoc($select_result)) {
                        $i++;
                        $no = $row['no'];
                        $title = $row['title'];
                        $writer = $row['writer'];  
                        $date = $row['date'];              
                ?>
                <tr>
                  <td><?php echo $i; ?></td>
                  <td>
                    <a href="sub1706_detail2.php?no=<?php echo $no; ?>"><?php echo $title; ?></a>
                  </td>
                  <td><?php echo $writer; ?></td>
                  <td><?php echo $date; ?></td>
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
<!-- <script type="text/javascript" src="/jd/include/js/script.js"></script> -->
