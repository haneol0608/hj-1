<?php include "../layout/header.php"; ?>
<?php include '../include/dbcon.php'; ?>
<?php $_SESSION['NAV'] = 'mes5_2'; ?>

<div class="content sub03">
  <div class="ct_wrap">
    <?php include "../layout/nav2.php" ?>
    <div class="container_ct">
      <div class="container sub03">
        <div class="sub_plate">
          <h1 class="tb_h1">테이블 스타일 설정</h1>
          <p class="tb_p">※일부 적용 안되는 테이블도 있습니다.</p>
          <div class="setting">
            <div class="style1">
              <!-- <a href="#"><h3>style.1</h3></a> -->
              <input type="hidden" name="tb_style1_click" value="tb_style1">
              <input type="button" onclick="tb_style_1(this)" value="style.1">
              <table class="tb_style1">
                <thead>
                  <tr>
                    <th></th>
                    <th>1</th>
                    <th>2</th>
                    <th>3</th>
                    <th>ect</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>text</td>
                    <td>text</td>
                    <td>text</td>
                    <td>text</td>
                    <td>text</td>
                  </tr>
                  <tr>
                    <td>text</td>
                    <td>text</td>
                    <td>text</td>
                    <td>text</td>
                    <td>text</td>
                  </tr>
                  <tr>
                    <td>text</td>
                    <td>text</td>
                    <td>text</td>
                    <td>text</td>
                    <td>text</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="style2">
              <input type="hidden" name="tb_style1_click" value="tb_style2">
              <input type="button" onclick="tb_style_1(this)" value="style.2">
              <table class="tb_style2">
                <thead>
                  <tr>
                    <th></th>
                    <th>1</th>
                    <th>2</th>
                    <th>3</th>
                    <th>ect</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>text</td>
                    <td>text</td>
                    <td>text</td>
                    <td>text</td>
                    <td>text</td>
                  </tr>
                  <tr>
                    <td>text</td>
                    <td>text</td>
                    <td>text</td>
                    <td>text</td>
                    <td>text</td>
                  </tr>
                  <tr>
                    <td>text</td>
                    <td>text</td>
                    <td>text</td>
                    <td>text</td>
                    <td>text</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="style3">
              <input type="hidden" name="tb_style1_click" value="tb_style3">
              <input type="button" onclick="tb_style_1(this)" value="style.3">
              <table class="tb_style3">
                <thead>
                  <tr>
                    <th></th>
                    <th>1</th>
                    <th>2</th>
                    <th>3</th>
                    <th>ect</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>text</td>
                    <td>text</td>
                    <td>text</td>
                    <td>text</td>
                    <td>text</td>
                  </tr>
                  <tr>
                    <td>text</td>
                    <td>text</td>
                    <td>text</td>
                    <td>text</td>
                    <td>text</td>
                  </tr>
                  <tr>
                    <td>text</td>
                    <td>text</td>
                    <td>text</td>
                    <td>text</td>
                    <td>text</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="style4">
              <input type="hidden" name="tb_style1_click" value="tb_style4">
              <input type="button" onclick="tb_style_1(this)" value="style.4">
              <table class="tb_style4">
                <thead>
                  <tr>
                    <th></th>
                    <th>1</th>
                    <th>2</th>
                    <th>3</th>
                    <th>ect</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>text</td>
                    <td>text</td>
                    <td>text</td>
                    <td>text</td>
                    <td>text</td>
                  </tr>
                  <tr>
                    <td>text</td>
                    <td>text</td>
                    <td>text</td>
                    <td>text</td>
                    <td>text</td>
                  </tr>
                  <tr>
                    <td>text</td>
                    <td>text</td>
                    <td>text</td>
                    <td>text</td>
                    <td>text</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="now_tb">
            <h1 class="tb_h1">현재 적용된 스타일</h1>
            <div class="setting">
            <?php
              $select_table_query = "SELECT * FROM hj_table WHERE ok = 'Y' ";
              $select_table_result = mysqli_query($conn, $select_table_query);
              $table_row = mysqli_fetch_assoc($select_table_result);
              $style = $table_row['style'];
            ?>
            <table class="<?php echo $style; ?>">
              <thead>
                <tr>
                  <th></th>
                  <th>1</th>
                  <th>2</th>
                  <th>3</th>
                  <th>ect</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>text</td>
                  <td>text</td>
                  <td>text</td>
                  <td>text</td>
                  <td>text</td>
                </tr>
                <tr>
                  <td>text</td>
                  <td>text</td>
                  <td>text</td>
                  <td>text</td>
                  <td>text</td>
                </tr>
                <tr>
                  <td>text</td>
                  <td>text</td>
                  <td>text</td>
                  <td>text</td>
                  <td>text</td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- <div class="setting">
            <div class="style1">
              <a href="#"><h3>style.1</h3></a>
              <img src="/gwang/images/style1.png" alt="style3">
            </div>
            <div class="style2">
              <a href="#"><h3>style.2</h3></a>
              <img src="/gwang/images/style2.png" alt="style3">
            </div>
            <div class="style3">
              <a href="#"><h3>style.3</h3></a>
              <img src="/gwang/images/style3.png" alt="style3">
            </div>
            <div class="style4">
              <a href="#"><h3>style.4</h3></a>
              <img src="/gwang/images/style4.png" alt="style3">
            </div>
          </div> -->
        </div>

        </div>
      </div>
    </div>
  </div>
</div>


<?php include "../layout/footer.php"; ?>
