<?php
	include("db_conn.php");

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


	$cloth_name = $_POST["cloth_name"];
	//上衣 下著 連身衣
	$category_arr = array("top", "down", "overall");
	$style_arr = array("cute", "simple", "grace");
	//衣服種類的binary
#category
	if (isset($_POST["category"]))
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
		$category=NULL;
	print("trytry $category<br>");

#style
	if (isset($_POST["style"]))
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
		$category=NULL;

#info
	if (isset($_POST["text_info"]))
	{

		$text_info = $_POST["text_info"];
	}
	else
		$text_info=NULL;

#store
	if (isset($_POST["store"]))
	{

		$store = $_POST["store"];
	}
	else
		$store=NULL;



	/*$query = ("select * from user where user_id = ?");
    $stmt =  $db -> prepare($query);
    $error= $stmt -> execute(array($user_id));
	$result = $stmt -> fetchAll();
	*/	
	$query = ("select * from cloth_detail ");
    $stmt =$db->prepare($query);
    $error=$stmt->execute();
	$result=$stmt->fetchALL();
	$cloth_id=count($result)+1;//當前衣櫃有多少衣服
	//使用預處理寫法是為了防止「sql injection」
    //設定要使用的SQL指令
	$query=("insert into cloth_detail values(?,?,?,?,?,?,?)");
	$stmt=$db->prepare($query);
	//執行SQL語法
	$result=$stmt->execute(array($cloth_id,$cloth_name,$style,null,$category,$text_info,$store));
	


?>


