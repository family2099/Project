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
	
  	
}
else
{
  
  $_SESSION['login_decide'] = "無效的帳號或密碼";
  
  
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
	<div class="row">
		<a class="btn btn-primary" data-toggle="modal" href="#myModal" >Login</a>

        <div class="modal hide" id="myModal">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">x</button>
            <h3>Login to MyWebsite.com</h3>
          </div>
          <div class="modal-body">
            <form method="post" action='' name="login_form">
              <p><input type="text" class="span3" name="eid" id="email" placeholder="Email"></p>
              <p><input type="password" class="span3" name="passwd" placeholder="Password"></p>
              <p><button type="submit" class="btn btn-primary">Sign in</button>
                <a href="#">Forgot Password?</a>
              </p>
            </form>
          </div>
          <div class="modal-footer">
            New To MyWebsite.com?
            <a href="#" class="btn btn-primary">Register</a>
          </div>
        </div>
	</div>
</div>
        <!-- /container -->


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script src="dist/js/bootstrap.min.js"></script>





    </body>

    </html>
    