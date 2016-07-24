<?php
if (!isset($_SESSION)) {
	session_start();	
}

//----------------------------------
// 清空購物車
//----------------------------------

// 商品的編號				
$_SESSION['item']['item_index'] = NULL;
unset($_SESSION['item']['item_index']);
// 商品的名稱
$_SESSION['item']['item_name'] = NULL;
unset($_SESSION['item']['item_name']);
// 商品的單價
$_SESSION['item']['price'] = NULL;
unset($_SESSION['item']['price']);
// 商品的數量
$_SESSION['item']['quantity'] = NULL;
unset($_SESSION['item']['quantity']);
// 商品的總價
$_SESSION['item']['total_price'] = NULL;
unset($_SESSION['item']['total_price']);
// 訂單編號
$_SESSION['item']['order_index'] = NULL;
unset($_SESSION['item']['order_index']);

// 回到首頁
header("Location: index.php");
?>