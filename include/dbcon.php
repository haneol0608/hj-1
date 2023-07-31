<?php
  /***************************************************
  2020.12.23. KHO. DB연결 리팩토링

  $server = "localhost";
  $id = "root";
  $pw = "0072266";
  $db = "cms";

  $conn = mysqli_connect($server, $id, $pw, $db);
  **************************************************/

  /***************************************************
  2020.12.23. KHO. define()
  foreach(키 => 값) - 배열을 변수로 만드는 함수
  define(상수명, 상수값) - 상수를 정의하는 함수
  strtoupper(문자열) - 문자열을 대문자로 바꾸는 함수
  **************************************************/
  $db['db_host'] = "localhost";
  $db['db_id'] = "jd5225";
  $db['db_pw'] = "wjdehd5225!";
  $db['db_name'] = "jd5225";

  /***************************************************
  2020.12.24. KHO. 배열 표현
  array(
    key => value;
  )
  **************************************************/

  foreach($db as $key => $value) {
    define(strtoupper($key), $value);
  }

  $conn = mysqli_connect(DB_HOST, DB_ID, DB_PW, DB_NAME);
  // if(!$conn) {
  //   echo "DB 연결 안됨!!";
  // } else {
  //   echo "DB 연결 완료!!";
  // }

  $db2['db_host2'] = "27.96.135.94";
  $db2['db_id2'] = "root";
  $db2['db_pw2'] = "ghdls3450!";
  $db2['db_name2'] = "hj_marking";

  foreach($db2 as $key2 => $value2) {
      define(strtoupper($key2), $value2);
  }

  $conn2 = mysqli_connect(DB_HOST2, DB_ID2, DB_PW2, DB_NAME2);
  // mysqli_set_charset($conn2, "utf8"); // 한글깨짐 방지
?>
