<?php require_once('connection.php'); ?>
<?php require_once('function.php'); ?>
<?php
if (!isset($_SESSION)) {
	session_start();	
}
?>
<?php
//------------------------------------
// 查詢要購買的商品的資料
//------------------------------------

// $_SESSION['database'] 資料表的欄位數值
$field = "-1";
if (isset($_GET['id'])) {
  $field = $_GET['id'];
  
}


    try{
			$db = new PDO("mysql:host=localhost;dbname=test", "root", "");
			
			$db->exec("SET CHARACTER SET utf8");
	} 
	catch (PDOException $e) {
	     echo 'Error!: ' . $e->getMessage() . '<br />';
	}
	
	$query =sprintf("SELECT * FROM " . $_SESSION['database'] . " WHERE id = %s", GetSQLValue($field, "int"));
	
	$result = $db->prepare($query);

	//print_r($data);

	$result->execute();
    if($result)
	{
	    $totalRows = $result->rowCount();
		//目前的紀錄
		$row=$result->fetch(PDO::FETCH_ASSOC);
		// 總頁數,ceil() 函數向上捨入為最接近的整數(就是有小數點就直接進位)。
		//$totalPages = ceil($totalRows / $rowsPerPage);
		//echo $totalRows;
	}



/*------------------------------------
 檢查要購買的商品是否已經存在
------------------------------------*/

// 檢查商品是否已經存在
$item_exist = FALSE;

// 購物車內已經有商品
if (isset($_SESSION['item']['item_index']))	
{
	// 巡迴購物車內的商品
	foreach($_SESSION['item']['item_index'] as $key => $value) 
	{	
		// 購物車內的商品編號,與加入的商品編號相同
		if ($_SESSION['item']['item_index'][$key] == $row['item_index']) 
		{
			// 商品已經存在, 不要再加入
			$item_exist = TRUE;
			break;
		}
	}
}

// 商品還沒存在, 加入目前要購買的商品
if (!$item_exist)
{
  // 商品的編號				
  $_SESSION['item']['item_index'][] = $row['item_index'];
  // 商品的名稱
  $_SESSION['item']['item_name'][] = $row['title'];
  // 商品的單價
  $_SESSION['item']['price'][] = $row['saleprice'];
  // 商品的數量
  $_SESSION['item']['quantity'][] = 1;
  // 商品的總價
  $_SESSION['item']['total_price'][] = $row['saleprice'];
}


var_dump($_SESSION['item']['item_index']);		
//------------------------------------
// 已經登入?
//------------------------------------


  header('Location: order_step01.php');

?>
