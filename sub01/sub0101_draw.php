<?php
    $draw_file = base64_decode($_GET['draw_file']);
    $file = '/hj/sub01/draw_folder/'. $draw_file;
    // $filename = $draw_file;

    // header('Content-type: application/pdf');
    // header('Content-Disposition: inline; filename="'.$filename . '"');
    // header('Content-Transfer-Encoding: binary');
    // header('Content-Length: ' . filesize($file));
    // header('Accept-Ranges: bytes');

    // @readfile($file);
?>
<!-- <iframe src="<?php echo $file; ?>" style="width:100%; height:100%;" frameborder="0"></iframe> -->
<!-- <iframe src="<?php echo $file; ?>" style="width:100%; height:100%;" frameborder="0"></iframe> -->
<!-- <iframe src="<?php echo $file; ?>" style="width:718px; height:900px;" frameborder="0"></iframe> -->
<!-- <object type="application/pdf" data="<?php echo $file; ?>" width="700" height="800">
<param name="src" value="<?php echo $file; ?>">
</object> -->
<html lang="ko">
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="author" content="(유)호인 IT 사업부 김한얼">
	<meta name="description" content="2021-11-11_호인">
	<meta name="generator" content="Sublime, Atom">

    <input type='button' style="margin-bottom:10px" value="창닫기" onClick='window.close()'>
    <iframe style="width: 100%; height: 100%;" src="/hj/include/lib/PDF/web/viewer.html?file=<?php echo $file; ?>" frameborder="0"></iframe>
</html>
