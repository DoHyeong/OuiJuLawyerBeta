<?
 session_start();
  include '../db_conn.php';
 if(!$_SESSION['aid']) {return; exit; }
 $now = date("Y-m-d",time());

 ?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>외주변호사 CMS</title>
	
	<!-- bootstrap -->
	<link rel="stylesheet" type="text/css" href="css/bootstrap/bootstrap.min.css" />
	
	<!-- RTL support - for demo only -->
	<script src="js/demo-rtl.js"></script>
	<!-- 
	If you need RTL support just include here RTL CSS file <link rel="stylesheet" type="text/css" href="css/libs/bootstrap-rtl.min.css" />
	And add "rtl" class to <body> element - e.g. <body class="rtl"> 
	-->
	
	<!-- libraries -->
	<link rel="stylesheet" type="text/css" href="css/libs/font-awesome.css" />
	<link rel="stylesheet" type="text/css" href="css/libs/nanoscroller.css" />

	<!-- global styles -->
	<link rel="stylesheet" type="text/css" href="css/compiled/theme_styles.css" />

	<!-- this page specific styles -->
	<link rel="stylesheet" href="css/libs/daterangepicker.css" type="text/css" />
	<link rel="stylesheet" href="css/libs/jquery-jvectormap-1.2.2.css" type="text/css" />
	<link rel="stylesheet" href="css/libs/weather-icons.css" type="text/css" />
	
	<!-- Favicon -->
	<link type="image/x-icon" href="favicon.png" rel="shortcut icon" />

	<!-- google font libraries -->
	<link href='//fonts.googleapis.com/css?family=Open+Sans:400,600,700,300' rel='stylesheet' type='text/css'>

	<!--[if lt IE 9]>
		<script src="js/html5shiv.js"></script>
		<script src="js/respond.min.js"></script>
	<![endif]-->
</head>
<body class="pace-done theme-blue">
	<div id="theme-wrapper">

		
<? include 'top.php'; ?>

<? include 'left.php'; ?>



				<div id="content-wrapper">
					<div class="row">
						<div class="col-lg-12">
							<div class="row">
								<div class="col-lg-12">
									<div id="content-header" class="clearfix">
										<div class="pull-left">
											<ol class="breadcrumb">
												<li><a href="#">홈</a></li>
												<li class="active"><span>계약서명보기</span></li>
											</ol>
											
											<h1>서명보기</h1> <? echo "서버 기준 시각:".date("Y-m-d H:i:s",time()); ?>
										</div>

										<div class="pull-right hidden-xs">
											<div class="xs-graph pull-left">
												
												
											</div>

											<div class="xs-graph pull-left mrg-l-lg mrg-r-sm">
											
											
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
							
							
								<div class="col-lg-3 col-sm-6 col-xs-12">
																	

									<div class="main-box infographic-box colored emerald-bg">
										<i class="fa fa-envelope"></i>
										<span class="headline">작성된 계약서 갯수</span>
										<span class="value">
                                         <?
                                        $sql = "SELECT Count(*) FROM  `contract_simple`;";
                                        $result = mysql_query($sql);
                                        $row = mysql_fetch_array($result);
                                        echo $row[0]."개";

                                        ?>
                                        
                                        </span>
									</div>
								</div>

								<div class="col-lg-3 col-sm-6 col-xs-12">
									<div class="main-box infographic-box colored green-bg">
										<i class="fa fa-money"></i>
										<span class="headline">총 계약금액</span>
										<span class="value">
                                        
                                          <?
                                        $sql = "SELECT SUM( contract_amount ) FROM  `imsi_contract`;";
                                        $result = mysql_query($sql);
                                        $row = mysql_fetch_array($result);
                                        echo number_format($row[0])."원";

                                        ?>
                                        
                                        
                                        </span>
									</div>
								</div>

								<div class="col-lg-3 col-sm-6 col-xs-12">
									<div class="main-box infographic-box colored red-bg">
										<i class="fa fa-user"></i>
										<span class="headline">유저</span>
										<span class="value">
                                        <?
                                        $sql = "SELECT Count(*) FROM  `user`;";
                                        $result = mysql_query($sql);
                                        $row = mysql_fetch_array($result);
                                        echo $row[0]."명";

                                        ?>
                                        
                                        
                                        </span>
									</div>
								</div>

								<div class="col-lg-3 col-sm-6 col-xs-12">
									<div class="main-box infographic-box colored purple-bg">
										<i class="fa fa-globe"></i>
										<span class="headline">오늘 작성된 계약서</span>
										<span class="value">
                                         <?

                                        $sql = "SELECT count(*) 
                                                FROM  `contract_simple` 
                                                WHERE  `mk_date` LIKE  '%$now%'";
                                        $result = mysql_query($sql);
                                        $row = mysql_fetch_array($result);
                                        echo $row[0]."개";

                                        ?>
                                        
                                        </span>
									</div>
								</div>
							</div>

						
					<div class="row">

                                <?

                                $sql = "SELECT `imsi_contract`.`cid`,`imsi_contract`.`user_id`,`imsi_contract`.`balju_name`,`my_info`.`uid`,`my_info`.`my_name`
                                        FROM  `imsi_contract` 
                                        INNER JOIN `my_info`
                                        WHERE `imsi_contract`.`user_id` = `my_info`.`uid`";

                                $result = mysql_query($sql);
                                while($row = mysql_fetch_array($result)){

                                    ?>        
						<div style="width:200px;max-height:200px;" class="col-lg-4 col-md-6 col-sm-6">
									<div class="main-box clearfix project-box emerald-box">
										<div class="main-box-body clearfix">
											<div class="project-box-header emerald-bg">
												<div class="name">
													<a href="#">
                                                    <? echo $row['my_name'];?>													
                                                    </a>
												</div>
											</div>
											
											<div class="project-box-content">
											<? 
                                                     $src = md5($row['cid']."my");
                                                    echo "<img width='100px' src='../sign/$src.png'>"; ?>
											</div>
											
											
										
										</div>
									</div>
								</div>


                                				<div style="width:200px;max-height:200px;" class="col-lg-4 col-md-6 col-sm-6">
									<div class="main-box clearfix project-box emerald-box">
										<div class="main-box-body clearfix">
											<div class="project-box-header emerald-bg">
												<div class="name">
													<a href="#">
                                                    <? echo $row['balju_name'];?>													
                                                    </a>
												</div>
											</div>
											
											<div class="project-box-content">
											<? 
                                                     $src = md5($row['cid']."your");
                                                    echo "<img width='100px' src='../sign/$src.png'>"; ?>
											</div>
											
											
										
										</div>
									</div>
								</div>

                                <? } ?>
								
							
								
								
										<div class="col-md-7">
													<div id="world-map" style="width: 100%; height: 400px"></div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							
						</div>
					</div>
			
				</div>
			</div>
		</div>
	</div>
		
	
	
	<!-- global scripts -->
	<script src="js/demo-skin-changer.js"></script> <!-- only for demo -->
	
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.js"></script>
	<script src="js/jquery.nanoscroller.min.js"></script>
	
	<script src="js/demo.js"></script> <!-- only for demo -->
	
	<!-- this page specific scripts -->
	<script src="js/moment.min.js"></script>
	<script src="js/jquery-jvectormap-1.2.2.min.js"></script>
	<script src="js/jquery-jvectormap-world-merc-en.js"></script>
	<script src="js/gdp-data.js"></script>
	<script src="js/flot/jquery.flot.min.js"></script>
	<script src="js/flot/jquery.flot.resize.min.js"></script>
	<script src="js/flot/jquery.flot.time.min.js"></script>
	<script src="js/flot/jquery.flot.threshold.js"></script>
	<script src="js/flot/jquery.flot.axislabels.js"></script>
	<script src="js/jquery.sparkline.min.js"></script>
	<script src="js/skycons.js"></script>
	
	<!-- theme scripts -->
	<script src="js/scripts.js"></script>
	<script src="js/pace.min.js"></script>
	
	<!-- this page specific inline scripts -->
	
</body>
</html>