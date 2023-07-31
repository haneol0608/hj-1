<?php
$topw = date("Ymd");
$HPLN = $_COOKIE["HPLN"];

// 아이디 없을시 로그인 화면으로 이동
$HPID = $_COOKIE['HPID'];
if(!$_COOKIE['HPID']) {
	header("Location: /hj/login.php");
}

// [웹 캐시] - 데이터 임시 저장소
// 1. 사용자가 웹 서버에 접속할 때, 정적 컨텐츠(이미지, JS, CSS 등)를 특정 위치에 저장
// 2. 웹 사이트 서버에 해당 컨텐츠를 특정 위치에 불러옴으로써 사이트 응답시간을 줄이고, 서버 트래픽 감소 효과를 볼 수 있음.
// (* 코드 수정 시 새 코드로 반영되지 않고 수정 전 코드로 적용되는 경우 웹 캐시가 적용되는 현상...)
// 3. HTTP/HTTPS에서 브라우저에 개인 정보가 남는다면 문제가 발생..(캐싱 문제)

// 점속날짜가 현재 날짜와 다르면 개인 정보 캐시 기록 삭제
if($HPLN != $topw) {
	Header("Content-type: text/html");
	header("Cache-Control: no-cache, must-revalidate"); // HTTP 1.1. 캐싱(브라우저에 개인정보 기록 남김) 방지
	header("Pragma: no-cache"); // HTTP 1.0. 캐싱 방지
	header("Location: /hj/login.php");
	exit;
}
?>
