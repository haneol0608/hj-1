
<?php
  $SESSION_STAT = $_SESSION['STAT'];
  $style = "current_nav";
?>


<div class="container sub01">
  <div class="product_menu">
    <a class="<?php if($SESSION_STAT == '컷팅지 등록') echo $style; ?>" href="sub0101.php">컷팅지 등록</a><img src="/jd/include/images/next2.PNG" alt="입고서 이미지">
    <span></span>
    <a class="<?php if($SESSION_STAT == '물량 산출') echo $style; ?>" href="sub0102.php">물량 산출</a><img src="/jd/include/images/next2.PNG" alt="입고서 이미지">
    <span></span>
    <a class="<?php if($SESSION_STAT == '공정리스트 조회') echo $style; ?>" href="sub0103.php">공정리스트 조회</a><img src="/jd/include/images/next2.PNG" alt="입고서 이미지">
    <span></span>
    <a class="<?php if($SESSION_STAT == '라벨 마킹대기') echo $style; ?>" href="sub0105.php">라벨 마킹대기</a><img src="/jd/include/images/next2.PNG" alt="입고서 이미지">
    <span></span>
    <a class="<?php if($SESSION_STAT == '라벨 마킹') echo $style; ?>" href="sub0106.php">라벨 마킹</a>
    <span></span>
    <a class="<?php if($SESSION_STAT == '라벨 마킹완료') echo $style; ?>" href="sub0107.php">라벨 마킹완료</a>

  </div>
</div>

