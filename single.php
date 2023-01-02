<?php
    include("con_db.php");
    session_start();//include這個才能用session
//$user_id=strval($_SESSION["user_id"]);
$user_id="00957117";
echo $user_id;
//echo "id".($_SESSION["user_id"]);
if(isset($user_id))echo "存在";
else echo "not exist";
if(empty($user_id))echo "不存在";

/*$_SESSION["login"] = false;
    if($_SESSION["login"] == false){
        header('Location: ./index.php');
        exit;  //記得要跳出來，不然會重複轉址過多次
    }*/
?>

<html>
    <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
      <title>single.html</title>
      <style>
        body {
            margin: 0px;
        }
        a {
            text-decoration: none;
            color: white;
            font-family: 微軟正黑體,新細明體,標楷體;
            font-weight: bold;
            font-size: 17px;
        }
        
        .menu {
            position:fixed;
            width: 100%;
            height: 40px;
            background-color: dimgrey;
            z-index: 9999999;
        }
        
        .menu_css {
            float: left;
            width: 100%;
            height: inherit;
            overflow: hidden;
            font-family: 微軟正黑體,新細明體,標楷體;
            font-weight: bold;
            font-size: 17px;
            color: white;
            border-spacing: 0px;
        }
        .menu_css tr {
            display: block;
        }
        .menu_css td {
            height: 40px;
            padding: 0px 15px 0px 15px;
            white-space: nowrap;
        }
        .menu_css td:hover {
            background-color: black;
        }
        
        .content {
            position: relative;
            word-wrap: break-word;
            width: 100%;
            top: 40px;
        }
        .secondtopbar{
            width:25%;
            position: relative;
            /*word-wrap: break-word;
            */top: 40px;
        }
        .button {
           /*padding-left :30%;*/
            border: none;
            color: white;
            width:100% ;
            /*height: 20px;
        */}
      </style>
     
    </head>
    <script>

function EditContent(){
    document.getElementById("user_id").value = document.getElementById("user_id").value;
    /*document.getElementById("TName").value = document.getElementById("TName").value;
    document.getElementById("Price").value = document.getElementById("Price").value;
    document.getElementById("Description").value = document.getElementById("Description").value;
    document.getElementById("Name").value = document.getElementById("Name").value;
    document.getElementById("Address").value = document.getElementById("Address").value;
    document.getElementById("Phone").value = document.getElementById("Phone").value;
    document.getElementById("mfrom").action = "toy_mdysave.php";
    document.getElementById("mfrom").submit();
*/
document.getElementById("mfrom").action = "toy_mdysave.php";
}    
</script>
    <body>
    
    <div class="menu">
        <table class="menu_css">
            <tr>
                <td>
                    <a href="index.php"></a>我的衣櫃</a>
                </td>
                <td>
                    <a href="./person.php">個人資訊</a>
                </td>
            </tr>
        </table>
    </div>
    <div class="secondtopbar">
         <table cellspaceing="0">
            <tr>
                <td> <div calss="button">
                   
        <!--        <input type="button"><input type="image" src="plus.png" heigt="20px" width="20px"></button>
                    <input type="image"  id="saveform" src="plus.png " heigt="20px" width="20px" alt="Submit Form" />
        -->      	<a href="single_add.html"> <input type="image" src="plus.png"   heigt=20% width=20%  onClick="document.formname.submit();"></a>
                    </div>
                </td>
                <td> <div calss="button">
                      <input type="image" src="search.png" heigt=100% width=100% onClick="document.formname.submit();">
                </div>
                </td>
            </tr>
        </table>
        <form method="POST" action="single.php">
        <table class="menu_search">
            <tr>
                <td >
                    <form method="post" action="single.php">
                    Search
                    <input type="text" id="keyword" name="keyword" value="" placeholder="輸入搜尋衣服關鍵字" />
                    <input type="submit" value="送出">				
                    </form>
                </td>
            </tr>
    </form>
   
    <form method="POST" action="single.php">
   
	<div style="min-width:20px;">category</div>
		<input type="radio" name="category" value="top"> 上衣
		<input type="radio" name="category" value="down"> 下著
        <input type="radio" name="category" value="overall"> 連身衣
        
     <div style="min-width:20px;">style</div>
    	<input type="radio" name="style" value="cute"> 可愛
		<input type="radio" name="style" value="simple"> 簡約
		<input type="radio" name="style" value="grace"> 優雅
	

    <input type="submit" value="種類&風格查詢">				 
    </form>



    </div>
    <div style="text-align: left;font-family: &quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;font-size: 15px;font-weight: bold;">        
            <table>
            <?php
                if (isset($_POST["category"])||isset($_POST['style']))
                {echo "已選<br>&nbsp;&nbsp;&nbsp;&nbsp;";
                    $category_arr = array("top", "down", "overall");
                    $style_arr = array("cute", "simple", "grace");
                    //衣服種類的binary
                    $style_name = array("可愛", "簡約", "優雅");
                    $category_name = array("上衣", "下著", "連身衣");
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
                            }
                        }
                        echo "種類: ".($category_name[$cate_id])." ";
                        while($cate_id>0)
                        {$cate_num*=2;
                            $cate_id-=1;
                        }
                    
                    }
                #style
                    if (isset($_POST["style"]))
                    {
                
                        $style = $_POST["style"];
                        $style_id=1;#在arr中第幾個 2^cate_id
                        $style_num=1;//實際的數值
                        for ($i=0;$i<count($style_arr);$i++){
                            if ($style_arr[$i]==$style)
                            { 	$style_id=$i;
                            }
                        }
                
                        echo "風格:".($style_name[$style_id]);
                        while($style_id>0)
                        {$style_num*=2;
                            $style_id-=1;
                        }
                    }
                    echo "<br>總數量為: ";
                    if(isset($_POST["category"])&&isset($_POST['style']))//choose two 
                    {
                        $sql = "SELECT *
                        FROM cloth_detail t left join cloth_number ts on (t.cloth_id = ts.cloth_id) 
                        where (ts.user_id=? )and (t.cloth_style=?) and t.cloth_category=?";
                        $stmt =  $db->prepare($sql);
                        $stmt->execute(array($user_id,$style_num,$cate_num));
                        $rows = $stmt->fetchAll();
                    }elseif(isset($_POST["category"]))
                    {
                        $sql = "SELECT *
                        FROM cloth_detail t left join cloth_number ts on (t.cloth_id = ts.cloth_id) 
                        where (ts.user_id=? ) and t.cloth_category=?";
                        $stmt =  $db->prepare($sql);
                        $stmt->execute(array($user_id,$cate_num));
                        $cloth_detail = $stmt->fetchAll();
                    }else 
                    {
                        $sql = "SELECT *
                        FROM cloth_detail t left join cloth_number ts on (t.cloth_id = ts.cloth_id) 
                        where (ts.user_id=? )and (t.cloth_style=?)";
                        $stmt =  $db->prepare($sql);
                        $stmt->execute(array($user_id,$style_num));
                        $cloth_detail = $stmt->fetchAll();
                    }
                    echo count($cloth_detail);
                    for( $count = 0; $count < count($cloth_detail); $count++){
                        ?>
                            <tr>
                                <th scope="row"><?php echo $count+1;?></th> 
                                <form id="mfrom" method="post" action="single_info.php">
                                <td><input type="hidden" id="cloth_id" name="cloth_id"  value="<?php echo $cloth_detail[$count]['cloth_id'] ;?>"/></td>
                                <td><input type="submit" id="cloth_name" name="cloth_name" readonly style="border-style:none" value="<?php echo $cloth_detail[$count]['cloth_name'] ;?>"/></td>
                                <td><input type="hidden" id="cloth_img" name="cloth_img"  value="<?php echo $cloth_detail[$count]['cloth_img'] ;?>"/></td>
                                <td><img src="<?php echo $cloth_detail[$count]['cloth_img'];?>"></td>            
                                </form>
                            </tr><?php
                    }
                }
				elseif (isset($_POST["keyword"]))
				{
					$keyword = $_POST["keyword"];
					
					if($keyword == ''){
					  $keyword = '%';
				    }else{
					  $keyword = '%'.$keyword.'%';
				    }
					
                    $sql = "SELECT *
                    FROM cloth_detail t left join cloth_number ts on (t.cloth_id = ts.cloth_id) 
                    where (ts.user_id=? )and (t.cloth_name like  ?)";

                ?>總數量為: 
                <?php  
                    if($stmt = $db->prepare($sql)){
						//$stmt->execute(array($keyword,$keyword));
                        $stmt->execute(array($user_id,$keyword));
                        $cloth_detail = $stmt->fetchAll();
                        echo count($cloth_detail);

						//$stmt->execute(array($user_id));
						for( $count = 0; $count < count($cloth_detail); $count++){
			        ?>
						<tr>
                            <th scope="row"><?php echo $count+1;?></th> 
                            <form id="mfrom" method="post" action="single_info.php">
                            <td><input type="hidden" id="cloth_id" name="cloth_id"  value="<?php echo $cloth_detail[$count]['cloth_id'] ;?>"/></td>
                            <td><input type="submit" id="cloth_name" name="cloth_name" readonly style="border-style:none" value="<?php echo $cloth_detail[$count]['cloth_name'] ;?>"/></td>
                            <td><input type="hidden" id="cloth_img" name="cloth_img"  value="<?php echo $cloth_detail[$count]['cloth_img'] ;?>"/></td>
                            <td><img src="<?php echo $cloth_detail[$count]['cloth_img'];?>"></td>
                            </form>
                        </tr>
			<?php
						}		
					}
				}else{?>
                總數量為: 
                  <?php  

//aggregate
                $sql = "SELECT COUNT(*) FROM cloth_number WHERE cloth_number.user_id=?";
				$stmt =  $db->prepare($sql);
				$error = $stmt->execute(array($user_id));
				
				if($rowcount = $stmt->fetchColumn())
					echo ($rowcount);

                    $query = ("select cloth_id from cloth_number where user_id = ?");
                    $stmt =  $db -> prepare($query);
                    $error= $stmt -> execute(array($user_id));
                   // $result = $stmt -> fetchAll();
                   $mycloth_id = $stmt->fetchAll();
                   sort($mycloth_id);
                    // echo count($mycloth_id);
                 
            $query = ("select * from cloth_detail ");
            $stmt =  $db -> prepare($query);
            $error= $stmt -> execute();
            $cloth_detail = $stmt->fetchAll();
           
            $sql = "SELECT *
            FROM cloth_detail t left join cloth_number ts on (t.cloth_id = ts.cloth_id) 
            where (ts.user_id=? )";


            for($my = 0, $count = 0; $my < count($mycloth_id)&&$count<count($cloth_detail); $count++)
            {
               if($mycloth_id[$my]['cloth_id']==$cloth_detail[$count]['cloth_id'])
               { // print($cloth_detail[$count]['cloth_name'] );
               ?>
                  
                <tr>
                 <th scope="row"><?php echo $my+1;?></th> 
                 <form id="mfrom" method="post" action="single_info.php">
                 <td><input type="hidden" id="cloth_id" name="cloth_id"  value="<?php echo $cloth_detail[$count]['cloth_id'] ;?>"/></td>
                 <td><input type="submit" id="cloth_name" name="cloth_name" readonly style="border-style:none" value="<?php echo $cloth_detail[$count]['cloth_name'] ;?>"/></td>
                 <td><input type="hidden" id="cloth_img" name="cloth_img"  value="<?php echo $cloth_detail[$count]['cloth_img'] ;?>"/></td>
                 <td><img src="<?php echo $cloth_detail[$count]['cloth_img'];?>"></td>
               
                 
                 </form>
               </tr>

               <?php     $my+=1;

               }
             }
            }?>
        

        </table>
            
				
                        
    </div>
    </body>
</html>