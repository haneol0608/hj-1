<?php
    include "../include/dbcon.php";

    //한글 꺠짐, 윈도우와 맥의 호환성을 고려 하여 Excel2007.php 라이브러리 사용으로 변경
    //기존 파일 excel.php.bak

    include_once '../include/lib/PHPExcel.php';
    require_once("../include/lib/PHPExcel/IOFactory.php");
    require_once("../include/lib/PHPExcel/Reader/Excel2007.php");

    $objPHPExcel = new PHPExcel();

    //************************************************************************** 원자재 사용 리스트 **************************************************************************************//
    $date = date("Y-m-d");
    // echo $select_query = "SELECT * FROM hj_label WHERE stat = '마킹' AND date = '$date' ORDER BY la_no ASC";
    $select_query = "SELECT * FROM hj_label WHERE stat = '마킹' ORDER BY la_no ASC";
    $select_result = mysqli_query($conn, $select_query);
    while($row = mysqli_fetch_assoc($select_result)) {
        $no[] = $row['no'];
        $la_no[] = $row['la_no'];
        $ho[] = $row['ho'];
        $por[] = $row['por'];
        $seq []= $row['seq'];
        $paint[] = $row['paint'];
        $other[] = $row['other'];
        // $count[] = $row['count'];
    }
    //**********************************************************************************************************************************************************************************//

    //************************************************************************** 엑셀 설정 **************************************************************************************//
    $cells = array(
        'A' => array(20, '마킹순서', '마킹순서'),
        'B' => array(20, '호선', '호선'),
        'C' => array(30, 'POR', 'POR'),
        'D' => array(20, 'SEQ', 'SEQ'),
        'E' => array(20, 'PAINT', 'PAINT'),
        'F' => array(20, '기타', '기타')
        // 'G' => array(20, '라벨 수량', '라벨 수량')
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

    $objPHPExcel->getActiveSheet()->setCellValue("A1", "마킹순서");
    $objPHPExcel->getActiveSheet()->setCellValue("B1", "호선");
    $objPHPExcel->getActiveSheet()->setCellValue("C1", "POR");
    $objPHPExcel->getActiveSheet()->setCellValue("D1", "SEQ");
    $objPHPExcel->getActiveSheet()->setCellValue("E1", "PAINT");
    $objPHPExcel->getActiveSheet()->setCellValue("F1", "기타");
    // $objPHPExcel->getActiveSheet()->setCellValue("G1", "라벨 수량");

    foreach ($cells as $key => $value) {
        $cellName = $key.'1'; //엑셀의 1행 지정
        $objPHPExcel->getActiveSheet()->getColumnDimension($key)->setWidth($value[0]); // 열 넓이 조절
    }
    $objPHPExcel->getActiveSheet()->getStyle('A1:G1')->applyFromArray($cell_style1);

    foreach ($la_no as $key => $value) {
        $key = $key + 2;
        $objPHPExcel->getActiveSheet()->setCellValue('A'.$key, $value);
    }
    foreach ($ho as $key => $value) {
        $key = $key + 2;
        $objPHPExcel->getActiveSheet()->setCellValue('B'.$key, $value);
    }
    foreach ($por as $key => $value) {
        $key = $key + 2;
        $objPHPExcel->getActiveSheet()->setCellValue('C'.$key, $value);
    }
    foreach ($seq as $key => $value) {
        $key = $key + 2;
        $objPHPExcel->getActiveSheet()->setCellValue('D'.$key, $value);
    }
    foreach ($paint as $key => $value) {
        $key = $key + 2;
        $objPHPExcel->getActiveSheet()->setCellValue('E'.$key, $value);
    }
    foreach ($other as $key => $value) {
        $key = $key + 2;
        $objPHPExcel->getActiveSheet()->setCellValue('F'.$key, $value);
    }
    // foreach ($count as $key => $value) {
    //     $key = $key + 2;
    //     $objPHPExcel->getActiveSheet()->setCellValue('G'.$key, $value);
    // }
    //**********************************************************************************************************************************************************************************//
    
    //********************************************************************************* 엑셀 기타 설정 *********************************************************************************//
    // 첫번째 시트(Sheet)로 열리게 설정
    $objPHPExcel -> setActiveSheetIndex(0);

    // 파일의 저장형식이 utf-8일 경우 한글파일 이름은 깨지므로 euc-kr로 변환해준다.
    $filename = iconv("UTF-8", "EUC-KR", "라벨 마킹_".date("Y-m-d"));

    // 브라우저로 엑셀파일을 리다이렉션
    header("Content-Type:application/vnd.ms-excel");
    header("Content-Disposition: attachment;filename=".$filename.".xls");
    header("Cache-Control:max-age=0");

    // Excel5 또는 Excel2007로 설정해야 안깨진다.
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel2007");

    $objWriter -> save("php://output");
    //**********************************************************************************************************************************************************************************//

?>