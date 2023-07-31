<?php
  include "../include/dbcon.php";

  //한글 꺠짐, 윈도우와 맥의 호환성을 고려 하여 Excel2007.php 라이브러리 사용으로 변경
  //기존 파일 excel.php.bak

  include_once '../include/lib/PHPExcel.php';
  require_once("../include/lib/PHPExcel/IOFactory.php");
  require_once("../include/lib/PHPExcel/Reader/Excel2007.php");

  $objPHPExcel = new PHPExcel();

  //************************************************************************** 원자재 사용 리스트 **************************************************************************************//
  $i = -1;
  $j = 1;

  $lot_date = base64_decode($_GET['lot_date']);
  $list_lot = base64_decode($_GET['list_lot']);

 
    if($lot_date != null && $list_lot != null) {
        $select_query = "SELECT A.ho AS ho, A.por AS por, A.qt_no AS qt_no, SUM(B.count) AS count, SUM(B.weight) AS weight, SUM(money) AS money, MIN(B.pro_date) AS pro_date, MIN(B.mp_date) AS mp_date, A.series AS series, A.revision AS revision, A.sp AS sp, A.lot_date, A.list_lot 
        FROM hj_prolist AS A INNER JOIN hj_quantity AS B ON A.ho = B.ho AND A.por = B.por AND A.seq = B.seq 
        WHERE lot_date = '$lot_date' AND list_lot = '$list_lot' 
        GROUP BY A.ho, A.por, A.qt_no, A.series, A.revision, A.sp, A.lot_date, A.list_lot 
        ORDER BY A.qt_no * '1' ASC, A.qt_no ASC";
    } else {
        $select_query = "SELECT A.ho AS ho, A.por AS por, A.qt_no AS qt_no, SUM(B.count) AS count, SUM(B.weight) AS weight, SUM(money) AS money, MIN(B.pro_date) AS pro_date, MIN(B.mp_date) AS mp_date, A.series AS series, A.revision AS revision, A.sp AS sp, A.lot_date, A.list_lot 
        FROM hj_prolist AS A INNER JOIN hj_quantity AS B ON A.ho = B.ho AND A.por = B.por AND A.seq = B.seq 
        WHERE lot_date IS NULL AND list_lot IS NULL 
        GROUP BY A.ho, A.por, A.qt_no, A.series, A.revision, A.sp, A.lot_date, A.list_lot 
        ORDER BY A.qt_no * '1' ASC, A.qt_no ASC";
    }

  
  $select_result = mysqli_query($conn, $select_query);
  while($row = mysqli_fetch_assoc($select_result)) {
    $i++;

    $ho[] = $row['ho'];
    $por[] = $row['por'];
    $qt_no[] = $row['qt_no'];
    $count[] = $row['count'];
    $weight[] = $row['weight'];
    $money[] = $row['money'];
    $pro_date[] = $row['pro_date'];
    $mp_date[] = $row['mp_date'];
    $series[] = $row['series'];
    $revision[] = $row['revision'];
    $sp[] = $row['sp'];

    $j++;
    $show_paint = [];
    $select_paint_query = "SELECT A.paint AS paint, COUNT(A.paint) AS count_paint FROM hj_cutting AS A RIGHT JOIN hj_prolist AS B ON A.por = B.por AND A.ho = B.ho AND A.seq = B.seq
    WHERE A.ho = '$ho[$i]' AND A.por = '$por[$i]' AND A.paint != '' AND B.qt_no = '$qt_no[$i]' GROUP BY A.ho, A.por, A.paint, B.qt_no ";
    $select_paint_result = mysqli_query($conn, $select_paint_query);
    while($paint_row = mysqli_fetch_assoc($select_paint_result)) {
      $paint = $paint_row['paint'];
      $count_paint = $paint_row['count_paint'];
      $show_paint[] = $paint . " : " . $count_paint;
    }
    $show_paint = implode(", ", $show_paint);
    $objPHPExcel->getActiveSheet()->setCellValue('L'.$j, $show_paint); // ,로 결합해 기록
  }
  //**********************************************************************************************************************************************************************************//

  //************************************************************************** 엑셀 설정 **************************************************************************************//
  $cells = array(
    'A' => array(20, 'NO', 'NO'),
  	'B' => array(30, '호선', '호선'),
  	'C' => array(20, 'POR', 'POR'),
    'D' => array(20, 'SEQ', 'SEQ'),
    'E' => array(20, '수량', '수량'),
    'F' => array(20, '중량', '중량'),
    'G' => array(20, '금액', '금액'),
    'H' => array(20, '제작납기', '제작납기'),
    'I' => array(20, 'MP납기', 'MP납기'),
    'J' => array(40, '시리즈', '시리즈'),
    'K' => array(10, '사상', '사상'),
    'L' => array(10, 'PAINT', 'PAINT'),
    'M' => array(30, '특수자재', '특수자재'),
  	'N' => array(15, '개정도', '개정도'),
  );

  $cell_style1 = array(
     // 배경색 설정
     'fill' => array(
       'type' => PHPExcel_Style_Fill::FILL_SOLID,
       'color' => array('rgb'=>'D3E0E7'),
     ),

     // 폰트 설정
     'font' => array(
       'bold' => 'true',
       'size' => '15',
       'color' => array('rgb'=>'000000'),
       'name' => '맑은 고딕'
     ),

     // 정렬
     'alignment' => array(
       'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
       'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
     ),

     // 테두리 설정
     'borders' => array(
         'outline' => array(
             'style' => PHPExcel_Style_Border::BORDER_THIN,
             'color' => array('grab'=>'000000')
          ),
          'inside' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => array('grab'=>'000000')
          )
      ),
  );

  $cell_style2 = array(
     // 폰트 설정
     'font' => array(
       'size' => '13',
       'name' => '맑은 고딕'
     ),

     // 정렬
     'alignment' => array(
       'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
       'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
     ),

     // 테두리 설정
     'borders' => array(
         'outline' => array(
             'style' => PHPExcel_Style_Border::BORDER_THIN,
             'color' => array('grab'=>'000000')
          ),
          'inside' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => array('grab'=>'000000')
          )
      ),
  );

  $objPHPExcel->getActiveSheet()->setCellValue("A1", "NO");
  $objPHPExcel->getActiveSheet()->setCellValue("B1", "호선");
  $objPHPExcel->getActiveSheet()->setCellValue("C1", "POR");
  $objPHPExcel->getActiveSheet()->setCellValue("D1", "SEQ");
  $objPHPExcel->getActiveSheet()->setCellValue("E1", "수량");
  $objPHPExcel->getActiveSheet()->setCellValue("F1", "중량");
  $objPHPExcel->getActiveSheet()->setCellValue("G1", "금액");
  $objPHPExcel->getActiveSheet()->setCellValue("H1", "제작납기");
  $objPHPExcel->getActiveSheet()->setCellValue("I1", "MP납기");
  $objPHPExcel->getActiveSheet()->setCellValue("J1", "시리즈");
  $objPHPExcel->getActiveSheet()->setCellValue("K1", "사상");
  $objPHPExcel->getActiveSheet()->setCellValue("L1", "PAINT");
  $objPHPExcel->getActiveSheet()->setCellValue("M1", "특수자재");
  $objPHPExcel->getActiveSheet()->setCellValue("N1", "개정도");

  foreach ($cells as $key => $value) {
    $cellName = $key.'1'; //엑셀의 1행 지정
    $objPHPExcel->getActiveSheet()->getColumnDimension($key)->setWidth($value[0]); // 열 넓이 조절
  }
  $objPHPExcel->getActiveSheet()->getStyle('A1:N1')->applyFromArray($cell_style1);

  for($j = 0; $j <= count($qt_no) + 1; $j++) {
    $objPHPExcel->getActiveSheet()->getStyle('A2:N'.$j)->applyFromArray($cell_style2);
  }

  foreach ($qt_no as $key => $value) {
    $key = $key + 2;
    $objPHPExcel->getActiveSheet()->setCellValue('A'.$key, $value);
  }
  foreach ($ho as $key => $value) {
    $key = $key + 2;
    $objPHPExcel->getActiveSheet()->setCellValue('B'.$key, $value);
  }

  $i = -1;
  foreach ($por as $key => $value) {
    $i++;
    $key = $key + 2;
    $objPHPExcel->getActiveSheet()->setCellValue('C'.$key, $value);

    $select_seq_query = "SELECT GROUP_CONCAT(seq SEPARATOR ', ') AS seq FROM hj_prolist WHERE ho = '$ho[$i]' AND por = '$por[$i]' AND qt_no = '$qt_no[$i]' ORDER BY seq ASC";
    $select_seq_result = mysqli_query($conn, $select_seq_query);
    while($seq_row = mysqli_fetch_assoc($select_seq_result)) {
      $seq = $seq_row['seq'];
      $seq < 10 ? "0" . $seq : $seq;
    //   echo $seq;
      $objPHPExcel->getActiveSheet()->setCellValue('D'.$key, $seq);
    }
  }

  foreach ($count as $key => $value) {
    $key = $key + 2;
    $objPHPExcel->getActiveSheet()->setCellValue('E'.$key, $value);
  }
  foreach ($weight as $key => $value) {
    $key = $key + 2;
    $objPHPExcel->getActiveSheet()->setCellValue('F'.$key, $value);
  }
  foreach ($money as $key => $value) {
    $key = $key + 2;
    $objPHPExcel->getActiveSheet()->setCellValue('G'.$key, number_format($value));
  }
  foreach ($pro_date as $key => $value) {
    $key = $key + 2;
    $objPHPExcel->getActiveSheet()->setCellValue('H'.$key, $value);
  }
  foreach ($mp_date as $key => $value) {
    $key = $key + 2;
    $objPHPExcel->getActiveSheet()->setCellValue('I'.$key, $value);
  }
  foreach ($series as $key => $value) {
    $key = $key + 2;
    $objPHPExcel->getActiveSheet()->setCellValue('J'.$key, $value);
  }

  $i = -1;
  foreach ($series as $key => $value) {
    $i++;
    // $select_lap_query = "SELECT COUNT(A.lap) AS count_lap FROM hj_cutting AS A RIGHT JOIN hj_prolist AS B ON A.por = B.por AND A.ho = B.ho AND A.seq = B.seq WHERE A.ho = '$ho[$i]' AND A.por = '$por[$i]'
    // AND A.paint != '' AND A.lap !='' ";
    $select_lap_query = "SELECT COUNT(A.lap) AS count_lap FROM hj_cutting AS A RIGHT JOIN hj_prolist AS B ON A.por = B.por AND A.ho = B.ho AND A.seq = B.seq WHERE A.ho = '$ho[$i]' AND A.por = '$por[$i]' "; 
    $select_lap_query .= "AND B.qt_no = '$qt_no[$i]' AND A.paint != '' AND A.lap !='' ";
    $select_lap_result = mysqli_query($conn, $select_lap_query);
    $lap_row = mysqli_fetch_assoc($select_lap_result);
    $count_lap = $lap_row['count_lap'];

    if($count_lap == 0) {
      $show_lap = "";
    } else if($count[$i] == $count_lap) {
      $show_lap = "3P";
    } else if($count[$i] > $count_lap) {
      $show_lap = "일부 3P";
    }
    
    $key = $key + 2;
    $objPHPExcel->getActiveSheet()->setCellValue('K'.$key, $show_lap);
  }

  foreach ($sp as $key => $value) {
    $key = $key + 2;
    $objPHPExcel->getActiveSheet()->setCellValue('M'.$key, $value);
  }

  $i = -1;
  foreach ($ho as $key => $value) {
    $i++;
    $select_revision_query = "SELECT revision FROM hj_draw WHERE ho = '$ho[$i]' AND por = '$por[$i]' ";
    $select_revision_result = mysqli_query($conn, $select_revision_query);
    $revision_row = mysqli_fetch_assoc($select_revision_result);
    $show_revision = $revision_row['revision'];
    if($show_revision == null or $show_revision == "") {
        $show_revision = "";
    } else if($show_revision == 0) {
        $show_revision = "0";
    } else if($show_revision < 10) {
        $show_revision = "00" . $show_revision;
    } else if($show_revision > 10 AND $show_revision < 100) {
        $show_revision = "0" . $show_revision;
    }
    
    $key = $key + 2;
    $objPHPExcel->getActiveSheet()->setCellValue('N'.$key, $show_revision);
  }
  //**********************************************************************************************************************************************************************************//

  //********************************************************************************* 엑셀 기타 설정 *********************************************************************************//
  // 첫번째 시트(Sheet)로 열리게 설정
  $objPHPExcel -> setActiveSheetIndex(0);

  // 파일의 저장형식이 utf-8일 경우 한글파일 이름은 깨지므로 euc-kr로 변환해준다.
  $filename = iconv("UTF-8", "EUC-KR", "공정리스트_".date("Y-m-d"));

  // 브라우저로 엑셀파일을 리다이렉션
  header("Content-Type:application/vnd.ms-excel");
  header("Content-Disposition: attachment;filename=".$filename.".xls");
  header("Cache-Control:max-age=0");

  // Excel5 또는 Excel2007로 설정해야 안깨진다.
  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel2007");

  $objWriter -> save("php://output");
  //**********************************************************************************************************************************************************************************//

?>
