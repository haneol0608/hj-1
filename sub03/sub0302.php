<?php include "../layout/header.php"; ?>
<?php include '../include/dbcon.php'; ?>
<?php $_SESSION['STAT'] = '물량 산출'; ?>
<?php $_SESSION['NAV'] = 'sub3' ?>

<!-------------------------------2023-06-28. 김한얼 팀장. 로딩중 추가------------------------------->
<?php include "../include/lib/loading/loading.php"; ?>
<!------------------------------------------------------------------------------------------------->

<!-------------------------------2023-06-28. 김한얼 팀장. 검색 이벤트 추가------------------------------->
<?php include "../include/lib/search/search.php"; ?>
<!----------------------------------------------------------------------------------------------------->

<div id="show" class="content sub0302">
    <div class="ct_wrap">
        <?php include "../layout/nav2.php"; ?>

        <div class="container_ct">
            <?php include "product_menu.php"; ?>
            
            <div class="container sub0302">

                <div class="sub_plate">
                    <h3>절단치수 검색</h3>
                    <div class="search_div">
                        <form action="<?php echo $_SERVER['PHP_SELF'] . $search_url; ?>">
                            <table>
                                <caption>
                                    <input type="submit" value="검색">
                                </caption>
                                <tr>
                                    <td>호선</td>
                                    <td><input name="s_ho" type="text" value="<?php echo $s_ho; ?>"></td>
                                    <td>POR</td>
                                    <td><input name="s_por" type="text" value="<?php echo $s_por; ?>"></td>
                                </tr>

                                <tr>
                                    <td>LOT 번호</td>
                                    <td><input name="s_lot" type="text" value="<?php echo $s_lot; ?>"></td>
                                    <td>Type</td>
                                    <td>
                                        <select name="s_type">
                                            <option value=""></option>
                                            <?php 
                                                $select_type_query = "SELECT type FROM hj_cut_all GROUP BY type";
                                                $select_type_result = mysqli_query($conn, $select_type_query);
                                                while($type_row = mysqli_fetch_assoc($select_type_result)) {
                                                    $show_type = $type_row['type'];
                                            ?>
                                            <option <?php if($show_type == $s_type) echo "selected"; ?> value="<?php echo $show_type; ?>"><?php echo $show_type; ?></option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td>재질</td>
                                    <td><input name="s_material" type="text" value="<?php echo $s_material; ?>"></td>
                                    <td>두께</td>
                                    <td>
                                        <input name="s_thick1" type="text" value="<?php echo $s_thick1; ?>"> ~ <input name="s_thick2" type="text" value="<?php echo $s_thick2; ?>">
                                    </td>
                                </tr>

                                <tr>
                                    <td>길이</td>
                                    <td>
                                        <input name="s_length1" type="text" value="<?php echo $s_length1; ?>"> ~ <input name="s_length2" type="text" value="<?php echo $s_length2; ?>">
                                    </td>
                                    <td>절단치수</td>
                                    <td><input type="text"></td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>

                <div class="sub_plate">
                    <div class="head_div">
                        <h3>물량산출 리스트</h3>
                        <div class="input_div">
                            <input type="button" onclick="cut_back();" value="절단치수 이전">
                            <input type="button" onclick="nc_insert();" value="NC절단 등록">
                        </div>
                    </div>

                    <div class="body_div">
                        <table>
                            <thead>
                                <tr>
                                    <td>
                                        <input type="checkbox">
                                    </td>
                                    <td>호선</td>
                                    <td>POR</td>
                                    <td>LOT번호</td>
                                    <td>Type</td>
                                    <td>재질</td>
                                    <td>두께</td>
                                    <td>길이</td>
                                    <td>절단치수</td>
                                    <td>물량 등록자</td>
                                    <td>물량 등록일</td>
                                    <td>절단 수량</td>
                                    <td>절단 길이</td>
                                    <td>남은 길이</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $select_query = "SELECT * FROM hj_cut_all $search_str AND stat = '물량' ";
                                    $select_result = mysqli_query($conn, $select_query);
                                    while($row = mysqli_fetch_assoc($select_result)) {
                                        $no = $row['no'];
                                        $ho = $row['ho'];
                                        $por = $row['por'];
                                        $lot = $row['lot'];
                                        $type = $row['type'];
                                        $material = $row['material'];
                                        $thick = $row['thick'];
                                        $length = $row['length'];
                                        $cut_size = $row['cut_size'];
                                        $quan_name = $row['quan_name'];
                                        $quan_date = $row['quan_date'];
                                ?>
                                <tr onchange="resting(this, <?php echo $length; ?>);">
                                    <td>
                                        <input name="no[]" type="checkbox" value="<?php echo $no; ?>">
                                    </td>
                                    <td><?php echo $ho; ?></td>
                                    <td><?php echo $por; ?></td>
                                    <td><?php echo $lot; ?></td>
                                    <td><?php echo $type; ?></td>
                                    <td><?php echo $material; ?></td>
                                    <td><?php echo $thick; ?></td>
                                    <td><?php echo $length; ?></td>
                                    <td><?php echo nl2br($cut_size); ?></td>
                                    <td><?php echo $quan_name; ?></td>
                                    <td><?php echo $quan_date; ?></td>
                                    <td>
                                        <input name="cut_count" type="text">
                                    </td>
                                    <td>
                                        <input name="cut_length" type="text">
                                    </td>
                                    <td id="show_span">
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