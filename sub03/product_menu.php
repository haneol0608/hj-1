<?php
  $SESSION_STAT = $_SESSION['STAT'];
  $style = "current_nav";
?>


<div class="container sub01">
    <div class="product_menu">
        <a class="<?php if($SESSION_STAT == '절단 치수') echo $style; ?>" href="sub0301.php">절단치수 등록</a><img src="/jd/include/images/next2.PNG" alt="입고서 이미지">
        <span></span>
        <a class="<?php if($SESSION_STAT == '물량 산출') echo $style; ?>" href="sub0302.php">물량 산출</a><img src="/jd/include/images/next2.PNG" alt="입고서 이미지">
        <span></span>
        <a class="<?php if($SESSION_STAT == 'NC 절단') echo $style; ?>" href="sub0303.php">NC 절단공정</a><img src="/jd/include/images/next2.PNG" alt="입고서 이미지">
        <span></span>
        <a class="<?php if($SESSION_STAT == '취부/사상') echo $style; ?>" href="sub0304.php">취부/사상 공정</a><img src="/jd/include/images/next2.PNG" alt="입고서 이미지">
        <span></span>
        <a class="<?php if($SESSION_STAT == '실적 집계') echo $style; ?>" href="sub0305.php">절단실적 집계</a><img src="/jd/include/images/next2.PNG" alt="입고서 이미지">
        <span></span>
        <a class="<?php if($SESSION_STAT == '도장/도금') echo $style; ?>" href="sub0306.php">도장/도금 공정</a><img src="/jd/include/images/next2.PNG" alt="입고서 이미지">
        <span></span>
        <a class="<?php if($SESSION_STAT == '라벨') echo $style; ?>" href="sub0307.php">라벨제작 확인</a><img src="/jd/include/images/next2.PNG" alt="입고서 이미지">
        <span></span>
        <a class="<?php if($SESSION_STAT == '출고') echo $style; ?>" href="sub0308.php">출고(자동제작)</a><img src="/jd/include/images/next2.PNG" alt="입고서 이미지">
    </div>
</div>

