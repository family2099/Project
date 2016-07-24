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
	
	


	
	
?>




<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<!---PS:其他js檔都要放JQUERY後面要不其他js檔先執行會錯誤--->
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="/EasyMVC/views/shopping/js/jquery.js"></script>
	<link href="/EasyMVC/views/shopping/css/bootstrap.min.css" rel="stylesheet">
	<link href="/EasyMVC/views/shopping/css/self.css" rel="stylesheet">
	<link href="/EasyMVC/views/shopping/css/index.css" rel="stylesheet">
	<!--出現問題Mixed Content: The page at 'https://lab-coolmancz.c9users.io/shopping/' was loaded over HTTPS, but requested an insecure stylesheet 'http://fonts.googleapis.com/css?family=Roboto'. This request has been blocked; the content must be served over HTTPS.
	解決方法Edit your theme replacing every occurency of http://fonts.googleapis.com/... with https://fonts.googleapis.com/... (mind the s).

	Resources that might pose a security risk (such as scripts and fonts) must be loaded through a secure connection when requested in the context of a secured page for an obvious reason: they could have been manipulated along the way-->
	<link href="/EasyMVC/views/shopping/css/login.css" rel="stylesheet">
	<script type="text/javascript" src="/EasyMVC/views/js/getindex.js"></script>
	<script src="/EasyMVC/views/shopping/js/bootstrap.min.js"></script>
	<script src="/EasyMVC/views/shopping/js/login_form.js"></script>
	<script type="text/javascript" src="/EasyMVC/views/shopping/js/getindex.js"></script>




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


							<!-- List group -->
							<ul class="list-group" id="showcomp">
								<li class="list-group-item"><a href="/EasyMVC/Index/get_category_page/0/0" class="computer">網頁設計</a></li>
								<li class="list-group-item"><a href="/EasyMVC/Index/get_category_page/0/1" class="computer">程式語言</a></li>
								<li class="list-group-item"><a href="/EasyMVC/Index/get_category_page/0/2" class="computer">多媒體系列</a></li>

							</ul>
						</div>

						<div class="panel panel-warning">
							<!-- Default panel contents -->
							<div class="panel-heading" id="edu">教育軟體</div>


							<!-- List group -->
							<ul class="list-group" id="showedu">
								<li class="list-group-item"><a href="/EasyMVC/Index/get_category_page/1/0" class="education">影像多媒體</a></li>
								<li class="list-group-item"><a href="/EasyMVC/Index/get_category_page/1/1" class="education">電腦繪圖</a></li>
								<li class="list-group-item"><a href="/EasyMVC/Index/get_category_page/1/2" class="education">工具軟體</a></li>

							</ul>
						</div>

						<div class="panel panel-warning">
							<!-- Default panel contents -->
							<div class="panel-heading" id="bus">商用軟體</div>


							<!-- List group -->
							<ul class="list-group" id="showbus">
								<li class="list-group-item"><a href="/EasyMVC/Index/get_category_page/2/0" class="business">作業系統</a></li>
								<li class="list-group-item"><a href="/EasyMVC/Index/get_category_page/2/1" class="business">防毒防駭</a></li>
								<li class="list-group-item"><a href="/EasyMVC/Index/get_category_page/2/2" class="business">文書處理</a></li>

							</ul>
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
				<?php 
					//-----------------------------
					// 有書籍的紀錄
					//-----------------------------
					if ($data[3])
					{
						//echo $rowsOfCurrentPage;
						for($i=0;$i<$data[3];$i++)
						{
							//echo $row['id'];
							//var_dump($row);
							//exit;
				?>			
							<div class=divsa>
								<table>
									
									<tr>
											<span >
												<img src="<?php echo '/EasyMVC/views/shopping/photo/item/' . $data[4][$i]['photo']; ?>" width="120" height="145" />
											</span >
											<br />
											<span >
												<a href="item_detail.php?pro_id=<?php echo $data[4][$i]['id']; ?>" >
												<?php echo mb_substr($data[4][$i]['title'],0,12,"utf-8");  ?>
											</a>
											</span >
											<br /> 
											作者 :
											<span >
					                        <?php echo $data[4][$i]['author']; ?>
					                      	</span>
					                      	
											<br /> 
											發行日 :
											<span >
					                        <?php echo date("Y年n月", strtotime($data[4][$i]['publishdate'])); ?>
					                      	</span>
											<br /> 
											原價 :
											<span >
												<?php echo $data[4][$i]['price']; ?> 元
					                      	</span>
											<br />
											特價
											<span >
						                        <?php echo $data[4][$i]['discount']; ?> 折 
						                        <?php echo $data[4][$i]['saleprice']; ?> 元
					                      	</span>
											<br />
											<a href="/EasyMVC/Index/add_to_cart/<?php echo $data[4][$i]['id']; ?>" class="btn btn-danger btn-lg" role="button">放入購物車</a>
											
										</td>
									</tr>
									
								</table>
			
							</div>
				<?php
						}
					}
				?>


			</div>

			<div class="col-sm-9 col-sm-offset-3 col-md-9 col-md-offset-3 col-lg-9 col-lg-offset-3 col-xs-12">

				<table class="index_style4">
				    <tr>
				      <td class="index_style5">
				        資料筆數 ： <?php echo $data[1] ?> 
				      </td>
				      <td class="index_style5">
				        共分 <?php echo $data[2]; ?> 頁
				      </td>
				      <td class="index_style5">
				        每頁 10 筆
				      </td>
				      <td class="index_style6">
						<?php 
							if ($data[0] > 0) 
							{
						?>
				            <a href="/EasyMVC/Index/get_Index/0" class="index_style7">首頁 /</a>
						<?php 
							}
						?>
				        <?php 
							if ($data[0] > 0) 
							{
						?>
							 <!--max() 返回最大值 -->
				            <a href="/EasyMVC/Index/get_Index/<?php echo max(0, $page - 1); ?>" class="index_style7">上頁 /</a>        
				        <?php 
							}
						?>
								第 <?php echo $page + 1; ?> 頁
			    		<?php 
							if ($data[0] < $data[2] - 1) 
							{				
						?>
				            <a href="/EasyMVC/Index/get_Index/<?php echo min($data[2] - 1, $page + 1); ?>" class="index_style7"> / 下頁</a>
				        <?php 
							}
						?>
						<?php 
						  if ($data[0] < $data[2] - 1) 
						  {				
						?>
				            <a href="/EasyMVC/Index/get_Index/<?php echo ($data[2] - 1); ?>" class="index_style7"> / 末頁</a>
				        <?php 
							}
						?>
				      </td>
				    </tr>
				  </table>
  					<br />



			</div>


		</div>
	</div>




</body>

</html>
