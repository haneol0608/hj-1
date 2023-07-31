<?php include "dbcon.php"; ?>
<?php header("Content-Type:text/html;charset=utf-8"); ?>
<?php
    // include_once 'lib/PHPExcel.php';
    // require_once("lib/PHPExcel/IOFactory.php");
    // require_once("lib/PHPExcel/Reader/Excel2007.php");
?>

<?php 
//**************************************이력 관리 - 사용이력 등록**************************************//

if(isset($_POST['log_insert'])) {
    $ho = $_POST['ho'];
    $por = $_POST['por'];
    $seq = $_POST['seq'];

    $qt_no = $_POST['qt_no'];

    $url = $_POST['url'];

    $id = $_POST['id'];

    $name = $_POST['name'];

    $func = $_POST['func'];

    $date = date("Y-m-d h:i:s");



    $insert_query = "INSERT INTO hj_log SET ";

    $insert_query .= "ho = '$ho', ";

    $insert_query .= "por = '$por', ";

    

    if($seq == null or $seq == '') {

        $insert_query .= "seq = NULL, ";

    } else {

        $insert_query .= "seq = '$seq', ";

    }



    if($qt_no == null or $qt_no == '') {

        $insert_query .= "qt_no = NULL, ";

    } else {

        $insert_query .= "qt_no = '$qt_no', ";

    }



    if($url == '' or $url == null) {

        

    } else {

        $insert_query .= "url = '$url', ";

        $insert_query .= "id = '$id', ";

        $insert_query .= "name = '$name', ";

        $insert_query .= "func = '$func', ";

        $insert_query .= "date = '$date' ";



        $insert_result = mysqli_query($conn, $insert_query);

        if(!$insert_result) {

            die("이력 등록 오류....." . mysqli_error($conn));

        }

    }



    

}

//*******************************************************************************************************//



//**************************************수주 관리 - 리스트 등록**************************************//

if(isset($_FILES['draw_file'])) {

  $POR_NO = $_FILES['draw_file'];



  $file_name = $POR_NO['name']; // 파일 명

  $file_size = $POR_NO['size']; // 파일 사이즈

  $file_type = $POR_NO['type']; // 파일 타입

  $tmp_name = $POR_NO['tmp_name']; // 파일 tmp name;

  // print_r($file_name) . '<br>';



  for($i = 0; $i < count($file_name); $i++) {

    // $dataFile = "../sub01/draw_folder/" . $file_name[$i];



    // move_uploaded_file($tmp_name[$i], $dataFile);



    $ho = substr($file_name[$i], 0, 4);

    $por = substr($file_name[$i], 4, 3);

    $upload_day = date("Y-m-d");

    

    $insert_query = "INSERT INTO hj_draw SET ";

    $insert_query .= "ho = '$ho', ";

    $insert_query .= "por = '$por', ";

    $insert_query .= "file_name = '$file_name[$i]', ";

    $insert_query .= "upload_day = '$upload_day' ";

    

    $insert_result = mysqli_query($conn, $insert_query);

    if(!$insert_result) {

      die("리스트 등록 에러....." . mysqli_error($conn));

    }



  }



  echo "<script>

    alert('리스트 등록를 완료했습니다.');

    location.replace('/hj/sub02/sub0201.php');

  </script>";

}

//*******************************************************************************************************//



//**************************************수주 상세 - 컷팅지 등록**************************************//

if(isset($_FILES['cutting_file'])) {

  $file = $_FILES['cutting_file'];

  $cutting_por = $_POST['cutting_por'];

  $cutting_ho = $_POST['cutting_ho'];



  $file_name = $file['name']; // 파일 명

  $file_size = $file['size']; // 파일 사이즈

  $file_type = $file['type']; // 파일 타입

  $tmp_name = $file['tmp_name']; // 파일 tmp name;

  $dataFile = "../sub01/cut_folder/" . $file_name;



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



    for($row = 3; $row <= $highestRow; $row++) {

      $por = $cutting_por;

      $ho = $cutting_ho;

      $seq = $objWorksheet->getCell("B" . $row)->getValue();



      if($seq == null) {

        break;

      }



      // 1. 엑셀 데이터 가져오기

      // echo "A".$row . "<br>";

      $lap = $objWorksheet->getCell("A" . $row)->getValue();

      $count = $objWorksheet->getCell("C" . $row)->getValue();

      $weight = $objWorksheet->getCell("D" . $row)->getValue();

      $fr_one = $objWorksheet->getCell("E" . $row)->getValue();

      $fr_two = $objWorksheet->getCell("F" . $row)->getValue();

      $fr_three = $objWorksheet->getCell("G" . $row)->getValue();

      $fr_four = $objWorksheet->getCell("H" . $row)->getValue();

      $fr_five = $objWorksheet->getCell("I" . $row)->getValue();

      $leg1_one = $objWorksheet->getCell("J" . $row)->getValue();

      $leg1_two = $objWorksheet->getCell("K" . $row)->getValue();

      $leg1_three = $objWorksheet->getCell("L" . $row)->getValue();

      $leg1_four = $objWorksheet->getCell("M" . $row)->getValue();

      $leg1_five = $objWorksheet->getCell("N" . $row)->getValue();

      $leg2_one = $objWorksheet->getCell("O" . $row)->getValue();

      $leg2_two = $objWorksheet->getCell("P" . $row)->getValue();

      $leg2_three = $objWorksheet->getCell("Q" . $row)->getValue();

      $leg2_four = $objWorksheet->getCell("R" . $row)->getValue();

      $leg2_five = $objWorksheet->getCell("S" . $row)->getValue();

      $pad_one = $objWorksheet->getCell("T" . $row)->getValue();

      $pad_two = $objWorksheet->getCell("U" . $row)->getValue();

      $W = $objWorksheet->getCell("V" . $row)->getValue();

      $P = $objWorksheet->getCell("W" . $row)->getValue();

      $U = $objWorksheet->getCell("X" . $row)->getValue();

      $B = $objWorksheet->getCell("Y" . $row)->getValue();

      $paint = $objWorksheet->getCell("Z" . $row)->getValue();

      $gak_count = $objWorksheet->getCell("AA" . $row)->getValue();

      $RB22 = $objWorksheet->getCell("AB" . $row)->getValue();

      $RB25 = $objWorksheet->getCell("AC" . $row)->getValue();

      $hoop1 = $objWorksheet->getCell("AD" . $row)->getValue();

      $hoop2 = $objWorksheet->getCell("AE" . $row)->getValue();



      // 2. 빈 값 오류 -> 0으로 삼항연산자 치환

      // $pad_one == '' ? $pad_one = 0 : $pad_one;

      // $RB22 == '' ? $RB22 = 0 : $RB22;

      // $RB25 == '' ? $RB25 = 0 : $RB25;

      $hoop1 == '' ? $hoop1 = 0 : $hoop1;

      $hoop2 == '' ? $hoop2 = 0 : $hoop2;

      $count == '' ? $count = 0 : $count;

      $weight == '' ? $weight = 0 : $weight;

      $fr_one == '' ? $fr_one = 0 : $fr_one;

      $fr_five == '' ? $fr_five = 0 : $fr_five;

      $leg2_one == '' ? $leg2_one = 0 : $leg2_one;

      $leg2_five == '' ? $leg2_five = 0 : $leg2_five;

      // $pad_two == '' ? $pad_two = 0 : $pad_two;

      // $W == '' ? $W = 0 : $W;

      // $P == '' ? $P = 0 : $P;

      // $U == '' ? $U = 0 : $U;

      // $B == '' ? $B = 0 : $B;

      // $gak_count == '' ? $gak_count = 0 : $gak_count;

      $leg1_one == '' ? $leg1_one = 0 : $leg1_one;

      $leg1_five == '' ? $leg1_five = 0 : $leg1_five;



      // 3. 쿼리문 적용

      $insert_query = "INSERT INTO hj_lada SET ";

      $insert_query .= "por = '$por', ";

      $insert_query .= "ho = '$ho', ";

      $insert_query .= "seq = '$seq', ";

      $insert_query .= "lap = '$lap', ";

      $insert_query .= "count = '$count', ";

      $insert_query .= "weight = '$weight', ";

      $insert_query .= "fr_one = '$fr_one', ";

      $insert_query .= "fr_two = '$fr_two', ";

      $insert_query .= "fr_three = '$fr_three', ";

      $insert_query .= "fr_four = '$fr_four', ";

      $insert_query .= "fr_five = '$fr_five', ";

      $insert_query .= "leg1_one = '$leg1_one', ";

      $insert_query .= "leg1_two = '$leg1_two', ";

      $insert_query .= "leg1_three = '$leg1_three', ";

      $insert_query .= "leg1_four = '$leg1_four', ";

      $insert_query .= "leg1_five = '$leg1_five', ";

      $insert_query .= "leg2_one = '$leg2_one', ";

      $insert_query .= "leg2_two = '$leg2_two', ";

      $insert_query .= "leg2_three = '$leg2_three', ";

      $insert_query .= "leg2_four = '$leg2_four', ";

      $insert_query .= "leg2_five = '$leg2_five', ";

      $insert_query .= "pad_one = '$pad_one', ";

      $insert_query .= "pad_two = '$pad_two', ";

      $insert_query .= "W = '$W', ";

      $insert_query .= "P = '$P', ";

      $insert_query .= "U = '$U', ";

      $insert_query .= "B = '$B', ";

      $insert_query .= "paint = '$paint', ";

      $insert_query .= "gak_count = '$gak_count', ";

      $insert_query .= "RB22 = '$RB22', ";

      $insert_query .= "RB25 = '$RB25', ";

      $insert_query .= "hoop1 = '$hoop1', ";

      $insert_query .= "hoop2 = '$hoop2' ";

      // echo $insert_query . "<br>";



      $insert_result = mysqli_query($conn, $insert_query);

      if(!$insert_result) {

        die("컷팅지 등록 에러..." . mysqli_error($conn));

      }

      

    }



    echo "<script>

      alert('가공지시를 완료했습니다.');

      location.replace('/hj/sub02/sub0201_detail.php?por_no=$ho$por');

    </script>";

  }



}

//*******************************************************************************************************//



//**************************************수주 상세 - 물량 산출 등록**************************************//

if(isset($_POST['quantity_seq'])) {

  $quantity_ho = $_POST['quantity_ho'];

  $quantity_por = $_POST['quantity_por'];

  $quantity_count = json_decode($_POST['quantity_count']);

  $quantity_seq = json_decode($_POST['quantity_seq']);

  $weight_in = json_decode($_POST['weight_in']);



  $select_query = "SELECT MAX(qt_no * 1) AS MAX_qt_no FROM hj_lada WHERE quantity_ok IS NULL AND qt_no != '긴급' ";

  $select_result = mysqli_query($conn, $select_query);

  $row = mysqli_fetch_assoc($select_result);

  $MAX_qt_no = $row['MAX_qt_no'];



  if($MAX_qt_no === null) {

    $MAX_qt_no = 1;

  } else if($MAX_qt_no !== null) {

    $MAX_qt_no = $MAX_qt_no + 1;

  }



  for($i = 0; $i < count($quantity_seq); $i++) {

    $update_query = "UPDATE hj_lada SET ";

    $update_query .= "qt_no = '$MAX_qt_no' ";

    $update_query .= "WHERE ho = '$quantity_ho' AND por = '$quantity_por' AND seq = '$quantity_seq[$i]' AND (hide_date IS NULL AND hide_name IS NULL) ";



    $update_result = mysqli_query($conn, $update_query);

    if(!$update_result) {

      die("물량 등록 에러..." . mysqli_error($conn));

    }



    //********** 2023-05-09. 김한얼 팀장. 로그 기록 추가(도입기업 데이터 확인 - 05/08 요청사항) **********//

    $id = $_COOKIE['HPID'];

    $name = $_COOKIE['HPNAME'];

    $date = date("Y-m-d h:i:s");



    $logInsert_query = "INSERT INTO hj_log SET ";

    $logInsert_query .= "ho = '$quantity_ho', ";

    $logInsert_query .= "por = '$quantity_por', ";

    $logInsert_query .= "seq = '$quantity_seq[$i]', ";

    $logInsert_query .= "qt_no = NULL, ";

    $logInsert_query .= "id = '$id', ";

    $logInsert_query .= "name = '$name', ";

    $logInsert_query .= "func = '물량산출 등록', ";

    $logInsert_query .= "date = '$date' ";



    $logInsert_result = mysqli_query($conn, $logInsert_query);

    if(!$logInsert_result) {

        die("로그 데이터 등록 오류........" . mysqli_error($conn));

    }

    // *********************************************************************************************//



  }

}

//*******************************************************************************************************//





//**************************************수주 상세 - 컷팅지 데이터 초기화**************************************//

if(isset($_POST['quantity_del'])) {

    $del_ho = $_POST['del_ho'];

    $del_por = $_POST['del_por'];

    $hide_date = date("Y-m-d h:i:s");

    $hide_name = $_COOKIE['HPNAME'];



    //************** 2023-05-17. 김한얼 팀장. 라다 공정리스트 테이블 충돌(hj_laad, hj_ladaList) 해결 **************//

    // old code

    // $delete_query = "DELETE FROM hj_lada WHERE ho = '$del_ho' AND por = '$del_por' ";

    // $delete_result = mysqli_query($conn, $delete_query);

    // if(!$delete_result) {

    //     die("컷팅지 데이터 초기화 에러......." . mysqli_error($conn));

    // }



    // new code

    $update_query = "UPDATE hj_lada SET ";

    $update_query .= "hide_date = '$hide_date', ";

    $update_query .= "hide_name = '$hide_name' ";

    $update_query .= "WHERE ho = '$del_ho' AND por = '$del_por' ";



    $update_result = mysqli_query($conn, $update_query);

    if(!$update_result) {

        die("컷팅지 숨김처리 오류...." . mysqli_error($conn));

    }

    //********************************************************************************************************//



    //********** 2023-05-09. 김한얼 팀장. 로그 기록 추가(도입기업 데이터 확인 - 05/08 요청사항) **********//

    $id = $_COOKIE['HPID'];

    $name = $_COOKIE['HPNAME'];

    $date = date("Y-m-d h:i:s");



    $logInsert_query = "INSERT INTO hj_log SET ";

    $logInsert_query .= "ho = '$del_ho', ";

    $logInsert_query .= "por = '$del_por', ";

    $logInsert_query .= "seq = NULL, ";

    $logInsert_query .= "qt_no = NULL, ";

    $logInsert_query .= "id = '$id', ";

    $logInsert_query .= "name = '$name', ";

    $logInsert_query .= "func = '컷팅지 데이터 리셋', ";

    $logInsert_query .= "date = '$date' ";



    $logInsert_result = mysqli_query($conn, $logInsert_query);

    if(!$logInsert_result) {

        die("로그 데이터 등록 오류........" . mysqli_error($conn));

    }

    // *********************************************************************************************//

}

//*******************************************************************************************************//



//**************************************수주 관리 - 도면 삭제**************************************//
if(isset($_POST['draw_delete2'])) {
  $por_no = $_POST['draw_delPorNo'];
  $draw_delPorNo = $_POST['draw_delPorNo'];
  $ho = substr($draw_delPorNo, 0, 4);
  $por = substr($draw_delPorNo, 4, 6);

  $delete_query1 = "DELETE FROM hj_draw WHERE ho = '$ho' AND por = '$por' ";
  $delete_result1 = mysqli_query($conn, $delete_query1);
  if(!$delete_result1) {
    die("도면 삭제 에러1....." . mysqli_error($conn));
  }

  $delete_query2 = "DELETE FROM hj_lada WHERE ho = '$ho' AND por = '$por' ";
  $delete_result2 = mysqli_query($conn, $delete_query2);
  if(!$delete_result2) {
    die("도면 삭제 에러2....." . mysqli_error($conn));
  }
}
//*******************************************************************************************************//



//**************************************수주 상세 - 긴급 물량 등록**************************************//

if(isset($_POST['emg_quantity_seq2'])) {

  $quantity_ho = $_POST['emg_quantity_ho2'];

  $quantity_por = $_POST['emg_quantity_por2'];

  $quantity_count = json_decode($_POST['emg_quantity_count2']);

  $quantity_seq = json_decode($_POST['emg_quantity_seq2']);

  $weight_in = json_decode($_POST['emg_weight_in2']);

  $qt_no = "긴급";



  for($i = 0; $i < count($quantity_seq); $i++) {

    $update_query = "UPDATE hj_lada SET ";

    $update_query .= "qt_no = '$qt_no' ";

    $update_query .= "WHERE ho = '$quantity_ho' AND por = '$quantity_por' AND seq = '$quantity_seq[$i]' AND (hide_name IS NULL AND hide_date IS NULL) ";



    $update_result = mysqli_query($conn, $update_query);

    if(!$update_result) {

      die("물량 등록 에러..." . mysqli_error($conn));

    }



    //********** 2023-05-09. 김한얼 팀장. 로그 기록 추가(도입기업 데이터 확인 - 05/08 요청사항) **********//

    $id = $_COOKIE['HPID'];

    $name = $_COOKIE['HPNAME'];

    $date = date("Y-m-d h:i:s");



    $logInsert_query = "INSERT INTO hj_log SET ";

    $logInsert_query .= "ho = '$quantity_ho', ";

    $logInsert_query .= "por = '$quantity_por', ";

    $logInsert_query .= "seq = '$quantity_seq[$i]', ";

    $logInsert_query .= "qt_no = '$qt_no', ";

    $logInsert_query .= "id = '$id', ";

    $logInsert_query .= "name = '$name', ";

    $logInsert_query .= "func = '긴급 물량 등록', ";

    $logInsert_query .= "date = '$date' ";



    $logInsert_result = mysqli_query($conn, $logInsert_query);

    if(!$logInsert_result) {

        die("로그 데이터 등록 오류........" . mysqli_error($conn));

    }

    // *********************************************************************************************//

  }

}

//*******************************************************************************************************//



//**************************************물량 산출 - 전체 취소 기능**************************************//

if(isset($_POST['quantity_delete2'])) {

  $quantity_ho = json_decode($_POST['del_quantity_ho']);

  $quantity_por = json_decode($_POST['del_quantity_por']);

  $quantity_seq = json_decode($_POST['del_quantity_seq']);



  for($i = 0; $i < count($quantity_ho); $i++) {

    $update_query = "UPDATE hj_lada SET ";

    $update_query .= "qt_no = null, ";

    $update_query .= "money = null, ";

    $update_query .= "other = null, ";

    $update_query .= "pro_date = null, ";

    $update_query .= "mp_date = null, ";

    $update_query .= "lot_date = null, ";

    $update_query .= "list_lot = null, ";

    $update_query .= "list_title = null ";

    $update_query .= "WHERE ho = '$quantity_ho[$i]' AND por ='$quantity_por[$i]' AND seq = '$quantity_seq[$i]' ";



    $update_result = mysqli_query($conn, $update_query);



    if(!$update_result) {

      die("물량취소 에러..." . mysqli_error($conn));

    }



    //********** 2023-05-09. 김한얼 팀장. 로그 기록 추가(도입기업 데이터 확인 - 05/08 요청사항) **********//

    $id = $_COOKIE['HPID'];

    $name = $_COOKIE['HPNAME'];

    $date = date("Y-m-d h:i:s");



    $logInsert_query = "INSERT INTO hj_log SET ";

    $logInsert_query .= "ho = '$quantity_ho[$i]', ";

    $logInsert_query .= "por = '$quantity_por[$i]', ";

    $logInsert_query .= "seq = '$quantity_seq[$i]', ";

    $logInsert_query .= "qt_no = NULL, ";

    $logInsert_query .= "id = '$id', ";

    $logInsert_query .= "name = '$name', ";

    $logInsert_query .= "func = '선택물량 취소', ";

    $logInsert_query .= "date = '$date' ";



    $logInsert_result = mysqli_query($conn, $logInsert_query);

    if(!$logInsert_result) {

        die("로그 데이터 등록 오류........" . mysqli_error($conn));

    }

    // *********************************************************************************************//

  }

}

//*******************************************************************************************************//





//**************************************물량 산출 - 전체 저장 기능**************************************//

if(isset($_POST['other_update3'])) {

  $no = json_decode($_POST['no']);

  $money = json_decode($_POST['money']);

  $other = json_decode($_POST['other']);

  $pro_date = json_decode($_POST['pro_date']);

  $mp_date = json_decode($_POST['mp_date']);



  $ho = json_decode($_POST['ho']);

  $por = json_decode($_POST['por']);

  $seq = json_decode($_POST['seq']);



  for($i = 0; $i < count($no); $i++) {

    if($money[$i] == null or $money[$i] == '') {$money[$i] = 0;}



    $update_query = "UPDATE hj_lada SET ";

    $update_query .= "money = '$money[$i]', ";

    $update_query .= "other = '$other[$i]', ";

    $update_query .= "pro_date = '$pro_date[$i]', ";

    $update_query .= "mp_date = '$mp_date[$i]' ";

    $update_query .= "WHERE ho = '$ho[$i]' AND por = '$por[$i]' AND seq = '$seq[$i]' AND (hide_date IS NULL AND hide_name IS NULL) ";



    $update_result = mysqli_query($conn, $update_query);

    if(!$update_result) {

      die("물량 정보 전체 저장 요류...." . mysqli_error($conn));

    }



    //********** 2023-05-09. 김한얼 팀장. 로그 기록 추가(도입기업 데이터 확인 - 05/08 요청사항) **********//

    $id = $_COOKIE['HPID'];

    $name = $_COOKIE['HPNAME'];

    $date = date("Y-m-d h:i:s");



    $logInsert_query = "INSERT INTO hj_log SET ";

    $logInsert_query .= "ho = '$ho[$i]', ";

    $logInsert_query .= "por = '$por[$i]', ";

    $logInsert_query .= "seq = '$seq[$i]', ";

    $logInsert_query .= "qt_no = NULL, ";

    $logInsert_query .= "id = '$id', ";

    $logInsert_query .= "name = '$name', ";

    $logInsert_query .= "func = '선택물량 취소', ";

    $logInsert_query .= "date = '$date' ";



    $logInsert_result = mysqli_query($conn, $logInsert_query);

    if(!$logInsert_result) {

        die("로그 데이터 등록 오류........" . mysqli_error($conn));

    }

    // *********************************************************************************************//

  }

}

//*******************************************************************************************************//



//**************************************물량 산출 - 공정리스트 등록**************************************//

if(isset($_POST['input_prolist2'])) {

    $input_ho = json_decode($_POST['input_ho']);

    $input_por = json_decode($_POST['input_por']);

    $input_seq = json_decode($_POST['input_seq']);

    $input_qt_no = json_decode($_POST['input_qt_no']);

    $date = date("Y-m-d h:i:s");



    for($i = 0; $i < count($input_seq); $i++) {

        $update_query = "UPDATE hj_lada SET ";

        $update_query .= "quantity_ok = '$date' ";

        $update_query .= "WHERE ho = '$input_ho[$i]' AND por = '$input_por[$i]' AND seq = '$input_seq[$i]' AND qt_no = '$input_qt_no[$i]' AND (hide_date IS NULL AND hide_name IS NULL) ";



        $update_result = mysqli_query($conn, $update_query);

        if(!$update_result) {

            die("물량 산출 -> 공정리스트 등록 오류" . mysqli_error($conn));

        }



        // $select_query = "SELECT * FROM hj_lada WHERE ho = '$input_ho[$i]' AND por = '$input_por[$i]' AND seq = '$input_seq[$i]' AND qt_no = '$input_qt_no[$i]' ";

        // $select_result = mysqli_query($conn, $select_query);

        // $row = mysqli_fetch_assoc($select_result);



        // $no = $row['no'];

        // $ho = $row['ho'];

        // $por = $row['por'];

        // $seq = $row['seq'];

        // $lap = $row['lap'];

        // $count = $row['count'];

        // $weight = $row['weight'];

        // $fr_one = $row['fr_one'];

        // $fr_two = $row['fr_two'];

        // $fr_three = $row['fr_three'];

        // $fr_four = $row['fr_four'];

        // $fr_five = $row['fr_five'];

        // $leg1_one = $row['leg1_one'];

        // $leg1_two = $row['leg1_two'];

        // $leg1_three = $row['leg1_three'];

        // $leg1_four = $row['leg1_four'];

        // $leg1_five = $row['leg1_five'];

        // $leg2_one = $row['leg2_one'];

        // $leg2_two = $row['leg2_two'];

        // $leg2_three = $row['leg2_three'];

        // $leg2_four = $row['leg2_four'];

        // $leg2_five = $row['leg2_five'];

        // $pad_one = $row['pad_one'];

        // $pad_two = $row['pad_two'];

        // $W = $row['W'];

        // $P = $row['P'];

        // $U = $row['U'];

        // $B = $row['B'];

        // $paint = $row['paint'];

        // $gak_count = $row['gak_count'];

        // $RB22 = $row['RB22'];

        // $RB25 = $row['RB25'];

        // $hoop1 = $row['hoop1'];

        // $hoop2 = $row['hoop2'];

        // $qt_no = $row['qt_no'];

        // $money = $row['money'];

        // $other = $row['other'];

        // $pro_date = $row['pro_date'];

        // $mp_date = $row['mp_date'];

        // $quantity_ok = $row['quantity_ok'];

        // $series = $row['series'];

        // $sp = $row['sp'];

        // $revision = $row['revision'];

        // $lot_date = $row['lot_date'];

        // $list_lot = $row['list_lot'];

        // $list_title = $row['list_title'];



        // 2. 빈 값 오류 -> 0으로 삼항연산자 치환

        // $hoop1 == '' ? $hoop1 = 0 : $hoop1;

        // $hoop2 == '' ? $hoop2 = 0 : $hoop2;

        // $count == '' ? $count = 0 : $count;

        // $weight == '' ? $weight = 0 : $weight;

        // $fr_one == '' ? $fr_one = 0 : $fr_one;

        // $fr_five == '' ? $fr_five = 0 : $fr_five;

        // $leg2_one == '' ? $leg2_one = 0 : $leg2_one;

        // $leg2_five == '' ? $leg2_five = 0 : $leg2_five;

        // $money == '' ? $money = 0 : $money;

        // $quantity_ok == '' ? $quantity_ok = NULL : $quantity_ok;

        // $leg1_one == '' ? $leg1_one = 0 : $leg1_one;

        // $leg1_five == '' ? $leg1_five = 0 : $leg1_five;



        //******************************* 2023-05-03. 김한얼 팀장. 중복 체크 *******************************//

        // $select_val_query = "SELECT no FROM hj_ladaList WHERE no = '$no' ";

        // $select_val_result = mysqli_query($conn, $select_val_query);

        // $select_val_row = mysqli_fetch_assoc($select_val_result);

        // $ladaList_no = $select_val_row['no'];



        // if($ladaList_no != $no) {

            // $insert_query = "TRUNCATE hj_ladaList"; 

            // $insert_query2 = "INSERT INTO hj_ladaList SELECT * FROM hj_lada WHERE qt_no IS NOT NULL AND qt_no != '' ";



            // $insert_query = "INSERT INTO hj_ladaList SET ";

            // $insert_query .= "no = '$no', ";

            // $insert_query .= "ho = '$ho', ";

            // $insert_query .= "por = '$por', ";

            // $insert_query .= "seq = '$seq', ";

            // $insert_query .= "lap = '$lap', ";

            // $insert_query .= "count = '$count', ";

            // $insert_query .= "weight = '$weight', ";

            // $insert_query .= "fr_one = '$fr_one', ";

            // $insert_query .= "fr_two = '$fr_two', ";

            // $insert_query .= "fr_three = '$fr_three', ";

            // $insert_query .= "fr_four = '$fr_four', ";

            // $insert_query .= "fr_five = '$fr_five', ";

            // $insert_query .= "leg1_one = '$leg1_one', ";

            // $insert_query .= "leg1_two = '$leg1_two', ";

            // $insert_query .= "leg1_three = '$leg1_three', ";

            // $insert_query .= "leg1_four = '$leg1_four', ";

            // $insert_query .= "leg1_five = '$leg1_five', ";

            // $insert_query .= "leg2_one = '$leg2_one', ";

            // $insert_query .= "leg2_two = '$leg2_two', ";

            // $insert_query .= "leg2_three = '$leg2_three', ";

            // $insert_query .= "leg2_four = '$leg2_four', ";

            // $insert_query .= "leg2_five = '$leg2_five', ";

            // $insert_query .= "pad_one = '$pad_one', ";

            // $insert_query .= "pad_two = '$pad_two', ";

            // $insert_query .= "W = '$W', ";

            // $insert_query .= "P = '$P', ";

            // $insert_query .= "U = '$U', ";

            // $insert_query .= "B = '$B', ";

            // $insert_query .= "paint = '$paint', ";

            // $insert_query .= "gak_count = '$gak_count', ";

            // $insert_query .= "RB22 = '$RB22', ";

            // $insert_query .= "RB25 = '$RB25', ";

            // $insert_query .= "hoop1 = '$hoop1', ";

            // $insert_query .= "hoop2 = '$hoop2', ";

            // $insert_query .= "qt_no = '$qt_no', ";

            // $insert_query .= "money = '$money', ";

            // $insert_query .= "other = '$other', ";

            // $insert_query .= "pro_date = '$pro_date', ";

            // $insert_query .= "mp_date = '$mp_date', ";

            // $insert_query .= "quantity_ok = '$quantity_ok', ";

            // $insert_query .= "series = '$series', ";

            // $insert_query .= "sp = '$sp', ";

            // $insert_query .= "revision = '$revision' ";

            // $insert_query .= "lot_date = '$lot_date', ";

            // $insert_query .= "list_lot = '$list_lot', ";

            // $insert_query .= "list_title = '$list_title' ";



            

            // $insert_result = mysqli_query($conn, $insert_query);

            // if(!$insert_result) {

            //     die("라다공정 리스트 복사 등록 에러...." . mysqli_error($conn));

            // } else {

            //     $insert_result2 = mysqli_query($conn, $insert_query2);

            // }



            //********** 2023-05-09. 김한얼 팀장. 로그 기록 추가(도입기업 데이터 확인 - 05/08 요청사항) **********//

            $id = $_COOKIE['HPID'];

            $name = $_COOKIE['HPNAME'];

            $date = date("Y-m-d h:i:s");



            $logInsert_query = "INSERT INTO hj_log SET ";

            $logInsert_query .= "ho = '$input_ho[$i]', ";

            $logInsert_query .= "por = '$input_por[$i]', ";

            $logInsert_query .= "seq = '$input_seq[$i]', ";

            $logInsert_query .= "qt_no = '$input_qt_no[$i]', ";

            $logInsert_query .= "id = '$id', ";

            $logInsert_query .= "name = '$name', ";

            $logInsert_query .= "func = '라다 공정리스트 등록', ";

            $logInsert_query .= "date = '$date' ";



            $logInsert_result = mysqli_query($conn, $logInsert_query);

            if(!$logInsert_result) {

                die("로그 데이터 등록 오류........" . mysqli_error($conn));

            }

        // }

    }

}

//*******************************************************************************************************//



//**************************************물량 산출 - 긴급 공정리스트 등록**************************************//

if(isset($_POST['emg_prolist2'])) {

  $emg_input_ho = json_decode($_POST['emg_input_ho']);

  $emg_input_por = json_decode($_POST['emg_input_por']);

  $emg_input_seq = json_decode($_POST['emg_input_seq']);

  $emg_input_qt_no = json_decode($_POST['emg_input_qt_no']);

  $emg_list_title = $_POST['emg_list_title'];

  $date = date("Y-m-d H:i:s");



  $select_query2 = "SELECT lot_date, list_lot FROM hj_lada WHERE list_title = '$emg_list_title' ";

  $select_result2 = mysqli_query($conn, $select_query2);

  $row2 = mysqli_fetch_assoc($select_result2);

  $lot_date = $row2['lot_date'];

  $list_lot = $row2['list_lot'];



  for($i = 0; $i < count($emg_input_qt_no); $i++) {



    $update_query = "UPDATE hj_lada SET ";

    $update_query .= "quantity_ok = '$date', ";

    $update_query .= "list_lot = '$list_lot', ";

    $update_query .= "lot_date = '$lot_date', ";

    $update_query .= "list_title = '$emg_list_title' ";

    $update_query .= "WHERE ho = '$emg_input_ho[$i]' AND por = '$emg_input_por[$i]' AND seq = '$emg_input_seq[$i]' AND qt_no = '$emg_input_qt_no[$i]' AND (hide_date IS NULL AND hide_name IS NULL) ";



    $update_result = mysqli_query($conn, $update_query);

    if(!$update_result) {

      die("물량 산출 -> 공정리스트 등록 오류" . mysqli_error($conn));

    }



    // $select_query = "SELECT * FROM hj_lada WHERE ho = '$emg_input_ho[$i]' AND por = '$emg_input_por[$i]' AND seq = '$emg_input_seq[$i]' AND qt_no = '$emg_input_qt_no[$i]' ";

    // $select_result = mysqli_query($conn, $select_query);

    // $row = mysqli_fetch_assoc($select_result);



    // $no = $row['no'];

    // $ho = $row['ho'];

    // $por = $row['por'];

    // $seq = $row['seq'];

    // $lap = $row['lap'];

    // $count = $row['count'];

    // $weight = $row['weight'];

    // $fr_one = $row['fr_one'];

    // $fr_two = $row['fr_two'];

    // $fr_three = $row['fr_three'];

    // $fr_four = $row['fr_four'];

    // $fr_five = $row['fr_five'];

    // $leg1_one = $row['leg1_one'];

    // $leg1_two = $row['leg1_two'];

    // $leg1_three = $row['leg1_three'];

    // $leg1_four = $row['leg1_four'];

    // $leg1_five = $row['leg1_five'];

    // $leg2_one = $row['leg2_one'];

    // $leg2_two = $row['leg2_two'];

    // $leg2_three = $row['leg2_three'];

    // $leg2_four = $row['leg2_four'];

    // $leg2_five = $row['leg2_five'];

    // $pad_one = $row['pad_one'];

    // $pad_two = $row['pad_two'];

    // $W = $row['W'];

    // $P = $row['P'];

    // $U = $row['U'];

    // $B = $row['B'];

    // $paint = $row['paint'];

    // $gak_count = $row['gak_count'];

    // $RB22 = $row['RB22'];

    // $RB25 = $row['RB25'];

    // $hoop1 = $row['hoop1'];

    // $hoop2 = $row['hoop2'];

    // $qt_no = $row['qt_no'];

    // $money = $row['money'];

    // $other = $row['other'];

    // $pro_date = $row['pro_date'];

    // $mp_date = $row['mp_date'];

    // $quantity_ok = $row['quantity_ok'];

    // $series = $row['series'];

    // $sp = $row['sp'];

    // $revision = $row['revision'];

    // $lot_date = $row['lot_date'];

    // $list_lot = $row['list_lot'];

    // $list_title = $row['list_title'];



    // 2. 빈 값 오류 -> 0으로 삼항연산자 치환

    // // $pad_one == '' ? $pad_one = 0 : $pad_one;

    // // $RB22 == '' ? $RB22 = 0 : $RB22;

    // // $RB25 == '' ? $RB25 = 0 : $RB25;

    // $hoop1 == '' ? $hoop1 = 0 : $hoop1;

    // $hoop2 == '' ? $hoop2 = 0 : $hoop2;

    // $count == '' ? $count = 0 : $count;

    // $weight == '' ? $weight = 0 : $weight;

    // $fr_one == '' ? $fr_one = 0 : $fr_one;

    // $fr_five == '' ? $fr_five = 0 : $fr_five;

    // $leg2_one == '' ? $leg2_one = 0 : $leg2_one;

    // $leg2_five == '' ? $leg2_five = 0 : $leg2_five;

    // $money == '' ? $money = 0 : $money;

    // $quantity_ok == '' ? $quantity_ok = NULL : $quantity_ok;

    // $lot_date == '' ? $lot_date = NULL : $lot_date;

    // $list_lot == '' ? $list_lot = NULL : $list_lot;

    // $list_title == '' ? $list_title = NULL : $list_title;

    // // $pad_two == '' ? $pad_two = 0 : $pad_two;

    // // $W == '' ? $W = 0 : $W;

    // // $P == '' ? $P = 0 : $P;

    // // $U == '' ? $U = 0 : $U;

    // // $B == '' ? $B = 0 : $B;

    // // $gak_count == '' ? $gak_count = 0 : $gak_count;

    // $leg1_one == '' ? $leg1_one = 0 : $leg1_one;

    // $leg1_five == '' ? $leg1_five = 0 : $leg1_five;



    // $insert_query = "TRUNCATE hj_ladaList";

    // $insert_query2 = " INSERT INTO hj_ladaList SELECT * FROM hj_lada WHERE qt_no IS NOT NULL AND qt_no != '' ";



    // $insert_query = "INSERT INTO hj_ladaList SET ";

    // $insert_query .= "no = '$no', ";

    // $insert_query .= "ho = '$ho', ";

    // $insert_query .= "por = '$por', ";

    // $insert_query .= "seq = '$seq', ";

    // $insert_query .= "lap = '$lap', ";

    // $insert_query .= "count = '$count', ";

    // $insert_query .= "weight = '$weight', ";

    // $insert_query .= "fr_one = '$fr_one', ";

    // $insert_query .= "fr_two = '$fr_two', ";

    // $insert_query .= "fr_three = '$fr_three', ";

    // $insert_query .= "fr_four = '$fr_four', ";

    // $insert_query .= "fr_five = '$fr_five', ";

    // $insert_query .= "leg1_one = '$leg1_one', ";

    // $insert_query .= "leg1_two = '$leg1_two', ";

    // $insert_query .= "leg1_three = '$leg1_three', ";

    // $insert_query .= "leg1_four = '$leg1_four', ";

    // $insert_query .= "leg1_five = '$leg1_five', ";

    // $insert_query .= "leg2_one = '$leg2_one', ";

    // $insert_query .= "leg2_two = '$leg2_two', ";

    // $insert_query .= "leg2_three = '$leg2_three', ";

    // $insert_query .= "leg2_four = '$leg2_four', ";

    // $insert_query .= "leg2_five = '$leg2_five', ";

    // $insert_query .= "pad_one = '$pad_one', ";

    // $insert_query .= "pad_two = '$pad_two', ";

    // $insert_query .= "W = '$W', ";

    // $insert_query .= "P = '$P', ";

    // $insert_query .= "U = '$U', ";

    // $insert_query .= "B = '$B', ";

    // $insert_query .= "paint = '$paint', ";

    // $insert_query .= "gak_count = '$gak_count', ";

    // $insert_query .= "RB22 = '$RB22', ";

    // $insert_query .= "RB25 = '$RB25', ";

    // $insert_query .= "hoop1 = '$hoop1', ";

    // $insert_query .= "hoop2 = '$hoop2', ";

    // $insert_query .= "qt_no = '$qt_no', ";

    // $insert_query .= "money = '$money', ";

    // $insert_query .= "other = '$other', ";

    // $insert_query .= "pro_date = '$pro_date', ";

    // $insert_query .= "mp_date = '$mp_date', ";

    // $insert_query .= "quantity_ok = '$quantity_ok', ";

    // $insert_query .= "series = '$series', ";

    // $insert_query .= "sp = '$sp', ";

    // $insert_query .= "revision = '$revision', ";

    // $insert_query .= "lot_date = '$lot_date', ";

    // $insert_query .= "list_lot = '$list_lot', ";

    // $insert_query .= "list_title = '$list_title' ";



    // $insert_result = mysqli_query($conn, $insert_query);

    // if(!$insert_result) {

    //     die("라다공정 리스트 복사본 긴급 등록 에러...." . mysqli_error($conn));

    // } else {

    //     $insert_result2 = mysqli_query($conn, $insert_query2);

    // }



    //********** 2023-05-09. 김한얼 팀장. 로그 기록 추가(도입기업 데이터 확인 - 05/08 요청사항) **********//

    $id = $_COOKIE['HPID'];

    $name = $_COOKIE['HPNAME'];

    $date = date("Y-m-d h:i:s");



    $logInsert_query = "INSERT INTO hj_log SET ";

    $logInsert_query .= "ho = '$emg_input_ho[$i]', ";

    $logInsert_query .= "por = '$emg_input_por[$i]', ";

    $logInsert_query .= "seq = '$emg_input_seq[$i]', ";

    $logInsert_query .= "qt_no = '$emg_input_qt_no[$i]', ";

    $logInsert_query .= "id = '$id', ";

    $logInsert_query .= "name = '$name', ";

    $logInsert_query .= "func = '$list_title 긴급 등록', ";

    $logInsert_query .= "date = '$date' ";



    $logInsert_result = mysqli_query($conn, $logInsert_query);

    if(!$logInsert_result) {

        die("로그 데이터 등록 오류........" . mysqli_error($conn));

    }

    // *********************************************************************************************//



  }

}

//*******************************************************************************************************//



//**************************************공정 리스트 - 제작 납기 자동 저장**************************************//

// 2023-02-09. 김한얼 팀장. 제작 납기 / MP 납기 일정 등록 안되는 오류 수정

// New Code - 제작 납기 등록

if(isset($_POST['proDate_up2'])) {

    $pro_date = $_POST['pro_date'];

    $ho = $_POST['ho'];

    $por = $_POST['por'];

    $qt_no = $_POST['qt_no'];



    $select_query = "SELECT * FROM hj_lada WHERE ho = '$ho' AND por = '$por' AND qt_no = '$qt_no' ";

    $select_result = mysqli_query($conn, $select_query);

    while($row = mysqli_fetch_assoc($select_result)) {

        $seq = $row['seq'];



        $update_query2 = "UPDATE hj_lada SET ";

        $update_query2 .= "pro_date = '$pro_date' ";

        $update_query2 .= "WHERE ho = '$ho' AND por = '$por' AND seq = '$seq' AND (hide_name IS NULL AND hide_date IS NULL) ";



        $update_result2 = mysqli_query($conn, $update_query2);

        if(!$update_result2) {

            die("공정 리스트 정보 전체 저작 요류...." . mysqli_error($conn));

        }



        $update_query3 = "UPDATE hj_ladaList SET ";

        $update_query3 .= "pro_date = '$pro_date' ";

        $update_query3 .= "WHERE ho = '$ho' AND por = '$por' AND seq = '$seq' ";



        $update_resul3 = mysqli_query($conn, $update_query3);

        if(!$update_resul3) {

            die("공정 리스트 정보 복사본 전체 저장 요류...." . mysqli_error($conn));

        }

    };

    

}

//*******************************************************************************************************//



//**************************************공정 리스트 - MP 납기 자동 저장**************************************//

// 2023-02-09. 김한얼 팀장. 제작 납기 / MP 납기 일정 등록 안되는 오류 수정

// New Code - MP 납기 등록

if(isset($_POST['mpDate_up2'])) {

    $mp_date = $_POST['mp_date'];

    $ho = $_POST['ho'];

    $por = $_POST['por'];

    $qt_no = $_POST['qt_no'];



    $select_query = "SELECT * FROM hj_lada WHERE ho = '$ho' AND por = '$por' AND qt_no = '$qt_no' ";

    $select_result = mysqli_query($conn, $select_query);

    while($row = mysqli_fetch_assoc($select_result)) {

        $seq = $row['seq'];



        $update_query2 = "UPDATE hj_lada SET ";

        $update_query2 .= "mp_date = '$mp_date' ";

        $update_query2 .= "WHERE ho = '$ho' AND por = '$por' AND seq = '$seq' AND (hide_name IS NULL AND hide_date IS NULL) ";



        $update_result2 = mysqli_query($conn, $update_query2);

        if(!$update_result2) {

            die("공정 리스트 정보 전체 저작 요류...." . mysqli_error($conn));

        }



        $update_query2 = "UPDATE hj_ladaList SET ";

        $update_query2 .= "mp_date = '$mp_date' ";

        $update_query2 .= "WHERE ho = '$ho' AND por = '$por' AND seq = '$seq' ";



        $update_result2 = mysqli_query($conn, $update_query2);

        if(!$update_result2) {

            die("공정 리스트 정보 복사본 전체 저장 요류...." . mysqli_error($conn));

        }

    };

    

}

//*******************************************************************************************************//



//**************************************공정 리스트 - 전체 저장 기능**************************************//

if(isset($_POST['other_update4'])) {

  $prolist_ho = json_decode($_POST['prolist_ho']);

  $prolist_por = json_decode($_POST['prolist_por']);

  $series = json_decode($_POST['series']);

//   $pro_date = json_decode($_POST['pro_date']);

//   $mp_date = json_decode($_POST['mp_date']);

  $sp = json_decode($_POST['sp']);

  $qt_no = json_decode($_POST['upQt_no']);

//   $revision = json_decode($_POST['revision']);



  for($i = 0; $i < count($prolist_ho); $i++) {

    $update_query = "UPDATE hj_lada SET ";

    $update_query .= "series = '$series[$i]', ";

    $update_query .= "sp = '$sp[$i]' ";

    $update_query .= "WHERE ho = '$prolist_ho[$i]' AND por = '$prolist_por[$i]' AND qt_no = '$qt_no[$i]' AND (hide_date IS NULL AND hide_name IS NULL) ";



    $update_result = mysqli_query($conn, $update_query);

    if(!$update_result) {

      die("공정 리스트 정보 전체 저작 요류...." . mysqli_error($conn));

    }



    $update_query2 = "UPDATE hj_ladaList SET ";

    $update_query2 .= "series = '$series[$i]', ";

    $update_query2 .= "sp = '$sp[$i]' ";

    $update_query2 .= "WHERE ho = '$prolist_ho[$i]' AND por = '$prolist_por[$i]' AND qt_no = '$qt_no[$i]' ";



    $update_result2 = mysqli_query($conn, $update_query2);

    if(!$update_result2) {

      die("공정 리스트 정보 전체 저작 요류...." . mysqli_error($conn));

    }



    $select_query = "SELECT * FROM hj_lada WHERE ho = '$prolist_ho[$i]' AND por = '$prolist_por[$i]' AND qt_no = '$qt_no[$i]' ";

    $select_result = mysqli_query($conn, $select_query);

    while($row = mysqli_fetch_assoc($select_result)) {

        $seq = $row['seq'];

        $id = $_COOKIE['HPID'];

        $name = $_COOKIE['HPNAME'];

        $date = date("Y-m-d h:i:s");

        $func = '특수자재 변경 : ' . $sp[$i] . ' / ' . '시리즈 변경 : ' . $series[$i];



        $logInsert_query = "INSERT INTO hj_log SET ";

        $logInsert_query .= "ho = '$prolist_ho[$i]', ";

        $logInsert_query .= "por = '$prolist_por[$i]', ";

        $logInsert_query .= "seq = '$seq', ";

        $logInsert_query .= "qt_no = '$qt_no[$i]', ";

        $logInsert_query .= "id = '$id', ";

        $logInsert_query .= "name = '$name', ";

        $logInsert_query .= "func = '$func', ";

        $logInsert_query .= "date = '$date' ";



        $logInsert_result = mysqli_query($conn, $logInsert_query);

        if(!$logInsert_result) {

            die("로그 데이터 등록 오류........" . mysqli_error($conn));

        }

    }



    

  }

}

//*******************************************************************************************************//



//**************************************공정 리스트 - 선택한 공정 취소**************************************//

if(isset($_POST['prolist_delete2'])) {

  $prolist_qtNo = json_decode($_POST['prolist_qtNo']);

  $prolist_ho = json_decode($_POST['prolist_ho']);

  $prolist_por = json_decode($_POST['prolist_por']);



  for($i = 0; $i < count($prolist_qtNo); $i++) {



    $select_query = "SELECT seq FROM hj_lada WHERE ho = '$prolist_ho[$i]' AND por = '$prolist_por[$i]' AND qt_no = '$prolist_qtNo[$i]' ";

    $select_result = mysqli_query($conn, $select_query);

    while($row = mysqli_fetch_assoc($select_result)) {

        $seq = $row['seq'];



        $update_query = "UPDATE hj_lada SET ";

        $update_query .= "quantity_ok = NULL, ";

        $update_query .= "lot_date = NULL, ";

        $update_query .= "list_lot = NULL, ";

        $update_query .= "list_title = NULL ";

        $update_query .= "WHERE ho = '$prolist_ho[$i]' AND por = '$prolist_por[$i]' AND seq = '$seq' ";



        $update_result = mysqli_query($conn, $update_query);

        if(!$update_result) {

            die("물량 산출 등록일 초기화 에러....." . mysqli_error($conn));

        }



        $delete_query = "DELETE FROM hj_ladaList WHERE ho = '$prolist_ho[$i]' AND por = '$prolist_por[$i]' AND seq = '$seq' ";



        $delete_result = mysqli_query($conn, $delete_query);

        if(!$delete_result) {

            die("공정리스트 복사본 해당 삭제 오류...." . mysqli_error($conn));

        }



        $id = $_COOKIE['HPID'];

        $name = $_COOKIE['HPNAME'];

        $date = date("Y-m-d h:i:s");

        $func = '선택공정 취소';



        $logInsert_query = "INSERT INTO hj_log SET ";

        $logInsert_query .= "ho = '$prolist_ho[$i]', ";

        $logInsert_query .= "por = '$prolist_por[$i]', ";

        $logInsert_query .= "seq = '$seq', ";

        $logInsert_query .= "qt_no = '$prolist_qtNo[$i]', ";

        $logInsert_query .= "id = '$id', ";

        $logInsert_query .= "name = '$name', ";

        $logInsert_query .= "func = '$func', ";

        $logInsert_query .= "date = '$date' ";



        $logInsert_result = mysqli_query($conn, $logInsert_query);

        if(!$logInsert_result) {

            die("로그 데이터 등록 오류........" . mysqli_error($conn));

        }

    }



  }

}

//*******************************************************************************************************//



//**************************************공정 리스트 - NO 변경**************************************//

// 2022-12-12. 김한얼. No(qt_no) 변경 요구사항 반영

if(isset($_POST['add_prolist2'])) {

    $ho = $_POST['prolist_ho'];

    $por = $_POST['prolist_por'];

    $qt_no = $_POST['update_qtNo'];

    $seq = json_decode($_POST['prolist_seq']);



    for($i = 0; $i < count($seq); $i++) {

        $update_query = "UPDATE hj_lada SET ";

        $update_query .= "qt_no = '$qt_no' ";

        $update_query .= "WHERE ho = '$ho' AND por = '$por' AND seq = '$seq[$i]' AND (hide_date IS NULL AND hide_name IS NULL) ";



        $update_result = mysqli_query($conn, $update_query);

        if(!$update_result) {

            die("NO 변경 오류....." . mysqli_error($conn));

        }



        // $update_query2 = "UPDATE hj_ladaList SET ";

        // $update_query2 .= "qt_no = '$qt_no' ";

        // $update_query2 .= "WHERE ho = '$ho' AND por = '$por' AND seq = '$seq[$i]' ";



        // $update_result2 = mysqli_query($conn, $update_query2);

        // if(!$update_result2) {

        //     die("복사본 NO 변경 오류....." . mysqli_error($conn));

        // }

    }

}

//*******************************************************************************************************//



//**************************************공정 리스트 - LOT 번호 부여**************************************//

if(isset($_POST['insert_proList2'])) {

  $in_prolist_no = json_decode($_POST['in_prolist_no']);

  $in_prolist_ho = json_decode($_POST['in_prolist_ho']);

  $in_prolist_por = json_decode($_POST['in_prolist_por']);

  

  $date = date("Y-m-d");

  

  $select_query = "SELECT MAX(list_lot) AS MAX_list_lot FROM hj_lada WHERE lot_date = '$date' ";

  $select_result = mysqli_query($conn, $select_query);

  $row = mysqli_fetch_assoc($select_result);

  $MAX_list_lot = $row['MAX_list_lot'];



  if($MAX_list_lot == null) {

    $list_lot = 1;

  } else {

    $list_lot = $MAX_list_lot + 1;

  }



  for($i = 0; $i < count($in_prolist_por); $i++) {

    $update_query = "UPDATE hj_lada SET ";

    $update_query .= "lot_date = '$date', ";

    $update_query .= "list_lot = '$list_lot' ";

    $update_query .= "WHERE ho = '$in_prolist_ho[$i]' AND por = '$in_prolist_por[$i]' AND qt_no = '$in_prolist_no[$i]' AND (hide_date IS NULL AND hide_name IS NULL) ";

    

    $update_result = mysqli_query($conn, $update_query);

    if(!$update_result) {

        die("공정리스트 LOT 번호 부여 에러...." . mysqli_error($conn));

    }



    // $update_query = "UPDATE hj_ladaList SET ";

    // $update_query .= "lot_date = '$date', ";

    // $update_query .= "list_lot = '$list_lot' ";

    // $update_query .= "WHERE ho = '$in_prolist_ho[$i]' AND por = '$in_prolist_por[$i]' AND qt_no = '$in_prolist_no[$i]' ";

    

    // $update_result = mysqli_query($conn, $update_query);

    // if(!$update_result) {

    //     die("공정리스트 LOT 번호 부여 에러...." . mysqli_error($conn));

    // }



    //********** 2023-05-09. 김한얼 팀장. 로그 기록 추가(도입기업 데이터 확인 - 05/08 요청사항) **********//

    $select_seq_query = "SELECT seq FROM hj_lada WHERE '$in_prolist_ho[$i]' AND por = '$in_prolist_por[$i]' AND qt_no = '$in_prolist_no[$i]' ";    

    $select_seq_result = mysqli_query($conn, $select_seq_query);

    while($seq_row = mysqli_fetch_assoc($select_seq_result)) {

        $seq = $seq_row['seq'];



        $id = $_COOKIE['HPID'];

        $name = $_COOKIE['HPNAME'];

        $date2 = date("Y-m-d h:i:s");

        $func = $date . '_' . $list_lot . " 공정리스트 LOT번호 부여";



        $logInsert_query = "INSERT INTO hj_log SET ";

        $logInsert_query .= "ho = '$in_prolist_ho[$i]', ";

        $logInsert_query .= "por = '$in_prolist_por[$i]', ";

        $logInsert_query .= "seq = '$seq', ";

        $logInsert_query .= "qt_no = '$in_prolist_no[$i]', ";

        $logInsert_query .= "id = '$id', ";

        $logInsert_query .= "name = '$name', ";

        $logInsert_query .= "func = '$func', ";

        $logInsert_query .= "date = '$date2' ";



        $logInsert_result = mysqli_query($conn, $logInsert_query);

        if(!$logInsert_result) {

            die("로그 데이터 등록 오류........" . mysqli_error($conn));

        }

    }

    // *********************************************************************************************//

  }

  

}

//*******************************************************************************************************//



//**************************************공정 리스트 - 리스트 제목 수정**************************************//

if(isset($_POST['prolist_titUp2'])) {

    $list_title = $_POST['list_title'];

    $lot_date = $_POST['lot_date'];

    $list_lot = $_POST['list_lot'];



    $update_query = "UPDATE hj_lada SET ";

    $update_query .= "list_title = '$list_title' ";

    $update_query .= "WHERE lot_date = '$lot_date' AND list_lot = '$list_lot' ";



    $update_result = mysqli_query($conn, $update_query);

    if(!$update_result) {

        die("공정 리스트 제목 수정 에러....." . mysqli_error($conn));

    }



    // $update_query2 = "UPDATE hj_ladaList SET ";

    // $update_query2 .= "list_title = '$list_title' ";

    // $update_query2 .= "WHERE lot_date = '$lot_date' AND list_lot = '$list_lot' ";



    // $update_result2 = mysqli_query($conn, $update_query2);

    // if(!$update_result2) {

    //     die("공정 리스트 제목 수정 복사본 에러....." . mysqli_error($conn));

    // }



    $id = $_COOKIE['HPID'];

    $name = $_COOKIE['HPNAME'];

    $date = date("Y-m-d h:i:s");

    $func = 'LOT번호(' . $lot_date . '_' . $list_lot . ') -> 제목 변경 : ' . $list_title;



    $logInsert_query = "INSERT INTO hj_log SET ";

    $logInsert_query .= "ho = NULL, ";

    $logInsert_query .= "por = NULL, ";

    $logInsert_query .= "seq = NULL, ";

    $logInsert_query .= "qt_no = NULL, ";

    $logInsert_query .= "id = '$id', ";

    $logInsert_query .= "name = '$name', ";

    $logInsert_query .= "func = '$func', ";

    $logInsert_query .= "date = '$date' ";



    $logInsert_result = mysqli_query($conn, $logInsert_query);

    if(!$logInsert_result) {

        die("로그 데이터 등록 오류........" . mysqli_error($conn));

    }

}

//*******************************************************************************************************//



























?>