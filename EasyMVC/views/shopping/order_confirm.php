<?php require_once('connection.php'); ?>
<?php require_once('function.php'); ?>
<?php
if (!isset($_SESSION)) {
	session_start();	
}
// 尚未登入
if ((!isset($_SESSION['userName'])) && (!isset($_SESSION['userGroup']))) {
  header('Location: order_step01.php');
}
?>
<?php
//------------------------------------
// 檢查購物車內是否有商品
//------------------------------------

// 購物車內有商品
$_SESSION['has_item'] = TRUE;
// 商品的編號				
if (!isset($_SESSION['item']['item_index']) || (count($_SESSION['item']['item_index']) == 0)) {
  // 購物車內沒有商品
  $_SESSION['has_item'] = FALSE;
}

// 沒有加入商品
if (!$_SESSION['has_item']) {
  header('Location: order_step02.php');
}
?>
<?php
//------------------------------------
// 顯示購物者的資料
//------------------------------------

$field = "-1";
if (isset($_SESSION['Username'])) {
  $field = $_SESSION['Username'];
}

// 選擇 MySQL 資料庫

try{
			$db = new PDO("mysql:host=localhost;dbname=test", "root", "");
			
			$db->exec("SET CHARACTER SET utf8");
	} 
	catch (PDOException $e) {
	     echo 'Error!: ' . $e->getMessage() . '<br />';
	}
	
	$query = sprintf("SELECT * FROM member WHERE username = %s", GetSQLValue($field, "text"));
	
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


?>
<?php
// 設定信件的格式
$to = $row['email'];	// 收信人
$subject = "德瑞購物廣場 - 網路下單成功通知函";	// 主旨
$message = "<html><body style='font-size: 9px'>" . $row['name'] . " 先生/小姐 您好:<br />";
$message .= "
	<span style='padding-left: 40px'>我們已收到您的網路訂單，謝謝您！</span><br />
	<span style='padding-left: 40px'>請依您選擇的方式儘快付款。收到您的款項後我們會再次發函通知您。</span><br />
	<span style='padding-left: 40px'>您所訂購的書籍大約七～十個工作天就會收到。</span><br />
祝<br />
	<span style='padding-left: 40px'>學習順利。</span><br /><br />

◆德瑞購物客服中心<br />
　<span style='padding-left: 8px'>德瑞購物廣場：http://www.derek.com</span><br />
　<span style='padding-left: 8px'>電話：(02)12345678 週一 ~ 週五 9:30AM-6:00PM</span><br />
　<span style='padding-left: 8px'>傳真：(02)12345678</span><br /><br />
  您的訂單詳細資料如下:</span><br /><br />
";

if (isset($_SESSION['item']['item_index'])) 
{
   $message .= "<table>";
   $message .= 
	    "<tr><td align='left' valign='middle' style='padding: 4px; width: 80px;'>" . 
		   '書籍編號' . 
		   "</td><td align='left' valign='middle' style='padding: 4px; width: 300px;'>" . 
		   '書名' . 
		   "</td><td align='left' valign='middle' style='padding: 4px; width: 40px;'>" . 
		   '單價' . 
		   "</td><td align='left' valign='middle' style='padding: 4px; width: 40px;'>" . 
		   '數量' . 
		   "</td><td align='left' valign='middle' style='padding: 4px; width: 40px;'>" . 
		   '總價' . "</td></tr>";
   
   foreach ($_SESSION['item']['item_index'] as $key => $val) 
   {  
			$message .= 
				"<tr><td align='left' valign='middle' style='padding: 4px;'>" . 
				 $_SESSION['item']['item_index'][$key] . 
				 "</td><td align='left' valign='middle' style='padding: 4px;'>" . 
				 $_SESSION['item']['item_name'][$key] . 
				 "</td><td align='left' valign='middle' style='padding: 4px;'>" . 
				 $_SESSION['item']['price'][$key] . 
				 "</td><td align='left' valign='middle' style='padding: 4px;'>" . 
				 $_SESSION['item']['quantity'][$key] . 
				 "</td><td align='left' valign='middle' style='padding: 4px;'>" . 
				 $_SESSION['item']['total_price'][$key] . "</td></tr>";
	 }
	 
	 $message .= "</table><br />";
}

$message .= "訂單編號 : " . $_SESSION['order_index'] . "<br /><br />";
$message .= "付款方式 : " . $_SESSION['payment'] . "<br /><br />";
$message .= "總金額 : 新台幣 " . $_SESSION['total'] . " 元整<br />";
$message .= "</body></html>";

// 信件的標頭
$headers = "Content-type: text/html; charset=utf-8";
// 寄信
mb_internal_encoding("utf-8");
mb_send_mail($to, $subject, $message, $headers);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>完成訂單程序</title>
</head>
<body>
<script type="text/javascript">
  alert("感謝您的訂購, 您的訂單詳細資料已經寄到您的電子信箱中.");
  // 清除購物車
  location.href = "clear_cart.php";
</script>
</body>
</html>
