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

  $lot_date = base64_decode($_GET['lot_date']);
  $list_lot = base64_decode($_GET['list_lot']);

  $select_query = "SELECT * FROM hj_lada WHERE (lot_date = '$lot_date' AND list_lot = '$list_lot') ORDER BY qt_no * '1' ASC, qt_no ASC, seq ASC, count DESC";
  $select_result = mysqli_query($conn, $select_query);
  while($row = mysqli_fetch_assoc($select_result)) {
    $i++;
    $seq[] = $row['seq'];
    $count[] = $row['count'];
    $leg1_one[] = $row['leg1_one'];
    $leg1_two[] = $row['leg1_two'];
    $leg1_three[] = $row['leg1_three'];
    $leg1_four[] = $row['leg1_four'];
    $leg1_five[] = $row['leg1_five'];
    $leg2_one[] = $row['leg2_one'];
    $leg2_two[] = $row['leg2_two'];
    $leg2_three[] = $row['leg2_three'];
    $leg2_four[] = $row['leg2_four'];
    $leg2_five[] = $row['leg2_five'];
    $pad_one[] = $row['pad_one'];
    $pad_two[] = $row['pad_two'];
    $RB22[] = $row['RB22'];
    $RB25[] = $row['RB25'];
    $hoop1[] = $row['hoop1'];
    $hoop2[] = $row['hoop2'];
    $paint[] = $row['paint'];
    $ho[] = $row['ho'];
    $por[] = $row['por'];
    $qt_no[] = $row['qt_no'];

    $count[$i] == 0 ? $count[$i] ='' : $count[$i];
    $leg1_one[$i] == 0 ? $leg1_one[$i] = '' : $leg1_one[$i];
    $leg1_five[$i] == 0 ? $leg1_five[$i] = '' : $leg1_five[$i];
    $leg2_one[$i] == 0 ? $leg2_one[$i] = '' : $leg2_one[$i];
    $leg2_five[$i] == 0 ? $leg2_five[$i] = '' : $leg2_five[$i];
    // $pad_one == 0 ? $pad_one = '' : $pad_one;
    // $pad_two == 0 ? $pad_two = '' : $pad_two;
    $hoop1[$i] == 0 ? $hoop1[$i] = '' : $hoop1[$i];
    $hoop2[$i] == 0 ? $hoop2[$i] = '' : $hoop2[$i];
  }
  //**********************************************************************************************************************************************************************************//

  //************************************************************************** 엑셀 설정 **************************************************************************************//
  $cells = array(
    'A' => array(20, 'SEQ', 'SEQ'),
  	'B' => array(20, '수량', '수량'),
    'C' => array(30, 'F.B(LEG)65*9', 'F.B(LEG)65*9T'),
    'H' => array(20, 'F.B(LEG)65*65*8T', 'F.B(LEG)65*65*8T'),
    'M' => array(20, 'PAD100', 'PAD100'),
    'N' => array(20, 'PAD130', 'PAD130'),
    'O' => array(20, 'R.BØ22', 'R.BØ22'),
    'P' => array(20, 'R.BØ25', 'R.BØ25'),
    'Q' => array(20, 'HOOP50*9T', 'HOOP50*9T'),
  	'R' => array(20, 'HOOPØ19', 'HOOPØ19'),
    'S' => array(20, 'PAINT', 'PAINT'),
    'T' => array(20, '호선', '호선'),
    'U' => array(20, 'POR', 'POR'),
  	'V' => array(20, '비고 No', '비고 No'),
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

  $objPHPExcel->getActiveSheet()->setCellValue("A1", "SEQ");
  $objPHPExcel->getActiveSheet()->setCellValue("B1", "수량");
  $objPHPExcel->getActiveSheet()->setCellValue("C1", "F.B(LEG)65*9T");
  $objPHPExcel->getActiveSheet()->setCellValue("H1", "F.B(LEG)65*65*8T");
  $objPHPExcel->getActiveSheet()->setCellValue("M1", "PAD100");
  $objPHPExcel->getActiveSheet()->setCellValue("N1", "PAD130");
  $objPHPExcel->getActiveSheet()->setCellValue("O1", "R.BØ22");
  $objPHPExcel->getActiveSheet()->setCellValue("P1", "R.BØ25");
  $objPHPExcel->getActiveSheet()->setCellValue("Q1", "HOOP50*9T");
  $objPHPExcel->getActiveSheet()->setCellValue("R1", "HOOPØ19");
  $objPHPExcel->getActiveSheet()->setCellValue("S1", "PAINT");
  $objPHPExcel->getActiveSheet()->setCellValue("T1", "호선");
  $objPHPExcel->getActiveSheet()->setCellValue("U1", "POR");
  $objPHPExcel->getActiveSheet()->setCellValue("V1", "비고 No");

  foreach ($cells as $key => $value) {
    $cellName = $key.'1'; //엑셀의 1행 지정
    $objPHPExcel->getActiveSheet()->getColumnDimension($key)->setWidth($value[0]); // 열 넓이 조절
  }
  $objPHPExcel->setActiveSheetIndex(0)->mergeCells('C1:G1');
  $objPHPExcel->setActiveSheetIndex(0)->mergeCells('H1:L1');
  $objPHPExcel->getActiveSheet()->getStyle('A1:V1')->applyFromArray($cell_style1);

  for($j = 0; $j <= count($seq) + 1; $j++) {
    $objPHPExcel->getActiveSheet()->getStyle('A2:V'.$j)->applyFromArray($cell_style2);
  }

  foreach ($seq as $key => $value) {
    $key = $key + 2;
    $objPHPExcel->getActiveSheet()->setCellValue('A'.$key, $value);
  }
  foreach ($count as $key => $value) {
    $key = $key + 2;
    $objPHPExcel->getActiveSheet()->setCellValue('B'.$key, $value);
  }
  foreach ($leg1_one as $key => $value) {
    $key = $key + 2;
    $objPHPExcel->getActiveSheet()->setCellValue('C'.$key, $value);
  }
  foreach ($leg1_two as $key => $value) {
    $key = $key + 2;
    $objPHPExcel->getActiveSheet()->setCellValue('D'.$key, $value);
  }
  foreach ($leg1_three as $key => $value) {
    $key = $key + 2;
    //************************ 2022-11-30. KHO. 엑셀 다운로드 파일 -> '+' 표시 추가 ************************//
    $objPHPExcel->getActiveSheet()->getStyle('E'.$key)->getNumberFormat()->setFormatCode("+#,##0;-#,##0");
    // ************************************************************************************************* //

    $objPHPExcel->getActiveSheet()->setCellValue('E'.$key, $value);
  }
  foreach ($leg1_four as $key => $value) {
    $key = $key + 2;
    $objPHPExcel->getActiveSheet()->setCellValue('F'.$key, $value);
  }
  foreach ($leg1_five as $key => $value) {
    $key = $key + 2;
    $objPHPExcel->getActiveSheet()->setCellValue('G'.$key, $value);
  }
  foreach ($leg2_one as $key => $value) {
    $key = $key + 2;
    $objPHPExcel->getActiveSheet()->setCellValue('H'.$key, $value);
  }
  foreach ($leg2_two as $key => $value) {
    $key = $key + 2;
    $objPHPExcel->getActiveSheet()->setCellValue('I'.$key, $value);
  }
  foreach ($leg2_three as $key => $value) {
    $key = $key + 2;
    //************************ 2022-11-30. KHO. 엑셀 다운로드 파일 -> '+' 표시 추가 ************************//
    $objPHPExcel->getActiveSheet()->getStyle('J'.$key)->getNumberFormat()->setFormatCode("+#,##0;-#,##0");
    // ************************************************************************************************* //

    $objPHPExcel->getActiveSheet()->setCellValue('J'.$key, $value);
  }
  foreach ($leg2_four as $key => $value) {
    $key = $key + 2;
    $objPHPExcel->getActiveSheet()->setCellValue('K'.$key, $value);
  }
  foreach ($leg2_five as $key => $value) {
    $key = $key + 2;
    $objPHPExcel->getActiveSheet()->setCellValue('L'.$key, $value);
  }
  foreach ($pad_one as $key => $value) {
    $key = $key + 2;
    $objPHPExcel->getActiveSheet()->setCellValue('M'.$key, $value);
  }
  foreach ($pad_two as $key => $value) {
    $key = $key + 2;
    $objPHPExcel->getActiveSheet()->setCellValue('N'.$key, $value);
  }
  foreach ($RB22 as $key => $value) {
    $key = $key + 2;
    $objPHPExcel->getActiveSheet()->setCellValue('O'.$key, $value);
  }
  foreach ($RB25 as $key => $value) {
    $key = $key + 2;
    $objPHPExcel->getActiveSheet()->setCellValue('P'.$key, $value);
  }
  foreach ($hoop1 as $key => $value) {
    $key = $key + 2;
    $objPHPExcel->getActiveSheet()->setCellValue('Q'.$key, $value);
  }
  foreach ($hoop2 as $key => $value) {
    $key = $key + 2;
    $objPHPExcel->getActiveSheet()->setCellValue('R'.$key, $value);
  }
  foreach ($paint as $key => $value) {
    $key = $key + 2;
    $objPHPExcel->getActiveSheet()->setCellValue('S'.$key, $value);
  }
  foreach ($ho as $key => $value) {
    $key = $key + 2;
    $objPHPExcel->getActiveSheet()->setCellValue('T'.$key, $value);
  }
  foreach ($por as $key => $value) {
    $key = $key + 2;
    $objPHPExcel->getActiveSheet()->setCellValue('U'.$key, $value);
  }
  foreach ($qt_no as $key => $value) {
    $key = $key + 2;
    $objPHPExcel->getActiveSheet()->setCellValue('V'.$key, $value);
  }
  //**********************************************************************************************************************************************************************************//

  //********************************************************************************* 엑셀 기타 설정 *********************************************************************************//
  // 첫번째 시트(Sheet)로 열리게 설정
  $objPHPExcel -> setActiveSheetIndex(0);

  // 파일의 저장형식이 utf-8일 경우 한글파일 이름은 깨지므로 euc-kr로 변환해준다.
  $filename = iconv("UTF-8", "EUC-KR", "컷팅지(다릿발)_".date("Y-m-d"));

  // 브라우저로 엑셀파일을 리다이렉션
  header("Content-Type:application/vnd.ms-excel");
  header("Content-Disposition: attachment;filename=".$filename.".xls");
  header("Cache-Control:max-age=0");

  // Excel5 또는 Excel2007로 설정해야 안깨진다.
  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel2007");

  $objWriter -> save("php://output");
  //**********************************************************************************************************************************************************************************//

?>
