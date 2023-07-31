<html lang="ko">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="author" content="(유)호인 IT 사업부 김한얼">
	<meta name="description" content="2021-11-11_호인">
	<meta name="generator" content="Sublime, Atom">
	<title>한진기공 MES</title>

	<!-- style -->
	<!-- <link rel="stylesheet" href="/hoin/include/css/reset.css">
	<link rel="stylesheet" href="/hoin/include/css/style.css"> -->

	<!-- 웹 폰트 -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css?family=Nanum+Gothic" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Nanum+Brush+Script" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Abel&display=swap" rel="stylesheet">

  <style>
    /* 전체 css 적용 */
    * {
    	box-sizing: border-box;
			margin: 0;
			padding: 0;
		}
    body {
      /* background-image: url("/jd/include/images/JD_login_bg.jpg"); */
      background-size: cover;
	  background-position: center;
      background-repeat: no-repeat;
      font-family: 'Gaegu';
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
			margin: 0;
		}

    .container {
			background: rgba(255, 255, 255, 0.95);
	    border-radius: 5px;
	    box-shadow: 0 4px 24px 0 rgb(34 41 47 / 10%);
	    width: 350px;
	    height: 450px;
	    position: relative;
	    border-radius: 5px;
	    overflow: hidden;
		}

    .form {
    	margin-top: 25px;
    	padding: 20px;
			position: relative;
			text-align: center;
		}

    .form-control {
      margin-bottom: 10px;
      /* padding-bottom: 20px; */
      position: relative;
			text-align: left;
    }

    .form-control label {
      margin-left: 20px;
      color: #777;
      display: block;
      margin-bottom: 5px;
    }

    /* input창 css */
    .form-control input {
      margin-left: 20px;
      border: 2px solid #f0f0f0;
      border-radius: 4px;
      display: block;
      width: 90%;
      padding: 10px;
      font-size: 14px;
    }

    /* 커서가 input으로 지정된 상태일때 */
    .form-control input:focus {
      outline: 0;
      border-color: #777;
    }

    .form button {
			cursor: pointer;
	    background: rgba(17, 50, 84, 0.5);
	    border: rgba(29, 20, 123, 0.8);
	    border-radius: 4px;
	    color: #fff;
	    display: block;
	    font-size: 16px;
			font-weight: bold;
	    width: 90%;
	    padding: 5px;
	    display: inline-block;
	    margin-top: 10px;
    }
		.mes_title {
			background: rgba(17, 50, 84, 0.3);
	    padding: 15px;
	    /* background-image: linear-gradient(90deg, #1d147b 30%, #723eda 100%); */
	    color: #fff;
	    /* text-shadow: 0 0 5px #999; */
}
			/* opacity: 0.2; */
		}
		.mes_title p {
			margin: 5px;
			font-size: 0.9em;
		}
		.mes_title span {
			font-size: 0.9em;
		}
		.logos {
			width: 150px;
	    /* height: 40px; */
	    position: absolute;
	    bottom: 60px;
	    left: 50%;
	    transform: translateX(-50%);
		}
		.logos img {
			width: 100%;
	    /* height: 100%; */
	    position: absolute;
		}
		.auto_memo {
			text-align: center;
			font-size: 0.9em;
		}


  </style>
</head>

<body>
  <div class="container">
		<div class="mes_title">
			<h3><span>(주)</span>한진기공<h3>
			<p>스마트 생산관리 시스템</p>
		</div>


    <form action="include/userCheck.php" method="post" id="form" class="form">
      <div class="form-control">
        <label for="userid">회원아이디</label>
        <input name="login_id" type="text" id="userid" placeholder="아이디를 입력하세요.">
      </div>

      <div class="form-control">
        <label for="password">비밀번호</label>
        <input name="password" type="password" id="password" placeholder="비밀번호를 입력하세요.">
      </div>

      <button type="submit" name="login">로그인</button>
    </form>

		<div class="auto_memo">
			<input type="checkbox"> <sapn>로그인정보 기억하기</span>
		</div>

		<!-- <div class="logos"><img src="include/images/logos.png"></div> -->


  </div>
</body>
</html>
