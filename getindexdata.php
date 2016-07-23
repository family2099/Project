<?php

header("content-type: text/html; charset=utf-8");
require_once("connection.php");

ConfigDataBase::getDsn();
//var_dump(ConfigDataBase::getDsn());


$arr=array();

$p=0;
$combookdata = ConfigDataBase::$_dsnconn->prepare("select * from computer_books where author = '德瑞工作室' OR translator = '德瑞工作室' ORDER BY publishdate DESC");
//var_dump(login::$cmd);


$combookdata->execute();
//$row = $cmd->fetch();
//var_dump(login::$cmd);

	while($row = $combookdata->fetch(PDO::FETCH_ASSOC))
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

	//var_dump($arr);

	echo json_encode($arr);//將$value轉成JSON格式傳回
 

 
	

	



?>