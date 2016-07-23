<?php
//做成按鈕傳送到另一個頁面
session_start();

if(!isset($_SESSION['userName'])){
    
   
  	header("Location: index.php");
  	exit();
    
    
    
}
 $_SESSION['PrevPage'] = 'member_center.php';


//echo $_SESSION['userName'];
?>


<!DOCTYPE html>
<html>
<head><meta charset="utf-8">
	<!---PS:其他js檔都要放JQUERY後面要不其他js檔先執行會錯誤--->
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="js/jquery.js"></script>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/self.css" rel="stylesheet">
	<link href="css/login.css" rel="stylesheet">
	<script src="js/bootstrap.min.js"></script>
	
	

	
	
	
</head>

<body>

    <?php require_once('nav.php'); ?>


    <div class="container-fluid dis_top">
				
		<div class="row">
		
			<div class="page-header">
			  <center><h1>會員中心 <small>member center</small></h1></center>
			</div>
			
		</div>	
		<div class="row">
			<div class="col-xm-12 col-sm-10 col-sm-offset-1 col-md-9 col-md-offset-1 col-lg-8 col-lg-offset-2">
				<div class="panel panel-danger">
					<div class="panel-heading">
						<h3 class="panel-title"><h2>帳號管理</h2></h3>
					</div>
					<div class="panel-body">
						<div class="row">
				    		<!--<div class="col-sm-5 col-sm-offset-1 col-md-4 col-md-offset-1 col-lg-4 col-lg-offset-1">-->
				    			<a class="btn btn-danger btn-block" href="member_modify.php" role="button">會員資料管理</a>
				    		<!--</div>-->
				    		<!--<div class=" col-md-2 col-lg-2">-->
				    			
				    		<!--</div>-->
				    		<!--<div class="col-sm-5 col-md-4 col-lg-4">-->
				    		<!--	<a class="btn btn-danger btn-lgc" href="member_modify.php" role="button">變更會員密碼</a>-->
				    		<!--</div>-->
				    	</div>
					</div>
				</div>
			</div>
		</div>
				<!--<div class="jumbotron">-->
				<!--  <h1>Hello, world!</h1>-->
				<!--  <p>...</p>-->
				<!--  <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a></p>-->
				<!--</div>-->
				<!--<div class="panel panel-info">-->
				<!--  <div class="panel-heading">-->
				<!--    <h3 class="panel-title">會員功能</h3>-->
				<!--  </div>-->
				<!--  <div class="panel-body">-->
				<!--  		<div class="panel panel-warning">-->
						  <!-- Default panel contents -->
				<!--		  <div class="panel-heading" id="membm">會員資料管理</div>-->
						  
						
						  <!-- List group -->
				<!--		  <ul class="list-group" id="showmembm">-->
				<!--		    <li class="list-group-item" id="checkmem_getmemdata">編輯會員資料</li>-->
				<!--		    <li class="list-group-item">變更密碼</li>-->
						    
						    
				<!--		  </ul>-->
				<!--		</div>-->
						
				<!--		<div class="panel panel-warning">-->
						  <!-- Default panel contents -->
				<!--		  <div class="panel-heading" id="ordsear">訂單相關查詢</div>-->
						  
				<!--			<div class="col-lg-3 col-lg-offset-3">-->
				<!--				<a class="btn btn-primary btn-lg btn-block" href="#" role="button">訂單查詢</a>-->
				<!--			</div>	-->
				<!--			<div class="col-lg-3 col-lg-offset-3">-->
				<!--				<a class="btn btn-primary btn-lg btn-block" href="#" role="button">申請退換貨</a>-->
								
				<!--			</div>-->
						  <!-- List group -->
						  <!--<ul class="list-group" id="showordsear">-->
						  <!--  <li class="list-group-item">訂單查詢</li>-->
						  <!--  <li class="list-group-item">申請退換貨</li>-->
						    
						  <!--</ul>-->
				<!--		</div>-->
						
						
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
					
						
				<!--  </div>-->
				<!--</div>-->
				

			
	
		<div class="row">
			<div class="col-xm-12 col-sm-10 col-sm-offset-1 col-md-9 col-md-offset-1 col-lg-8 col-lg-offset-2">
				<div class="panel panel-warning">
				  <div class="panel-heading">
				    <h3 class="panel-title"><h2>訂單相關查詢</h2></h3>
				  </div>
				  <div class="panel-body">
						<div class="row">
				    		<!--<div class="col-sm-5 col-sm-offset-1 col-md-4 col-md-offset-1 col-lg-4 col-lg-offset-1">-->
				    			<a class="btn btn-warning btn-block" href="orderhandle.php" role="button">訂單查詢</a>
				    		<!--</div>-->
				    		<!--<div class="col-md-2 col-lg-2">-->
				    			
				    		<!--</div>-->
				    		<!--<div class="col-sm-5 col-md-4 col-lg-4">-->
				    		<!--	<a class="btn btn-warning btn-lgc" href="orderhandle.php" role="button">申請退貨</a>-->
				    		<!--</div>-->
				    	</div>
				  </div>
				</div>
			</div>
		</div>
	</div>
			
			
			
	
    
</body>

</html>
