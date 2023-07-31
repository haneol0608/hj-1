<div class="pagination">
  <?php
    if($page <= 1) {

    } else {
  ?>
  <a href='<?php echo $_SERVER['PHP_SELF']; ?>?page=1<?php echo $page_search; ?>'>처음</a>
  <?php
    }

    if($page <= 1) {

    } else {
  ?>
  <a href="<?php echo $_SERVER['PHP_SELF']; ?>?page=<?php echo $page - 1; ?><?php echo $page_search; ?>">이전</a>
  <?php
    }
    for($i = $block_start; $i <= $block_end; $i++) {
      if($page == $i) {
        ?>
        <p style='display: inline; color: white; font-weight: bold;'><?php echo $i; ?></p>
        <?php
      } else {
        ?>
        <a href="<?php echo $_SERVER['PHP_SELF']; ?>?page=<?php echo $i; ?><?php echo $page_search; ?>"><?php echo $i; ?></a>
        <?php
      }
    }

    if($page >= $total_page) {

    } else {
      ?>
      <a href="<?php echo $_SERVER['PHP_SELF']; ?>?page=<?php echo $page + 1; ?><?php echo $page_search; ?>">다음</a>
      <?php
    }

    if($page >= $total_page) {

    } else {
      ?>
      <a href='<?php echo $_SERVER['PHP_SELF']; ?>?page=<?php echo $total_page; ?><?php echo $page_search; ?>'>마지막</a>
      <?php
    }
  ?>
</div>
