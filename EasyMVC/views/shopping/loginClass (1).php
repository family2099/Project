<?php
#require_once('connection.php'); 
#session_start();
            
class login
{
	private static $db;
	
	function __construct()
	{
		try {		
		self::$db= new PDO("mysql:host=localhost;dbname=test", "root", "");
		// 資料庫使用 UTF8 編碼
		self::$db->exec("SET CHARACTER SET utf8");
		} 
		catch (PDOException $e) {
			echo 'Error!: ' . $e->getMessage() . '<br />';
		}
	}
	
    function acctpassw_check($userName,$passWord)
    {        
        if (isset(self::$db) && isset($userName) && isset($passWord)) 
        {
        	//產生錯誤:Fatal error: Call to a member function prepare() on a non-object in /home/ubuntu/workspace/shopping/loginClass.php on line 15
            //Call Stack: 0.0021 238448 1. {main}() /home/ubuntu/workspace/shopping/loginClass.php:0 0.0021 238920 2. 
            //login->acctpassw_check() /home/ubuntu/workspace/shopping/loginClass.php:67
            //這錯誤是因為沒把資料庫連結放到Class裡面
			//echo $userName;
        	$cmd = self::$db->prepare("SELECT username, password, userlevel FROM member WHERE username=? AND password=?");
        	
           	//設定要查詢的參數值
           	$cmd->bindValue(1, $userName, PDO::PARAM_STR);
           	$cmd->bindValue(2, $passWord, PDO::PARAM_STR);
           	//執行並查詢，查詢後只回傳一個查詢結果的物件，必須使用fetc、fetcAll...等方式取得資料
           	$result =$cmd->execute();
            var_dump($result);
            $row = $cmd->fetch(PDO::FETCH_ASSOC);
	         	
        	if($result)
        	{
        		// 結果集的記錄筆數
            	$totalRows = $cmd->rowCount();
        	
        		// 使用者輸入的帳號與密碼存在於member資料表
            	if ($totalRows) 
        		{    
        			// 建立session變數
            		$_SESSION['Username'] = $userName;
        		    $_SESSION['UserGroup'] = $row['userlevel'];
        			// 成功登入, 前往 main.php
            		header("Location: member_center.php");
        	  	}
          		else 
        		{
        		    // login_form.php的標題
        			$_SESSION['login_form_title'] = "無效的帳號或密碼";
        		    // 重新登入, 前往login_form.php 
            		header("Location: index.php");
          		}
        	}
        	else
        	{
        	    // login_form.php的標題
        		$_SESSION['login_form_title'] = "無效的帳號或密碼";
        		// 無效的帳號或密碼, 重新登入, 前往login_form.php 
            	header("Location: index.php");
        	}		
        }
    }
}

$obj=new login();
$obj->acctpassw_check("daniel",123456);

?>
