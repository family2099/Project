<?php
header("content-type: text/html; charset=utf-8");

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

//撰寫注意事項

// 如果用$this->方法或變數不用加$this
//如果PDO有SQL的屬性變數盡量用$result->bindValue(1, $userName, PDO::PARAM_STR);或$result->bindParam(':id',$id,PDO::PARAM_INT);

  
class database
{

    protected $_dbms = "mysql";             //資料庫類型 
    protected $_host = "localhost";         //資料庫ip位址
    // protected $_port = "3306";           //資料庫埠
    protected $_username = "root";          //資料庫用戶名
    protected $_password = "";              //密碼
    protected $_dbname = "test";            //資料庫名
    // protected $_charset = 'utf-8';       //資料庫字元編碼
    protected $_dsnconn;                    //data soruce name 資料來源

/**
*@return   返回資料來源名
*/
    /*-------------------------
    預設先連資料庫
    -------------------------*/
    function __construct()
    {
        
        try 
        {
                
            //特別注意空格和單雙引號可能導致錯誤(天啊)
    		$this->_dsnconn = new PDO($this->_dbms.':host='.$this->_host.';dbname='.$this->_dbname,$this->_username,$this->_password);
    	   // echo $this->$_dsnconn;
    		//echo self::$_dsnconn;不能用echo $statement variable as it is a PDOStatement Object會產生錯誤
    		//Object of class Pdo Mysql Operator could not be converted to string
    		// 資料庫使用 UTF8 編碼
    		$this->_dsnconn->exec("SET CHARACTER SET utf8");
    	    
        	//var_dump(self::$_dsnconn);
    		//echo "123";
		} 
		catch (PDOException $e) {
		    
			echo 'Error!: ' . $e->getMessage() . '<br />';
		}
        
    
    }
    
    /*-----------------------------------------------------
	 讀取test資料庫的computer_books資料表總紀錄數
	-----------------------------------------------------*/
    
    function get_Index_data_number($database_name)
    {
        
        
        $query = "SELECT * FROM " . $database_name;
    // 	echo $query;
    	$result = $this->_dsnconn->prepare($query);
        $result->execute();    
        if($result)
    	{
    		// 結果集的記錄筆數
    		$totalRows = $result->rowCount();
    		// 總頁數,ceil() 函數向上捨入為最接近的整數(就是有小數點就直接進位)。
    // 		$totalPages = ceil($totalRows / $rowsPerPage);
    		//echo $totalRows;
    	}
    	
    	return $totalRows;
        
    }
    
    
    
    
    /*-----------------------------------------------------
	 讀取test資料庫的computer_books資料表10筆紀錄
	-----------------------------------------------------*/
    
    function get_computer_books_ten_record($database_name,$startrecord)
    {
        
        $p=0;
        $query = "SELECT * FROM " . $database_name. " LIMIT ". $startrecord.", 10";
    // 	echo $query;
    	$result = $this->_dsnconn->prepare($query);
    
        $result->execute();    
        if ($result) 
        {	
    		$rows_currentPage = $result->rowCount();
    		//echo $rowsOfCurrentPage;
    		while($row=$result->fetch(PDO::FETCH_ASSOC))
			{
			   $arr[$p]=array(
					"id"=>$row["id"],
					"title"=>$row["title"],
					"author"=>$row["author"],
					"translator"=>$row["translator"],
					"contents"=>$row["contents"],
					"feature"=>$row["feature"],
					"cd"=>$row["cd"],
					"publishdate"=>$row["publishdate"],
					"price"=>$row["price"],
					"discount"=>$row["discount"],
					"saleprice"=>$row["saleprice"],
					"item_index"=>$row["item_index"],
					"photo"=>$row["photo"],
					"publisher"=>$row["publisher"],
					"color"=>$row["color"],
					"category"=>$row["category"],
					"category_type"=>$row["category_type"]
			
			    );
			
			    $p++; 
			    
			}   
    		
    	}
        $row=Array();
        
        $row[0]=$rows_currentPage;
        $row[1]=$arr;
    	
    	return $row;
        
    }
    
    /*--------------------------------------
    確認登入帳密
    
    ----------------------------------------*/
    function login_check($userName,$passWord)
    {
            $p=0;
        
    	   // echo $userName;
        
            $query="SELECT username, password, userlevel FROM member WHERE username=? AND password=?";
            
            $result = $this->_dsnconn->prepare($query);
            
        	
        	
        	//var_dump(self::$cmd);
           	//設定要查詢的參數值
           	$result->bindValue(1, $userName, PDO::PARAM_STR);
           	$result->bindValue(2, $passWord, PDO::PARAM_STR);
           	//var_dump(self::$cmd);
           	//執行並查詢，查詢後只回傳一個查詢結果的物件，必須使用fetc、fetcAll...等方式取得資料
           	$result->execute();
           	/*if (!self::$cmd->execute())
            {
            	$info =self::$cmd->errorInfo();
            	print_r($info);
            }*/
           	
            //var_dump($result);
            	
        	if($result)
        	{
        		
        		//echo $rowsOfCurrentPage;
        		while($row=$result->fetch(PDO::FETCH_ASSOC))
    			{
    			   $arr[$p]=array(
    					"username"=>$row["username"],
    					"userlevel"=>$row["userlevel"]
    					
    			            
    			    );
    			
    			    $p++; 
    			    
    			}
    			
    // 			var_dump($arr);
    			return $arr;
        
        	}
        
        	
        
    }
    
    
    function add_car($database_name,$id)
    {
        
        
        
        $query ="SELECT * FROM " .$database_name. " WHERE id = ?";
        
        $result = $this->_dsnconn->prepare($query);
        
        $result->bindValue(1, $id, PDO::PARAM_STR);
        
        $result->execute();
        
        if($result)
    	{
    	    $totalRows = $result->rowCount();
    		//目前的紀錄
    		$row=$result->fetch(PDO::FETCH_ASSOC);
    		
    	}
        
        
        return $row;
        
    }

    
    
    
    
    
    
    
    // function get_book_data()
    // {
        
        
    //     $query = "SELECT * FROM " . $_SESSION['database'] .  
    //   	" WHERE category = '" . $_SESSION['category'] . "' AND " . 
    //   	" category_type = '" . $_SESSION['category_type'] . "' ORDER BY publishdate DESC";
    	
    // 	$result = $db->prepare($query);
    //     $result->execute();    
    //     if($result)
    // 	{
    // 		// 結果集的記錄筆數
    // 		$totalRows = $result->rowCount();
    // 		// 總頁數,ceil() 函數向上捨入為最接近的整數(就是有小數點就直接進位)。
    // 		$totalPages = ceil($totalRows / $rowsPerPage);
    // 		//echo $totalRows;
    // 	}
        
    // }
     /*-------------------------
     關閉資料連接
     -------------------------*/
    public function close() {
        $this->$_dsnconn = null;
    }
     
     
     

}
// $obj=new database;
// $obj->login_check('andy','a123456');
// var_dump($obj->get_computer_books_ten_record('computer_books',0));
// var_dump($obj->get_Index_data_number('computer_books'));
// class login extends ConfigDataBase{
    
?>