<?php 

require_once('connection.php'); 
require_once('function.php');


if (!isset($_SESSION)) {
  session_start();
}

// 前一個網頁
$_SESSION['PrevPage'] = $_SERVER['PHP_SELF'] . "?" . $_SERVER['QUERY_STRING'];

?>
<?php
// 沒有URL參數
if (!(isset($_GET['pro_id'])) || !(isset($_GET['sub_id']))) {
	header("Location: index.php");
	  
	exit;
}
?>

<?php	
$database = array("computer_books", "education_software", "commerical_software");
$category = array("電腦圖書", "教育軟體", "商用軟體");
$category_type = array(0 => array("網頁設計","程式語言","多媒體系列"), 
	1 => array("影像多媒體","電腦繪圖","工具軟體"), 2 => array("作業系統","防毒防駭","文書處理"));

$index1 = $_GET['pro_id'];//資料庫編號
$index2 = $_GET['sub_id'];//陣列編號

//echo $index1;

// 作用資料表的名稱
$_SESSION['database'] = $database[$index1];

//echo $_SESSION['database'];
// 電腦圖書, 教育軟體, 商用軟體
$_SESSION['category'] = $category[$index1];
// 網頁設計, 程式語言, 多媒體系列
$_SESSION['category_type'] = $category_type[$index1][$index2];
?>
<?php
//---------------------------------------------------------
// 讀取庫ch30資料庫的 $_SESSION['database'] 資料表的全部紀錄
//---------------------------------------------------------

// 最大的列數
$page = 0;
$rowsPerPage = 10;

// 選擇 MySQL 資料庫
  try{
			$db = new PDO("mysql:host=localhost;dbname=test", "root", "");
			
			$db->exec("SET CHARACTER SET utf8");
	} 
	catch (PDOException $e) {
	     echo 'Error!: ' . $e->getMessage() . '<br />';
	}
	
  $query = "SELECT * FROM " . $_SESSION['database'] .  
  	" WHERE category = '" . $_SESSION['category'] . "' AND " . 
  	" category_type = '" . $_SESSION['category_type'] . "' ORDER BY publishdate DESC";
	
	$result = $db->prepare($query);

	//print_r($data);
// 傳回目前頁的結果集
	$result->execute();
	
	//$db=null;
	
	
	//echo $totalRows;
	if($result)
	{
		// 結果集的記錄筆數
		$totalRows = $result->rowCount();
		// 總頁數,ceil() 函數向上捨入為最接近的整數(就是有小數點就直接進位)。
		$totalPages = ceil($totalRows / $rowsPerPage);
		echo $totalRows;
	}

/*-----------------------------------------------------
	 讀取test資料庫的computer_books資料表10筆紀錄
	-----------------------------------------------------*/
	
	// 目前頁的開始編號變數
	$startRow = $page * $rowsPerPage;
	echo $startRow;
	// 從目前頁的開始編號查詢
	//sprintf() 函數把格式化的字串寫入一個變數中
	$current_query = sprintf("%s LIMIT %d, %d", $query, $startRow, $rowsPerPage);
	echo $current_query;
	$result = $db->prepare($current_query);
	//var_dump($result);
	$result->execute();
	//var_dump($result);
	// 目前頁的記錄筆數
	if ($result) {	
		$rowsOfCurrentPage = $result->rowCount();
		//echo $rowsOfCurrentPage;
		
	}
	
	
	
	//echo $rowsOfCurrentPage;
	$obj=new login();
	$obj->acctpassw_check($_POST['userN'],$_POST['passW']);


//-----------------------------------------------------
// 讀取庫ch30資料庫的computer_books資料表的目前頁的紀錄
//-----------------------------------------------------


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
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


							<!-- List group -->
							<ul class="list-group" id="showcomp">
								<li class="list-group-item"><a href="category_result.php?pro_id=0&sub_id=0" class="computer">網頁設計</a></li>
								<li class="list-group-item"><a href="category_result.php?pro_id=0&sub_id=1" class="computer">程式語言</a></li>
								<li class="list-group-item"><a href="category_result.php?pro_id=0&sub_id=2" class="computer">多媒體系列</a></li>

							</ul>
						</div>

						<div class="panel panel-warning">
							<!-- Default panel contents -->
							<div class="panel-heading" id="edu">教育軟體</div>


							<!-- List group -->
							<ul class="list-group" id="showedu">
								<li class="list-group-item"><a href="category_result.php?pro_id=1&sub_id=0" class="education">影像多媒體</a></li>
								<li class="list-group-item"><a href="category_result.php?pro_id=1&sub_id=1" class="education">電腦繪圖</a></li>
								<li class="list-group-item"><a href="category_result.php?pro_id=1&sub_id=2" class="education">工具軟體</a></li>

							</ul>
						</div>

						<div class="panel panel-warning">
							<!-- Default panel contents -->
							<div class="panel-heading" id="bus">商用軟體</div>


							<!-- List group -->
							<ul class="list-group" id="showbus">
								<li class="list-group-item"><a href="category_result.php?pro_id=2&sub_id=0" class="business">作業系統</a></li>
								<li class="list-group-item"><a href="category_result.php?pro_id=2&sub_id=1" class="business">防毒防駭</a></li>
								<li class="list-group-item"><a href="category_result.php?pro_id=2&sub_id=2" class="business">文書處理</a></li>

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
					if ($rowsOfCurrentPage)
					{
						//echo $rowsOfCurrentPage;
						while($row=$result->fetch(PDO::FETCH_ASSOC))
						{
							//echo $row['id'];
							//var_dump($row);
							//exit;
				?>			
							<div class=divsa>
								<table>
									
									<tr>
											<span >
												<img src="<?php echo 'photo/item/' . $row['photo']; ?>" width="120" height="145" />
											</span >
											<br />
											<span >
												<a href="item_detail.php?pro_id=<?php echo $row['id']; ?>" >
												<?php echo mb_substr($row['title'],0,12,"utf-8");  ?>
											</a>
											</span >
											<br /> 
											作者 :
											<span >
					                        <?php echo $row['author']; ?>
					                      	</span>
					                      	
											<br /> 
											發行日 :
											<span >
					                        <?php echo date("Y年n月", strtotime($row['publishdate'])); ?>
					                      	</span>
											<br /> 
											原價 :
											<span >
												<?php echo $row['price']; ?> 元
					                      	</span>
											<br />
											特價
											<span >
						                        <?php echo $row['discount']; ?> 折 
						                        <?php echo $row['saleprice']; ?> 元
					                      	</span>
											<br />
											<a href="/EasyMVC/Index/add_to_cart/<?php echo $row['id']; ?>" class="btn btn-danger btn-lg" role="button">放入購物車</a>
											
										</td>
									</tr>
									
								</table>
			
							</div>
				<?php
						}
					}
				?>


			</div>

			<div class="col-sm-9 col-sm-offset-2 col-md-9 col-md-offset-2 col-lg-9 col-lg-offset-2 col-xs-12">

				<table class="index_style4">
				    <tr>
				      <td class="index_style5">
				        資料筆數 ： <?php echo $totalRows ?> 
				      </td>
				      <td class="index_style5">
				        共分 <?php echo $totalPages; ?> 頁
				      </td>
				      <td class="index_style5">
				        每頁 <?php echo $rowsPerPage; ?> 筆
				      </td>
				      <td class="index_style6">
							  <?php 
								  if ($page > 0) {
							  ?>
				            <a href="<?php printf("%s?page=%d", $_SERVER["PHP_SELF"], 0); ?>" class="index_style7">首頁 /</a>
								<?php 
									}
								?>
				        <?php 
								  if ($page > 0) {
							  ?>
							 <!--max() 返回最大值 -->
				            <a href="<?php printf("%s?page=%d", $_SERVER["PHP_SELF"], max(0, $page - 1)); ?>" 
				              class="index_style7">上頁 /</a>        
				        <?php 
									}
								?>
								第 <?php echo $page + 1; ?> 頁
				    		<?php 
								  if ($page < $totalPages - 1) {				
								?>
				            <a href="<?php printf("%s?page=%d", $_SERVER["PHP_SELF"], min($totalPages - 1, $page + 1)); ?>" 
				              class="index_style7"> / 下頁</a>
				        <?php 
									}
								?>
								<?php 
								  if ($page < $totalPages - 1) {				
								?>
				            <a href="<?php printf("%s?page=%d", $_SERVER["PHP_SELF"], $totalPages - 1); ?>" class="index_style7"> / 末頁</a>
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
