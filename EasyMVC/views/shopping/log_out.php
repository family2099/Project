<?php

  session_start();


//-------------------------------
// 清除帳號與層級
//-------------------------------
	// 使用者的名稱
	$_SESSION['userName'] = NULL;
	unset($_SESSION['userName']);
	// 使用者的等級
	$_SESSION['userGroup'] = NULL;
	unset($_SESSION['userGroup']);
	//當登入前的前一瀏覽頁面
	$_SESSION['PrevPage'] = NULL;

	unset($_SESSION['PrevPage']);
	
	// unset($_SESSION['decidelogincount']);

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

	header("Location: index.php");
?>