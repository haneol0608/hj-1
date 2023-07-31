<?php
$lurl = $_REQUEST['lurl'];
if(!$lurl){
	$lurl = "/hj/login.php";
}

// 1. 로그아웃 버튼 클릭 시 쿠키(개인 PC)에 저장된 로그인 정보 삭제
setcookie("HPLN","",0,"/hj");
setcookie("HPID","",0,"/hj");
setcookie("HPNAME","",0,"/hj");
setcookie("HPLEVEL","c",0,"/hj");

// 2. 로그인 접속 시간 초기화
$HPLN="";

// 3. 로그인 창으로 이동
Header("Content-type: text/html");
header("Location:$lurl");
?>
