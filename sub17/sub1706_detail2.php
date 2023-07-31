<!-- header -->
<?php include "../layout/header.php"; ?>
<?php include '../include/dbcon.php'; ?>
<?php $_SESSION['NAV'] = 'mes5_4'; ?>
<!-- //header -->

<div class="content mes5_4">
  <div class="ct_wrap">
    <?php include "../layout/nav2.php" ?>
    <div class="container_ct">
      <div class="container mes5_4">

        <div class="sub_plate">
          <h2>공지사항</h2>
            <div class="write_post">
              <button onclick = "notice_delete(this)">삭제</button>
            </div>
            <div class="notice_read">
              <table>
                <?php
                  $no = $_GET['no'];
                  $select_query = "SELECT * FROM hj_notice WHERE no = '$no' ";
                  $select_result = mysqli_query($conn, $select_query);
                  $row = mysqli_fetch_assoc($select_result);
                    $title = $row['title'];
                    $writer = $row['writer'];
                    $text = $row['text'];
                ?>
                <tr>
                  <th>NO</th>
                  <td><?php echo $no; ?></td>
                  <input type="hidden" name="no" value="<?php echo $no; ?>">
                  <th>제목</th>
                  <td colspan="3">
                    <input type="text" name="title" Value="<?php echo $title; ?>">
                  </td>
                  <th>작성자</th>
                  <td colspan="3">
                    <input type="text" name="writer" Value="<?php echo $writer; ?>">
                  </td>
                </tr>
                <tr>
                  <th>내용</th>
                    <td colspan="7">
                      <input type="text" name="text" class="n_ct" Value="<?php echo $text; ?>" >
                    </td>
                  </td>
                </tr>
              </table>
              <div class="n_ft">
                <!-- <button onclick="notice_update(this); location.href='sub6_3.php'">수정</a> -->
                <button onclick="notice_update(this)">수정</a>
                <button onclick="location.href='sub1706.php'" >뒤로가기</a>
              </div>
            </div>
      </div>
    </div>
  </div>
</div>

<?php include "../layout/footer.php"; ?>
<!-- <script type="text/javascript" src="/jd/include/js/script.js"></script> -->
