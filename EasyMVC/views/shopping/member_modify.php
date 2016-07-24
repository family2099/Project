<?php
//可根據GET的值來做判斷
session_start();

require_once('function.php');

if(!isset($_SESSION['userName'])){
    
   
    
  	header("Location: index.php");
  	exit();
  	
  	
}
//**********************************//
// 顯示member資料表的目前紀錄
//**********************************//
$username = "-1";
if (isset($_SESSION['userName'])) {
  $username = $_SESSION['userName'];
}    
    
	try{
			$db = new PDO("mysql:host=localhost;dbname=test", "root", "");
			
			$db->exec("SET CHARACTER SET utf8");
	} 
	catch (PDOException $e) {
	     echo 'Error!: ' . $e->getMessage() . '<br />';
	}
	
	$query = sprintf("SELECT * FROM member WHERE username = %s", GetSQLValue($username, "text"));
	
	$result = $db->prepare($query);

	//print_r($data);

	$result->execute();
    if($result)
	{
	  
		//目前的紀錄
		$row=$result->fetch(PDO::FETCH_ASSOC);
		// 總頁數,ceil() 函數向上捨入為最接近的整數(就是有小數點就直接進位)。
		//$totalPages = ceil($totalRows / $rowsPerPage);
		//echo $totalRows;
	}
	else
	{
		
		header('Location: index.php');
		
	}


if ((isset($_POST["update"])) && ($_POST["update"] == "member_info")) 
{
    
	
	// 新的帳號
	$_SESSION['userName'] = $_POST['username'];
	
	// 在member資料表內插入一筆新的紀錄
    $query = sprintf("UPDATE member SET username=%s, password=%s, name=%s, sex=%s, birthday=%s, email=%s, phone=%s, address=%s, uniform=%s, unititle=%s, userlevel=%s WHERE id=%s", GetSQLValue($_POST['username'], "text"), 
	GetSQLValue($_POST['password'], "text"), GetSQLValue($_POST['name'], "text"), GetSQLValue($_POST['sex'], "text"), 
	GetSQLValue($_POST['birthday'], "date"), GetSQLValue($_POST['email'], "text"), GetSQLValue($_POST['phone'], "text"), 
	GetSQLValue($_POST['address'], "text"), GetSQLValue($_POST['uniform'], "text"), GetSQLValue($_POST['unititle'], "text"),
	GetSQLValue($_POST['userlevel'], "int"), GetSQLValue($_POST['id'], "int"));

	// 傳回結果集
    $result = $db->prepare($query);
    $result->execute();
  // 回到前一個網頁 
	if ($result) {
	  	header(sprintf("Location: member_center.php"));
	}
}



// 取得這筆紀錄的 birthday 欄位值
$date = getdate(strtotime($row['birthday']));
// 設定 [年],[月],[日] 欄位
$year = $date['year'];
$month = $date['mon'];
$day = $date['mday'];









?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<!---PS:其他js檔都要放JQUERY後面要不其他js檔先執行會錯誤--->
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="js/jquery.js"></script>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/self.css" rel="stylesheet">
	
	<!--出現問題Mixed Content: The page at 'https://lab-coolmancz.c9users.io/shopping/' was loaded over HTTPS, but requested an insecure stylesheet 'http://fonts.googleapis.com/css?family=Roboto'. This request has been blocked; the content must be served over HTTPS.
	解決方法Edit your theme replacing every occurency of http://fonts.googleapis.com/... with https://fonts.googleapis.com/... (mind the s).

	Resources that might pose a security risk (such as scripts and fonts) must be loaded through a secure connection when requested in the context of a secured page for an obvious reason: they could have been manipulated along the way-->
	<link href="css/login.css" rel="stylesheet">
	<script src="js/bootstrap.min.js"></script>
	
	<link href="css/member_info.css" rel="stylesheet" type="text/css" />

	
	<!--<script src="js/member_info.js" type="text/javascript"></script>-->
	
	
</head>

<body>

<?php require_once('nav.php'); ?>

<div class="container-fluid dis_top">
    <div class="row">
		<div class="col-xm-12 col-sm-10 col-sm-offset-1 col-md-9 col-md-offset-1 col-lg-8 col-lg-offset-2">
			<div class="panel panel-danger">
			  <div class="panel-heading">
			    <h3 class="panel-title">會員資料修改</h3>
			  </div>
			  <div class="panel-body">
					<div class="row">
			    		
			    			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" onkeydown="if(event.keyCode==13) return false;"> 
						        <table class="member_info_style4">
						          <tr>
						            <td class="member_info_style5">
						              <span class="member_info_style6">注意事項</span>
						              <br /><br />
						              <span class="member_info_style7">
						                1. 在修改之前，請先確認您要修改的資料。
						              </span>
						              <br />
						              <span class="member_info_style7">
						                2. 修改資料之後，就無法再還原。
						              </span>
						            </td>
						          </tr>
						          <tr>
						            <td class="member_info_style16">
						            <table class="member_info_style9">
						               <tr>
						                 <td class="member_info_style10">
						                   <span class="member_info_style11">帳　　號</span>                 
						                 </td>
						                 <td class="member_info_style12">
						                   <input name="username" id="username" type="text" class="member_info_style13" pattern="[A-Za-z0-9]{3,20}" required="true" value="<?php echo $row['username']; ?>" />
						                     <span class="member_info_style8">＊</span>（3~20個字元，請勿使用中文）                 
						                 </td>
						               </tr>
						               <tr>
						                 <td class="member_info_style10">
						                   <span class="member_info_style11">
						                     密　　碼
						                   </span>
						                 </td>
						                <td class="member_info_style12">
						                   <input name="password" id="password" type="password" class="member_info_style13" pattern="[A-Za-z0-9]{3,20}" size="10" required="true" value="<?php echo $row['password']; ?>" />
						                     <span class="member_info_style8">＊</span>（3~20個字元，請勿使用中文）
						                 </td>
						               </tr>
						               <tr>
						                 <td class="member_info_style10">
						                   <span class="member_info_style11">
						                     姓　　名
						                   </span> 
						                 </td>
						                 <td class="member_info_style12">
						                   <input name="name" id="name" type="text" class="member_info_style13" required="true" size="20" maxlength="40" 
						                     value="<?php echo $row['name']; ?>" />
						                     <span class="member_info_style8">＊</span>
						                 </td>
						               </tr>
						               <tr>
						                 <td class="member_info_style10">
						                   <span class="member_info_style11">
						                     性　　別
						                   </span> 
						                 </td>
						                 <td class="member_info_style12">
										    <!--strcmp() 函數比較兩個字符串	-->
										    <!--0 - 如果两个字符串相等-->
											<!--<0 - 如果 string1 小于 string2-->
											<!--大於0 - 如果 string1 大于 string2-->

						                   <input name="sex" type="radio" value="男" class="member_info_style14"  
						                     <?php if (!(strcmp($row['sex'],'男'))) 
						                   {echo "checked=\"checked\"";} ?> />
						                     男
						               <input name="sex" type="radio" value="女" 
						                 <?php if (!(strcmp($row['sex'],'女'))) 
						                  {echo "checked=\"checked\"";} ?> />
						                     女  
						                 </td>
						               </tr>
						               <tr>
						                 <td class="member_info_style10">
						                   <span class="member_info_style11">
						                     電子信箱
						                   </span> 
						                 </td>
						                 <td class="member_info_style12">
						                   <input name="email" id="email" type="email" class="member_info_style13" size="40" required="true" maxlength="40" value="<?php echo $row['email']; ?>" />
						                     <span class="member_info_style8">＊</span>
						                 </td>
						               </tr>
						               <tr>
						                 <td class="member_info_style10">
						                   <span class="member_info_style11">
						                     出生日期
						                   </span> 
						                 </td>
						                 <td class="member_info_style12">
						                   <input name="year" id="year" type="text" class="member_info_style13" pattern="[0-2][9][0-9][0-9]" required="true" size="6" value="<?php echo $year; ?>" />
						                     &nbsp;年&nbsp;
						                   <!-- 在選單中填入[出生日期]的[月]欄位值 -->
						                   <select name="month" id="month">
						                   <?php
						                     for ($i = 1; $i <= 12; $i++)
						                     {
						                   ?>
						                     <option value="<?php echo $i ?>"
						                       <?php if ($i==$month){echo "selected=\"selected\"";} ?>>
						                       &nbsp;&nbsp;<?php echo $i ?>&nbsp;
						                     </option>         
						                   <?php
						                     }
						                   ?>
						                   </select>
						                   &nbsp;月&nbsp;&nbsp;
						                   <select name="day" id="day">
						                   <?php
						                     for ($i = 1; $i <= 31; $i++)
						                     {
						                   ?>
						                       <option value="<?php echo $i ?>" 
						                         <?php if ($i==$day){echo "selected=\"selected\"";} ?>>
						                         &nbsp;&nbsp;<?php echo $i ?>&nbsp;&nbsp;
						                       </option>         
						                   <?php
						                     }
						                   ?>
						                   </select>
						                   &nbsp;日&nbsp;&nbsp;
						                   <span class="member_info_style8">＊</span>（請填入西元年, 例如 2010）
						                 </td>
						               </tr>
						               <tr>
						                 <td class="member_info_style10">
						                   <span class="member_info_style11">
						                     連絡電話 
						                   </span> 
						                 </td>
						                 <td class="member_info_style12">
						                   <input name="phone" id="phone" type="text" class="member_info_style13" required="true" size="20" maxlength="15" 
						                     value="<?php echo $row['phone']; ?>" />
						                     <span class="member_info_style8">＊</span>  
						                 </td>
						               </tr>
						               
						              
						             </table>
						           </td>
						         </tr>
						         <tr>
						           <td class="member_info_style2">
						             <table class="member_info_style9">
						               <tr>
						                 <td class="member_info_style2">
						                   <input type="submit" value="確定送出"  />
						                   <input type="button" value="取消" class="member_info_style15" 
						                     onclick="document.location='<?php echo $_SESSION['PrevPage']; ?>'; return false;" />
						                 </td>
						               </tr>
						             </table> 
						           </td>
						         </tr>
						       </table> 
						       <input name="userlevel" id="userlevel"type="hidden" value="<?php echo $row['userlevel']; ?>" />
						         <input name="birthday" id="birthday" type="hidden" value="<?php echo $row['birthday']; ?>" />
						         <input name="id" id="id" type="hidden" value="<?php echo $row['id']; ?>" />
						       <input name="old_username" id="old_username" type="hidden" value="<?php echo $row['username']; ?>" />
						         <input name="update" id="update" type="hidden" value="member_info" />
						      </form>
			    		
			    		
			    		
			    		
			    		
			    		
			    	</div>
			  </div>
			</div>
		</div>
	</div>

</div>







</body>

</html>






