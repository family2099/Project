<?php require_once('connection.php'); ?>
<?php require_once('function.php'); ?>
<?php
session_start();

// 尚未登入
// if ((!isset($_SESSION['userName'])) && (!isset($_SESSION['userGroup']))) {
//   header('Location: index.php');
// }
// 前一個網頁
$_SESSION['PrevPage'] = $_SERVER['PHP_SELF'];

$obj=new login();
	$obj->acctpassw_check($_POST['userN'],$_POST['passW']);
?>
  <?php
/*------------------------------------
 修改購買商品的數量
------------------------------------*/

if (isset($_POST['order_nextstep'])) 
{
  // [數量]文字欄位的索引值
  $index = 0;
  // 巡迴購物車內的所有商品
  foreach ($_SESSION['item']['item_index'] as $key => $value) 
  {
    // 有商品
    if (isset($_SESSION['item']['item_index'][$key])) 
    {			
			// 重新設定商品的數量
      $_SESSION['item']['quantity'][$key] = $_POST['order_quantity'][$index];
		}
		// [數量]文字欄位的索引值
		$index++;
  } 
	
	header('Location: order_step02.php');
}
?>
    <?php
/*------------------------------------
 刪除購買的商品
------------------------------------*/

// $_POST['order_delete'] 是[刪除]按鈕, $_POST['order_check'] 是核取方塊
if (isset($_POST['order_delete']) && isset($_POST['order_check'])) 
{ 
  // 巡迴所有的商品核取方塊
  foreach ($_POST['order_check'] as $key => $value) 
  {
    // 商品的核取方塊被勾選, $_POST['order_check'][$key]等於value屬性值
    if (isset($_POST['order_check'][$key])) 
		{	      
			// 第?個商品被刪除
			$index = $_POST['order_check'][$key];
			// 商品的編號				
			$_SESSION['item']['item_index'][$index] = NULL;
			unset($_SESSION['item']['item_index'][$index]);
			// 商品的名稱
			$_SESSION['item']['item_name'][$index] = NULL;
			unset($_SESSION['item']['item_name'][$index]);
			// 商品的單價
			$_SESSION['item']['price'][$index] = NULL;
			unset($_SESSION['item']['price'][$index]);
			// 商品的數量
			$_SESSION['item']['quantity'][$index] = NULL;
			unset($_SESSION['item']['quantity'][$index]);
			// 商品的總價
			$_SESSION['item']['total_price'][$index] = NULL;
			unset($_SESSION['item']['total_price'][$index]);	
		}
  }
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
          <link href="css/order_step02.css" rel="stylesheet" type="text/css" />
          <script src="js/order_step02.js" type="text/javascript"></script>
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

                      <table class="order_step02_style1">

                        <tr>
                          <td class="order_step02_style2">
                            <table class="order_step02_style3">
                              <tr>

                                <td class="order_step02_style4">
                                  step1. 檢視 / 修改
                                </td>
                                <td class="order_step02_style5">
                                  step2. 預覽 / 付款
                                </td>
                                <td class="order_step02_style5">
                                  step3. 完成訂單
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>

                        <tr>
                          <td>
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="order_step01_style16">
                              <table class="order_step01_style7">
                                <tr>
                                  <td class="order_step01_style8">》臨時購物車</td>
                                </tr>
                              </table>
                              <!-- ------------------------ -->
                              <!--      顯示購物車內的商品    -->
                              <!-- ------------------------ -->
                              <table class="order_step01_style7">
                                <tr>
                                  <td class="order_step01_style17">X</td>
                                  <td class="order_step01_style18">編號<?php echo "123"; ?></td>
                                  <td class="order_step01_style19">名稱</td>
                                  <td class="order_step01_style20">單價</td>
                                  <td class="order_step01_style21">數量</td>
                                </tr>
                                <?php 
                                  if (isset($_SESSION['item']['item_index'])) 
                                  {					
                                    // 巡迴購物車內的每個商品
                                    foreach ($_SESSION['item']['item_index'] as $key => $value) 
                        						{ 
                                ?>
                                        <tr>
                                          <!-- 顯示購物車內商品的索引值 -->
                                          <td class="order_step01_style22">
                                            <input name="order_check[]" type="checkbox" value="<?php echo $key; ?>" />
                                          </td>
                                          <!-- 顯示購物車內商品的編號 -->
                                          <td class="order_step01_style23">
                                            <?php echo $_SESSION['item']['item_index'][$key]; ?>
                                          </td>
                                          <!-- 顯示購物車內商品的名稱 -->
                                          <td class="order_step01_style23">
                                            <?php echo $_SESSION['item']['item_name'][$key]; ?>
                                          </td>
                                          <!-- 顯示購物車內商品的單價 -->
                                          <td class="order_step01_style23">
                                            <?php echo $_SESSION['item']['price'][$key]; ?>
                                          </td>
                                          <!-- 顯示購物車內商品的數量 -->
                                          <td class="order_step01_style22">
                                            <input name="order_quantity[]" type="text" size="3" maxlength="3" value="<?php echo $_SESSION['item']['quantity'][$key]; ?>" />
                                          </td>
                                        </tr>
                                <?php 
                                    } 
                                  } 
                                ?>
                              </table>
                              <!-- ------------------------------------------------------ -->
                              <!-- 顯示 "刪除","修改數量","清空購物車","繼續購物","下一步" 按鈕 -->
                              <!-- ------------------------------------------------------ -->
                              <table class="order_step01_style7">
                                <?php 
                                  // 購物車沒有商品
                                  if (!$_SESSION['has_item']) 
                                  { 
                                ?>
                                    <tr>
                                      <td>
                                        <table class="order_step01_style7">
                                          <tr>
                                            <td colspan="5" class="order_step01_style24">
                                              沒有商品
                                            </td>
                                          </tr>
                                        </table>
                                      </td>
                                    </tr>
                                <?php 
                                  } 
                        					// 購物車內有商品
                                  else
                                  { 
                                ?>
                                    <tr>
                                      <td>
                                        <table class="order_step01_style7">
                                          <tr>
                                            <td class="order_step01_style25">
                                              <input name="order_delete" id="order_delete" type="submit" value="刪除" />
                                            </td>
                                          </tr>
                                        </table>
                                      </td>
                                    </tr>
                                <?php 
                                  } 
                                ?>
                                    <tr>
                                      <td>
                                        <table class="order_step01_style7">
                                          <tr>
                                            <?php 
                          									  // 購物車內有商品
                          									  if ($_SESSION['has_item']) 
                          										{ 
                          									?>
                                                  <td class="order_step01_style27">
                                                    <input type="button" value="清空購物車" onclick="return clearCart();" />
                                                  </td>
                                            <?php 
                          									  } 
                          								  ?>
                                                  <td class="order_step01_style28">
                                                  <input type="button" value="繼續購物" class="order_step01_style29" onclick="document.location='index.php'" />
                                            <?php 
                          									  // 購物車內有商品
                          									  if(isset($_SESSION['userName']) && $_SESSION['has_item']) 
                          										{ 
                          									?>
                                                <input name="order_nextstep" id="order_nextstep" class="order_step01_style29" type="submit" value="下一步" />
                                            <?php 
                          									  }
                          									  else
                          									  {
                          									?>  
                          									
                          									    <input name="order_nextstep" id="order_nextstep" class="order_step01_style29" type="submit" value="下一步" onclick="alert('您還未登入或目前無購買商品')"/>
                          									<?php
                          									  }
                          									?>
                                            </td>
                                          </tr>
                                        </table>
                                      </td>
                                    </tr>
                              </table>
                            </form>
                          </td>
                        </tr>
                        <tr>
                          <tr>
                            <td class="order_step02_style32">
                              <table class="order_step02_style33">
                                <tr>
                                  <td>
                                    <span class="order_step02_style34">
                                      貼心小叮嚀
                                    </span>
                                    <br />
                                    <ul>
                                      <li class="order_step02_style38">
                                        付款幣別為新台幣。
                                      </li>
                                      <li class="order_step02_style38">
                                        下載版軟體購買說明
                                        <br />
                                        <table class="order_step02_style36">
                                          <tr>
                                            <td class="order_step02_style37">
                                              1.
                                              <span class="order_step02_style35">
                                                出貨方式
                                              </span>
                                              <br /> 此商品為線上下載版軟體，德瑞購物網將於確認收到您的貨款無誤後，一個工作天即為您辦理出貨程序，軟體的序號及下載軟體的位置，將會以email通知收貨人。
                                              <br /> 2.
                                              <span class="order_step02_style35">
                                                退換貨相關
                                              </span>
                                              <br /> 下載版軟體在線上交易成功之後，系統將以電子郵件方式發送軟體登入序號，不需要拆封即可立即安裝使用，因此序號一經發出後，恕不受理退換貨。
                                            </td>
                                          </tr>
                                        </table>
                                      </li>
                                      <li class="order_step02_style38">
                                        <span class="order_step02_style35">
                                          單次訂購滿1000元即可免費宅配
                                        </span> ，未滿1000元酌收運費100元。
                                        <br /> 建議您可以購買我們所推廌的商品，以節省您的運費
                                      </li>
                                      <li class="order_step02_style38">
                                        請注意避免刷卡不成功:
                                        <br /> 1.
                                        <span class="order_step02_style35">
                                          卡號填錯
                                        </span> 2.
                                        <span class="order_step02_style35">
                                          過期
                                        </span> 3.
                                        <span class="order_step02_style35">
                                          檢查碼cvc2沒填或輸入錯誤
                                        </span> 4.
                                        <span class="order_step02_style35">
                                          已刷爆
                                        </span> 5.
                                        <span class="order_step02_style35">
                                          該卡非VISA / MASTER / JCB
                                        </span>
                                      </li>
                                      <li class="order_step02_style38">
                                        使用ATM轉帳 / 郵政劃撥 / 電匯付款的讀者，完成付款之後請
                                        <span class="order_step02_style35">
                                          傳真您的收據
                                        </span> 到
                                        <span class="order_step02_style35">
                                          (02)1234-5678
                                        </span> 。
                                      </li>
                                    </ul>
                                  </td>
                                </tr>
                              </table>
                            </td>
                          </tr>
                      </table>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          </div>

        </body>

        </html>
