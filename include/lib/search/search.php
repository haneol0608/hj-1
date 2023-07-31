<?php 
    $s_ho = $_GET['s_ho'];
    $s_por = $_GET['s_por'];
    $s_lot = $_GET['s_lot'];
    $s_type = $_GET['s_type'];
    $s_material = $_GET['s_material'];
    $s_thick1 = $_GET['s_thick1'];
    $s_thick2 = $_GET['s_thick2'];
    $s_length1 = $_GET['s_length1'];
    $s_length2 = $_GET['s_length2'];

    $search_str = " WHERE 1 ";

    if($s_ho) {
        $search_str .= " AND ho = '$s_ho' ";
    }

    if($s_por) {
        $search_str .= " AND por = '$s_por' ";
    }

    if($s_lot) {
        $search_str .= " AND lot = '$s_lot' ";
    }

    if($s_type) {
        $search_str .= " AND type = '$s_type' ";
    }

    if($s_material) {
        $search_str .= " AND material = '$s_material' ";
    }

    if($s_thick1 && $s_thick2) {
        $search_str .= " AND thick BETWEEN '$s_thick1' AND '$s_thick2' ";
    } else {
        if($s_thick1) {
            //*******************************2023-06-14. 김한얼 팀장. 최대 값 지정*******************************//
            $select_s_query = "SELECT COUNT(*) AS max_count FROM hj_cut_all ";
            $select_s_result = mysqli_query($conn, $select_s_query);
            $s_row = mysqli_fetch_assoc($select_s_result);
            
            $max_count = $s_row['max_count'];
            //*************************************************************************************************//

            $search_str .= " AND thick BETWEEN '$s_thick1' AND '$max_count' ";
        }
    }

    if($s_length1 && $s_length2) {
        $search_str .= " AND length BETWEEN '$s_length1' AND '$s_length2' ";
    } else {
        if($s_length1) {
            //*******************************2023-06-14. 김한얼 팀장. 최대 값 지정*******************************//
            $select_s_query = "SELECT COUNT(*) AS max_count FROM hj_cut_all ";
            $select_s_result = mysqli_query($conn, $select_s_query);
            $s_row = mysqli_fetch_assoc($select_s_result);
            
            $max_count = $s_row['max_count'];
            //*************************************************************************************************//

            $search_str .= " AND length BETWEEN '$s_length1' AND '$max_count' ";
        }
    }

    // 검색 폼 값 선언
    $form_query = "s_ho=" . $s_ho . "&s_por=" . $s_por . "&s_lot=" . $s_lot . "&s_type=" . $s_type . "&s_material=" . $s_material . "&s_thick1=" . $s_thick1 . "&s_thick2=" . $s_thick2 . "&s_length1=" . $s_length1 . "s_length2=" . $s_length2;
    // 검색조건 적용
    $search_url = "?" . $form_query;

?>