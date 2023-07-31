<!-- header -->
<?php include "layout/header.php"; ?>
<?php include 'include/dbcon.php'; ?>
<?php include "include/loginCheck.php" ?>

	<!-- content -->
	<div class="content main">
        
		<div class="container ct_wrap">
			<?php include "layout/nav2.php" ?>

			<div class="container_ct">
				<div class="monitoring">
					<div id="piechart"></div>
					<div id="curve_chart"></div>
				</div>
                
		    	<div class="main_ct">
					<section class="main_touch">
						<a href="/hj/sub02/sub0201.php"><span><img src="/hj/include/images/layers.png" alt="입고서 이미지1"></span>라다 공정</a>
						<a href="/hj/sub05/sub0501.php"><span><img src="/hj/include/images/worksheet1.png" alt="메인버튼 이미지2"></span>생산 관리</a>
						<a href="/hj/sub10/sub1001.php"><span><img src="/hj/include/images/materials.png" alt="메인버튼 이미지3"></span>계정 관리</a>
						<a href="/hj/sub13/sub1302.php"><span><img src="/hj/include/images/rulers.png" alt="메인버튼 이미지4"></span>가공도면 관리</a>
						<a href="/hj/sub11/sub1106.php"><span><img src="/hj/include/images/producing.png" alt="메인버튼 이미지5"></span>원자재 마스터 관리</a>
						<a href="/hj/sub14/sub1401.php"><span><img src="/hj/include/images/sending_out.png" alt="메인버튼 이미지6"></span>수송 지시</a>
						<a href="/hj/sub16/sub1602.php"><span><img src="/hj/include/images/scanning.png" alt="메인버튼 이미지7"></span>제품검사 관리</a>
						<a href="/hj/sub19/sub1901.php"><span><img src="/hj/include/images/repairing.png" alt="메인버튼 이미지8"></span>설비장비 관리</a>
						<a href="/hj/sub21/sub2101.php"><span><img src="/hj/include/images/client.png" alt="메인버튼 이미지9"></span>KPI(라벨) 지표</a>
					</section>
		    	</div>
			</div>

		</div>


	</div>

	<!-- //content -->

<!-- footer -->
<?php include "layout/footer.php"; ?>
<!-- //footer -->
