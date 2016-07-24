<?php
session_start();
class IndexController extends Controller 
{
    
    /*function index() {
        echo "home page of HomeController";
    }*/
    
    // function hello($name) {
    //     $user = $this->model("User");
    //     $user->name = $name;
    //     $this->view("Home/hello", $user);
    //     // echo "Hello! $user->name";
    // }
    
    
    /*-----------------------------------------
    進入網頁要先顯示資料該方發就是進入index要顯是什麼的方法
    
    ----------------------------------------------*/
    
    function get_Index($c1) 
    {
        // 目前是頁數變數
        $page=0;
        
        // 每頁10筆
        $rowsPerPage = 10;
        
        //目前database名稱
        $_SESSION['database'] = 'computer_books';
        //判斷有沒有傳頁數值
        if (isset($c1)) 
        {
    	    $page = $c1;
    	}
    	
    	
        
        
        $get_Index_data = $this->model("database");
        $totalrecord=$get_Index_data->get_Index_data_number($_SESSION['database']);
        $totalPages = ceil($totalrecord / $rowsPerPage);
        //從資料庫取的第幾筆開始抓
        $startRow = $page * $rowsPerPage;
    
	    $get_computer_books_ten_record=$get_Index_data->get_computer_books_ten_record($_SESSION['database'],$startRow);
        // var_dump($get_computer_books_ten_record);
        // echo "123";
        
        $data=Array();
        // $data[]=Array();
        //目前頁數
        $data[0]=$page;
        //computer_book全部資料筆數
        $data[1]=$totalrecord;
        //computer_book資料產生的總頁數
        $data[2]=$totalPages;
        //目前資料的筆數
        $data[3]=$get_computer_books_ten_record[0];
        //結果集
        $data[4]=$get_computer_books_ten_record[1];
        // var_dump($data[4]);
        
        $this->view("index",$data);
        
    }
    /*-----------------------------------------
    導向不同的類別頁方法
    目前還沒處理完畢
    ----------------------------------------------*/
    
    function get_category_page($q1,$q2) 
    {
        
        if ((isset($q1)) and (isset($q2))) 
        {
            $data=Array();
            $data[0]=$q1;
            $data[1]=$q2;
            
            $this->view("category_result",$data);
            
        }
        else 
        {
            $this->get_Index();
            	  
            
        }
            
        
    }
    
    
    /*-----------------------------------------
    
    登入驗證方法
    ----------------------------------------------*/
    
    function get_login_data() 
    {
        
        
        if((isset($_POST['userN'])) and (isset($_POST['passW']))) 
        {
            $get_login_data = $this->model("database");
            $result=$get_login_data->login_check($_POST['userN'],$_POST['passW']);
            // echo $get_login_data;
            if($get_login_data)
            {
                $_SESSION['userName'] = $result[0]['username'];
                
            	$_SESSION['decidelogincount']=1;
                $_SESSION['userGroup'] = $result[0]['userlevel'];
                // echo $_SESSION['userName'];
            }
            // $data=$get_login_data;
            // echo $data;
            $this->get_Index();
            
        }
        else 
        {
            $this->get_Index();
            	  
            
        }
            
        
    }
     /*-----------------------------------------
    
    將點選的商品資料從資料庫取出並存入session
    ----------------------------------------------*/
    
    function add_to_cart($q1)
    {
        
        if (isset($q1))
        {
          $field = $q1;
          
        }
        $get_car_data = $this->model("database");
        $result=$get_car_data->add_car($_SESSION['database'],$q1);
        // var_dump($result);
        // 判斷商品是否已經存在
        $item_exist = FALSE;
        // 購物車內已經有商品
        if (isset($_SESSION['item']['item_index']))	
        {
        	// 巡迴購物車內的商品
        	foreach($_SESSION['item']['item_index'] as $key => $value) 
        	{	
        		// 購物車內的商品編號,與加入的商品編號相同
        		if ($_SESSION['item']['item_index'][$key] == $get_car_data['item_index']) 
        		{
        			// 商品已經存在, 不要再加入
        			$item_exist = TRUE;
        			break;
        		}
        	}
        }
        // 商品還沒存在, 加入目前要購買的商品
        if (!$item_exist)
        {
          // 商品的編號				
          $_SESSION['item']['item_index'][] = $result['item_index'];
          // 商品的名稱
          $_SESSION['item']['item_name'][] = $result['title'];
          // 商品的單價
          $_SESSION['item']['price'][] = $result['saleprice'];
          // 商品的數量
          $_SESSION['item']['quantity'][] = 1;
          // 商品的總價
          $_SESSION['item']['total_price'][] = $result['saleprice'];
        }
        
        header('Location: /EasyMVC/Index/get_order_step01');
        
        
    }
    
     /*-----------------------------------------
    
    導向order_step01檔
    ----------------------------------------------*/
    
    
    
    function get_order_step01()
    {
        
        
        
        
        
        
        
        
        
        $this->view("order_step01");
    
    }
    
    /*-----------------------------------------
    
    
    ----------------------------------------------*/
    
    // function get_category_page($q1,$q2) 
    // {
        
    //     if ((isset($q1)) and (isset($q2))) 
    //     {
    //         $data=Array();
    //         $data[0]=$q1;
    //         $data[1]=$q2;
            
    //         $this->view("shopping/category_result",$data);
            
    //     }
    //     else 
    //     {
    //         $this->view("shopping/index");
            	  
    //         exit;
    //     }
            
        
    // }
    
    
    
    
    
    
}

?>