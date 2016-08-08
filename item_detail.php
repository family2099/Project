<?php 
	header("content-type: text/html; charset=utf-8");
	session_start();
	require_once("connection.php");
	require_once('function.php');
	
	//設定前一瀏覽頁面
	$_SESSION['PrevPage'] =  $_SERVER['PHP_SELF'];
	if(!(isset($_GET['pro_id']))){
    
   
    
	  	header("Location: index.php");
	  	exit();
	    
    
    
	}
	
	try {
			$db = new PDO("mysql:host=localhost;dbname=test", "root", "");
			
			$db->exec("SET CHARACTER SET utf8");
	} 
	catch (PDOException $e) {
	     echo 'Error!: ' . $e->getMessage() . '<br />';
	}
	
	
	/*-------------------------
	 顯示目前書籍的詳細資料
	-------------------------*/
	
	//ConfigDataBase::getDsn();
	
	$query=sprintf("SELECT * FROM " . $_SESSION['database'] . " WHERE id = %s", GetSQLValue($_GET['pro_id'], "int"));
	
	$result = $db->prepare($query);

	//print_r($data);

	$result->execute();
	
	//$db=null;
	
	
	//echo $totalRows;
	if($result)
	{
		//目前的列
		$data=$result->fetch(PDO::FETCH_ASSOC);
		// 總頁數,ceil() 函數向上捨入為最接近的整數(就是有小數點就直接進位)。
		//$totalPages = ceil($totalRows / $datasPerPage);
		//echo $totalRows;
	}
	
	
	
    	
	
	    
	  	
    $obj=new login();
	$obj->acctpassw_check($_POST['userN'],$_POST['passW']);
    
    
	
	/*-------------------------
	 顯示目前書籍的詳細資料
	-------------------------*/
	
	// 選擇 MySQL 資料庫test
	 
	// 查詢 $_SESSION['database'] 資料表
	//如果變數內容是字串請加單引號並用雙引號包住,要小心空格
	// $query = "SELECT * FROM computer_books WHERE id=".$_GET['id']." AND category='".$_GET['category']."'";
	//echo $query;
	// $getitem=ConfigDataBase::$_dsnconn->prepare($query);
	// $getitem->execute();
	//var_dump($getitem);
	//$totalRows = $getitem->rowCount();	
	//echo $totalRows;
	//$data = $getitem->fetch(PDO::FETCH_ASSOC)
	
	// while($data = $getitem->fetch(PDO::FETCH_ASSOC))
	// {

	// 		$data=array(
	// 				"id"=>$data["id"],
	// 				"title"=>$data["title"],
	// 				"author"=>$data["author"],
	// 				"translator"=>$data["translator"],
	// 				"contents"=>$data["contents"],
	// 				"feature"=>$data["feature"],
	// 				"cd"=>$data["cd"],
	// 				"publishdate"=>$data["publishdate"],
	// 				"price"=>$data["price"],
	// 				"discount"=>$data["discount"],
	// 				"saleprice"=>$data["saleprice"],
	// 				"item_index"=>$data["item_index"],
	// 				"photo"=>$data["photo"],
	// 				"publisher"=>$data["publisher"],
	// 				"color"=>$data["color"],
	// 				"category"=>$data["category"],
	// 				"category_type"=>$data["category_type"]
			
	// 		);
			
			
			
	// }

	//var_dump($data);
		
	
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

	<!--出現問題Mixed Content: The page at 'https://lab-coolmancz.c9users.io/shopping/' was loaded over HTTPS, but requested an insecure stylesheet 'http://fonts.googleapis.com/css?family=Roboto'. This request has been blocked; the content must be served over HTTPS.
	解決方法Edit your theme replacing every occurency of http://fonts.googleapis.com/... with https://fonts.googleapis.com/... (mind the s).

	Resources that might pose a security risk (such as scripts and fonts) must be loaded through a secure connection when requested in the context of a secured page for an obvious reason: they could have been manipulated along the way-->
	<link href="css/login.css" rel="stylesheet">
	<script src="js/bootstrap.min.js"></script>
	<script src="js/getindex.js"></script>
	<script src="js/cardata.js"></script>
	<link href="css/item_detail.css" rel="stylesheet">




</head>

<body>


	<?php require_once('nav.php'); ?>

	<div class="container-fluid dis_top">

		<div class="row">

			<!--<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12 ">-->

			<!--	<div class="panel panel-info">-->
			<!--	  <div class="panel-heading">-->
			<!--	    <h3 class="panel-title">商品分類</h3>-->
			<!--	  </div>-->
			<!--	  <div class="panel-body">-->
			<!--	  		<div class="panel panel-warning">-->
			<!-- Default panel contents -->
			<!--			  <div class="panel-heading" id="comp">電腦圖書</div>-->


			<!-- List group -->
			<!--			  <ul class="list-group" id="showcomp">-->
			<!--			    <li class="list-group-item">網頁設計</li>-->
			<!--			    <li class="list-group-item">程式語言</li>-->
			<!--			    <li class="list-group-item">多媒體系列</li>-->

			<!--			  </ul>-->
			<!--			</div>-->

			<!--			<div class="panel panel-warning">-->
			<!-- Default panel contents -->
			<!--			  <div class="panel-heading" id="edu">教育軟體</div>-->


			<!-- List group -->
			<!--			  <ul class="list-group" id="showedu">-->
			<!--			    <li class="list-group-item">影像多媒體</li>-->
			<!--			    <li class="list-group-item">電腦繪圖</li>-->
			<!--			    <li class="list-group-item">工具軟體</li>-->

			<!--			  </ul>-->
			<!--			</div>-->

			<!--			<div class="panel panel-warning">-->
			<!-- Default panel contents -->
			<!--			  <div class="panel-heading" id="bus">商用軟體</div>-->


			<!-- List group -->
			<!--			  <ul class="list-group" id="showbus">-->
			<!--			    <li class="list-group-item">作業系統</li>-->
			<!--			    <li class="list-group-item">防毒防駭</li>-->
			<!--			    <li class="list-group-item">文書處理</li>-->

			<!--			  </ul>-->
			<!--			</div>-->
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


			<!--	  </div>-->
			<!--	</div>-->



			<!--</div>-->

			<div class="col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1 col-xs-12">
				<table class="item_detail_style1">
					<tr>
						<td class="item_detail_style2">
							<table class="item_detail_style1">
								<tr>
									<td class="item_detail_style3">
										<?php echo $data['title']; ?>
									</td>
								</tr>
							</table>
							<table class="item_detail_style4">
								<tr>
									<td class="item_detail_style5">
										<img src="<?php echo 'photo/item/'.$data['photo']; ?>" width="108" />
										<br /><br />


									</td>
									<td class="item_detail_style6">
										<table class="item_detail_style1">
											<tr>
												<td class="item_detail_style7">
													編號
												</td>
												<td class="item_detail_style8">
													<?php echo $data['item_index']; ?>
												</td>
											</tr>
											<tr>
												<td class="item_detail_style7">
													作者
												</td>
												<td class="item_detail_style8">
													<?php echo $data['author']; ?>
												</td>
											</tr>
											<tr>
												<td class="item_detail_style7">
													翻譯
												</td>
												<td class="item_detail_style8">
													<?php echo $data['translator']; ?>
												</td>
											</tr>
											<tr>
												<td class="item_detail_style7">
													出版商
												</td>
												<td class="item_detail_style8">
													<?php echo $data['publisher']; ?>
												</td>
											</tr>
											<tr>
												<td class="item_detail_style7">
													初版日
												</td>
												<td class="item_detail_style8">
													<?php echo date("Y年n月", strtotime($data['publishdate'])); ?>
												</td>
											</tr>
											<tr>
												<td class="item_detail_style7">
													類別
												</td>
												<td class="item_detail_style8">
													<?php echo $data['category']; ?> 
													<?php echo $data['category_type']; ?>
												</td>
											</tr>
											<tr>
												<td class="item_detail_style7">
													定價
												</td>
												<td class="item_detail_style8">
													<?php echo $data['price']; ?> 元
												</td>
											</tr>
											<tr>
												<td class="item_detail_style7">
													線上價
												</td>
												<td class="item_detail_style8">
													<span class="item_detail_style10">
													<?php echo $data['discount']; ?>
				                  		  </span> 折
													<span class="item_detail_style10">
													<?php echo $data['saleprice']; ?>
						                  </span> 元
												</td>
											</tr>
											<tr>
												<td class="item_detail_style7">
													備註
												</td>
												<td class="item_detail_style8">
													<?php if ($data['cd']==1) { echo '本產品附光碟'; } ?>
												</td>
											</tr>
										</table>
									</td>
									<td class="item_detail_style6">
										<br>
										<a href="add_to_cart.php?id=<?php echo $data['id']; ?>" class="btn btn-info btn-lg cardata" role="button">加入購物車</a>


										<br>
										<br>
									

									</td>
								</tr>
							</table>
							<?php 
						      if (isset($data['contents'])) 
						      { 
						    ?>
							<table class="item_detail_style13">
								<tr>
									<td class="item_detail_style11">
										目<br />錄
									</td>
									<td class="item_detail_style12">
										<?php echo nl2br($data['contents']); ?>
									</td>
								</tr>
							</table>
							<?php 
								  } 
								  if (isset($data['feature'])) 
									{ 
							  ?>
							<table class="item_detail_style13">
								<tr>
									<td class="item_detail_style11">
										特<br />色
									</td>
									<td class="item_detail_style12">
										<?php echo nl2br($data['feature']); ?>
									</td>
								</tr>
							</table>
							<?php 
								  } 
								?>
							<table class="item_detail_style13">
								<tr>
									<td class="item_detail_style11">
										光<br />碟<br />內<br />容
									</td>
									<td class="item_detail_style12">
										範例檔案
									</td>
								</tr>
							</table>
							<table class="item_detail_style13">
								<tr>
									<td class="item_detail_style11">
										備<br />註
									</td>
									<td class="item_detail_style12">
										<?php if ($data['color']==1) { echo '彩色書'; } ?>
									</td>
								</tr>
							</table>
						</td>




					</tr>
				</table>




			</div>
		</div>
	</div>




</body>

</html>
