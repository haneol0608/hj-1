<?php include "../layout/header.php"; ?>
<?php include '../include/dbcon.php'; ?>
<?php $_SESSION['STAT'] = '용접'; ?>
<?php $_SESSION['NAV'] = 'sub4'; ?>

<div class="content sub05">
    <div class="ct_wrap">
        <?php include "../layout/nav2.php" ?>
        <div class="container_ct">
            <div class="container sub0504">
                <?php include 'product_menu.php'; ?>
                <div class="sub_plate">
                    <h3>용접자재 검색</h3>
                    <div class="search_box">

                        <form action="<?php echo $_SERVER['PHP_SELF'] . '?search_type=' . $search_type . '&search=' . $search ?>" method="get">
                            <input type="text" name="search" placeholder="검색어를 입력해주세요." value="<?php echo $search ?>" >
                            <select name="search_type">
                                <option value="DRAW_NO">도면ID</option>
                                <option value="DRAW_SUB_NO">가공지시도면ID</option>
                            </select>
                            <input type="submit" value="검색">
                        </form>
                    </div>
                </div>
                <div class="sub_plate">
                    <h3>용접자재 리스트</h3>
                    <div class="drawing_table">
                        <table>
                            <thead>
                                <tr>
                                    <td>도면ID</td>
                                    <td>호선</td>
                                    <td>POR</td>
                                    <td>SEQ</td>
                                    <td>수량</td>
                                    <td>중량</td>
                                    <td>금액</td>
                                    <td>제작납기</td>
                                    <td>MP납기</td>
                                    <td>시리즈</td>
                                    <td>사상</td>
                                    <td>PAINT</td>
                                    <td>특수자재</td>
                                    <td>처리</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $search_type = $_GET['search_type'];
                                    $search = $_GET['search'];

                                    //************************************** 2022.09.02. KHO. 페이지 수 계산 **************************************//
                                    // 1. 반드시 아래 SELECT 쿼리 문에 LIMIT $page_start, $list를 추가해야 함!!!
                                    // include "../include/lib/pagination/pagination.php";
                                    //************************************************************************************************************//
                                    $i = 0;
                                    if($search_type && $search) {
                                    $select_query = "SELECT * FROM hj_pro WHERE $search_type LIKE '%$search%' AND STAT = '용접' ";
                                    } else {
                                    $select_query = "SELECT * FROM hj_pro WHERE STAT = '용접' ORDER BY no DESC ";
                                    }
                                    $select_result = mysqli_query($conn, $select_query);
                                    while($row = mysqli_fetch_assoc($select_result)) {
                                    $i++;
                                    $no = htmlspecialchars($row['no']);
                                    $por = htmlspecialchars($row['por']);
                                    $ho = htmlspecialchars($row['ho']);
                                    $por_no = $ho . $por;
                                    $seq = htmlspecialchars($row['seq']);
                                    $count = htmlspecialchars($row['count']);
                                    $weight = htmlspecialchars($row['weight']);
                                    $price = htmlspecialchars($row['price']);
                                    $pro_period = htmlspecialchars($row['pro_period']);
                                    $mp_period = htmlspecialchars($row['mp_period']);
                                    $series = htmlspecialchars($row['series']);
                                    $finish = htmlspecialchars($row['finish']);
                                    $paint = htmlspecialchars($row['paint']);
                                    $sp_material = htmlspecialchars($row['sp_material']);
                                ?>
                                <tr>
                                    <td>
                                    <?php echo $i; ?>
                                    <input type="hidden" name="pro_no" value="<?php echo $no; ?>">
                                    </td>
                                    <td><?php echo $por; ?></td>
                                    <td><?php echo $ho; ?></td>
                                    <td><?php echo $seq; ?></td>
                                    <td><?php echo $count; ?></td>
                                    <td><?php echo $weight; ?></td>
                                    <td><?php echo $price; ?></td>
                                    <td><?php echo $pro_period; ?></td>
                                    <td><?php echo $mp_period; ?></td>
                                    <td><?php echo $series; ?></td>
                                    <td><?php echo $finish; ?></td>
                                    <td><?php echo $paint; ?></td>
                                    <td><?php echo $sp_material; ?></td>
                                    <td>
                                    <input type="button" onclick="pre_pro_3(this)" value="취부">
                                    <input type="button" onclick="next_pro_4(this)" value="사상">
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
