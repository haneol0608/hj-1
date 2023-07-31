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
          <div class="notice_write">
              <table>
                <tr>
                  <th>제목</th>
                  <td colspan="1">
                    <input type="text" name="title" placeholder="제목">
                  </td>
                  <th>작성자</th>
                  <td colspan="3">
                    <input type="text" name="writer" placeholder="작성자" value="<?php echo $_COOKIE['HPNAME'] ?>">
                  </td>
                </tr>
                <tr>
                  <th>내용</th>
                  <td colspan="5">
                    <input type="text" name="text" class="n_ct" placeholder="내용">
                  </td>
                </tr>
              </table>
              <div class="n_ft">
                <button onclick="notice_add(this)" >저장</a>
                <button onclick="location.href='sub1706.php'" >취소</a>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include "../layout/footer.php"; ?>
<!-- <script type="text/javascript" src="/jd/include/js/script.js"></script> -->
