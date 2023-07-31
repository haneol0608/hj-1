<?php
    $_SESSION['page'];
    $list = 10; // 한 페이지에 보여질 리스트 개수

    if($_SESSION['page'] = 'sub2101') {
        $sql = "SELECT ship_no, por_no, seq_no, paint_code, COUNT(ship_no) AS count FROM hj_label $search_str GROUP BY ship_no, por_no, seq_no, paint_code ORDER BY date DESC";
    }

    $res = mysqli_query($conn2, $sql);
    $total_record = mysqli_num_rows($res); // 모든 게시글 수

    $page = ($_GET['page']) ? $_GET['page'] : 1; // 현재 페이지 번호
    $block_count = 10; // 블록 당 보여줄 페이지의 개수

    $total_page = ceil($total_record / $list); // 페이징 수
    $total_block = ceil($total_page / $block_count); // 전체 블록 수

    $page_start = ($page - 1) * $list; // 페이지 시작 번호
    $page = ($_GET['page']) ? $_GET['page'] : 1; // 현재 페이지 번호

    // $block_count = 10; // 블록 당 보여줄 페이지의 개수
    $block_num = ceil($page / $block_count); // 현재 페이지 블록
    $block_start = (($block_num - 1) * $block_count) + 1; // 시작 블록
    $block_end = $block_start + $block_count - 1; // 마지막 블록
    if($block_end > $total_page) { // 마지막 블록이 전체 페이징 수 보다 크다면..
      $block_end = $total_page;
    }

    // echo "페이지 수 : " . $total_page . "<br>";
    // echo "시작 블록 : " . $block_start . "<br>";
    // echo "마지막 블록 : " . $block_end . "<br>";
?>
