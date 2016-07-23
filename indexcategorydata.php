<?php

header("content-type: text/html; charset=utf-8");
require_once("connection.php");

ConfigDataBase::getDsn();
//var_dump(ConfigDataBase::getDsn());
//var_dump($_POST['table']);
//$table=computer_books;
//$category_type="網頁設計";
$table= $_POST["table"];
$category_type= $_POST["category_type"];

$arr=array();

$p=0;





$combookdata = ConfigDataBase::$_dsnconn->prepare("select * from ".$table." where category_type=? ORDER BY publishdate DESC");
//var_dump($combookdata);
//只有欄位變數才可以用bindValue(1, $_POST['category_type'], PDO::PARAM_STR);
//$combookdata->bindValue(1, $_POST['table']);
$combookdata->bindValue(1, $category_type, PDO::PARAM_STR);
$combookdata->execute();
//var_dump($combookdata);
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
 

 
	mysql_close;

	



?>