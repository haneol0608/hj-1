<html lang="ko">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="author" content="(유)호인 IT 사업부 김한얼">
	<meta name="description" content="2021-11-11_">
	<meta name="generator" content="Sublime, Atom">
	<title>한진기공</title>

	<!-- style -->
	<!-- <link rel="stylesheet" href="/hoin/include/css/reset.css">
	<link rel="stylesheet" href="/hoin/include/css/style.css"> -->

	<!-- 웹 폰트 -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css?family=Nanum+Gothic" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Nanum+Brush+Script" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Abel&display=swap" rel="stylesheet">

<?php include "dbcon.php"; ?>
<?php
  //***************************************** 2021-12-17. KHO. 로그인 기능 *****************************************//
  // 1. 로그인 화면 -> id, password 변수
  $loginid = $_POST['login_id'];
  $password = $_POST['password'];

	$select_pw_query = "SELECT * FROM hj_user WHERE user_id = '$loginid' LIMIT 1";
	$select_pw_result = mysqli_query($conn, $select_pw_query);
	$select_pw_row = mysqli_fetch_assoc($select_pw_result);
	$hash_password = $select_pw_row['user_pw'];

	if(password_verify($password, $hash_password)) {
		$password = $hash_password;
	}
    $topw = date("Ymd");

    // 2. 로그인 DB 접근 및 변수화
	// $login_query = "SELECT id, name, level, flag FROM user WHERE id = '$loginid' AND password = '$password' ";
	$login_query = "SELECT user_id AS id, user_name AS name, user_power AS level FROM hj_user WHERE user_id = '$loginid' AND user_pw = '$password' ";
	// echo $login_query;
	// exit;
    $login_result = mysqli_query($conn, $login_query);
    $login_row = mysqli_fetch_assoc($login_result);
    // if($login_row) { "Yes"; } elseif(!$login_row) { echo "Nothing"; }

  if(!$login_row) {
    echo "아이디 또는 비밀번호가 맞지 않습니다. 확인주세요!!";
  } else {

		// echo $login_id = $login_row['id']; exit;
    $login_id = $login_row['id'];
    $login_name = $login_row['name'];
    $login_level = $login_row['level'];
    // $login_flag = $login_row['flag'];

    // print_r($login_row);

    // 3. Cookie 설정
    // 2021.04.28. KHO - setcookie() 분석
  	// setcookie(쿠키이름(name), 쿠키 값(value), 쿠키 만료 시간(expires), 쿠키 서버 경로(path))
  	// 쿠키 만료 시간(expires) - '0'으로 설정하거나 생략하면 세션이 끝날때(브라우저가 닫힐 때) 쿠키가 만료
  	// 쿠키 서버 경로(path) - '/'로 설정하면 쿠키를 전체 경로에서 사용이 가능하다.
    setcookie("HPLN", "$topw", 0, "/hj");
    setcookie("HPID", "$login_id", 0, "/hj");
    setcookie("HPNAME", "$login_name", 0, "/hj");
    setcookie("HPLEVEL", "$login_level", 0, "/hj");
    // setcookie("FLAG", "$login_flag", 0, "/hoin");


		// header("<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />");
  	// header("<meta http-equiv='refresh' content=\'0; url=../main.php\'>");
		// echo "<html><head><title></title>
		// <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
		// <meta http-equiv='refresh' content=\"0; url=/main.php\">
		//
		// </head>
		// <body>
		//
		// </body>
		//
		// </html>";

  }
?>
<meta http-equiv='refresh' content='0; url=/hj/index.php'>
</head>
