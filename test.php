<?php
require_once('connection.php'); 
session_start();

    

    echo $_POST["userName"];
echo "OK";
// 有帳號與密碼欄位
if (isset($_POST['userName']) && isset($_POST['inputPassword'])) 
{
    // 帳號與密碼欄位
	$username = $_POST['userName'];
  	$password = $_POST['inputPassword'];	
	
	echo $username;
  	//查詢member資料表的username與password欄位
  	//建立查詢資料表的SQL語法
  	$cmd = $db->prepare("SELECT username, password, userlevel FROM member WHERE username=? AND password=?"); 		
   	// 傳回結果集
   	$cmd->bindValue(1, $username, PDO::PARAM_STR);
   	$cmd->bindValue(2, $password, PDO::PARAM_STR);
   	$result =$cmd->execute();
   	// 結果集的記錄筆數
   	$tol=$cmd->rowCount();
    $row = $cmd->fetch(PDO::FETCH_ASSOC);
	echo $tol;
	
	if($tol)
	{
	    // 建立session變數
    		$_SESSION['Username'] = $username;
		    $_SESSION['UserGroup'] = $row['userlevel'];
		
		    echo $_SESSION['Username'];
    	if (isset($_SESSION['lastPage'])) 
		{    
		    
			
			// 成功登入, 前往上次觀看的頁面
    		header("location:index.php");
	  	}
  		else 
		{
		   
		    // 重新登入, 前往login.php 
    		header("location: login.php");
  		}
	}
	else
	{
	    
    	header("location: login.php");
	}
}



    
    
?>
<!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="dist/css/self.css" rel="stylesheet">

        <title></title>


    </head>

    <body>
<div class="container">

            
            
            <div class="panel panel-default">
                <div class="panel-heading">
                    <center>    <h3 class="panel-title">請登入您的帳號密碼</h3></center>
                </div>
                <div class="panel-body">
                    
                    <form class="form-horizontal" method="post">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">使用者帳號</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="userName" name="userName" placeholder="輸入帳號">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">使用者密碼</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="inputPassword" name="inputPassword" placeholder="輸入密碼">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <div class="checkbox">
                                    <label>
                              <input type="checkbox">記住我
                            </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default">登入</button>
                            </div>
                        </div>
                    </form>
                    
                    
                    
                    
                    
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script src="dist/js/bootstrap.min.js"></script>





    </body>

    </html>           
                    
            





