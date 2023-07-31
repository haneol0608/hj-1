<?php
  include "../include/dbcon.php";

  //한글 꺠짐, 윈도우와 맥의 호환성을 고려 하여 Excel2007.php 라이브러리 사용으로 변경
  //기존 파일 excel.php.bak

  include_once '../include/lib/PHPExcel.php';
  require_once("../include/lib/PHPExcel/IOFactory.php");
  require_once("../include/lib/PHPExcel/Reader/Excel2007.php");

  $objPHPExcel = new PHPExcel();

  //************************************************************************** 원자재 사용 리스트 **************************************************************************************//
  $w = $_GET['w'];
  $p = $_GET['p'];

  $lot_date = base64_decode($_GET['lot_date']);
  $list_lot = base64_decode($_GET['list_lot']);

  $i = -1;
  $select_query = "SELECT * FROM hj_lada WHERE (w = '$w' AND p= '$p' AND lot_date = '$lot_date' AND list_lot = '$list_lot') ORDER BY qt_no * '1' ASC, qt_no ASC, qt_no ASC, seq ASC, count DESC ";
  $select_result = mysqli_query($conn, $select_query);
  while($row = mysqli_fetch_assoc($select_result)) {
    $lap[] = $row['lap'];
    $seq[] = $row['seq'];
    $count[] = $row['count'];
    $fr_one[] = $row['fr_one'];
    $fr_two[] = $row['fr_two'];
    $fr_three[] = $row['fr_three'];
    $fr_four[] = $row['fr_four'];
    $fr_five[] = $row['fr_five'];
    // $W = $row['W'];
    // $P = $row['P'];
    $U[] = $row['U'];
    $B[] = $row['B'];
    $gak_count[] = $row['gak_count'];
    $ho[] = $row['ho'];
    $por[] = $row['por'];
    $qt_no[] = $row['qt_no'];

    $count[$i] == 0 ? $count[$i] ='' : $count[$i];
    $fr_one[$i] == 0 ? $fr_one[$i] = '' : $fr_one[$i];
    $fr_two[$i] == 0 ? $fr_two[$i] = '' : $fr_two[$i];
    // $fr_three == 0 ? $fr_three = '' : $fr_three;
    // $fr_four == 0 ? $fr_four = '' : $fr_four;
    $fr_five[$i] == 0 ? $fr_five[$i] = '' : $fr_five[$i];
    // $pad_one[$i] == 0 ? $pad_one[$i] = '' : $pad_one[$i];
    // $pad_two[$i] == 0 ? $pad_two[$i] = '' : $pad_two[$i];
    // $gak_count == 0 ? $gak_count = '' : $gak_count;
  }
  //**********************************************************************************************************************************************************************************//

  //************************************************************************** 엑셀 설정 **************************************************************************************//
  $cells = array(
    'A' => array(20, '사상', '사상'),
  	'B' => array(30, 'SEQ', 'SEQ'),
    'C' => array(20, '수량', '수량'),
    'D' => array(20, 'F.B(FRAME)65*9T', 'F.B(FRAME)65*9T'),
    'I' => array(20, 'U', 'U'),
    'J' => array(20, 'B', 'B'),
    'K' => array(20, '각철수량', '각철수량'),
    'L' => array(20, '호선', '호선'),
    'M' => array(20, 'POR', 'POR'),
  	'N' => array(20, '비고 No', '비고 No'),
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

  $objPHPExcel->getActiveSheet()->setCellValue("A1", "사상");
  $objPHPExcel->getActiveSheet()->setCellValue("B1", "SEQ");
  $objPHPExcel->getActiveSheet()->setCellValue("C1", "수량");
  $objPHPExcel->getActiveSheet()->setCellValue("D1", "F.B(FRAME)65*9T");
  $objPHPExcel->getActiveSheet()->setCellValue("I1", "U");
  $objPHPExcel->getActiveSheet()->setCellValue("J1", "B");
  $objPHPExcel->getActiveSheet()->setCellValue("K1", "각철수량");
  $objPHPExcel->getActiveSheet()->setCellValue("L1", "호선");
  $objPHPExcel->getActiveSheet()->setCellValue("M1", "POR");
  $objPHPExcel->getActiveSheet()->setCellValue("N1", "비고 No");


  foreach ($cells as $key => $value) {
    $cellName = $key.'1'; //엑셀의 1행 지정
    $objPHPExcel->getActiveSheet()->getColumnDimension($key)->setWidth($value[0]); // 열 넓이 조절
  }
  $objPHPExcel->setActiveSheetIndex(0)->mergeCells('D1:H1');
  $objPHPExcel->getActiveSheet()->getStyle('A1:N1')->applyFromArray($cell_style1);

  for($j = 0; $j <= count($qt_no) + 1; $j++) {
    $objPHPExcel->getActiveSheet()->getStyle('A2:N'.$j)->applyFromArray($cell_style2);
  }

  foreach ($lap as $key => $value) {
    $key = $key + 2;
    $objPHPExcel->getActiveSheet()->setCellValue('A'.$key, $value);
  }
  foreach ($seq as $key => $value) {
    $key = $key + 2;
    $objPHPExcel->getActiveSheet()->setCellValue('B'.$key, $value);
  }
  foreach ($count as $key => $value) {
    $objPHPExcel->getActiveSheet()->setCellValue("C1", "수량");
    $key = $key + 2;
    $objPHPExcel->getActiveSheet()->setCellValue('C'.$key, $value);
  }
  foreach ($fr_one as $key => $value) {
    $objPHPExcel->getActiveSheet()->setCellValue("D1", "F.B(FRAME)65*9T");
    $key = $key + 2;
    $objPHPExcel->getActiveSheet()->setCellValue('D'.$key, $value);
  }
  foreach ($fr_two as $key => $value) {
    $key = $key + 2;
    $objPHPExcel->getActiveSheet()->setCellValue('E'.$key, $value);
  }
  foreach ($fr_three as $key => $value) {
    $key = $key + 2;
    $objPHPExcel->getActiveSheet()->setCellValue('F'.$key, $value);
  }
  foreach ($fr_four as $key => $value) {
    $key = $key + 2;
    $objPHPExcel->getActiveSheet()->setCellValue('G'.$key, $value);
  }
  foreach ($fr_five as $key => $value) {
    $key = $key + 2;
    $objPHPExcel->getActiveSheet()->setCellValue('H'.$key, $value);
  }
  foreach ($U as $key => $value) {
    $key = $key + 2;
    $objPHPExcel->getActiveSheet()->setCellValue('I'.$key, $value);
  }
  foreach ($B as $key => $value) {
    $key = $key + 2;
    $objPHPExcel->getActiveSheet()->setCellValue('J'.$key, $value);
  }
  foreach ($gak_count as $key => $value) {
    $key = $key + 2;
    $objPHPExcel->getActiveSheet()->setCellValue('K'.$key, $value);
  }
  foreach ($ho as $key => $value) {
    $key = $key + 2;
    $objPHPExcel->getActiveSheet()->setCellValue('L'.$key, $value);
  }
  foreach ($por as $key => $value) {
    $key = $key + 2;
    $objPHPExcel->getActiveSheet()->setCellValue('M'.$key, $value);
  }
  foreach ($qt_no as $key => $value) {
    $key = $key + 2;
    $objPHPExcel->getActiveSheet()->setCellValue('N'.$key, $value);
  }
  //**********************************************************************************************************************************************************************************//

  //********************************************************************************* 엑셀 기타 설정 *********************************************************************************//
  // 첫번째 시트(Sheet)로 열리게 설정
  $objPHPExcel -> setActiveSheetIndex(0);

  // 파일의 저장형식이 utf-8일 경우 한글파일 이름은 깨지므로 euc-kr로 변환해준다.
  $filename = iconv("UTF-8", "EUC-KR", "컷팅지(프레임)_"."W($w)P($p)_".date("Y-m-d"));

  // 브라우저로 엑셀파일을 리다이렉션
  header("Content-Type:application/vnd.ms-excel");
  header("Content-Disposition: attachment;filename=".$filename.".xls");
  header("Cache-Control:max-age=0");

  // Excel5 또는 Excel2007로 설정해야 안깨진다.
  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel2007");

  $objWriter -> save("php://output");
  //**********************************************************************************************************************************************************************************//

?>
