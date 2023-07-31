<?php include "dbcon.php"; ?>
<?php header("Content-Type:text/html;charset=utf-8"); ?>
<?php
    include_once 'lib/PHPExcel.php';
    require_once("lib/PHPExcel/IOFactory.php");
    require_once("lib/PHPExcel/Reader/Excel2007.php");
?>

<?php
//************************************************ 2023-06-28. 김한얼 팀장. 절단대기 업로드  ************************************************//
if(isset($_FILES['cut_file'])) {
    $file = $_FILES['cut_file'];

    $file_name = $file['name']; // 파일 명
    $file_size = $file['size']; // 파일 사이즈
    $file_type = $file['type']; // 파일 타입
    $tmp_name = $file['tmp_name']; // 파일 tmp name;
    $dataFile = "../sub03/cut_folder/" . $file_name;

    move_uploaded_file($tmp_name, $dataFile);

    $fh = fopen($dataFile, 'r'); // 파일 열기
    $theData = fread($fh, filesize($dataFile)); // fread(fopen()함수로 생성한 파일, 파일 크기) - 파일 읽기
    $datalinearr = explode(chr(13), $theData); // explode(분할 조건, 입력문자) - 문자열 분할
    $linecnt = count($datalinearr); // count() - 데이터 갯수 세기

    $objReader = PHPExcel_IOFactory::createReaderForFile($dataFile); // 업로드된 엑셀 형식에 맞는 Reader 객체를 생성
    $objReader->setReadDataOnly(true); // 읽기 전용으로 설정
    $objExcel = $objReader->load($dataFile); // 엑셀 파일 읽기
    $objExcel->setActiveSheetIndex(0); // 첫번째 시트 선택

    $objWorksheet = $objExcel->getActiveSheet(0); // 첫번째 시트 가져오기
    $rowIterator = $objWorksheet->getRowIterator();

    foreach ($rowIterator as $row) {
        $cellIterator = $row->getCellIterator();
        $cellIterator->setIterateOnlyExistingCells(false);
    }

    $highestRow = $objWorksheet->getHighestRow(); // 최대행을 변수화
    $highestColumn = $objWorksheet->getHighestColumn(); // 최대열을 변수화
    $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);

    if($highestRow) {
        for($row = 4; $row <= $highestRow; $row++) {
            $ho = $objWorksheet->getCell("A" . $row)->getValue();
            $por = $objWorksheet->getCell("B" . $row)->getValue();
            $lot = $objWorksheet->getCell("C" . $row)->getValue();
            $type = $objWorksheet->getCell("D" . $row)->getValue();
            $material = $objWorksheet->getCell("E" . $row)->getValue();
            $thick = $objWorksheet->getCell("F" . $row)->getValue();
            $length = $objWorksheet->getCell("G" . $row)->getValue();
            $cut_size = $objWorksheet->getCell("H" . $row)->getValue();

            $insert_query = "INSERT INTO hj_cut_all (ho, por, lot, type, material, thick, length, cut_size, stat) ";
            $insert_query .= "VALUES ($ho, '$por', '$lot', '$type', '$material', $thick, $length, '$cut_size', '대기') ";

            $insert_result = mysqli_query($conn, $insert_query);
            if(!$insert_result) {
                // die("절단대기 등록 오류......." . mysqli_error($conn));
                // die("정보 수정오류 발생!!(관리자에게 문의해주세요!!)");
            } else {
                echo "<script>
                    alert('절단대기 리스트 업로드 완료!!');
                    location.replace('/hj/sub03/sub0301_upload.php');
                </script>";
            }
        }
    }
}
//*******************************************************************************************************************************//

//************************************** 2023-06-28. 김한얼 팀장. 절단대기 -> 등록  **************************************//
if(isset($_POST['cut_insert'])) {
    $no = json_decode($_POST['cut_no']);
    
    for($i = 0; $i < count($no); $i++) {
        $update_query = "UPDATE hj_cut_all SET ";
        $update_query .= "stat = '등록' ";
        $update_query .= "WHERE no = '$no[$i]' ";

        $update_result = mysqli_query($conn, $update_query);
        if(!$update_result) {
            // die("절단등록 오류...." . mysqli_error($conn));
            die("절단등록 오류발생!!(관리자에게 문의해주세요!!)");
        } else {
            echo "절단등록 완료!!";
        }
    }
    
}
//*****************************************************************************************************************************//

//************************************** 2023-06-28. 김한얼 팀장. 절단대기 삭제  **************************************//
if(isset($_POST['cut_delete'])) {
    $no = json_decode($_POST['cut_delNo']);
    
    for($i = 0; $i < count($no); $i++) {
        $delete_query = "DELETE FROM hj_cut_all WHERE no = '$no[$i]' ";

        $delete_result = mysqli_query($conn, $delete_query);
        if(!$delete_result) {
            // die("절단등록 오류...." . mysqli_error($conn));
            die("절단삭제 오류발생!!(관리자에게 문의해주세요!!)");
        } else {
            echo "절단삭제 완료";
        }
    }
    
}
//*****************************************************************************************************************************//

//************************************** 2023-06-28. 김한얼 팀장. 절단등록 -> 물량산출  **************************************//
if(isset($_POST['quantity_ok'])) {
    $no = json_decode($_POST['quantity_okNo']);
    $name = $_COOKIE['HPNAME'];
    $date = date("Y-m-d h:i:s");

    for($i = 0; $i < count($no); $i++) {
        $update_query = "UPDATE hj_cut_all SET ";
        $update_query .= "stat = '물량', ";
        $update_query .= "quan_name = '$name', ";
        $update_query .= "quan_date = '$date' ";
        $update_query .= "WHERE no = '$no[$i]' ";

        $update_result = mysqli_query($conn, $update_query);
        if(!$update_result) {
            // die("절단등록 오류...." . mysqli_error($conn));
            die("물량등록 오류발생!!(관리자에게 문의해주세요!!)");
        } else {
            echo "물량등록 완료!!";
        }
    }
}
//*****************************************************************************************************************************//

//************************************** 2023-06-28. 김한얼 팀장. 물량산출 -> 절단이전 **************************************//
if(isset($_POST['cut_back'])) {
    $no = json_decode($_POST['cutBack_no']);

    for($i = 0; $i < count($no); $i++) {
        $update_query = "UPDATE hj_cut_all SET ";
        $update_query .= "stat = '등록' ";
        $update_query .= "WHERE no = '$no[$i]' ";

        $update_result = mysqli_query($conn, $update_query);
        if(!$update_result) {
            // die("절단등록 오류...." . mysqli_error($conn));
            die("절단이전 오류발생!!(관리자에게 문의해주세요!!)");
        } else {
            echo "절단이전 완료!!";
        }
    }
}
//*****************************************************************************************************************************//

?>