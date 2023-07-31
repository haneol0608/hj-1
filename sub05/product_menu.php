<?php
  $SESSION_STAT = $_SESSION['STAT'];
  $style = "current_nav";
?>
<div class="container sub05">
  <div class="product_menu">
    <a class="<?php if($SESSION_STAT == '절단') echo $style; ?>" href="sub0501.php">절단관리</a><img src="/jd/include/images/next2.PNG" alt="입고서 이미지">
    <span></span>
    <a class="<?php if($SESSION_STAT == '벤딩') echo $style; ?>" href="sub0502.php">벤딩관리</a><img src="/jd/include/images/next2.PNG" alt="입고서 이미지">
    <span></span>
    <a class="<?php if($SESSION_STAT == '취부') echo $style; ?>" href="sub0503.php">취부관리</a><img src="/jd/include/images/next2.PNG" alt="입고서 이미지">
    <span></span>
    <a class="<?php if($SESSION_STAT == '용접') echo $style; ?>" href="sub0504.php">용접관리</a><img src="/jd/include/images/next2.PNG" alt="입고서 이미지">
    <span></span>
    <a class="<?php if($SESSION_STAT == '사상') echo $style; ?>" href="sub0505.php">사상관리</a>

  </div>
</div>
