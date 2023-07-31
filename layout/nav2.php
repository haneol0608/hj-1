<?php
  $SESSION_NAV = $_SESSION['NAV'];
  $SESSION = $_SESSION['STAT'];
  $style_m = "current_menu";
?>
<nav>
  <div class="nav_wrapper">
    
    <div class="account a2">
        <a><?php echo $_COOKIE['HPNAME'] . "(" . $_COOKIE['HPID'] . ")"; ?></a>
        <a href="/hj/include/logout.php" class="log_btn">로그아웃</a>
    </div>
    <ul>
      <li class="m1"><a href="#" class="nav_line jd">HJ MENU</a>
        <ul>

          <!-- <li><a class="<?php if($SESSION_NAV == 'sub1') echo $style_m; ?>" >수주관리(라다 공정)</a>
            <ul>
              <li><a class="<?php if($SESSION_NAV == 'sub1') echo $style_m; ?>" href="/hj/sub01/sub0101.php">컷팅지 등록</a></li>
              <li><a class="<?php if($SESSION_NAV == 'sub1') echo $style_m; ?>" href="/hj/sub01/sub0102.php">물량 산출</a></li>
              <li><a class="<?php if($SESSION_NAV == 'sub1') echo $style_m; ?>" href="/hj/sub01/sub0103.php">공정 리스트 조회</a></li>
              <li><a class="<?php if($SESSION_NAV == 'sub1') echo $style_m; ?>" href="/hj/sub01/sub0104.php">컷팅지 인쇄</a></li>
              <li><a class="<?php if($SESSION_NAV == 'sub1') echo $style_m; ?>" href="/hj/sub01/sub0105.php">라벨 마킹대기</a></li>
              <li><a class="<?php if($SESSION_NAV == 'sub1') echo $style_m; ?>" href="/hj/sub01/sub0106.php">라벨 마킹</a></li>
            </ul>
          </li> -->

          <li><a class="<?php if($SESSION_NAV == 'sub2') echo $style_m; ?>" >라다 공정</a>
            <ul>
              <li><a class="<?php if($SESSION_NAV == 'sub2') echo $style_m; ?>" href="/hj/sub02/sub0201.php">컷팅지 등록</a></li>
              <li><a class="<?php if($SESSION_NAV == 'sub2') echo $style_m; ?>" href="/hj/sub02/sub0202.php">물량 산출</a></li>
              <li><a class="<?php if($SESSION_NAV == 'sub2') echo $style_m; ?>" href="/hj/sub02/sub0203.php">공정 리스트 조회</a></li>
              <!-- <li><a class="<?php if($SESSION_NAV == 'sub2') echo $style_m; ?>" href="/hj/sub02/sub0104.php">컷팅지 인쇄</a></li> -->
              <!-- <li><a class="<?php if($SESSION_NAV == 'sub2') echo $style_m; ?>" href="/hj/sub02/sub0105.php">라벨 마킹대기</a></li> -->
              <!-- <li><a class="<?php if($SESSION_NAV == 'sub2') echo $style_m; ?>" href="/hj/sub02/sub0106.php">라벨 마킹</a></li> -->
            </ul>
          </li>

          <li><a class="<?php if($SESSION_NAV == 'sub3') echo $style_m; ?>">절단 공정(개발중)</a>
            <ul>
                <li><a class="<?php if($SESSION == '절단 치수') echo $style_m; ?>" href='/hj/sub03/sub0301.php'>절단 치수</a></li>
                <li><a class="<?php if($SESSION == '물량 산출') echo $style_m; ?>" href='/hj/sub03/sub0302.php'>물량 산출</a></li>
            </ul>
          </li>

          <li>
            <a class="<?php if($SESSION_NAV == 'sub5') echo $style_m; ?>" href="/hj/sub05/sub0501.php">생산관리</a>
          </li>

          <?php if($_COOKIE['HPLEVEL'] == "관리") { ?>
          <li>
            <a class="<?php if($SESSION_NAV == 'sub10') echo $style_m; ?>" href="/hj/sub10/sub1001.php">계정관리</a>
          </li>
          <?php } ?>
          
          <li>
            <a class="<?php if($SESSION_NAV == 'sub11') echo $style_m; ?>">기준정보관리</a>
            <ul>
                <li><a class="<?php if($SESSION_NAV == 'sub11') echo $style_m; ?>" href="/hj/sub11/sub1101.php">사업장 정보관리</a></li>
                <li><a class="<?php if($SESSION_NAV == 'sub11') echo $style_m; ?>" href="/hj/sub11/sub1102.php">사용자 정보관리</a></li>
                <li><a class="<?php if($SESSION_NAV == 'sub11') echo $style_m; ?>" href="/hj/sub11/sub1103.php">거래처 관리</a></li>
                <li><a class="<?php if($SESSION_NAV == 'sub11') echo $style_m; ?>" href="/hj/sub11/sub1104.php">공통코드 관리</a></li>
                <li><a class="<?php if($SESSION_NAV == 'sub11') echo $style_m; ?>" href="/hj/sub11/sub1105.php">제품 마스터 관리</a></li>
                <li><a class="<?php if($SESSION_NAV == 'sub11') echo $style_m; ?>" href="/hj/sub11/sub1106.php">원자재 마스터 관리</a></li>
                <li><a class="<?php if($SESSION_NAV == 'sub11') echo $style_m; ?>" href="/hj/sub11/sub1107.php">공정별 불량유형 관리</a></li>
                <li><a class="<?php if($SESSION_NAV == 'sub11') echo $style_m; ?>" href="/hj/sub11/sub1108.php">공정별 작업자 관리</a></li>
                <li><a class="<?php if($SESSION_NAV == 'sub11') echo $style_m; ?>" href="/hj/sub11/sub1109.php">작업표준서 관리(SOP)</a></li>
            </ul>
          </li>
          <li>
            <a class="<?php if($SESSION_NAV == 'sub12') echo $style_m; ?>">수주관리</a>
            <ul>
                <li><a class="<?php if($SESSION_NAV == 'sub12') echo $style_m; ?>" href="/hj/sub12/sub1201.php">수주관리</a></li>
                <li><a class="<?php if($SESSION_NAV == 'sub12') echo $style_m; ?>" href="/hj/sub12/sub1202.php">원자재 관리</a></li>
                <li><a class="<?php if($SESSION_NAV == 'sub12') echo $style_m; ?>" href="/hj/sub12/sub1203.php">수주완료 관리</a></li>
                <li><a class="<?php if($SESSION_NAV == 'sub12') echo $style_m; ?>" href="/hj/sub12/sub1204.php">완제품 관리</a></li>
                <li><a class="<?php if($SESSION_NAV == 'sub12') echo $style_m; ?>" href="/hj/sub12/sub1205.php">재고 현황</a></li>
            </ul>
          </li>
          <li>
            <a class="<?php if($SESSION_NAV == 'sub13') echo $style_m; ?>">가공관리</a>
            <ul>
                <li><a class="<?php if($SESSION_NAV == 'sub13') echo $style_m; ?>" href="/hj/sub13/sub1301.php">가공/생산지시서 관리</a></li>
                <li><a class="<?php if($SESSION_NAV == 'sub13') echo $style_m; ?>" href="/hj/sub13/sub1302.php">가공도면 관리</a></li>
                <li><a class="<?php if($SESSION_NAV == 'sub13') echo $style_m; ?>" href="/hj/sub13/sub1303.php">생산계획정보 관리</a></li>
                <li><a class="<?php if($SESSION_NAV == 'sub13') echo $style_m; ?>" href="/hj/sub13/sub1304.php">작업지시 관리</a></li>
                <li><a class="<?php if($SESSION_NAV == 'sub13') echo $style_m; ?>" href="/hj/sub13/sub1305.php">생산실적 관리</a></li>
                <li><a class="<?php if($SESSION_NAV == 'sub13') echo $style_m; ?>" href="/hj/sub13/sub1306.php">공정별 작업현황 관리</a></li>
                <li><a class="<?php if($SESSION_NAV == 'sub13') echo $style_m; ?>" href="/hj/sub13/sub1307.php">작업일보 관리</a></li>
                <li><a class="<?php if($SESSION_NAV == 'sub13') echo $style_m; ?>" href="/hj/sub13/sub1308.php">LOT별 원자재 현황</a></li>
            </ul>
          </li>
          <li>
            <a class="<?php if($SESSION_NAV == 'sub14') echo $style_m; ?>">수송관리</a>
            <ul>
                <li><a class="<?php if($SESSION_NAV == 'sub14') echo $style_m; ?>" href="/hj/sub14/sub1401.php">수송지시 관리</a></li>
                <li><a class="<?php if($SESSION_NAV == 'sub14') echo $style_m; ?>" href="/hj/sub14/sub1402.php">출하지시 관리</a></li>
                <li><a class="<?php if($SESSION_NAV == 'sub14') echo $style_m; ?>" href="/hj/sub14/sub1403.php">제품 미출하 현황</a></li>
                <li><a class="<?php if($SESSION_NAV == 'sub14') echo $style_m; ?>" href="/hj/sub14/sub1404.php">송장발행</a></li>
                <li><a class="<?php if($SESSION_NAV == 'sub14') echo $style_m; ?>" href="/hj/sub14/sub1405.php">송장 이력 추적</a></li>
            </ul>
          </li>
          <li>
            <a class="<?php if($SESSION_NAV == 'sub15') echo $style_m; ?>">공정관리</a>
            <ul>
                <li><a class="<?php if($SESSION_NAV == 'sub15') echo $style_m; ?>" href="/hj/sub15/sub1501.php">재고관리</a></li>
                <li><a class="<?php if($SESSION_NAV == 'sub15') echo $style_m; ?>" href="/hj/sub15/sub1502.php">가공 공정관리</a></li>
                <li><a class="<?php if($SESSION_NAV == 'sub15') echo $style_m; ?>" href="/hj/sub15/sub1503.php">라벨 마킹대기</a></li>
                <li><a class="<?php if($SESSION_NAV == 'sub15') echo $style_m; ?>" href="/hj/sub15/sub1504.php">라벨 마킹관리</a></li>
                <li><a class="<?php if($SESSION_NAV == 'sub15') echo $style_m; ?>" href="/hj/sub15/sub1505.php">라벨 마킹완료</a></li>
            </ul>
          </li>
          <li>
            <a class="<?php if($SESSION_NAV == 'sub16') echo $style_m; ?>">품질관리</a>
            <ul>
                <li><a class="<?php if($SESSION_NAV == 'sub15') echo $style_m; ?>" href="/hj/sub16/sub1601.php">제품불량 정보관리</a></li>
                <li><a class="<?php if($SESSION_NAV == 'sub15') echo $style_m; ?>" href="/hj/sub16/sub1602.php">제품검사 관리</a></li>
                <li><a class="<?php if($SESSION_NAV == 'sub15') echo $style_m; ?>" href="/hj/sub16/sub1603.php">통계적 품질정보 관리</a></li>
                <li><a class="<?php if($SESSION_NAV == 'sub15') echo $style_m; ?>" href="/hj/sub16/sub1604.php">제조이력 관리</a></li>
            </ul>
          </li>
          <li>
            <a class="<?php if($SESSION_NAV == 'sub17') echo $style_m; ?>">시스템 관리</a>
            <ul>
                <li><a class="<?php if($SESSION_NAV == 'sub17') echo $style_m; ?>" href="/hj/sub17/sub1701.php">사용자 설정</a></li>
                <li><a class="<?php if($SESSION_NAV == 'sub17') echo $style_m; ?>" href="/hj/sub17/sub1702.php">사용자 그룹 관리</a></li>
                <li><a class="<?php if($SESSION_NAV == 'sub17') echo $style_m; ?>" href="/hj/sub17/sub1703.php">그룹권한 설정</a></li>
                <li><a class="<?php if($SESSION_NAV == 'sub17') echo $style_m; ?>" href="/hj/sub17/sub1704.php">설정관리</a></li>
                <li><a class="<?php if($SESSION_NAV == 'sub17') echo $style_m; ?>" href="/hj/sub17/sub1705.php">암호변경</a></li>
                <li><a class="<?php if($SESSION_NAV == 'sub17') echo $style_m; ?>" href="/hj/sub17/sub1706.php">공지사항 관리</a></li>
                <li><a class="<?php if($SESSION_NAV == 'sub17') echo $style_m; ?>" href="/hj/sub17/sub1707.php">사용이력 관리</a></li>
                <li><a class="<?php if($SESSION_NAV == 'sub17') echo $style_m; ?>" href="/hj/sub17/sub1708.php">사용자 화면설정</a></li>
                <li><a class="<?php if($SESSION_NAV == 'sub17') echo $style_m; ?>" href="/hj/sub17/sub1709.php">사용화면 설정</a></li>
            </ul>
          </li>
          <li>
            <a class="<?php if($SESSION_NAV == 'sub19') echo $style_m; ?>">설비관리</a>
            <ul>
                <li><a class="<?php if($SESSION_NAV == 'sub19') echo $style_m; ?>" href="/hj/sub19/sub1901.php">설비장비관리</a></li>
                <li><a class="<?php if($SESSION_NAV == 'sub19') echo $style_m; ?>" href="/hj/sub19/sub1902.php">설비이력관리</a></li>
            </ul>
          </li>
          <li>
            <a class="<?php if($SESSION_NAV == 'sub20') echo $style_m; ?>">스마트패드 공정관리</a>
            <ul>
                <li><a class="<?php if($SESSION_NAV == 'sub20') echo $style_m; ?>" href="/hj/sub20/sub2001.php">통계적 공정정보 관리</a></li>
            </ul>
          </li>
          <li>
            <a class="<?php if($SESSION_NAV == 'sub21') echo $style_m; ?>">KPI 지표</a>
            <ul>
                <li><a class="<?php if($SESSION_NAV == 'sub21') echo $style_m; ?>" href="/hj/sub21/sub2101.php">성과표</a></li>
                <li><a class="<?php if($SESSION_NAV == 'sub21') echo $style_m; ?>" href="/hj/sub21/sub2103.php">로그데이터조회</a></li>
                <li><a class="<?php if($SESSION_NAV == 'sub21') echo $style_m; ?>" href="http://www.smart-robot.kr/admin/">라벨이력 조회</a></li>
            </ul>
          </li>
          
        </ul>
      </li>

      <!-- <li class="m2"><a href="#" class="nav_line mesM">MES</a>
        <ul class="subNav">
          <li><a href="#">기준정보관리</a>
            <ul>
              <li><a class="<?php if($SESSION_NAV == 'mes1_1') echo $style_m; ?>" href="/hj/MES/mes1_1.php">공통자료관리</a></li>
              <li><a class="<?php if($SESSION_NAV == 'mes1_2') echo $style_m; ?>" href="/hj/MES/mes1_2.php">거래처관리</a></li>
              <li><a href="/hj/MES/mes1_3.php">공정별 불량유형</a></li>
            </ul>
          </li>
          <li><a href="#">영업관리</a>
          </li>
          <li><a href="#">입출하관리</a>
            <ul>
              <li><a class="<?php if($SESSION_NAV == 'mes3_1') echo $style_m; ?>" href="/hj/MES/mes3_1.php">제품입고등록</a>
                <ul>
                  <li><a class="<?php if($SESSION_NAV == 'mes3_2') echo $style_m; ?>" href="/hj/MES/mes3_2.php">제품입고현황</a></li>
                </ul>
              </li>
              <li><a class="<?php if($SESSION_NAV == 'mes3_3') echo $style_m; ?>" href="/hj/MES/mes3_3.php">제품출하지시</a></li>
              <li><a class="<?php if($SESSION_NAV == 'mes3_4') echo $style_m; ?>" href="/hj/MES/mes3_4.php">제품출하처리</a></li>
              <li><a class="<?php if($SESSION_NAV == 'mes3_5') echo $style_m; ?>" href="/hj/MES/mes3_5.php">제품출하현황</a></li>
            </ul>
          </li>
          <li><a href="#">생산관리</a>
            <ul>
              <li><a class="<?php if($SESSION_NAV == 'mes4_1') echo $style_m; ?>" href="/hj/MES/mes4_1.php">수주정보관리</a>
                <ul>
                  <li><a class="<?php if($SESSION_NAV == 'mes4_2') echo $style_m; ?>" href="/hj/MES/mes4_2.php">생산계획정보관리</a></li>
                </ul>
              </li>
              <li><a class="<?php if($SESSION_NAV == 'mes4_3') echo $style_m; ?>" href="/hj/MES/mes4_3.php">작업지시관리</a></li>
            </ul>
          </li>
          <li><a href="#">공정관리</a></li>
          <li><a href="#">계측기관리</a></li>
          <li><a href="#">시스템관리</a>
            <ul>
              <li><a class="<?php if($SESSION_NAV == 'mes7_1') echo $style_m; ?>" href="/hj/MES/mes7_1.php">사용자설정</a></li>
            </ul>
          </li>
          <li><a href="#">품질관리</a>
            <ul>
              <li><a class="<?php if($SESSION_NAV == 'mes8_2') echo $style_m; ?>" href="/hj/MES/mes8_2.php">제품불량정보관리</a></li>
            </ul>
          </li>
          <li><a href="#">스마트패드관리</a></li>
        </ul>
      </li> -->
    </ul>

  </div>
</nav>
