<?php
  $SESSION_STAT = $_SESSION['STAT'];
  $style = "current_nav";
?>



<div class="product_menu">
    <a class="<?php if($SESSION_STAT == '컷팅지 등록') echo $style; ?>" href="sub0201.php">컷팅지 등록</a><img src="/jd/include/images/next2.PNG" alt="입고서 이미지">
    <span></span>
    <a class="<?php if($SESSION_STAT == '물량 산출') echo $style; ?>" href="sub0202.php">물량 산출</a><img src="/jd/include/images/next2.PNG" alt="입고서 이미지">
    <span></span>
    <a class="<?php if($SESSION_STAT == '공정리스트 조회') echo $style; ?>" href="sub0203.php">공정리스트 조회</a><img src="/jd/include/images/next2.PNG" alt="입고서 이미지">
    <!-- <span></span> -->
    <!-- <a class="<?php if($SESSION_STAT == '라벨 마킹대기') echo $style; ?>" href="sub0105.php">라벨 마킹대기</a><img src="/jd/include/images/next2.PNG" alt="입고서 이미지"> -->
    <!-- <span></span> -->
    <!-- <a class="<?php if($SESSION_STAT == '라벨 마킹') echo $style; ?>" href="sub0106.php">라벨 마킹</a> -->
    <!-- <span></span> -->
    <!-- <a class="<?php if($SESSION_STAT == '라벨 마킹완료') echo $style; ?>" href="sub0107.php">라벨 마킹완료</a> -->
</div>

