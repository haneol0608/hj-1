<!-- footer -->
<?php
//   $stat_arr = ["벤딩", "취부/용접", "사상"];
//   $count_statArr = array();

//   for($i = 0; $i < count($stat_arr); $i++) {
//     $select_query = "SELECT COUNT(no) AS COUNT_STAT FROM jd_RAW_MATER WHERE STAT = '$stat_arr[$i]' ";
//     $select_result = mysqli_query($conn, $select_query);
//     $row = mysqli_fetch_assoc($select_result);

//     $COUNT_STAT = $row['COUNT_STAT'];
//     array_push($count_statArr, $COUNT_STAT);
//   }

//   $bend_count = $count_statArr[0];
//   $chi_count = $count_statArr[1];
//   $sa_count = $count_statArr[2];
?>
<footer>
  <div class="f_wrap">
    <div class="container foot_ct">
      <p>contact1 : 061_281_5225<br> contact2 : hoin5225@hanmail.net</p>
      <a href="#"><img src="/hj/include/images/hoin_logo.PNG" alt="호인로고"></a>
    </div>
  </div>
</footer>
<!-- //footer -->

  <!-- javascript library -->
  <script type="text/javascript" src="/hj/include/js/jquery.min_1.12.4.js"></script>
  <!-- <scr

  <script type="text/javascript" src="http://code.jquery.com/jquery-3.5.1.min.js"></script> -->
  <script type="text/javascript" src="/hj/include/js/jquery-ui.js"></script>
  <script type="text/javascript" src="/hj/include/js/script.js"></script>
  <script type="text/javascript" src="/hj/include/js/lightgallery.ts"></script>
  <script type="text/javascript" src="/hj/include/js/lightgallery-all.min.js"></script>
  <!-- //javascript library -->

  <script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ['Task', 'Hours per Day'],
        ['벤딩', 10],
        ['취부/용접', 20],
        ['사상',  30]
      ]);

      var options = {
        title: '생산 공정 모니터링',
        backgroundColor: '#fff',
        titleTextStyle: { fontSize: 20 },
        legend : { position: 'bottom' },
        slices: {
          0: { color: '#6c5dd3' },
          1: { color: '#ffa2c0'},
          2: { color: '#46bcaa' }
        }
      };

      var chart = new google.visualization.PieChart(document.getElementById('piechart'));

      chart.draw(data, options);
    }

    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart2);

    function drawChart2() {
      var data = google.visualization.arrayToDataTable([
        ['Year', '예상목표', '진행결과'],
        ['1주차',  1000,      400],
        ['2주차',  1170,      460],
        ['3주차',  660,       1120],
        ['4주차',  1030,      540]
      ]);

      var options = {
        title: '주간 업무 진행 현황',
        backgroundColor: '#fff',
        curveType: 'function',
        legend: { position: 'bottom' },
        titleTextStyle: { fontSize: 20 },
        colors: ['#46bcaa', '#4d69fa']
      };

      var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

      chart.draw(data, options);
    }

  </script>

</body>
</html>
