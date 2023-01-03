<?php
    include("session_init.php");
    if(!isset($_SESSION["user_id"])){
        header('Location: ./index.php');
        exit;
    }
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
if (isset($_POST["store"])&&!empty($_POST["store"]))
{

	$store_name = $_POST["store"];
	//echo "這".($store_name)."kkk<br>";
	$query = ("select * from store ");
	$stmt =  $db -> prepare($query);
	   $error= $stmt -> execute();
	$result = $stmt -> fetchAll();
	echo "total ".count($result)."<br>";
	$store_id=0;
	//////////////////////////
	for ($i=0;$i<count($result);$i++){
		echo "arr".$result[$i]['store_name']."kk<br>";
		echo "my".$store_name."kk<br>";
		if(strval($result[$i]['store_name'])==strval($store_name))
		{$store_id=$i+1;
		echo "have same";}
	}
	if($store_id==0){$store_id=count($result)+1;
	$query=("insert into store values(?,?)");
	$stmt=$db->prepare($query);
	//執行SQL語法 need
	$result=$stmt->execute(array($store_id,$store_name));
	}
}
else
	$store=NULL;

#img
if (isset($_POST["cloth_img"])&&!empty($_POST["cloth_img"]))
{

	$img = $_POST["cloth_img"];
}
else
	$img=NULL;

echo "id: ".($cloth_id)."<br>";
echo "name: ".($cloth_name)."<br>";
echo "style: ".($style_num)."<br>";
echo "category: ".($cate_num)."<br>";
echo "store: ".($store)."<br>";
echo "info: ".($text_info)."<br>";
 
$sql = "UPDATE cloth_detail  SET cloth_name = ?,
cloth_style = ?,cloth_img = ?,cloth_category = ?,cloth_info = ?,store_id = ? WHERE cloth_id = ?";
if($stmt = $db->prepare($sql)){
	$success = $stmt->execute(array($cloth_name, $style_num, $img, $cate_num, $text_info,$store_id, $cloth_id));
	if (!$success) 
	{
		echo "刪除失敗!".$stmt->errorInfo();
	}else{
	  echo"succeess";
	  }
}


	
// header("location:single.php");

?>


