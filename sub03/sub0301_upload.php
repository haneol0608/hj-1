<!DOCTYPE html>
<html lang="ko">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="/hj/include/css/reset.css">
        <link rel="stylesheet" href="/hj/include/css/style.css">
        <link rel="stylesheet" href="/hj/include/css/style_mes.css">
        <link rel="stylesheet" href="/hj/include/css/lightgallery.css">
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="/hj/include/js/script.js"></script>
        <script src="lib/fulcalendar/main.js"></script>
        <script type="text/javascript" src="/hj/include/js/common.js"></script>
        <link rel="stylesheet" href="lib/fulcalendar/main.css">
        <?php include '../include/dbcon.php'; ?>

        <title>절단대기 목록</title>
    </head>
<!-------------------------------2023-06-28. 김한얼 팀장. 로딩중 추가------------------------------->
<?php include "../include/lib/loading/loading.php"; ?>
<!------------------------------------------------------------------------------------------------->
    <body>
        <div class="popup_div">
            <div class="close_div">
                <input type="button" onclick="window.close();" value="닫기">
            </div>

            <div class="sub_plate">
                <div>
                    <h3>절단대기 등록</h3>
                    <form action="/hj/include/query3.php" method="post" enctype="multipart/form-data">
                        <input type="file" name="cut_file">
                        <input type="submit" value="절단치수 업로드">
                    </form>
                </div>
            </div>

            <div class="sub_plate">
                <div class="head_div">
                    <h3>절단대기 리스트</h3>
                    <div class="input_div">
                        <input type="button" onclick="cut_insert();" value="절단치수 등록">
                        <input type="button" onclick="cut_delete();" value="절단치수 삭제">
                    </div>
                </div>
                <div class="drawing_table">
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
                            </tr>
                        </thead>

                        <tbody>
                            <?php 
                                $select_query = "SELECT * FROM hj_cut_all WHERE stat = '대기' ";
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
                            ?>
                            <tr>
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
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </body>
    <script src="js/script.js"></script>
</html>
