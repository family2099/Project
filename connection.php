<?php

// try {
// $db = new PDO("mysql:host=localhost;dbname=ch30", "root", "");
// // 資料庫使用 UTF8 編碼
// $db->exec("SET CHARACTER SET utf8");
// } 
// catch (PDOException $e) {
//     echo 'Error!: ' . $e->getMessage() . '<br />';
// }
/*$cmd = $pdo->prepare("select ProductID, ProductName, UnitPrice from products where productid = :pid lock in share mode");
$cmd->bindValue(":pid", $id);

$cmd->execute();
$row = $cmd->fetch();
echo "$id => {$row['ProductName']}"; */


class ConfigDataBase{
  
    static $_dbms = "mysql";    //資料庫類型 
    static $_host = 'localhost';     //資料庫ip位址
    static $_username = 'root';    //資料庫用戶名
    static $_password="";   //密碼
    static $_dbname = 'test';        //資料庫名
   
    static $_dsnconn;             //資料庫連結    
  
 /**
  *設定連線
  */
  //Static是應用在底層
     public static function getDsn() 
     {
          //將變數的值組合成  "mysql:host=localhost;dbname=ch30", "root", ""的形式
            try {
                
                //特別注意空格和單雙引號可能導致錯誤(天啊)
        		self::$_dsnconn = new PDO(self::$_dbms.':host='.self::$_host.';dbname='.self::$_dbname,self::$_username,self::$_password);
        	
        		//echo self::$_dsnconn;不能用echo $statement variable as it is a PDOStatement Object會產生錯誤
        		//Object of class Pdo Mysql Operator could not be converted to string
        		// 資料庫使用 UTF8 編碼
        		self::$_dsnconn->exec("SET CHARACTER SET utf8");
        	    
            	//var_dump(self::$_dsnconn);
        		//echo "123";
    		} 
    		catch (PDOException $e) {
    			echo 'Error!: ' . $e->getMessage() . '<br />';
    		}
            
              
              
    }
          //echo self::$_dsn;//返回資料來源名
          
    private function _preparefetch($sql) {
        $result = array();
        self::$stmt = self::$DB->prepare($sql);
        self::getPDOError($sql);
        self::$stmt->execute($input_parameters);
        self::getSTMTError($sql);
        self::$stmt->setFetchMode(PDO::FETCH_ASSOC);
        switch ($type) {
            case '0':
                $result = self::$stmt->fetch();
                break;
            case '1':
                $result = self::$stmt->fetchAll();
                break;
            case '2':
                if (self::$stmt) {
                    $result = self::$stmt->rowCount();
                } else {
                    $result = 0;
                }
                break;
        }
        self::$stmt = null;
        return $result;
    }   
     
     
     
     /**
     *關閉資料連接
     */
    public function close() {
        self::$_dsnconn = null;
    }
     
     
     

}




class login extends ConfigDataBase{
    
    static $cmd;
    //private static $db;
    //ConfigDataBase::getDsn();
    function acctpassw_check($userName,$passWord)
    {    
    	//應用父類別
    	ConfigDataBase::getDsn();
    	//self::$db = new PDO("mysql:host=localhost;dbname=ch30", "root", "");
    	//var_dump(self::$_dsnconn);
        if (isset(ConfigDataBase::$_dsnconn) && isset($userName) && isset($passWord)) 
        {
            //var_dump(self::$_dsnconn);
        	//產生錯誤:Fatal error: Call to a member function prepare() on a non-object in /home/ubuntu/workspace/shopping/loginClass.php on line 15
            //Call Stack: 0.0021 238448 1. {main}() /home/ubuntu/workspace/shopping/loginClass.php:0 0.0021 238920 2. 
            //login->acctpassw_check() /home/ubuntu/workspace/shopping/loginClass.php:67
            //這錯誤是因為沒把資料庫連結放到Class裡面
			//echo $userName;
			//用self::$db調用父類別的static變數
			//var_dump(self::$_dsnconn);
        	self::$cmd = ConfigDataBase::$_dsnconn->prepare("SELECT username, password, userlevel FROM member WHERE username=? AND password=?");
        	
        	//var_dump(self::$cmd);
           	//設定要查詢的參數值
           	self::$cmd->bindValue(1, $userName, PDO::PARAM_STR);
           	self::$cmd->bindValue(2, $passWord, PDO::PARAM_STR);
           	//var_dump(self::$cmd);
           	//執行並查詢，查詢後只回傳一個查詢結果的物件，必須使用fetc、fetcAll...等方式取得資料
           	$result =self::$cmd->execute();
           	/*if (!self::$cmd->execute())
            {
            	$info =self::$cmd->errorInfo();
            	print_r($info);
            }*/
           	
            //var_dump($result);
            $row = self::$cmd->fetch(PDO::FETCH_ASSOC);
	        var_dump($row); 	
        	if($result)
        	{
        		
        		// 結果集的記錄筆數
            	$totalRows = self::$cmd->rowCount();
        	    //echo $totalRows;
        		// 使用者輸入的帳號與密碼存在於member資料表
            	if ($totalRows) 
        		{    
        			// 建立session變數
            		$_SESSION['userName'] = $userName;
            		$_SESSION['decidelogincount']=1;
        		    $_SESSION['userGroup'] = $row['userlevel'];
        			// 成功登入, 前往 .php
            		//header("Location:".$_SESSION['PrevPage']);
        	  	}
          		else 
        		{
        		    // login_form.php的標題
        			$_SESSION['login_form_title'] = "無效的帳號或密碼";
        		    // 重新登入, 前往.indexphp 
            		//header("Location: index.php");
          		}
        	}
        	else
        	{
        	    // login_form.php的標題
        		$_SESSION['login_form_title'] = "無效的帳號或密碼";
        		// 無效的帳號或密碼, 重新登入, 前往login_form.php 
            	//header("Location: index.php");
        	}	
        }
    }
    
    
}



// $test= new ConfigDataBase();
// ConfigDataBase::getDsn();
// $obj=new login();

// $obj->acctpassw_check("daniel",123456);

//如果是protect無法取得,如果是公開static必須加父類別無法使用物件取得
//echo $_dsnconn;


?>