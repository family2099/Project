<?php
header("Content-Type:text/html; charset=utf-8");
/**
 * 類標準說明    PDO連接資料庫的配置類
 * 類名：     ConfigDataBase
 * 功能說明：    為了讓代碼重用，利用此類可以動態的連接各種資料庫
 * 參數說明：    $_dbms = "mysql教程";    //資料庫類型 
 *         $_host = '127.0.0.1';     //資料庫ip位址
 *         $_port = '3306';     //資料庫埠
 *         $_username = 'root';    //資料庫用戶名
 *         $_password = '';   //密碼
 *         $_dbname = '';        //資料庫名 預設為
 *         $_charset = 'utf-8';       //資料庫字元編碼
 *         $_dsn;//                    //data soruce name 資料來源
 *
 *
 * 類屬性說明：
 * 類方法說明：
 * 返回值：     不同函數返回不同的值
 * 備註說明：
 
 *
 *寫成這樣比較不用大幅度修改,例如當其他檔案要連到其他資料庫,我們只要建立物件並傳送要連結的參數,就可以連到別的資料庫,不用到class裡修改變數值,而且到class裡修改大家都只能連特定資料庫
 */
class ConfigDataBase {
  
    protected static $_dbms = "mysql";    //資料庫類型 
    protected static $_host = 'localhost';     //資料庫ip位址
    protected static $_port = '3306';     //資料庫埠
    protected static $_username = 'root';    //資料庫用戶名
    protected static $_password = '';   //密碼
    protected static $_dbname = 'ch30';        //資料庫名 預設為zenf
    protected static $_charset = 'utf-8';       //資料庫字元編碼
    protected static $_dsn;//                    //data soruce name 資料來源
 
 /**
  *@return   返回資料來源名
  */
 public static function getDsn() {
  //將變數的值組合成  mysql:host=localhost;port =3306;dbname=test',$login,$passwd的形式
  if (!isset(self::$_dsn)){
    self::$_dsn = self::$_dbms.':host = '.self::$_host.';port = '.
    self::$_port . ';dbname = ' . self::$_dbname.','.
    self::$_username . ','.self::$_password;
    
    if (strlen(self::$_charset) > 0){
     self::$_dsn = self::$_dsn . ';charset = ' . self::$_charset;
    }
  }
  return self::$_dsn;//返回資料來源名
 }
 
 /**
  * 功能：設置$dbms
  * @param $dbms
  */
 public static function setDbms($dbms){
  if (isset($dbms) &&(strlen($dbms) > 0 )){
   self::$_dbms = trim($dbms);
  } 
 }
 
 /**
  *
  * @param  $host  //資料庫位址
  */
 public static function setHost($host){
  if (isset($host) &&(strlen($host) > 0 )){
   self::$_host = trim($host);
  }
 }
 /**
  *
  * @param $host 埠號
  */
 public static function setPort($port){
  if (isset($port) &&(strlen($port) > 0 )){
   self::$_post = trim($port);
  }
 }
 
 /**
  *
  * @param  $passwd 密碼
  */
 public static function setPasswd($passwd){
  if (isset($passwd) &&(strlen($passwd) > 0 )){
   self::$_password = trim($passwd);
  }
 }
 
 /**
  *
  * @param  $username 用戶名
  */
 public static function setUsernName($username){
   if (isset($username) &&(strlen($username) > 0 )){
    self::$_username = trim($username);
   }
  }
 
 /**
  *
  * @param  $dbname 資料庫名
  */
 public static function setDbName($dbname){
   if (isset($dbname) &&(strlen($dbname) > 0 )){
    self::$_dbname = trim($dbname);
   }
  }
 
 
  /**
   *
   * @param  $charset 資料庫編碼
   */
 public static function setCharset($charset){
   if (isset($charset) &&(strlen($charset) > 0 )){
    self::$_charset = trim($charset);
   }
  }
}
//下面是對資料庫的操作：
 

//require_once 'ConfigDataBase.php';
//header("Content-Type: text/html; charset=utf-8");//設置編碼
/**
 * 類標準說明
 * 類名：       PdoMysql
 * 功能說明：   對資料庫進行各種操作
 * 參數說明：
 * 類屬性說明：
 * 類方法說明：
 * 返回值：
 * 備註說明：
 
 *
 */
class  PdoMysqlOperater{
 
 
 /**
  * @return 返回連接資料庫的控制碼
  */
 public function getConnection(){
  
  $connection = NULL;
  try {
   $connection = new PDO(ConfigDataBase::getDsn());
   echo 'Success';
  } catch (PDOException $e){
   echo 'Error!: ' . $e->getMessage() . '<br />';
  }
  return $connection;
 }
 
 /**
  *
  * @param  $connection    連接資料庫的控制碼
  */
 public function closeConnection($connection){
  try {
   if ($connection != null) {
    $connection = null;//關閉資料庫連接控制碼
   }
  } catch (Exception $e) {
   print 'Close the connectin is error:'.$e->getMessage();
  }
  
 }
 
 /**
  * 功能：      向資料庫中增加資料
  * @param $sql      sql語句
  */
 public  function insertDatabase($sql){
  $affect = false;//失敗返回false
  try {
   $conn = $this->getConnection();
   $conn->exec($sql);
   $affect = true;//插入成功返回true
   $this->closeConnection($conn);//關閉資料庫
  } catch (PDOException $e) {
   print 'Insert error '.$e->getMessage();
  }
  return $affect;//返回值
 }
 
 /**
  *
  * @param $id      表的主鍵id
  * @param $tableName    表名
  */
 public function deleltById($id,$tableName){
  $affact = false;
  $sql = 'delete from '.trim($tableName).' where id = '.$id;
  try {
   $conn = $this->getConnection();
   $conn->exec($sql);
   $this->closeConnection($conn);
   $affact = true;
  } catch (PDOException  $e) {
   print 'Delelte error is '.$e->getMessage();
  }
  return $affact;
 }
 
 /**
  * 功能：      以and 的形式刪除記錄
  * @param $tableName    表的名稱
  * @param $array        陣列表中欄位名=其值的方式進行組合
  */
 public  function prepareDeleteAnd($tableName,array $array=null){
  $sql = 'delete from '. $tableName . ' where ';
  $count = count($array);//計算陣列的長度
  $flag = 0;//設置標記
  foreach ($array as $key => $value){
   $flag++;//讓flag增加一
   $sql .= $key .'='."'".$value."'";
   if ($flag != $count ){//當falg不等於count時，陣列還有值，後面增加and，反之不增加
    $sql .= ' and ';
   }
  }
  echo  $sql;//測試sql語句的組合  
  try {
   $conn = $this->getConnection();//獲取連接
   $conn->prepare($sql);
   $this->closeConnection();
  } catch (PDOException $e) {
   print 'Delete error is '.$e->getMessage();
  }
  
 }
 
 /**
  * 功能：         以or 的形式刪除記錄
  * @param $tableName    表的名稱
  * @param $array        陣列表中欄位名=其值的方式進行組合
  */
 public  function prepareDeleteOr($tableName,array $array=null){
 
  $sql = 'delete from '. $tableName . ' where ';
  $count = count($array);//計算陣列的長度
  $flag = 0;//設置標記
  foreach ($array as $key => $value){
   $flag++;//讓flag增加一
   $sql .= $key .'='."'".$value."'";
   if ($flag != $count ){//當falg不等於count時，陣列還有值，後面增加and，反之不增加
    $sql .= ' or ';
   }
  }
  echo  $sql;//測試sql語句的組合  
  try {
   $conn = $this->getConnection();//獲取連接
   $stmt = $conn->prepare($sql);
   $stmt->execute();//執行
   $this->closeConnection();
  } catch (PDOException $e) {
   print 'Delete error is '.$e->getMessage();
  }
  
 }
 
 
 /**
  * 功能：      取得表中所有資料
  * @param  $sql     sql語句
  */
 public function getAll($sql){
  
  $result = null;
  try {
   $conn = $this->getConnection();
   $result = $conn->query($sql);
   $this->closeConnection($conn);
  } catch (PDOException $e) {
   print 'GetAll error is '.$e->getMessage();
  }
 }
 
 
 /**
  * 功能:更新資料表中的資訊
  * @param  $table      要更新的表名
  * @param array $updateFiled    要更新的欄位
  * @param array $updateConditon 更新需要的條件
  */
 public function updateDataBase($table,array $updateFiled,array $updateConditon ){
   
  $sql   = 'update from ' .$table .' set ';
  
  //對set欄位進行賦值操作
  $count = count($updateFiled);//獲取要修改陣列的長度
  $flag  = 0;//設置標記為0
  foreach ($updateFiled as $key => $value){
   $flag++;
   $sql .= $key .'='."'".$value."'";
   if ($flag != $count){
    $sql .=',';
   }
  }
  //對where條件進行賦值
  $countUpdateCondition = count($updateConditon);//獲取要修改陣列的長度
  $flag  = 0;//設置標記為0
  $sql .= ' where ';
  foreach ($updateConditon as $key => $value){
   $flag++;
   $sql .= $key .'='."'".$value."'";
   if ($flag != $countUpdateCondition){
    $sql .=' and ';
   }
  }
  try {
   $conn = $this->getConnection();
   $conn->exec($sql);
   $this->closeConnection($conn);
  } catch (PDOException $e) {
   print 'Update error is :'.$e->getMessage();
  }
  
 }
 
 
 /**
  * 功能：      根據表和提高的查詢準則進行查詢
  * 返回值：      返回結果集
  * @param  $table    資料表名
  * @param array $findCondition  查詢準則
  */
 public function findData($table,array $findCondition){
  
  $sql = 'select from '.$table .' where ';
  
  $count = count($findCondition);//獲取查詢準則陣列的長度
  $flag  = 0;//設置標記為0
  foreach ($findCondition as $key => $value){
   $flag++;
   $sql .= $key .'='."'".$value."'";
   if ($flag != $count){
    $sql .=' and ';
   }
  }
  try {
    $conn = $this->getConnection();
    $conn->exec($sql);
    $this->closeConnection($conn);
   } catch (PDOException $e) {
    print 'find error is :'.$e->getMessage();
   }
   
  }
}
//測試
// $db = new PdoMysqlOperater();
// $db->findData('liujijun',array('name'=>'liujijun','name1'=>'liujijun'));
$db = new ConfigDataBase();
echo $db->getDsn();
  
  
  
  $db1 = new PdoMysqlOperater();
  
  $conn1 =$db1->getConnection();
  var_dump( $conn1);
?>