<?php
require_once('abstractClass.php'); 
#session_start();

         
         
         
class login extends PdoConnect
{
	
	
	static $cmd;
	
	
    function acctpassw_check($userName,$passWord)
    {    
    	//應用父類別建構子
    	parent::__construct();
        if (isset(self::$db) && isset($userName) && isset($passWord)) 
        {
        	//產生錯誤:Fatal error: Call to a member function prepare() on a non-object in /home/ubuntu/workspace/shopping/loginClass.php on line 15
            //Call Stack: 0.0021 238448 1. {main}() /home/ubuntu/workspace/shopping/loginClass.php:0 0.0021 238920 2. 
            //login->acctpassw_check() /home/ubuntu/workspace/shopping/loginClass.php:67
            //這錯誤是因為沒把資料庫連結放到Class裡面
			//echo $userName;
			//用self::$db調用父類別的static變數
        	self::$cmd = self::$db->prepare("SELECT username, password, userlevel FROM member WHERE username=? AND password=?");
        	//var_dump($cmd);
           	//設定要查詢的參數值
           	self::$cmd->bindValue(1, $userName, PDO::PARAM_STR);
           	self::$cmd->bindValue(2, $passWord, PDO::PARAM_STR);
           	//var_dump(self::$cmd);
           	//執行並查詢，查詢後只回傳一個查詢結果的物件，必須使用fetc、fetcAll...等方式取得資料
           	$result =self::$cmd->execute();
            //var_dump($result);
            $row = self::$cmd->fetch(PDO::FETCH_ASSOC);
	        //var_dump($row); 	
        	if($result)
        	{
        		//echo $totalRows;
        		// 結果集的記錄筆數
            	$totalRows = self::$cmd->rowCount();
        	    echo $totalRows;
        		// 使用者輸入的帳號與密碼存在於member資料表
            	if ($totalRows) 
        		{    
        			// 建立session變數
            		$_SESSION['userName'] = $userName;
            		$_SESSION['decidelogincount']=1;
        		    $_SESSION['userGroup'] = $row['userlevel'];
        			// 成功登入, 前往 .php
            		header("Location:".$_SESSION['PrevPage']);
        	  	}
          		else 
        		{
        		    // login_form.php的標題
        			$_SESSION['login_form_title'] = "無效的帳號或密碼";
        		    // 重新登入, 前往.indexphp 
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
            
// class login
// {
	
// 	private static $db;
// 	private static $cmd;
// 	function __construct()
// 	{
// 		try {		
// 		self::$db = new PDO("mysql:host=localhost;dbname=ch30", "root", "");;
// 		// 資料庫使用 UTF8 編碼
// 		self::$db->exec("SET CHARACTER SET utf8");
// 		} 
// 		catch (PDOException $e) {
// 			echo 'Error!: ' . $e->getMessage() . '<br />';
// 		}
// 	}
	
//     function acctpassw_check($userName,$passWord)
//     {        
//         if (isset(self::$db) && isset($userName) && isset($passWord)) 
//         {
//         	//產生錯誤:Fatal error: Call to a member function prepare() on a non-object in /home/ubuntu/workspace/shopping/loginClass.php on line 15
//             //Call Stack: 0.0021 238448 1. {main}() /home/ubuntu/workspace/shopping/loginClass.php:0 0.0021 238920 2. 
//             //login->acctpassw_check() /home/ubuntu/workspace/shopping/loginClass.php:67
//             //這錯誤是因為沒把資料庫連結放到Class裡面
// 			//echo $userName;
//         	self::$cmd = self::$db->prepare("SELECT username, password, userlevel FROM member WHERE username=? AND password=?");
//         	//var_dump($cmd);
//           	//設定要查詢的參數值
//           	self::$cmd->bindValue(1, $userName, PDO::PARAM_STR);
//           	self::$cmd->bindValue(2, $passWord, PDO::PARAM_STR);
//           	// var_dump(self::$cmd);
//           	//執行並查詢，查詢後只回傳一個查詢結果的物件，必須使用fetc、fetcAll...等方式取得資料
//           	$result =self::$cmd->execute();
//             //var_dump($result);
//             $row = self::$cmd->fetch(PDO::FETCH_ASSOC);
// 	        //var_dump($row); 	
//         	if($result)
//         	{
//         		// 結果集的記錄筆數
//             	$totalRows = self::$cmd->rowCount();
//         	    echo $totalRows;
//         		// 使用者輸入的帳號與密碼存在於member資料表
//             	if ($totalRows) 
//         		{    
//         			// 建立session變數
//             		$_SESSION['userName'] = $userName;
//         		    $_SESSION['userGroup'] = $row['userlevel'];
//         			// 成功登入, 前往 .php
//             		header("Location:"+$_SESSION['PrevPage']+".php");
//         	  	}
//           		else 
//         		{
//         		    // login_form.php的標題
//         			$_SESSION['login_form_title'] = "無效的帳號或密碼";
//         		    // 重新登入, 前往.indexphp 
//             		header("Location: index.php");
//           		}
//         	}
//         	else
//         	{
//         	    // login_form.php的標題
//         		$_SESSION['login_form_title'] = "無效的帳號或密碼";
//         		// 無效的帳號或密碼, 重新登入, 前往login_form.php 
//             	header("Location: index.php");
//         	}	
//         }
//     }
// }

// $obj=new login();
// $obj->acctpassw_check("daniel",23456);

?>
