<?php

class HomeController extends Controller {
    
    function index() {
        echo "home page of HomeController";
    }
    
    function hello($name) {
        //繼承了Controller所以可以用this去取的方法
        $user = $this->model("User");
        $user->name = $name;
        $this->view("Home/hello", $user);
        // echo "Hello! $user->name";
    }
    
    
    function getv($year,$month) {
        //繼承了Controller所以可以用this去取的方法
        //$user = $this->model("User");
        //$user->name = $name;
        $this->view("Home/GET", $year,$month);
        // echo "Hello! $user->name";
    }
    
   
}

?>