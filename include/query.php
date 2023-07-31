<?php include "dbcon.php"; ?>
<?php header("Content-Type:text/html;charset=utf-8"); ?>
<?php
    // include_once 'lib/PHPExcel.php';
    // require_once("lib/PHPExcel/IOFactory.php");
    // require_once("lib/PHPExcel/Reader/Excel2007.php");
?>
<?php

//**************************************수주 관리 - 도면 등록**************************************//
// if(isset($_POST['draw_upload'])) {
//   $POR_NO = $_POST['draw_upload_porNo'];
//
//   $ho = substr($POR_NO, 0, 4);
//   $por = substr($POR_NO, 4, 6);
//   $upload_day = date("Y-m-d");
//
//   $por = mysqli_real_escape_string($conn, $por);
//   $ho = mysqli_real_escape_string($conn, $ho);
//   $upload_day = mysqli_real_escape_string($conn, $upload_day);
//
//   $insert_query = "INSERT INTO hj_draw SET ";
//   $insert_query .= "por = '$por', ";
//   $insert_query .= "ho = '$ho', ";
//   $insert_query .= "upload_day = '$upload_day' ";
//
//   $insert_result = mysqli_query($conn, $insert_query);
//   if(!$insert_result) {
//     die("도면 등록 에러..." . mysqli_error($conn));
//   }
// }
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
    location.replace('/hj/sub01/sub0101.php');
  </script>";
}
//*******************************************************************************************************//

//**************************************수주 관리 - PDF 도면 등록**************************************//
if(isset($_FILES['draw_file2'])) {
    $POR_NO = $_FILES['draw_file2'];

    $file_name = $POR_NO['name']; // 파일 명
    $file_size = $POR_NO['size']; // 파일 사이즈
    $file_type = $POR_NO['type']; // 파일 타입
    $tmp_name = $POR_NO['tmp_name']; // 파일 tmp name;
    // print_r($file_name) . '<br>';

    $dataFile = "../sub01/draw_folder/" . $file_name;

    move_uploaded_file($tmp_name, $dataFile);

    $ho = $_POST['draw_ho'];
    $por = $_POST['draw_por'];

    $update_query = "UPDATE hj_draw SET ";
    $update_query .= "draw_file = '$file_name' ";
    $update_query .= "WHERE ho = '$ho' AND por = '$por' ";
    // echo $update_query . '<br>';

    $update_result = mysqli_query($conn, $update_query);
    if(!$update_result) {
        die("도면 등록 에러....." . mysqli_error($conn));
    }

    echo "<script>
        alert('도면 업로드를 완료했습니다.');
        location.replace('/hj/sub02/sub0201.php');
    </script>";
}
//*******************************************************************************************************//

//**************************************수주 관리 - 도면 삭제**************************************//
if(isset($_POST['draw_delete'])) {
  $por_no = $_POST['draw_delPorNo'];
  $draw_delPorNo = $_POST['draw_delPorNo'];
  $ho = substr($draw_delPorNo, 0, 4);
  $por = substr($draw_delPorNo, 4, 6);

  $delete_query1 = "DELETE FROM hj_draw WHERE ho = '$ho' AND por = '$por' ";
  $delete_result1 = mysqli_query($conn, $delete_query1);
  if(!$delete_result1) {
    die("도면 삭제 에러1....." . mysqli_error($conn));
  }

  $delete_query2 = "DELETE FROM hj_cutting WHERE ho = '$ho' AND por = '$por' ";
  $delete_result2 = mysqli_query($conn, $delete_query2);
  if(!$delete_result2) {
    die("도면 삭제 에러2....." . mysqli_error($conn));
  }
}
//*******************************************************************************************************//


//**************************************수주 관리 - 컷팅지 등록**************************************//
if(isset($_POST['pro_start'])) {
  $por_no = $_POST['por_no'];
  $draw_no = $_POST['draw_no'];

  $ho = substr($por_no, 0, 4);
  $por = substr($por_no, 4, 6);

  $por = mysqli_real_escape_string($conn, $por);
  $ho = mysqli_real_escape_string($conn, $ho);

  $update_query = "UPDATE hj_draw SET ";
  $update_query .= "STAT = '생산지시' ";
  $update_query .= "WHERE no = '$draw_no' ";

  $update_result = mysqli_query($conn, $update_query);
  if(!$update_result) {
    die("안됨...".mysqli_error($conn));
  }

  $insert_query = "INSERT INTO hj_pro SET ";
  $insert_query .= "por = '$por', ";
  $insert_query .= "ho = '$ho' ";

  $insert_result = mysqli_query($conn, $insert_query);
  if(!$insert_result) {
    die("도면 등록 에러..." . mysqli_error($conn));
  }

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
      $insert_query = "INSERT INTO hj_cutting SET ";
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
      location.replace('/hj/sub01/sub0101_detail.php?por_no=$ho$por');
    </script>";
  }

}
//*******************************************************************************************************//

//**************************************수주 상세 - 중량 등록**************************************//
// if(isset($_POST['add_weight'])) {
//   $weight_in = json_decode($_POST['weight_in']);
//   $no_in = json_decode($_POST['no_in']);
//
//
//   for($i = 0; $i < count($no_in); $i++) {
//
//     $weight_in[$i] == '' ? $weight_in[$i] = 0 : $weight_in[$i];
//
//     $update_query = "UPDATE hj_cutting SET ";
//     $update_query .= "weight = '$weight_in[$i]' ";
//     $update_query .= "WHERE no = '$no_in[$i]' ";
//
//     $update_result = mysqli_query($conn, $update_query);
//     if(!$update_result) {
//       die("중량 추가 오류...." . mysqli_error($conn));
//     }
//   }
// }
//*******************************************************************************************************//

//**************************************수주 상세 - 물량 산출 등록**************************************//
if(isset($_POST['quantity_seq'])) {
  $quantity_ho = $_POST['quantity_ho'];
  $quantity_por = $_POST['quantity_por'];
  $quantity_count = json_decode($_POST['quantity_count']);
  $quantity_seq = json_decode($_POST['quantity_seq']);
  $weight_in = json_decode($_POST['weight_in']);

  $select_query = "SELECT MAX(qt_no * 1) AS MAX_qt_no FROM hj_quantity WHERE quantity_ok IS NULL AND qt_no != '긴급' ";
  $select_result = mysqli_query($conn, $select_query);
  $row = mysqli_fetch_assoc($select_result);
  $MAX_qt_no = $row['MAX_qt_no'];

  if($MAX_qt_no === null) {
    $MAX_qt_no = 1;
  } else if($MAX_qt_no !== null) {

    $MAX_qt_no = $MAX_qt_no + 1;

    // $select_query2 = "SELECT MAX(qt_no) AS MAX_qt_no FROM hj_quantity WHERE ho = '$quantity_ho' AND por = '$quantity_por' AND quantity_ok IS NULL ";
    // $select_result2 = mysqli_query($conn, $select_query2);
    // $row2 = mysqli_fetch_assoc($select_result2);
    // $another = $row2['MAX_qt_no'];
    //
    // if($another !== null) {
    //   $MAX_qt_no = $MAX_qt_no + 1;
    // } else if($another === null) {
    //   $MAX_qt_no = $MAX_qt_no + 1;
    // }
  }

  for($i = 0; $i < count($quantity_seq); $i++) {
    $insert_query = "INSERT INTO hj_quantity SET ";
    $insert_query .= "qt_no = '$MAX_qt_no', ";
    $insert_query .= "ho = '$quantity_ho', ";
    $insert_query .= "por = '$quantity_por', ";
    $insert_query .= "seq = '$quantity_seq[$i]', ";
    $insert_query .= "count = '$quantity_count[$i]', ";
    $insert_query .= "weight = '$weight_in[$i]' ";

    $insert_result = mysqli_query($conn, $insert_query);
    if(!$insert_result) {
      die("물량 등록 에러..." . mysqli_error($conn));
    }
  }
}
//*******************************************************************************************************//

//**************************************수주 상세 - 컷팅지 데이터 초기화**************************************//
if(isset($_POST['quantity_del'])) {
  $del_ho = $_POST['del_ho'];
  $del_por = $_POST['del_por'];

  $delete_query = "DELETE FROM hj_cutting WHERE ho = '$del_ho' AND por = '$del_por' ";
  $delete_result = mysqli_query($conn, $delete_query);
  if(!$delete_result) {
    die("컷팅지 데이터 초기화 에러......." . mysqli_error($conn));
  }
}
//*******************************************************************************************************//

//**************************************수주 상세 - 긴급 물량 등록**************************************//
if(isset($_POST['emg_quantity_seq'])) {
  $quantity_ho = $_POST['emg_quantity_ho'];
  $quantity_por = $_POST['emg_quantity_por'];
  $quantity_count = json_decode($_POST['emg_quantity_count']);
  $quantity_seq = json_decode($_POST['emg_quantity_seq']);
  $weight_in = json_decode($_POST['emg_weight_in']);
  $qt_no = "긴급";

  for($i = 0; $i < count($quantity_seq); $i++) {
    $insert_query = "INSERT INTO hj_quantity SET ";
    $insert_query .= "qt_no = '$qt_no', ";
    $insert_query .= "ho = '$quantity_ho', ";
    $insert_query .= "por = '$quantity_por', ";
    $insert_query .= "seq = '$quantity_seq[$i]', ";
    $insert_query .= "count = '$quantity_count[$i]', ";
    $insert_query .= "weight = '$weight_in[$i]' ";

    $insert_result = mysqli_query($conn, $insert_query);
    if(!$insert_result) {
      die("물량 등록 에러..." . mysqli_error($conn));
    }
  }
}
//*******************************************************************************************************//


//**************************************수주 등록 - 개정도 수정**************************************//
if(isset($_POST['revision_update'])) {
    $revision = $_POST['draw_revision'];
    $ho = $_POST['revision_ho'];
    $por = $_POST['revision_por'];

    $page = $_POST['page'];
    $search_ho = $_POST['search_ho'];
    $search_por = $_POST['search_por'];
    
    $update_query = "UPDATE hj_draw SET ";
    $update_query .= "revision = '$revision' ";
    $update_query .= "WHERE ho = '$ho' AND por = '$por' ";

    $update_result = mysqli_query($conn, $update_query);
    if(!$update_result) {
        die("개정도 수정 에러......" . mysqli_error($conn));
    } else {
      echo "location.replace('/hj/sub02/sub0201.php?page=$page&search_ho=$search_ho&search_por=$search_por');";
    }
}
//*******************************************************************************************************//

//**************************************물량 산출 - 전체 취소 기능**************************************//
if(isset($_POST['quantity_delete'])) {
  $quantity_no = json_decode($_POST['quantity_delNo']);

  for($i = 0; $i < count($quantity_no); $i++) {
    $delete_query = "DELETE FROM hj_quantity WHERE no = $quantity_no[$i] ";
    $delete_result = mysqli_query($conn, $delete_query);

    if(!$delete_result) {
      die("물량취소 에러..." . mysqli_error($conn));
    }
  }
}
//*******************************************************************************************************//

//**************************************물량 산출 - 공정리스트 등록**************************************//
if(isset($_POST['input_prolist'])) {
  $input_ho = json_decode($_POST['input_ho']);
  $input_por = json_decode($_POST['input_por']);
  $input_seq = json_decode($_POST['input_seq']);
  $input_qt_no = json_decode($_POST['input_qt_no']);
  $date = date("Y-m-d");

  for($i = 0; $i < count($input_seq); $i++) {
    $update_query = "UPDATE hj_quantity SET ";
    $update_query .= "quantity_ok = '$date' ";
    $update_query .= "WHERE ho = '$input_ho[$i]' AND por = '$input_por[$i]' AND seq = '$input_seq[$i]' AND qt_no = '$input_qt_no[$i]' ";

    $update_result = mysqli_query($conn, $update_query);
    if(!$update_result) {
      die("물량 산출 -> 공정리스트 등록 오류" . mysqli_error($conn));
    } else {
      $insert_query = "INSERT INTO hj_prolist SET ";
      $insert_query .= "ho = '$input_ho[$i]', ";
      $insert_query .= "por = '$input_por[$i]', ";
      $insert_query .= "seq = '$input_seq[$i]', ";
      $insert_query .= "qt_no = '$input_qt_no[$i]' ";

      $insert_result = mysqli_query($conn, $insert_query);
      if(!$insert_result) {
        die("공정리스트 등록 에러....." . mysqli_error($conn));
      }


    }

  }
}
//*******************************************************************************************************//

//**************************************물량 산출 - 전체 저장 기능**************************************//
if(isset($_POST['other_update'])) {
  $no = json_decode($_POST['no']);
  $money = json_decode($_POST['money']);
  $other = json_decode($_POST['other']);
  $pro_date = json_decode($_POST['pro_date']);
  $mp_date = json_decode($_POST['mp_date']);

  for($i = 0; $i < count($no); $i++) {
    $update_query = "UPDATE hj_quantity SET ";
    $update_query .= "money = '$money[$i]', ";
    $update_query .= "other = '$other[$i]', ";
    $update_query .= "pro_date = '$pro_date[$i]', ";
    $update_query .= "mp_date = '$mp_date[$i]' ";
    $update_query .= "WHERE no = '$no[$i]' ";

    $update_result = mysqli_query($conn, $update_query);
    if(!$update_result) {
      die("물량 정보 전체 저작 요류...." . mysqli_error($conn));
    }
  }
}
//*******************************************************************************************************//

//**************************************물량 산출 - 공정리스트 등록**************************************//
if(isset($_POST['emg_prolist'])) {
  $emg_input_ho = json_decode($_POST['emg_input_ho']);
  $emg_input_por = json_decode($_POST['emg_input_por']);
  $emg_input_seq = json_decode($_POST['emg_input_seq']);
  $emg_input_qt_no = json_decode($_POST['emg_input_qt_no']);
  $emg_list_title = $_POST['emg_list_title'];
  $date = date("Y-m-d");

  $select_query = "SELECT lot_date, list_lot FROM hj_prolist WHERE list_title = '$emg_list_title' ";
  $select_result = mysqli_query($conn, $select_query);
  $row = mysqli_fetch_assoc($select_result);
  $lot_date = $row['lot_date'];
  $list_lot = $row['list_lot'];

  for($i = 0; $i < count($emg_input_qt_no); $i++) {

    $update_query = "UPDATE hj_quantity SET ";
    $update_query .= "quantity_ok = '$lot_date' ";
    $update_query .= "WHERE ho = '$emg_input_ho[$i]' AND por = '$emg_input_por[$i]' AND seq = '$emg_input_seq[$i]' AND qt_no = '$emg_input_qt_no[$i]' ";

    $update_result = mysqli_query($conn, $update_query);
    if(!$update_result) {
      die("물량 산출 -> 공정리스트 등록 오류" . mysqli_error($conn));
    } else {
      $insert_query = "INSERT INTO hj_prolist SET ";
      $insert_query .= "ho = '$emg_input_ho[$i]', ";
      $insert_query .= "por = '$emg_input_por[$i]', ";
      $insert_query .= "seq = '$emg_input_seq[$i]', ";
      $insert_query .= "qt_no = '$emg_input_qt_no[$i]', ";
      $insert_query .= "list_lot = '$list_lot', ";
      $insert_query .= "lot_date = '$lot_date', ";
      $insert_query .= "list_title = '$emg_list_title' ";

      $insert_result = mysqli_query($conn, $insert_query);
      if(!$insert_result) {
        die("공정리스트 등록 에러....." . mysqli_error($conn));
      }
    }

  }
}
//*******************************************************************************************************//

//**************************************공정 리스트 - 리스트 제목 수정**************************************//
if(isset($_POST['prolist_titUp'])) {
  $list_title = $_POST['list_title'];
  $lot_date = $_POST['lot_date'];
  $list_lot = $_POST['list_lot'];

  $update_query = "UPDATE hj_prolist SET ";
  $update_query .= "list_title = '$list_title' ";
  $update_query .= "WHERE lot_date = '$lot_date' AND list_lot = '$list_lot' ";

  $update_result = mysqli_query($conn, $update_query);
  if(!$update_result) {
    die("공정 리스트 제목 수정 에러....." . mysqli_error($conn));
  }
}
//*******************************************************************************************************//

//**************************************공정 리스트 - 선택한 공정 취소**************************************//
if(isset($_POST['prolist_delete'])) {
  $prolist_qtNo = json_decode($_POST['prolist_qtNo']);
  $prolist_ho = json_decode($_POST['prolist_ho']);
  $prolist_por = json_decode($_POST['prolist_por']);

  for($i = 0; $i < count($prolist_qtNo); $i++) {

    $delete_query = "DELETE FROM hj_prolist WHERE ho = '$prolist_ho[$i]' AND por = '$prolist_por[$i]' AND qt_no = '$prolist_qtNo[$i]' ";
    
    $select_query = "SELECT seq FROM hj_prolist WHERE ho = '$prolist_ho[$i]' AND por = '$prolist_por[$i]' AND qt_no = '$prolist_qtNo[$i]' ";
    $select_result = mysqli_query($conn, $select_query);
    while($row = mysqli_fetch_assoc($select_result)) {
        $seq = $row['seq'];

        $update_query = "UPDATE hj_quantity SET ";
        $update_query .= "quantity_ok = NULL ";
        $update_query .= "WHERE ho = '$prolist_ho[$i]' AND por = '$prolist_por[$i]' AND seq = '$seq' ";

        $update_result = mysqli_query($conn, $update_query);
        if(!$update_result) {
            die("물량 산출 등록일 초기화 에러....." . mysqli_error($conn));
        }
    }
    
    $delete_result = mysqli_query($conn, $delete_query);
    if(!$delete_result) {
      die("공정 리스트 취소 에러..." . mysqli_error($conn));
    }

  }
}
//*******************************************************************************************************//

//**************************************공정 리스트 - 전체 저장 기능**************************************//
if(isset($_POST['other_update2'])) {
  $prolist_ho = json_decode($_POST['prolist_ho']);
  $prolist_por = json_decode($_POST['prolist_por']);
  $series = json_decode($_POST['series']);
//   $pro_date = json_decode($_POST['pro_date']);
//   $mp_date = json_decode($_POST['mp_date']);
  $sp = json_decode($_POST['sp']);
  $qt_no = json_decode($_POST['upQt_no']);
//   $revision = json_decode($_POST['revision']);

  for($i = 0; $i < count($prolist_ho); $i++) {
    $update_query = "UPDATE hj_prolist SET ";
    $update_query .= "series = '$series[$i]', ";
    $update_query .= "sp = '$sp[$i]' ";
    // $update_query .= "revision = '$revision[$i]' ";
    $update_query .= "WHERE ho = '$prolist_ho[$i]' AND por = '$prolist_por[$i]' AND qt_no = '$qt_no[$i]' ";

    $update_result = mysqli_query($conn, $update_query);
    if(!$update_result) {
      die("공정 리스트 정보 전체 저작 요류...." . mysqli_error($conn));
    }

    // 2023-02-09. 김한얼 팀장. 제작 납기 / MP 납기 일정 등록 안되는 오류 수정
    // Old Code
    // if($pro_date[$i] == '') {
    //     $pro_date[$i] = null;
    // }

    // $update_query2 = "UPDATE hj_quantity SET ";
    // $update_query2 .= "pro_date = '$pro_date[$i]', ";
    // $update_query2 .= "mp_date = '$mp_date[$i]' ";
    // $update_query2 .= "WHERE ho = '$prolist_ho[$i]' AND por = '$prolist_por[$i]' ";

    // $update_result2 = mysqli_query($conn, $update_query2);
    // if(!$update_result2) {
    //   die("공정 리스트 정보 전체 저작 요류...." . mysqli_error($conn));
    // }
  }
}
//*******************************************************************************************************//

//**************************************공정 리스트 - 제작 납기 자동 저장**************************************//
// 2023-02-09. 김한얼 팀장. 제작 납기 / MP 납기 일정 등록 안되는 오류 수정
// New Code - 제작 납기 등록
if(isset($_POST['proDate_up'])) {
    $pro_date = $_POST['pro_date'];
    $ho = $_POST['ho'];
    $por = $_POST['por'];
    $qt_no = $_POST['qt_no'];

    $select_query = "SELECT * FROM hj_prolist WHERE ho = '$ho' AND por = '$por' AND qt_no = '$qt_no' ";
    $select_result = mysqli_query($conn, $select_query);
    while($row = mysqli_fetch_assoc($select_result)) {
        $seq = $row['seq'];

        $update_query2 = "UPDATE hj_quantity SET ";
        $update_query2 .= "pro_date = '$pro_date' ";
        $update_query2 .= "WHERE ho = '$ho' AND por = '$por' AND seq = '$seq' ";

        $update_result2 = mysqli_query($conn, $update_query2);
        if(!$update_result2) {
            die("공정 리스트 정보 전체 저작 요류...." . mysqli_error($conn));
        }
    };
    
}
//*******************************************************************************************************//

//**************************************공정 리스트 - MP 납기 자동 저장**************************************//
// 2023-02-09. 김한얼 팀장. 제작 납기 / MP 납기 일정 등록 안되는 오류 수정
// New Code - MP 납기 등록
if(isset($_POST['mpDate_up'])) {
    $mp_date = $_POST['mp_date'];
    $ho = $_POST['ho'];
    $por = $_POST['por'];
    $qt_no = $_POST['qt_no'];

    $select_query = "SELECT * FROM hj_prolist WHERE ho = '$ho' AND por = '$por' AND qt_no = '$qt_no' ";
    $select_result = mysqli_query($conn, $select_query);
    while($row = mysqli_fetch_assoc($select_result)) {
        $seq = $row['seq'];

        $update_query2 = "UPDATE hj_quantity SET ";
        $update_query2 .= "mp_date = '$mp_date' ";
        $update_query2 .= "WHERE ho = '$ho' AND por = '$por' AND seq = '$seq' ";

        $update_result2 = mysqli_query($conn, $update_query2);
        if(!$update_result2) {
            die("공정 리스트 정보 전체 저작 요류...." . mysqli_error($conn));
        }
    };
    
}
//*******************************************************************************************************//


//**************************************공정 리스트 - LOT 번호 부여**************************************//
if(isset($_POST['insert_proList'])) {
  $in_prolist_no = json_decode($_POST['in_prolist_no']);
  $in_prolist_ho = json_decode($_POST['in_prolist_ho']);
  $in_prolist_por = json_decode($_POST['in_prolist_por']);
  
  $date = date("Y-m-d");
  
  $select_query = "SELECT MAX(list_lot) AS MAX_list_lot FROM hj_prolist WHERE lot_date = '$date' ";
  $select_result = mysqli_query($conn, $select_query);
  $row = mysqli_fetch_assoc($select_result);
  $MAX_list_lot = $row['MAX_list_lot'];

  if($MAX_list_lot == null) {
    $list_lot = 1;
  } else {
    $list_lot = $MAX_list_lot + 1;
  }

  for($i = 0; $i < count($in_prolist_por); $i++) {
    $update_query = "UPDATE hj_prolist SET ";
    $update_query .= "lot_date = '$date', ";
    $update_query .= "list_lot = '$list_lot' ";
    $update_query .= "WHERE ho = '$in_prolist_ho[$i]' AND por = '$in_prolist_por[$i]' AND qt_no = '$in_prolist_no[$i]' ";
    
    // echo $update_query . '<br>';
    $update_result = mysqli_query($conn, $update_query);
    if(!$update_result) {
        die("공정리스트 LOT 번호 부여 에러...." . mysqli_error($conn));
    }
  }
  
}
//*******************************************************************************************************//

//**************************************공정 리스트 - NO 변경**************************************//
// 2022-12-12. 김한얼. No(qt_no) 변경 요구사항 반영
if(isset($_POST['add_prolist'])) {
    $ho = $_POST['prolist_ho'];
    $por = $_POST['prolist_por'];
    $qt_no = $_POST['update_qtNo'];
    $seq = json_decode($_POST['prolist_seq']);

    for($i = 0; $i < count($seq); $i++) {
        $update_query = "UPDATE hj_prolist SET ";
        $update_query .= "qt_no = '$qt_no' ";
        $update_query .= "WHERE ho = '$ho' AND por = '$por' AND seq = '$seq[$i]' ";

        $update_result = mysqli_query($conn, $update_query);
        if(!$update_result) {
            die("NO 변경 오류....." . mysqli_error($conn));
        }
    }
}
//*******************************************************************************************************//

//**************************************컷팅지 인쇄 - 라벨 마킹대기 등록**************************************//
// 2022-12-20. 김한얼 대리. 마킹기계 등록 전 데이터 흐름
if(isset($_POST['label_wait'])) {
    $ho = json_decode($_POST['labelWait_ho']);
    $por = json_decode($_POST['labelWait_por']);
    $seq = json_decode($_POST['labelWait_seq']);
    $paint = json_decode($_POST['labelWait_paint']);
    $wait_date = date("Y-m-d");

    for($i = 0; $i < count($ho); $i++) {
        // $select_query = "SELECT MAX(la_no) AS max_la_no FROM hj_label WHERE wait_date = '$wait_date' ";
        // $select_result = mysqli_query($conn, $select_query);
        // $row = mysqli_fetch_assoc($select_result);
        // $max_la_no = $row['max_la_no'];

        // if($max_la_no == null or $max_la_no == 0) {
        //   $max_la_no = 1;
        // } else {
        //   $max_la_no = $max_la_no + 1;
        // }

        $select_query = "SELECT MAX(la_no) AS max_la_no FROM hj_label ";
        $select_result = mysqli_query($conn, $select_query);
        $row = mysqli_fetch_assoc($select_result);
        $max_la_no = $row['max_la_no'];

        if($max_la_no == null or $max_la_no == 0) {
          $max_la_no = 1;
        } else {
          $max_la_no = $max_la_no + 1;
        }

        $insert_query = "INSERT INTO hj_label SET ";
        $insert_query .= "ho = '$ho[$i]', ";
        $insert_query .= "por = '$por[$i]', ";
        $insert_query .= "seq = '$seq[$i]', ";
        $insert_query .= "paint = '$paint[$i]', ";
        $insert_query .= "block = '-', ";
        $insert_query .= "pcs = '-', ";
        $insert_query .= "lot = '-', ";
        $insert_query .= "wait_date = '$wait_date', ";
        $insert_query .= "la_no = '$max_la_no', ";
        $insert_query .= "stat = '마킹대기' ";

        $insert_result = mysqli_query($conn, $insert_query);
        if(!$insert_result) {
            die("라벨 마킹대기 등록 에러....." . mysqli_error($conn));
        }
    }
}
//**********************************************************************************************************//

//**************************************라벨 마킹대기 - 라벨 정보 등록**************************************//
// 2022-12-20. 김한얼 대리. 마킹기계 연동 데이터 생성
if(isset($_POST['label_start'])) {
    $la_no = $_POST['labelStart_laNo'];
    $no = $_POST['labelStart_no'];
    $other = $_POST['labelStart_other'];
    $count = $_POST['labelStart_count'];
    $date = date("Y-m-d");

    $update_query = "UPDATE hj_label SET ";
    $update_query .= "la_no = '$la_no', ";
    // $update_query .= "other = '$other', ";
    // $update_query .= "count = '$count', ";
    $update_query .= "date = '$date', ";
    $update_query .= "stat = '마킹' ";
    $update_query .= "WHERE no = '$no' ";

    $update_result = mysqli_query($conn, $update_query);
    if(!$update_result) {
        die("라벨 정보 등록 에러....." . mysqli_error($conn));
    }
}
//********************************************************************************************************//

//**************************************라벨 마킹대기 - 라벨 대기 삭제**************************************//
// 2022-12-20. 김한얼 대리. 마킹기계 연동 데이터 삭제
if(isset($_POST['labelWait_del'])) {
    $labelWait_delNo = $_POST['labelWait_delNo'];

    $delete_query = "DELETE FROM hj_label WHERE no = '$labelWait_delNo' ";
    $delete_result = mysqli_query($conn, $delete_query);
    if(!$delete_result) {
        die("라벨 대기 삭제 에러......" . mysqli_error($conn));
    }
}
//********************************************************************************************************//

//**************************************라벨 마킹 리스트- 라벨 정보 취소**************************************//
// 2022-12-20. 김한얼 대리. 마킹기계 연동 데이터 삭제
if(isset($_POST['label_cancle'])) {
    $labelCancle_no = $_POST['labelCancle_no'];

    $update_query = "UPDATE hj_label SET ";
    $update_query .= "date = NULL, ";
    $update_query .= "stat = '마킹대기' ";
    $update_query .= "WHERE no = '$labelCancle_no' ";

    $update_result = mysqli_query($conn, $update_query);
    if(!$update_result) {
        die("라벨 정보 취소 에러 ......." . mysqli_error($conn));
    }
}
//**********************************************************************************************************//


/***************************************** 생산관리 - 생산이전(수주관리)지시************************************/
if(isset($_POST['pre_input'])) {
  $pre_input = $_POST['pre_input'];
  $por_no = $_POST['por_no'];
  $ho = $_POST['ho'];
  $por = $_POST['por'];

  $select_query = "SELECT * FROM hj_draw WHERE ho = '$ho' AND por = '$por' ";
  $select_result = mysqli_query($conn, $select_query);
  $row = mysqli_fetch_assoc($select_result);
  $por_s = $row['por'];
  $ho_s = $row['ho'];
  $por_no_s = $por_s . $ho_s;


  if ($por_no = $por_no_s) {

    $delete_query = "DELETE FROM hj_pro WHERE no = '$pre_input' ";

    $delete_result = mysqli_query($conn, $delete_query);
    if(!$delete_result) {
      die("안됨..." . mysqli_error($conn));
    }

    $update_query = "UPDATE hj_draw SET ";
    $update_query .= "STAT = '생산대기' ";
    $update_query .= "WHERE ho = '$ho' ";

    $update_result = mysqli_query($conn, $update_query);
    if(!$update_result) {
      die("안됨...".mysqli_error($conn));
    }
  }
}
//*******************************************************************************************************//
/***************************************** 생산관리 - 벤딩(다음)지시*****************************************/
if(isset($_POST['next_pro_1'])) {
  $next_pro_1 = $_POST['next_pro_1'];

  $update_query = "UPDATE hj_pro SET ";
  $update_query .= "STAT = '벤딩' ";
  $update_query .= "WHERE no = '$next_pro_1' ";

  $update_result = mysqli_query($conn, $update_query);
  if(!$update_result) {
    die("안됨...".mysqli_error($conn));
  }
}
//*******************************************************************************************************//
/***************************************** 생산관리 - 절단(이전)지시*****************************************/
if(isset($_POST['pre_pro_1'])) {
  $pre_pro_1 = $_POST['pre_pro_1'];

  $update_query = "UPDATE hj_pro SET ";
  $update_query .= "STAT = '절단' ";
  $update_query .= "WHERE no = '$pre_pro_1' ";

  $update_result = mysqli_query($conn, $update_query);
  if(!$update_result) {
    die("안됨...".mysqli_error($conn));
  }
}
//*******************************************************************************************************//
/***************************************** 생산관리 - 취부(다음)지시*****************************************/
if(isset($_POST['next_pro_2'])) {
  $next_pro_2 = $_POST['next_pro_2'];

  $update_query = "UPDATE hj_pro SET ";
  $update_query .= "STAT = '취부' ";
  $update_query .= "WHERE no = '$next_pro_2' ";

  $update_result = mysqli_query($conn, $update_query);
  if(!$update_result) {
    die("안됨...".mysqli_error($conn));
  }
}
//*******************************************************************************************************//
/***************************************** 생산관리 - 벤딩(이전)지시*****************************************/
if(isset($_POST['pre_pro_2'])) {
  $pre_pro_2 = $_POST['pre_pro_2'];

  $update_query = "UPDATE hj_pro SET ";
  $update_query .= "STAT = '벤딩' ";
  $update_query .= "WHERE no = '$pre_pro_2' ";

  $update_result = mysqli_query($conn, $update_query);
  if(!$update_result) {
    die("안됨...".mysqli_error($conn));
  }
}
//*******************************************************************************************************//
/***************************************** 생산관리 - 용접(다음)지시*****************************************/
if(isset($_POST['next_pro_3'])) {
  $next_pro_3 = $_POST['next_pro_3'];

  $update_query = "UPDATE hj_pro SET ";
  $update_query .= "STAT = '용접' ";
  $update_query .= "WHERE no = '$next_pro_3' ";

  $update_result = mysqli_query($conn, $update_query);
  if(!$update_result) {
    die("안됨...".mysqli_error($conn));
  }
}
//*******************************************************************************************************//
/***************************************** 생산관리 - 취부(이전)지시*****************************************/
if(isset($_POST['pre_pro_3'])) {
  $pre_pro_3 = $_POST['pre_pro_3'];

  $update_query = "UPDATE hj_pro SET ";
  $update_query .= "STAT = '취부' ";
  $update_query .= "WHERE no = '$pre_pro_3' ";

  $update_result = mysqli_query($conn, $update_query);
  if(!$update_result) {
    die("안됨...".mysqli_error($conn));
  }
}
//*******************************************************************************************************//
/***************************************** 생산관리 - 용접(다음)지시*****************************************/
if(isset($_POST['next_pro_4'])) {
  $next_pro_4 = $_POST['next_pro_4'];

  $update_query = "UPDATE hj_pro SET ";
  $update_query .= "STAT = '사상' ";
  $update_query .= "WHERE no = '$next_pro_4' ";

  $update_result = mysqli_query($conn, $update_query);
  if(!$update_result) {
    die("안됨...".mysqli_error($conn));
  }
}
//*******************************************************************************************************//
/***************************************** 생산관리 - 취부(이전)지시*****************************************/
if(isset($_POST['pre_pro_4'])) {
  $pre_pro_4 = $_POST['pre_pro_4'];

  $update_query = "UPDATE hj_pro SET ";
  $update_query .= "STAT = '용접' ";
  $update_query .= "WHERE no = '$pre_pro_4' ";

  $update_result = mysqli_query($conn, $update_query);
  if(!$update_result) {
    die("안됨...".mysqli_error($conn));
  }
}
//*******************************************************************************************************//
//**************************************계정 관리 - 계정 추가**************************************//
if(isset($_POST['user_add'])) {
  $user_department = $_POST['user_department'];
  $user_name = $_POST['user_name'];
  $user_rank = $_POST['user_rank'];
  $user_id = $_POST['user_id'];
  $user_pw = password_hash($_POST['user_pw'], PASSWORD_DEFAULT);
  $user_contact = $_POST['user_contact'];
  $user_power = $_POST['user_power'];

  $insert_query = "INSERT INTO hj_user SET ";
  $insert_query .= "user_department = '$user_department', ";
  $insert_query .= "user_name = '$user_name', ";
  $insert_query .= "user_rank = '$user_rank', ";
  $insert_query .= "user_id = '$user_id', ";
  $insert_query .= "user_pw = '$user_pw', ";
  $insert_query .= "user_contact = '$user_contact', ";
  $insert_query .= "user_power = '$user_power' ";
  // echo $insert_query . "<br>";

  $insert_result = mysqli_query($conn, $insert_query);
  if(!$insert_result) {
    die("계정 등록 에러..." . mysqli_error($conn));
  }
}
//*******************************************************************************************************//
/***************************************** 계정관리 - 현재,새 비밀번호*****************************************/
if (isset($_POST['update_user'])) {
  $up_no = $_POST['up_no'];
  $up_user_department = $_POST['up_user_department'];
  $up_user_name = $_POST['up_user_name'];
  $up_user_rank = $_POST['up_user_rank'];
  $up_user_id = $_POST['up_user_id'];
  $current_password = $_POST['current_password'];
  $new_password = $_POST['new_password'];
  $up_user_contact = $_POST['up_user_contact'];
  $up_user_power = $_POST['up_user_power'];

  if($up_user_power == 'undefined' or $up_user_power == null) {
    $select_query = "SELECT * FROM hj_user WHERE no = '$up_no' ";
    $select_result = mysqli_query($conn, $select_query);
    $row = mysqli_fetch_assoc($select_result);

    $up_user_power = $row['user_power'];
  }

  $update_query2 = "UPDATE hj_user SET ";
  $update_query2 .= "user_department = '$up_user_department', ";
  $update_query2 .= "user_name = '$up_user_name', ";
  $update_query2 .= "user_rank = '$up_user_rank', ";
  $update_query2 .= "user_id = '$up_user_id', ";

  if($new_password != null or $new_password != "")  {
    $new_password = password_hash($new_password, PASSWORD_DEFAULT);
    $update_query2 .= "user_pw = '$new_password', ";
  }
  
  $update_query2 .= "user_contact = '$up_user_contact', ";
  $update_query2 .= "user_power = '$up_user_power' ";
  $update_query2 .= "WHERE no = '$up_no' ";

  $update_result2 = mysqli_query($conn, $update_query2);
  if(!$update_result2) {
    die("안됨...".mysqli_error($conn));
  }
}
//*******************************************************************************************************//
/***************************************** 계정관리 - 계정 삭제*****************************************/
if(isset($_POST['delete_user'])) {
  $up_no = $_POST['up_no'];

  $delete_query = "DELETE FROM hj_user WHERE no = '$up_no' ";
  $delete_result = mysqli_query($conn, $delete_query);
  if(!$delete_result) {
    die("입고 거래처 삭제 오류...." . mysqli_error($conn));
  }
}
//*******************************************************************************************************//






















//****************************************************** 평가용 기능(2022-12-28. 김한얼 대리) ******************************************************//
/***************************************** 사업장 정보관리 - 사업장 정보 등록 *****************************************/
if(isset($_POST['insert_company'])) {
    $name = $_POST['name'];
    $man = $_POST['man'];
    $addr = $_POST['addr'];
    $business = $_POST['business'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    $insert_query = "INSERT INTO hj_company SET ";
    $insert_query .= "name = '$name', ";
    $insert_query .= "man = '$man', ";
    $insert_query .= "addr = '$addr', ";
    $insert_query .= "business = '$business', ";
    $insert_query .= "phone = '$phone', ";
    $insert_query .= "email = '$email' ";

    $insert_result = mysqli_query($conn, $insert_query);
    if(!$insert_result) {
        die("사업장 정보 등록 오류 ......." . mysqli_error($conn));
    }
}
//******************************************************************************************************************//

/***************************************** 사업장 정보관리 - 사업장 정보 수정 *****************************************/
if(isset($_POST['upCompany_no'])) {
    $no = $_POST['upCompany_no'];
    $name = $_POST['name'];
    $man = $_POST['man'];
    $addr = $_POST['addr'];
    $business = $_POST['business'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    $update_query = "UPDATE hj_company SET ";
    $update_query .= "name = '$name', ";
    $update_query .= "man = '$man', ";
    $update_query .= "addr = '$addr', ";
    $update_query .= "business = '$business', ";
    $update_query .= "phone = '$phone', ";
    $update_query .= "email = '$email' ";
    $update_query .= "WHERE no = '$no' ";

    $update_result = mysqli_query($conn, $update_query);
    if(!$update_result) {
        die("사업장 정보 수정 오류......" . mysqli_error($conn));
    }
}
//******************************************************************************************************************//

/***************************************** 사용자 정보관리 - 사용자 권한 수정 *****************************************/
if(isset($_POST['power_update'])) {
    $user_id = $_POST['power_user_id'];
    $user_power = $_POST['user_power'];

    $update_query = "UPDATE hj_user SET ";
    $update_query .= "user_power = '$user_power' ";
    $update_query .= "WHERE user_id = '$user_id' ";

    $update_result = mysqli_query($conn, $update_query);
    if(!$update_result) {
        die("사용자 권한 수정 오류....." . mysqli_error($conn));
    }
}
//******************************************************************************************************************//

//**************************************** 평가용 기능(2022-12-29. 박중건 사원) **************************************//
//***************************************** 거래처 정보 관리 - 거래처 정보 등록 **************************************//
if(isset($_POST['add_account'])) {
    $name = $_POST['name'];
    $in_charge = $_POST['in_charge'];
    $address = $_POST['address'];
    $business = $_POST['business'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];

    $insert_query = "INSERT INTO hj_account SET ";
    $insert_query .= "name = '$name', ";
    $insert_query .= "in_charge = '$in_charge', ";
    $insert_query .= "address = '$address', ";
    $insert_query .= "business = '$business', ";
    $insert_query .= "email = '$email', ";
    $insert_query .= "contact = '$contact' ";

    $insert_result = mysqli_query($conn, $insert_query);
    if(!$insert_result) {
        die("거래처 정보 등록 오류 ......." . mysqli_error($conn));
    }
}
//******************************************************************************************************************//
//***************************************** 거래처 정보 관리 - 거래처 정보 수정 *****************************************/
if(isset($_POST['edit_account'])) {
    $no = $_POST['no'];
    $name = $_POST['name'];
    $in_charge = $_POST['in_charge'];
    $address = $_POST['address'];
    $business = $_POST['business'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];

    $update_query = "UPDATE hj_account SET ";
    $update_query .= "name = '$name', ";
    $update_query .= "in_charge = '$in_charge', ";
    $update_query .= "address = '$address', ";
    $update_query .= "business = '$business', ";
    $update_query .= "contact = '$contact', ";
    $update_query .= "email = '$email' ";
    $update_query .= "WHERE no = '$no' ";

    $update_result = mysqli_query($conn, $update_query);
    if(!$update_result) {
        die("거래처 정보 수정 오류....." . mysqli_error($conn));
    }
}
//******************************************************************************************************************//
//***************************************** 거래처 정보 관리 - 거래처 정보 삭제 *****************************************/
if(isset($_POST['delete_account'])) {
    $no = $_POST['no'];

    $delete_query = "DELETE FROM hj_account WHERE no = '$no' ";
    
    $delete_result = mysqli_query($conn, $delete_query);
    if(!$delete_result) {
        die("거래처 정보 삭제 오류...." . mysqli_error($conn));
    }
}
//******************************************************************************************************************//
//***************************************** 공통코드 관리 - 공통코드 정보 등록 **************************************//
if(isset($_POST['add_code'])) {
    $type = $_POST['type'];
    $name = $_POST['name'];
    $code = $_POST['code'];
    $possible = $_POST['possible'];

    $insert_query = "INSERT INTO hj_code SET ";
    $insert_query .= "type = '$type', ";
    $insert_query .= "name = '$name', ";
    $insert_query .= "code = '$code', ";
    $insert_query .= "possible = '$possible' ";

    $insert_result = mysqli_query($conn, $insert_query);
    if(!$insert_result) {
      die("공통코드 정보 등록 오류 ......." . mysqli_error($conn));
    }
}
//******************************************************************************************************************//
//***************************************** 공통코드 관리 - 공통코드 정보 삭제 *****************************************/
if(isset($_POST['delete_code'])) {
    $no = $_POST['no'];

    $delete_query = "DELETE FROM hj_code WHERE no = '$no' ";
    
    $delete_result = mysqli_query($conn, $delete_query);
    if(!$delete_result) {
      die("공통코드 정보 삭제 오류...." . mysqli_error($conn));
    }
}
//******************************************************************************************************************//
//***************************************** 제품마스터 관리 - 완제품 정보 등록 **************************************//
if(isset($_POST['add_product'])) {
    $type = $_POST['type'];
    $name = $_POST['name'];

    $insert_query = "INSERT INTO hj_product SET ";
    $insert_query .= "type = '$type', ";
    $insert_query .= "name = '$name' ";

    $insert_result = mysqli_query($conn, $insert_query);
    if(!$insert_result) {
      die("거래처 정보 등록 오류 ......." . mysqli_error($conn));
    }
}
//******************************************************************************************************************//
//***************************************** 제품마스터 관리 - 완제품 정보 수정 *****************************************/
if(isset($_POST['edit_product'])) {
    $no = $_POST['no'];
    $type = $_POST['type'];
    $name = $_POST['name'];

    $update_query = "UPDATE hj_product SET ";
    $update_query .= "type = '$type', ";
    $update_query .= "name = '$name' ";
    $update_query .= "WHERE no = '$no' ";

    $update_result = mysqli_query($conn, $update_query);
    if(!$update_result) {
        die("거래처 정보 수정 오류....." . mysqli_error($conn));
    }
}
//******************************************************************************************************************//
//***************************************** 제품마스터 관리 - 완제품 정보 삭제 *****************************************/
if(isset($_POST['delete_product'])) {
    $no = $_POST['no'];

    $delete_query = "DELETE FROM hj_product WHERE no = '$no' ";
    
    $delete_result = mysqli_query($conn, $delete_query);
    if(!$delete_result) {
      die("거래처 정보 삭제 오류...." . mysqli_error($conn));
    }
}
//******************************************************************************************************************//
//***************************************** 제품마스터 관리 - 완제품 정보 등록 **************************************//
if(isset($_POST['add_material'])) {
    $name = $_POST['name'];
    $standard = $_POST['standard'];
    $count = $_POST['count'];

    $insert_query = "INSERT INTO hj_material SET ";
    $insert_query .= "name = '$name', ";
    $insert_query .= "standard = '$standard', ";
    $insert_query .= "count = '$count' ";

    $insert_result = mysqli_query($conn, $insert_query);
    if(!$insert_result) {
      die("완제품 정보 등록 오류 ......." . mysqli_error($conn));
    }
}
//******************************************************************************************************************//
//***************************************** 제품마스터 관리 - 완제품 정보 수정 *****************************************/
if(isset($_POST['edit_material'])) {
    $no = $_POST['no'];
    $name = $_POST['name'];
    $standard = $_POST['standard'];
    $count = $_POST['count'];

    $update_query = "UPDATE hj_material SET ";
    $update_query .= "name = '$name', ";
    $update_query .= "standard = '$standard', ";
    $update_query .= "count = '$count' ";
    $update_query .= "WHERE no = '$no' ";

    $update_result = mysqli_query($conn, $update_query);
    if(!$update_result) {
        die("거래처 정보 수정 오류....." . mysqli_error($conn));
    }
}
//******************************************************************************************************************//
//***************************************** 제품마스터 관리 - 완제품 정보 삭제 *****************************************/
if(isset($_POST['delete_material'])) {
    $no = $_POST['no'];

    $delete_query = "DELETE FROM hj_material WHERE no = '$no' ";
    
    $delete_result = mysqli_query($conn, $delete_query);
    if(!$delete_result) {
      die("거래처 정보 삭제 오류...." . mysqli_error($conn));
    }
}
//******************************************************************************************************************//
//***************************************** 공정별 불량유형 관리  - 불량유형 정보 등록 **************************************//
if(isset($_POST['add_flaw'])) {
    $process = $_POST['process'];
    $flaw = $_POST['flaw'];

    $insert_query = "INSERT INTO hj_flaw SET ";
    $insert_query .= "process = '$process', ";
    $insert_query .= "flaw = '$flaw' ";

    $insert_result = mysqli_query($conn, $insert_query);
    if(!$insert_result) {
      die("불량유형 정보 등록 오류 ......." . mysqli_error($conn));
    }
}
//******************************************************************************************************************//
//***************************************** 공정별 불량유형 관리  - 불량유형 정보 수정 *****************************************/
if(isset($_POST['edit_flaw'])) {
    $no = $_POST['no'];
    $flaw = $_POST['flaw'];
    $process = $_POST['process'];

    $update_query = "UPDATE hj_flaw SET ";
    $update_query .= "flaw = '$flaw', ";
    $update_query .= "process = '$process' ";
    $update_query .= "WHERE no = '$no' ";

    $update_result = mysqli_query($conn, $update_query);
    if(!$update_result) {
        die("불량유형 정보 수정 오류....." . mysqli_error($conn));
    }
}
//******************************************************************************************************************//
//***************************************** 공정별 불량유형 관리  - 불량유형 정보 삭제 *****************************************/
if(isset($_POST['delete_flaw'])) {
    $no = $_POST['no'];

    $delete_query = "DELETE FROM hj_flaw WHERE no = '$no' ";
    
    $delete_result = mysqli_query($conn, $delete_query);
    if(!$delete_result) {
      die("불량유형 정보 삭제 오류...." . mysqli_error($conn));
    }
}
//******************************************************************************************************************//
//***************************************** 공정별 작업자  - 작업자 정보 등록 **************************************//
if(isset($_POST['add_worker'])) {
    $process = $_POST['process'];
    $power = $_POST['power'];
    $name = $_POST['name'];

    $insert_query = "INSERT INTO hj_worker SET ";
    $insert_query .= "process = '$process', ";
    $insert_query .= "power = '$power', ";
    $insert_query .= "name = '$name' ";

    $insert_result = mysqli_query($conn, $insert_query);
    if(!$insert_result) {
      die("작업자 정보 등록 오류 ......." . mysqli_error($conn));
    }
}
//******************************************************************************************************************//
//***************************************** 공정별 작업자  - 작업자 정보 수정 *****************************************/
if(isset($_POST['edit_worker'])) {
    $no = $_POST['no'];
    $power = $_POST['power'];
    $name = $_POST['name'];
    $process = $_POST['process'];

    $update_query = "UPDATE hj_worker SET ";
    $update_query .= "power = '$power', ";
    $update_query .= "name = '$name', ";
    $update_query .= "process = '$process' ";
    $update_query .= "WHERE no = '$no' ";

    $update_result = mysqli_query($conn, $update_query);
    if(!$update_result) {
        die("작업자 정보 수정 오류....." . mysqli_error($conn));
    }
}
//******************************************************************************************************************//
//***************************************** 공정별 작업자  - 작업자 정보 삭제 *****************************************/
if(isset($_POST['delete_worker'])) {
    $no = $_POST['no'];

    $delete_query = "DELETE FROM hj_worker WHERE no = '$no' ";
    
    $delete_result = mysqli_query($conn, $delete_query);
    if(!$delete_result) {
      die("작업자 정보 삭제 오류...." . mysqli_error($conn));
    }
}
//******************************************************************************************************************//
//***************************************** 작업표준서관리  - 표준서 정보 등록 **************************************//
if(isset($_POST['add_sop'])) {
    $process = $_POST['process'];
    $sequence = $_POST['sequence'];
    $corrective = $_POST['corrective'];
    $precaution = $_POST['precaution'];

    $insert_query = "INSERT INTO hj_sop SET ";
    $insert_query .= "process = '$process', ";
    $insert_query .= "sequence = '$sequence', ";
    $insert_query .= "corrective = '$corrective', ";
    $insert_query .= "precaution = '$precaution' ";

    $insert_result = mysqli_query($conn, $insert_query);
    if(!$insert_result) {
      die("작업자 정보 등록 오류 ......." . mysqli_error($conn));
    }
}
//******************************************************************************************************************//
//***************************************** 작업표준서관리  - 표준서 정보 수정 *****************************************/
if(isset($_POST['edit_sop'])) {
    $no = $_POST['no'];
    $sequence = $_POST['sequence'];
    $corrective = $_POST['corrective'];
    $precaution = $_POST['precaution'];
    $process = $_POST['process'];

    $update_query = "UPDATE hj_sop SET ";
    $update_query .= "sequence = '$sequence', ";
    $update_query .= "corrective = '$corrective', ";
    $update_query .= "precaution = '$precaution', ";
    $update_query .= "process = '$process' ";
    $update_query .= "WHERE no = '$no' ";

    $update_result = mysqli_query($conn, $update_query);
    if(!$update_result) {
        die("작업자 정보 수정 오류....." . mysqli_error($conn));
    }
}
//******************************************************************************************************************//
//***************************************** 작업표준서관리  - 표준서 정보 삭제 *****************************************/
if(isset($_POST['delete_sop'])) {
    $no = $_POST['no'];

    $delete_query = "DELETE FROM hj_sop WHERE no = '$no' ";
    
    $delete_result = mysqli_query($conn, $delete_query);
    if(!$delete_result) {
      die("작업자 정보 삭제 오류...." . mysqli_error($conn));
    }
}
//******************************************************************************************************************//
//***************************************** 완제품 관리  - 완제품 정보 등록 *****************************************/
if(isset($_POST['add_cutok'])) {
    $cut_name = $_POST['cut_name'];
    $cut_order = $_POST['cut_order'];
    $cut_addr = $_POST['cut_addr'];
    $cut_phone = $_POST['cut_phone'];

    $insert_query = "INSERT INTO hj_cutok set ";
    $insert_query .= "cut_name = '$cut_name', ";
    $insert_query .= "cut_order = '$cut_order', ";
    $insert_query .= "cut_addr = '$cut_addr', ";
    $insert_query .= "cut_phone = '$cut_phone' ";

    $insert_result = mysqli_query($conn, $insert_query);
    if(!$insert_result) {
        die("완제품 정보 등록 오류........." . mysqli_error($conn));
    }
}
//******************************************************************************************************************//


/***************************************** 평가용 기능(2022-12-30, 박중건 사원)*****************************************/
/***************************************** 출하지시 관리  - 출하지시 정보 등록 *******************************************/
if(isset($_POST['add_trans'])) {
    $code = $_POST['code'];
    $text = $_POST['text'];
    $account = $_POST['account'];

    $insert_query = "INSERT INTO hj_trans SET ";
    $insert_query .= "code = '$code', ";
    $insert_query .= "text = '$text', ";
    $insert_query .= "account = '$account' ";

    $insert_result = mysqli_query($conn, $insert_query);
    if(!$insert_result) {
      die("출하지시 정보 등록 오류 ......." . mysqli_error($conn));
    }
}
//******************************************************************************************************************//
/***************************************** 수송지시 관리  - 수송지시 정보 수정 *******************************************/
if(isset($_POST['edit_trans'])) {
    $no = $_POST['no'];
    $code = $_POST['code'];
    $text = $_POST['text'];
    $account = $_POST['account'];

    $update_query = "UPDATE hj_trans SET ";
    $update_query .= "code = '$code', ";
    $update_query .= "text = '$text', ";
    $update_query .= "account = '$account' ";
    $update_query .= "WHERE no = '$no' ";

   $update_result = mysqli_query($conn, $update_query);
    if(!$update_result) {
        die("출하지시 등록 오류....." . mysqli_error($conn));
    }
}
//******************************************************************************************************************//
/***************************************** 출하지시 관리  - 출하지시 정보 삭제*******************************************/
if(isset($_POST['delete_trans'])) {
    $no = $_POST['no'];

    $delete_query = "DELETE FROM hj_trans WHERE no = '$no' ";
    
    $delete_result = mysqli_query($conn, $delete_query);
    if(!$delete_result) {
      die("점검일지 정보 삭제 오류...." . mysqli_error($conn));
    }
}
//******************************************************************************************************************//
/***************************************** 출하지시 관리  - 출하지시 정보 등록 *******************************************/
if(isset($_POST['add_shipment'])) {
    $account = $_POST['account'];
    $name = $_POST['name'];
    $date = $_POST['date'];

    $insert_query = "INSERT INTO hj_shipment SET ";
    $insert_query .= "account = '$account', ";
    $insert_query .= "name = '$name', ";
    $insert_query .= "date = '$date' ";

    // echo $insert_query;

    $insert_result = mysqli_query($conn, $insert_query);
    if(!$insert_result) {
      die("출하지시 정보 등록 오류 ......." . mysqli_error($conn));
    }
}
//******************************************************************************************************************//
/***************************************** 출하지시 관리  - 출하지시 등록 *******************************************/
if(isset($_POST['edit_stat'])) {
    $no = $_POST['no'];

    $update_query = "UPDATE hj_shipment SET ";
    $update_query .= "stat = '출하' ";
    $update_query .= "WHERE no = '$no' ";

    // echo $insert_query;

   $update_result = mysqli_query($conn, $update_query);
    if(!$update_result) {
        die("출하지시 등록 오류....." . mysqli_error($conn));
    }
}
//******************************************************************************************************************//
/***************************************** 출하지시 관리  - 출하지시 정보 수정 *******************************************/
if(isset($_POST['edit_shipment'])) {
    $no = $_POST['no'];
    $name = $_POST['name'];

    $update_query = "UPDATE hj_shipment SET ";
    $update_query .= "name = '$name' ";
    $update_query .= "WHERE no = '$no' ";

   $update_result = mysqli_query($conn, $update_query);
    if(!$update_result) {
        die("출하지시 등록 오류....." . mysqli_error($conn));
    }
}
//******************************************************************************************************************//
/***************************************** 출하지시 관리  - 출하지시 정보 삭제*******************************************/
if(isset($_POST['delete_shipment'])) {
    $no = $_POST['no'];

    $delete_query = "DELETE FROM hj_shipment WHERE no = '$no' ";
    
    $delete_result = mysqli_query($conn, $delete_query);
    if(!$delete_result) {
      die("점검일지 정보 삭제 오류...." . mysqli_error($conn));
    }
}
//******************************************************************************************************************//
/************************************** 송장발행 - 송장출력, 출력일 등록****************************************************/
if(isset($_POST['shipment_print'])) {
    $no = $_POST['no'];
    $print_date = date("Y-m-d");

    $update_query = "UPDATE hj_shipment SET ";
    $update_query .= "stat = '송장출력', ";
    $update_query .= "print_date = '$print_date' ";
    $update_query .= "WHERE no = '$no' ";

   $update_result = mysqli_query($conn, $update_query);
    if(!$update_result) {
        die("출하지시 등록 오류....." . mysqli_error($conn));
    }
}
//******************************************************************************************************************//

// ********************************************2023-03-16. 김한얼 팀장. 평가용 기능 구현 *********************************************//

/************************************** 가공공정 관리 - 가공공정 등록****************************************************/
if(isset($_POST['add_pro2'])) {
    $por = $_POST['pro2_por'];
    $name = $_POST['pro2_name'];
    $count = $_POST['pro2_count'];

    $insert_query = "INSERT INTO hj_pro2 SET ";
    $insert_query .= "por = '$por', ";
    $insert_query .= "name = '$name', ";
    $insert_query .= "count = '$count' ";

    $insert_result = mysqli_query($conn, $insert_query);
    if(!$insert_result) {
        die("가공공정 등록 오류................" . mysqli_error($conn));
    }
}
//******************************************************************************************************************//

/************************************** 가공공정 관리 - 가공공정 등록****************************************************/
if(isset($_POST['edit_pro2'])) {
    $no = $_POST['pro2_no'];
    $por = $_POST['pro2_por'];
    $name = $_POST['pro2_name'];
    $count = $_POST['pro2_count'];

    $insert_query = "UPDATE hj_pro2 SET ";
    $insert_query .= "por = '$por', ";
    $insert_query .= "name = '$name', ";
    $insert_query .= "count = '$count' ";
    $insert_query .= "WHERE no = '$no' ";

    $insert_result = mysqli_query($conn, $insert_query);
    if(!$insert_result) {
        die("가공공정 수정 오류................" . mysqli_error($conn));
    }
}
//******************************************************************************************************************//

/************************************** 가공공정 관리 - 가공공정 삭제****************************************************/
if(isset($_POST['delete_pro2'])) {
  $no = $_POST['pro2_no'];

  $delete_query = "DELETE FROM hj_pro2 WHERE no = '$no' ";

  $delete_result = mysqli_query($conn, $delete_query);
  if(!$delete_result) {
    die("가공공정 삭제 오류.................." . mysqli_error($conn));
  }
}
//******************************************************************************************************************//

// **********************************************************************************************************************//

/***************************************** 설비 관리  - 점검일지 등록 *******************************************/
if(isset($_POST['add_check'])) {
    $equipment = $_POST['equipment'];
    $text = $_POST['text'];

    $insert_query = "INSERT INTO hj_check SET ";
    $insert_query .= "equipment = '$equipment', ";
    $insert_query .= "text = '$text' ";

    $insert_result = mysqli_query($conn, $insert_query);
    if(!$insert_result) {
      die("점검일지 정보 등록 오류 ......." . mysqli_error($conn));
    }
}
//******************************************************************************************************************//
/***************************************** 설비 관리  - 점검일지 삭제 *******************************************/
if(isset($_POST['delete_check'])) {
    $no = $_POST['no'];

    $delete_query = "DELETE FROM hj_check WHERE no = '$no' ";
    
    $delete_result = mysqli_query($conn, $delete_query);
    if(!$delete_result) {
      die("점검일지 정보 삭제 오류...." . mysqli_error($conn));
    }
}
//******************************************************************************************************************//
/***************************************** 설비이력 관리  - 설비이력 등록 *******************************************/
if(isset($_POST['add_record'])) {
    $equipment = $_POST['equipment'];
    $status = $_POST['status'];
    $plc = $_POST['plc'];
    $cloud = $_POST['cloud'];
    $date = $_POST['date'];

    $insert_query = "INSERT INTO hj_system_record SET ";
    $insert_query .= "equipment = '$equipment', ";
    $insert_query .= "status = '$status', ";
    $insert_query .= "plc = '$plc', ";
    $insert_query .= "cloud = '$cloud', ";
    $insert_query .= "date = '$date' ";

    $insert_result = mysqli_query($conn, $insert_query);
    if(!$insert_result) {
      die("설비이력 정보 등록 오류 ......." . mysqli_error($conn));
    }
}
//******************************************************************************************************************//
/***************************************** 설비이력 관리  - 설비이력 삭제 *******************************************/
if(isset($_POST['delete_record'])) {
    $no = $_POST['no'];

    $delete_query = "DELETE FROM hj_system_record WHERE no = '$no' ";
    
    $delete_result = mysqli_query($conn, $delete_query);
    if(!$delete_result) {
      die("설비이력 정보 삭제 오류...." . mysqli_error($conn));
    }
}
//******************************************************************************************************************//











//****************************************************** 평가용 기능(2022-12-28. 김한얼 대리) ******************************************************//
/***************************************** 수주완료 관리 - 수주완료 정보 삭제 *****************************************/
if(isset($_POST['cutok_del'])) {
  $quandel_ho = $_POST['quandel_ho'];
  $quandel_por = $_POST['quandel_por'];
  $quandel_seq = $_POST['quandel_seq'];

  $delete_query = "DELETE FROM hj_quantity WHERE ho = '$quandel_ho' AND por = '$quandel_por' AND seq = '$quandel_seq' ";
  $delete_result = mysqli_query($conn, $delete_query);
  if(!$delete_result) {
    die("수주완료 정보 삭제....." . mysqli_error($conn));
  }
}
//******************************************************************************************************************//

/***************************************** 완제품 관리 - 완제품 정보 등록 *****************************************/
if(isset($_POST['quan_del'])) {
    $cut_name = $_POST['cut_name'];
    $cut_order = $_POST['cut_order'];
    $cut_addr = $_POST['cut_addr'];
    $cut_phone = $_POST['cut_phone'];

    $insert_query = "INSERT INTO hj_cutok SET ";
    $insert_query .= "cut_name = '$cut_name', ";
    $insert_query .= "cut_order = '$cut_order', ";
    $insert_query .= "cut_addr = '$cut_addr', ";
    $insert_query .= "cut_phone = '$cut_phone' ";

    $insert_result = mysqli_query($conn, $insert_query);
    if(!$insert_result) {
      die("수주완료 정보 등록 오류....." . mysqli_error($conn));
    }
}
//******************************************************************************************************************//

/***************************************** 완제품 관리 - 완제품 정보 삭제 *****************************************/
if(isset($_POST['cutok_del'])) {
  $cutok_no = $_POST['cutok_no'];

  $delete_query = "DELETE FROM hj_cutok WHERE no = '$cutok_no' ";
  $delete_result = mysqli_query($conn, $delete_query);
  if(!$delete_result) {
    die("수주완료 정보 삭제....." . mysqli_error($conn));
  }
}
//******************************************************************************************************************//

/***************************************** 작업일보 관리 - 작업일보 정보 등록 *****************************************/
if(isset($_POST['add_daywork'])) {
    $work = $_POST['work'];
    $work_man = $_POST['work_man'];

    $insert_query = "INSERT INTO hj_daywork SET ";
    $insert_query .= "work = '$work', ";
    $insert_query .= "work_man = '$work_man' ";

    $insert_result = mysqli_query($conn, $insert_query);
    if(!$insert_result) {
      die("작업일보 정보 등록 오류....." . mysqli_error($conn));
    }
}
//******************************************************************************************************************//

/***************************************** 작업일보 관리 - 작업일보 정보 수정 *****************************************/
if(isset($_POST['edit_daywork'])) {
    $edit_work_no = $_POST['edit_work_no'];
    $edit_work = $_POST['edit_work'];
    $edit_work_man = $_POST['edit_work_man'];

    $update_query = "UPDATE hj_daywork SET ";
    $update_query .= "work = '$edit_work', ";
    $update_query .= "work_man = '$edit_work_man' ";
    $update_query .= "WHERE no = '$edit_work_no' ";

    $update_result = mysqli_query($conn, $update_query);
    if(!$update_result) {
      die("작업일보 정보 수정 오류....." . mysqli_error($conn));
    }
}
//******************************************************************************************************************//

/***************************************** 작업일보 관리 - 작업일보 정보 삭제 *****************************************/
if(isset($_POST['delete_daywork'])) {
    $del_work_no = $_POST['del_work_no'];

    $delete_query = "DELETE FROM hj_daywork WHERE no = '$del_work_no' ";

    $delete_result = mysqli_query($conn, $delete_query);
    if(!$delete_result) {
      die("작업일보 정보 삭제 오류....." . mysqli_error($conn));
    }
}
//******************************************************************************************************************//


// ***********************************************************************************************************************************************//







//****************************************************** 평가용 기능(2022-12-30. 김한얼 대리) ******************************************************//
/***************************************** 재고 관리 - 재고 정보 등록 *****************************************/
if(isset($_POST['add_inven'])) {
  $inven_kinds = $_POST['inven_kinds'];
  $inven_name = $_POST['inven_name'];
  $inven_count = $_POST['inven_count'];

  $insert_query = "INSERT INTO hj_inven SET ";
  $insert_query .= "inven_kinds = '$inven_kinds', ";
  $insert_query .= "inven_name = '$inven_name', ";
  $insert_query .= "inven_count = '$inven_count' ";

  $insert_result = mysqli_query($conn, $insert_query);
  if(!$insert_result) {
    die("재고 정보 등록 오류......" . mysqli_error($conn));
  }
}
//***********************************************************************************************************//

/***************************************** 재고 관리 - 재고 정보 수정 *****************************************/
if(isset($_POST['edit_inven'])) {
  $inven_no = $_POST['inven_no'];
  $inven_kinds = $_POST['inven_kinds'];
  $inven_name = $_POST['inven_name'];
  $inven_count = $_POST['inven_count'];

  $update_query = "UPDATE hj_inven SET ";
  $update_query .= "inven_kinds = '$inven_kinds', ";
  $update_query .= "inven_name = '$inven_name', ";
  $update_query .= "inven_count = '$inven_count' ";
  $update_query .= "WHERE no = '$inven_no' ";

  $update_result = mysqli_query($conn, $update_query);
  if(!$update_result) {
    die("재고 정보 수정 오류......" . mysqli_error($conn));
  }
}
//***********************************************************************************************************//

/***************************************** 재고 관리 - 재고 정보 삭제 *****************************************/
if(isset($_POST['delete_inven'])) {
  $inven_no = $_POST['inven_no'];

  $delete_query = "DELETE FROM hj_inven WHERE no = '$inven_no' ";
  $delete_result = mysqli_query($conn, $delete_query);
  if(!$delete_result) {
    die("재고 정보 삭제 오류........" . mysqli_error($conn));
  }
}
//***********************************************************************************************************//

/***************************************** 제품불량 관리 - 제품불량 정보 등록 *****************************************/
if(isset($_POST['add_error'])) {
  $error_por = $_POST['error_por'];
  $error_info = $_POST['error_info'];
  $error_count = $_POST['error_count'];
  $error_date = date("Y-m-d");

  $insert_query = "INSERT INTO hj_error SET ";
  $insert_query .= "error_por = '$error_por', ";
  $insert_query .= "error_info = '$error_info', ";
  $insert_query .= "error_count = '$error_count', ";
  $insert_query .= "error_date = '$error_date' ";

  $insert_result = mysqli_query($conn, $insert_query);
  if(!$insert_result) {
    die("제품불량 정보 등록 오류....." . mysqli_error($conn));
  }
}
//**************************************************************************************************************//

/***************************************** 제품불량 관리 - 제품불량 정보 삭제 *****************************************/
if(isset($_POST['delete_error'])) {
  $error_no = $_POST['error_no'];

  $delete_query = "DELETE FROM hj_error WHERE no = '$error_no' ";
  $delete_result = mysqli_query($conn, $delete_query);
  if(!$delete_result) {
    die("제품불량 정복 삭제 오류......" . mysqli_error($conn));
  }
}
//**************************************************************************************************************//

/***************************************** 제품검사 관리 - 제품검사 정보 등록 *****************************************/
if(isset($_POST['add_test'])) {
  $test_por = $_POST['test_por'];
  $test_seq = $_POST['test_seq'];
  $test_result = $_POST['test_result'];
  $test_date = date("Y-m-d");

  $insert_query = "INSERT INTO hj_test SET ";
  $insert_query .= "test_por = '$test_por', ";
  $insert_query .= "test_seq = '$test_seq', ";
  $insert_query .= "test_result = '$test_result', ";
  $insert_query .= "test_date = '$test_date' ";

  $insert_result = mysqli_query($conn, $insert_query);
  if(!$insert_result) {
    die("제품검사 정보 등록......." . mysqli_error($conn));
  }
}
//**************************************************************************************************************//

/***************************************** 제품검사 관리 - 제품검사 정보 삭제 *****************************************/
if(isset($_POST['delete_test'])) {
  $test_no = $_POST['test_no'];

  $delete_query = "DELETE FROM hj_test WHERE no = '$test_no' ";
  $delete_result = mysqli_query($conn, $delete_query);
  if(!$delete_result) {
    die("제품검사 정보 삭제....." . mysqli_error($conn));
  }
}
//**************************************************************************************************************//

/***************************************** 사용자 그룹정보 관리 - 사용자 그룹정보 등록 *****************************************/
if(isset($_POST['add_group'])) {
  $group_department = $_POST['group_department'];

  $insert_query = "INSERT INTO hj_group SET ";
  $insert_query .= "group_department = '$group_department' ";

  $insert_result = mysqli_query($conn, $insert_query);
  if(!$insert_result) {
    die("사용자 그룹정보 등록....." . mysqli_error($conn));
  }
}
//**************************************************************************************************************//

/***************************************** 사용자 그룹정보 관리 - 사용자 그룹정보 수정 *****************************************/
if(isset($_POST['group_update'])) {
  $group_no = $_POST['up_group_no'];
  $group_department = $_POST['up_group_department'];
  $group_power = $_POST['up_group_power'];

  if($group_power == '' or $group_power == null) {
    $group_power = "관리";
  }

  $update_query = "UPDATE hj_group SET ";
  $update_query .= "group_department = '$group_department', ";
  $update_query .= "group_power = '$group_power' ";
  $update_query .= "WHERE no = '$group_no' ";

  $update_result = mysqli_query($conn, $update_query);
  if(!$update_result) {
    die("사용자 그룹정보 수정 에러....." . mysqli_error($conn));
  }
}
//**************************************************************************************************************//

/***************************************** 사용자 그룹정보 관리 - 사용자 그룹정보 삭제 *****************************************/
if(isset($_POST['group_delete'])) {
    $group_no = $_POST['del_group_no'];

    $delete_query = "DELETE FROM hj_group WHERE no = '$group_no' ";
    $delete_result = mysqli_query($conn, $delete_query);

    if(!$delete_result) {
        die("사용자 그룹정보 삭제 에러...." . mysqli_error($conn));
    }
}
//**************************************************************************************************************//

/***************************************** 공지사항 관리 - 공지사항 등록 *****************************************/
if(isset($_POST['notice_add'])) {
    $title = $_POST['title'];
    $writer = $_POST['writer'];
    $text = $_POST['text'];
    $date = date("Y-m-d");

    $insert_query = "INSERT INTO hj_notice SET ";
    $insert_query .= "title = '$title', ";
    $insert_query .= "writer = '$writer', ";
    $insert_query .= "date = '$date', ";
    $insert_query .= "text = '$text' ";

    $insert_result = mysqli_query($conn, $insert_query);
    if(!$insert_result) {
        die("공지사항 등록 오류....." . mysqli_error($conn));
    }
}
//**************************************************************************************************************//

/***************************************** 공지사항 관리 - 공지사항 수정 *****************************************/
if(isset($_POST['notice_update'])) {
    $no = $_POST['no'];
    $title = $_POST['title'];
    $writer = $_POST['writer'];
    $text = $_POST['text'];

    $update_query = "UPDATE hj_notice SET ";
    $update_query .= "title = '$title', ";
    $update_query .= "writer = '$writer', ";
    $update_query .= "text = '$text' ";
    $update_query .= "WHERE no = '$no' ";

    $update_result = mysqli_query($conn, $update_query);
    if(!$update_result) {
        die("공지사항 수정 오류......" . mysqli_error($conn));
    }
}
//**************************************************************************************************************//

/***************************************** 공지사항 관리 - 공지사항 수정 *****************************************/
if(isset($_POST['notice_delete'])) {
  $no = $_POST['no'];

  $delete_query = "DELETE FROM hj_notice WHERE no = '$no' ";
  $delete_result = mysqli_query($conn, $delete_query);
  if(!$delete_result) {
    die("공지사항 삭제 오류....." . mysqli_error($conn));
  }
}
//**************************************************************************************************************//

//************************************** 2023-03-17. 김한얼 팀장. 평가용 기능 추가 **************************************//
/***************************************** 사용이력 관리 - 사용이력 등록 *****************************************/
if(isset($_POST['add_use_record'])) {
  $screen = $_POST['screen'];
  $content = $_POST['content'];
  $user = $_POST['user'];

  $insert_query = "INSERT INTO hj_record SET ";
  $insert_query .= "screen = '$screen', ";
  $insert_query .= "content = '$content', ";
  $insert_query .= "user = '$user' ";

  $insert_result = mysqli_query($conn, $insert_query);
  if(!$insert_result) {
    die('사용이력 등록 오류........' . mysqli_error($conn));
  }
}
//**************************************************************************************************************//

/***************************************** 사용이력 관리 - 사용이력 수정 *****************************************/
if(isset($_POST['edit_use_record'])) {
  $no = $_POST['no'];
  $screen = $_POST['screen'];
  $content = $_POST['content'];
  $user = $_POST['user'];

  $update_query = "UPDATE hj_record SET ";
  $update_query .= "screen = '$screen', ";
  $update_query .= "content = '$content', ";
  $update_query .= "user = '$user' ";
  $update_query .= "WHERE no = '$no' ";

  $update_result = mysqli_query($conn, $update_query);
  if(!$update_result) {
    die("사용이력 수정 오류......." . mysqli_error($conn));
  }
}
//**************************************************************************************************************//

/***************************************** 사용이력 관리 - 사용이력 삭제 *****************************************/
if(isset($_POST['delete_use_record'])) {
  $no = $_POST['no'];

  $delete_query = "DELETE FROM hj_record WHERE no = '$no' ";
  $delete_result = mysqli_query($conn, $delete_query);
  if(!$delete_result) {
    die("사용이력 삭제 오류......." . mysqli_error($conn));
  }
}
//**************************************************************************************************************//
//*********************************************************************************************************************//






//****************************************************** 평가용 기능(2023-03-21. 김한얼 대리) ******************************************************//

/***************************************** 그룹권한 설정 - 그룹권한 등록 *****************************************/
if(isset($_POST['add_group2'])) {
  $group_department = $_POST['group_name'];
  $group_power = $_POST['group_power'];

  $insert_query = "INSERT INTO hj_group SET ";
  $insert_query .= "group_department = '$group_department', ";
  $insert_query .= "group_power = '$group_power' ";

  $insert_result = mysqli_query($conn, $insert_query);
  if(!$insert_result) {
    die("그룹권한 등록 오류......." . mysqli_error($conn));
  }
}
//**************************************************************************************************************//

/***************************************** 설정관리 - 테이블 설정 *****************************************/
if(isset($_POST['style1'])) {
  $style = substr($_POST['style1'], -1);
  $style = (int)$style;

  $update_query = "UPDATE hj_table SET ";
  $update_query .= "ok = 'N' ";

  $update_result = mysqli_query($conn, $update_query);

  $update_query2 = "UPDATE hj_table SET ";
  $update_query2 .= "ok = 'Y' ";
  $update_query2 .= "WHERE no = '$style' ";

  $update_result2 = mysqli_query($conn, $update_query2);
  if(!$update_result2) {
    die("테이블 설정 오류.........." . mysqli_error($conn));
  }
}
//**************************************************************************************************************//

/********************************************* 암호 변경 - 암호 수정 *********************************************/
if(isset($_POST['pw_update'])) {
  $new_pw = password_hash($_POST['new_pw'], PASSWORD_DEFAULT);
  $pw_no = $_POST['pw_no'];

  $update_query = "UPDATE hj_user SET ";
  $update_query .= "user_pw = '$new_pw' ";
  $update_query .= "WHERE no = '$pw_no' ";

  $update_result = mysqli_query($conn, $update_query);
  if(!$update_result) {
    die("암호 수정............." . mysqli_error($conn));
  }
}
//**************************************************************************************************************//

/********************************************* 가공/생산 지시서 관리 - 가공/생산 지시서 버전 수정 *********************************************/
if(isset($_POST['version_update'])) {
  $draw_no - $_POST['draw_no'];
  $draw_revision - $_POST['draw_revision'];

  $update_query = "UPDATE hj_draw SET ";
  $update_query .= "revision = '$draw_revision' ";
  $update_query .= "WHERE no = '$draw_no' ";

  $update_result = mysqli_query($conn, $update_query);
  if(!$update_result) {
    die("가공/생산 지시서 버전 수정 오류.........." . mysqli_error($conn));
  }
}
//**************************************************************************************************************//


//*********************************************************************************************************************//

?>
