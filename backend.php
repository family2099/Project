<?php 
	header("content-type: text/html; charset=utf-8");
	//載入登入類別	
	require_once('connection.php');
	session_start();
	
	
	/*假設我們的網址是 http://www.wibibi.com/test.php?tid=333

	則以上 $_SERVER 分別顯示結果會是
	
	echo $_SERVER['HTTP_HOST'];　//顯示 www.wibibi.com
	echo $_SERVER['REQUEST_URI'];　//顯示 /test.php?tid=222
	echo $_SERVER['PHP_SELF'];　//顯示 /test.php
	echo $_SERVER['QUERY_STRING'];　//顯示 tid=222*/
	
	
	
    if(!isset($_SESSION['userName']) || !isset($_SESSION['Groun']))
    {
        
       
      	header("Location: index.php");
      	exit();
        
        
        
    }
	
	
	
	
	
	
	
?>




<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<!---PS:其他js檔都要放JQUERY後面要不其他js檔先執行會錯誤--->
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="js/jquery.js"></script>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/self.css" rel="stylesheet">
	<link href="css/index.css" rel="stylesheet">
	<!--出現問題Mixed Content: The page at 'https://lab-coolmancz.c9users.io/shopping/' was loaded over HTTPS, but requested an insecure stylesheet 'http://fonts.googleapis.com/css?family=Roboto'. This request has been blocked; the content must be served over HTTPS.
	解決方法Edit your theme replacing every occurency of http://fonts.googleapis.com/... with https://fonts.googleapis.com/... (mind the s).

	Resources that might pose a security risk (such as scripts and fonts) must be loaded through a secure connection when requested in the context of a secured page for an obvious reason: they could have been manipulated along the way-->
	<link href="css/login.css" rel="stylesheet">
	<script type="text/javascript" src="js/getindex.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/login_form.js"></script>





</head>

<body>


	<?php require_once('nav.php'); ?>

	<div class="container-fluid dis_top">

		<div class="row">

			<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12 ">

				<div class="panel panel-info">
					<div class="panel-heading">
						<h3 class="panel-title">商品分類</h3>
					</div>
					<div class="panel-body">
						<div class="panel panel-warning">
							<!-- Default panel contents -->
							<div class="panel-heading" id="comp">電腦圖書</div>


							
						</div>

						<div class="panel panel-warning">
							<!-- Default panel contents -->
							<div class="panel-heading" id="edu">教育軟體</div>


						
						</div>

						<div class="panel panel-warning">
							<!-- Default panel contents -->
							<div class="panel-heading" id="bus">商用軟體</div>


							
						</div>
						<!-- 		<button type="button" class="list-group-item" id="computer">電腦圖書</button>-->
						<!--	<div id="showcomputer">-->

						<!--	    <ul>-->
						<!--	      <li>List item one</li>-->
						<!--	      <li>List item two</li>-->
						<!--	      <li>List item three</li>-->
						<!--	    </ul>-->
						<!--  	</div>-->
						<!--<button type="button" class="list-group-item"></button>-->
						<!--<button type="button" class="list-group-item"></button>-->


					</div>
				</div>



			</div>

			<div class="col-sm-9 col-md-9 col-lg-9 col-xs-12" id="showitem">
				


			</div>

			<div class="col-sm-9 col-sm-offset-3 col-md-9 col-md-offset-3 col-lg-9 col-lg-offset-3 col-xs-12">

			


			</div>


		</div>
	</div>




</body>

</html>

