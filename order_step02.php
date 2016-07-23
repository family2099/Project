<?php require_once('connection.php'); ?>
<?php require_once('function.php'); ?>
<?php




if (!isset($_SESSION)) {
  session_start();
}
// 尚未登入
if ((!isset($_SESSION['userName'])) && (!isset($_SESSION['userGroup']))) {
  header('Location: order_step01.php');
}
?>
  <?php
//------------------------------------
// 檢查購物車內是否有商品
//------------------------------------

// 購物車內有商品
$_SESSION['has_item'] = TRUE;
// 商品的編號				
if (!isset($_SESSION['item']['item_index']) || (count($_SESSION['item']['item_index']) == 0)) {
  // 購物車內沒有商品
  $_SESSION['has_item'] = FALSE;
}

// 沒有加入商品
if (!$_SESSION['has_item']) {
  header('Location: order_step01.php');
}
?>
    <?php
//------------------------------------
// 設定付款方式
//------------------------------------
 
if (isset($_POST['order_nextstep'])) 
{
  $_SESSION['payment'] = $_POST['payment'];
  header('Location: order_step03.php');
}
?>
      <?php
//------------------------------------
// 顯示購物者的資料
//------------------------------------

// 選擇 MySQL 資料庫
try{
			$db = new PDO("mysql:host=localhost;dbname=test", "root", "");
			
			$db->exec("SET CHARACTER SET utf8");
	} 
	catch (PDOException $e) {
	     echo 'Error!: ' . $e->getMessage() . '<br />';
	}
	
	$query = sprintf("SELECT * FROM member WHERE username = %s", GetSQLValue($_SESSION['userName'], "text"));
	
	$result = $db->prepare($query);

	//print_r($data);

	$result->execute();
    if($result)
	{
	    $totalRows = $result->rowCount();
		//目前的紀錄
		$row=$result->fetch(PDO::FETCH_ASSOC);
		// 總頁數,ceil() 函數向上捨入為最接近的整數(就是有小數點就直接進位)。
		//$totalPages = ceil($totalRows / $rowsPerPage);
		//echo $totalRows;
	}
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
          <link href="css/index.css" rel="stylesheet">
          <!--出現問題Mixed Content: The page at 'https://lab-coolmancz.c9users.io/shopping/' was loaded over HTTPS, but requested an insecure stylesheet 'http://fonts.googleapis.com/css?family=Roboto'. This request has been blocked; the content must be served over HTTPS.
	解決方法Edit your theme replacing every occurency of http://fonts.googleapis.com/... with https://fonts.googleapis.com/... (mind the s).

	Resources that might pose a security risk (such as scripts and fonts) must be loaded through a secure connection when requested in the context of a secured page for an obvious reason: they could have been manipulated along the way-->
          <link href="css/login.css" rel="stylesheet">
          <script type="text/javascript" src="js/getindex.js"></script>
          <script src="js/bootstrap.min.js"></script>
          <script src="js/login_form.js"></script>
          <link href="css/order_step01.css" rel="stylesheet" type="text/css" />

          <script src="js/order_step02.js" type="text/javascript"></script>

          <link href="css/order_step03.css" rel="stylesheet" type="text/css" />
        </head>

        <body>

          <!-- 載入上邊區塊 -->

          <?php require_once('nav.php'); ?>
          <div class="container-fluid dis_top">

            <div class="row">
              <div class="col-xm-12 col-sm-10 col-sm-offset-1 col-md-9 col-md-offset-1 col-lg-8 col-lg-offset-2">
                <div class="panel panel-danger">
                  <div class="panel-heading">
                    <h3 class="panel-title">購物清單</h3>
                  </div>
                  <div class="panel-body">

                    <div class="row">



                      <table class="order_step03_style1">
                        <tr>
                          <td class="order_step03_style2">
                            <table class="order_step03_style3">
                              <tr>

                                <td class="order_step03_style5">
                                  step1. 檢視 / 修改
                                </td>
                                <td class="order_step03_style4">
                                  step2. 預覽 / 付款
                                </td>
                                <td class="order_step03_style5">
                                  step3. 完成訂單
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>

                        <tr>
                          <td>
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="order_step03_style15">
                              <!-- ------------------------ -->
                              <!--      顯示購物車內的商品    -->
                              <!-- ------------------------ -->
                              <table class="order_step03_style7">
                                <tr>
                                  <td class="order_step03_style16">編號</td>
                                  <td class="order_step03_style17">名稱</td>
                                  <td class="order_step03_style18">單價</td>
                                  <td class="order_step03_style19">數量</td>
                                  <td class="order_step03_style20">小計</td>
                                </tr>
                                <?php 				
					// 付款總計
	  			$_SESSION['total'] = 0; 
						
          if (isset($_SESSION['item']['item_index'])) 
          {							
            // 巡迴購物車內的每個商品
            foreach ($_SESSION['item']['item_index'] as $key => $value) 
						{ 
						  // 購物車的總金額
   				    $_SESSION['item']['total_price'][$key] = $_SESSION['item']['price'][$key] * $_SESSION['item']['quantity'][$key];
        ?>
                                <tr>
                                  <!-- 顯示購物車內商品的編號 -->
                                  <td class="order_step03_style22">
                                    <?php echo $_SESSION['item']['item_index'][$key]; ?>
                                  </td>
                                  <!-- 顯示購物車內商品的名稱 -->
                                  <td class="order_step03_style22">
                                    <?php echo $_SESSION['item']['item_name'][$key]; ?>
                                  </td>
                                  <!-- 顯示購物車內商品的單價 -->
                                  <td class="order_step03_style22">
                                    <?php echo $_SESSION['item']['price'][$key]; ?>
                                  </td>
                                  <!-- 顯示購物車內商品的數量 -->
                                  <td class="order_step03_style22">
                                    <?php echo $_SESSION['item']['quantity'][$key]; ?>
                                  </td>
                                  <!-- 顯示購物車內商品的總價 -->
                                  <td class="order_step03_style22">
                                    <?php echo $_SESSION['item']['total_price'][$key]; ?>
                                  </td>
                                </tr>
                                <?php 						            
							// 付款總計
							$_SESSION['total'] += $_SESSION['item']['total_price'][$key];
            }
          } 

					// 加上運費
					$_SESSION['total'] += 100; 
        ?>
                              </table>
                              <!-- ------------------- -->
                              <!--     顯示運費與總計    -->
                              <!-- ------------------- -->
                              <table class="order_step03_style7">
                                <tr>
                                  <td class="order_step03_style23">運費</td>
                                  <td class="order_step03_style24">&nbsp;</td>
                                  <td class="order_step03_style24">+</td>
                                  <td class="order_step03_style25">100</td>
                                </tr>
                                <tr>
                                  <td class="order_step03_style23">總計</td>
                                  <td class="order_step03_style24">&nbsp;</td>
                                  <td class="order_step03_style24">&nbsp;</td>
                                  <td class="order_step03_style25">
                                    <?php echo  $_SESSION['total']; ?>
                                  </td>
                                </tr>
                              </table>
                              <!-- ----------------- -->
                              <!--     選擇付款方式    -->
                              <!-- ----------------- -->
                              <table class="order_step03_style28">
                                <tr>
                                  <td class="order_step03_style26">
                                    <span class="order_step03_style27">
                》請選擇付款方式
              </span>
                                  </td>
                                </tr>
                                <tr>
                                  <td class="order_step03_style26">
                                    <input name="payment" id="payment" type="radio" value="線上刷卡" checked="checked" />
                                    <span class="order_step03_style27">
                線上刷卡
              </span> 財金資訊公司 - SSL PLUS 網路交易安全付款機制
                                    <br />
                                    <input name="payment" id="payment" type="radio" value="郵政劃撥" />
                                    <span class="order_step03_style27">
                郵政劃撥
              </span> 戶名：德瑞購物廣場股份有限公司 劃撥帳號：12345678
                                    <br />
                                    <input name="payment" id="payment" type="radio" value="電匯付款" />
                                    <span class="order_step03_style27">
                電匯付款
              </span> 帳號：台北三得銀行(代碼111) 南港分行 1111-2222-3333<br />
                                    <input name="payment" id="payment" type="radio" value="ATM轉帳" />
                                    <span class="order_step03_style27">
                ATM轉帳
              </span> 帳號：台北三得銀行(代碼111) 南港分行 2222-3333-4444
                                  </td>
                                </tr>
                              </table>
                              <!-- ------------------------ -->
                              <!-- 顯示 "上一步","下一步" 按鈕 -->
                              <!-- ------------------------ -->
                              <table class="order_step03_style7">
                                <tr>
                                  <td class="order_step03_style29">
                                    <input type="button" value="上一步" onclick="document.location='order_step01.php'; return false;" />
                                  </td>
                                  <td class="order_step03_style30">
                                    <input name="order_nextstep" id="order_nextstep" type="submit" value="下一步" />
                                  </td>
                                </tr>
                              </table>
                            </form>
                          </td>
                        </tr>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </body>

        </html>