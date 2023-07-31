<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="author" content="(유)호인 IT 사업부 김한얼">
	<meta name="description" content="2021-11-11_호인">
	<meta name="generator" content="Sublime, Atom">
	<title>한진기공 MES</title>

	<!-- style -->
	<link rel="stylesheet" href="/hj/include/css/reset.css">
	<link rel="stylesheet" href="/hj/include/css/style.css">
	<link rel="stylesheet" href="/hj/include/css/style_mes.css">
	<link rel="stylesheet" href="/hj/include/css/lightgallery.css">
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="/hj/include/js/common.js"></script>

	<!-- 웹 폰트 -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css?family=Nanum+Gothic" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nanum+Brush+Script" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Abel&display=swap" rel="stylesheet">
</head>
<body>
	<?php
		if(!$_COOKIE['HPID']) {
			header("Location:/hj/index.php");
		}
	?>
	<!-- header -->
	<header>
		<div class="h_wrapper">
			<!-- quick btn -->
        <a href="#" class="m_btn">
          <span></span>
        </a>

			<div class="h_tit">
					<a href="/hj/index.php">
					<img src="/hj/include/images/hj_logo.png" alt="한진로고"></a>
			</div>
			<div class="account a1">
					<a><?php echo $_COOKIE['HPNAME'] . "(" . $_COOKIE['HPID'] . ")"; ?></a>
					<a href="/hj/include/logout.php" class="log_btn">로그아웃</a>
			</div>
		</div>
	</header>
	<!-- <nav>
		<div class="nav2">
		</div>
		<div class="account a2">
				<a><?php echo $_COOKIE['HPNAME'] . "(" . $_COOKIE['HPID'] . ")"; ?></a>
				<a href="/hj/include/logout.php" class="log_btn">로그아웃</a>
		</div>
	</nav> -->
