<?php
header("content-type: text/html; charset=utf-8");
//可根據GET的值來做判斷ORsession
session_start();
require_once('function.php');



//echo $_SESSION['database'];
//echo "123";

$_SESSION['PrevPage'] = $_SERVER['PHP_SELF'];

if (isset($_SESSION['userName'])) {
  $username = $_SESSION['userName'];
}    
    
	try{
			$db = new PDO("mysql:host=localhost;dbname=test", "root", "");
			
			$db->exec("SET CHARACTER SET utf8");
	} 
	catch (PDOException $e) {
	     echo 'Error!: ' . $e->getMessage() . '<br />';
	}
	
	if(isset($_POST['order_index']))
	{
		
		$query="DELETE FROM order_list WHERE order_index=".GetSQLValue($_POST['order_index'], "text");
		echo $query;
		$result = $db->prepare($query);
		$result->execute();
		
	}
	
	
	$query = sprintf("SELECT order_index, order_price, payment, order_date FROM order_list WHERE `username` = %s", GetSQLValue($username, "text"));

	$result = $db->prepare($query);

	//print_r($data);
	
	$result->execute();
	
	$totalRows = $result->rowCount();
	echo $totalRows;
 //   if($result)
	// {

	// 	// $rowsOfCurrentPage = $result->rowCount();
	// 	//目前的紀錄
	// 	while($row=$result->fetch(PDO::FETCH_ASSOC))
	// 	{
			
			
			
			
			
	// 	}
	// 	// $rowsOfCurrentPage = $result->rowCount();
	// 	// 總頁數,ceil() 函數向上捨入為最接近的整數(就是有小數點就直接進位)。
	// 	//$totalPages = ceil($totalRows / $rowsPerPage);
	// 	// echo $totalRows;
	// }



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
	
	
</head>

<body>

<?php require_once('nav.php'); ?>
<div class="container-fluid dis_top">
    
    
    <div class="row">
		<div class="col-xm-12 col-sm-10 col-sm-offset-1 col-md-9 col-md-offset-1 col-lg-8 col-lg-offset-2">
			<div class="panel panel-danger">
			  <div class="panel-heading">
			    <h3 class="panel-title">購物清單</h3>
			  </div>
			  <div class="panel-body">
					<div class="row">
						<form method="post">
							<table class="table table-striped">
								<thead>
							      <tr>
							      	<center>
							         <th>訂單編號</th>
							         <th>總價格</th>
							         <th>付款方式</th>
							         <th>日期</th>
							         <th>刪除</th>
							        </center> 
							      </tr>
							   	</thead>
								<?php 
		 								if($result)
										{	
		 									while($row=$result->fetch(PDO::FETCH_ASSOC))
											{
		 						?>
	
					 							
								 				<tr>
								 					<td><a href="order_list.php?order=<?php echo $row['order_index']; ?>"><?php echo $row['order_index']; ?></a></td>
								 					<td><?php echo $row['order_price']?></td>
								 					<td><?php echo $row['payment']?></td>
								 					<td><?php echo $row['order_date']?></td>
								 					<input name="order_index" id="order_index" type="hidden" value="<?php echo $row['order_index']; ?>" />
								 					<td><input type="submit" value="刪除"  /></td>
								 				</tr>
								 							
								 							
								 					
											
				    		
					    		<?php			
					 						}	
										}	
				 				?>		
				    		
				    		</table>
				    		
				    	</form>	
			    	</div>
			  </div>
			</div>
		</div>
	</div>

</div>








</body>

</html>






