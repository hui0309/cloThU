<?php
	include("con_db.php");
	session_start();
//	echo $_SESSION["user_id"];
/*
	create table cloth_detail( 
	cloth_ID 		bigint(15) not null, 
o	cloth_name 		varchar(20), not null
o	cloth_style 		varchar(20), 
	cloth_Img 		varchar(20), //暫時無
o	cloth_category		varchar(20), 
o	cloth_info		varchar(120),
O	store_ID 		bigint(15) 
	primary key(cloth_ID),
	foreign key (store_ID) references store);
 */
$cloth_id = $_POST["cloth_id"];



	$cloth_name = $_POST["cloth_name"];
	//上衣 下著 連身衣
	$category_arr = array("top", "down", "overall");
	$style_arr = array("cute", "simple", "grace");
	//衣服種類的binary
#category
	if (isset($_POST["category"])&&!empty($_POST['category']))
	{
		//變數存在
		$category = $_POST["category"];
		$cate_id=1;#在arr中第幾個 2^cate_id
		$cate_num=1;//實際的數值
		for ($i=0;$i<count($category_arr);$i++){
			if ($category_arr[$i]==$category)
			{ 	$cate_id=$i;
				print("first $cate_id<br>");	
			}
		}
	
		while($cate_id>0)
		{$cate_num*=2;
			$cate_id-=1;
		}
		print("final val $cate_num <br>");	
	}
	else //變數不存在，未選
		$cate_num=NULL;
	print("trytry $cate_num<br>");

#style
	if (isset($_POST["style"])&&!empty($_POST['style']))
	{

		$style = $_POST["style"];
		$style_id=1;#在arr中第幾個 2^cate_id
		$style_num=1;//實際的數值
		for ($i=0;$i<count($style_arr);$i++){
			if ($style_arr[$i]==$style)
			{ 	$style_id=$i;
				print("first $style_id<br>");	
			}
		}

		while($style_id>0)
		{$style_num*=2;
			$style_id-=1;
		}
		print("final val $style_num <br>");
	#	print($cloth_name.'<br>');
	}
	else
		$style_num=NULL;

#info
	if (isset($_POST["text_info"])&&!empty($_POST['text_info']))
	{

		$text_info = $_POST["text_info"];
	}
	else
		$text_info=NULL;

#store
	if (isset($_POST["store"])&&!empty($_POST['store']))
	{

		$store = $_POST["store"];
	}
	else
		$store=NULL;

echo "id: ".($cloth_id)."<br>";
echo "name: ".($cloth_name)."<br>";
echo "style: ".($style_num)."<br>";
echo "category: ".($cate_num)."<br>";
echo "store: ".($store)."<br>";
echo "info: ".($text_info)."<br>";
 
$sql = "UPDATE cloth_detail  SET cloth_name = ?,
cloth_style = ?,cloth_img = ?,cloth_category = ?,cloth_info = ?,store_id = ? WHERE cloth_id = ?";
if($stmt = $db->prepare($sql)){
	$success = $stmt->execute(array($cloth_name, $style_num, null, $cate_num, $text_info,$store, $cloth_id));
	if (!$success) 
	{
		echo "刪除失敗!".$stmt->errorInfo();
	}else{
	  echo"succeess";
	  }
}


	
header("location:single.php");

?>


