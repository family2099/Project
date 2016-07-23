<?php
#require_once('connection.php'); 
#session_start();
//問老師看看abstract是不是只能放除了建構子以外的函數和屬性        
abstract class PdoConnect
{
	//要讓繼承的子類別使用所以要公開
	protected static $db;

	function __construct()
	{
		try {		
		self::$db = new PDO("mysql:host=localhost;dbname=ch30", "root", "");
		// 資料庫使用 UTF8 編碼
		self::$db->exec("SET CHARACTER SET utf8");
		} 
		catch (PDOException $e) {
			echo 'Error!: ' . $e->getMessage() . '<br />';
		}
	}
	
	
}
?>