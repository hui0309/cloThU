<?php
    include("con_db.php");
    if(!isset($_SESSION["user_id"])){
        header('Location: ./index.php');
        exit;
    }
    $cloth_id=$_POST["cloth_id"];
    $query = ("select * from cloth_detail t left join store ts on (t.store_id=ts.store_id) where cloth_id=?");
    $stmt =  $db -> prepare($query);
    $error= $stmt -> execute(array($cloth_id));
    $cloth_detail = $stmt->fetchAll();
//    echo $cloth_detail[0]['cloth_name'];
 //   $style_arr = array("可愛", "簡約", "優雅");
    $style = $cloth_detail[0]['cloth_style'];
    $style_id=0;#在arr中第幾個 2^style_id
    while($style>1)
    {   $style=floor($style/2);
        $style_id+=1;
    }
//    $style_val=$style_arr[$style_id];


//    $category_arr = array("上衣", "下著", "連身衣");
    $cate = $cloth_detail[0]['cloth_category'];
//print("ddd $cate");
    $cate_id=0;#在arr中第幾個 2^style_id
    while($cate>1)
    {   $cate=floor($cate/2);
        $cate_id+=1;
    }
//    $cate_val=$category_arr[$cate_id];
	
?>

<html>
    <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
      <title>single_update.html</title>
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
        
        li img {
            width: 100%;
            height: 100%;
        }
    
        .preview {
      background:#888888;
      width:550px;
      height:auto;
      text-align:center;
    }
    .preview img{
      height:320px;
      order:1;
      vertical-align : middle;
    }
    
    
      </style>
      

	</head>
	<script>
	function DeleteContent(){
		document.getElementById("cloth_id").value = document.getElementById("cloth_id").value;
		document.getElementById("mfrom").action = "single_delsave.php";
		document.getElementById("mfrom").submit();
	}
	

    function UpdateContent(){
        //name style category store info
		document.getElementById("cloth_id").value = document.getElementById("cloth_id").value;
		document.getElementById("cloth_name").value = document.getElementById("cloth_name").value;
		document.getElementById("cloth_img").value = document.getElementById("cloth_img").value;
//		document.getElementByName("style").value = document.getElementById("style").value;
//		document.getElementByName("category").value = document.getElementById("category").value;
	document.getElementById("store").value = document.getElementById("store").value;
		document.getElementById("text_info").value = document.getElementById("text_info").value;
        //window.location = "single_updasave.php";
		document.getElementById("mfrom").action = "single_updasave.php";
		document.getElementById("mfrom").submit();

	}
	</script>
    <body>
    
    
        <form id="mfrom" method="post" action="">
            <div class="menu">
                <a href="single.php"> <div style="text-align:right;padding-top:10px; ">離開</div></a>
                
            </div>
            <div class="content">
                <table style="height:50%;width:80%;">
                    <tr>
                        <td colspan="3"><img src="<?php echo $cloth_detail[0]['cloth_img'];?>">
                    <td><input type="hidden" id="cloth_img" name="cloth_img"  value="<?php echo $cloth_detail[0]['cloth_img'] ;?>"/></td>
                        
                    </td>
                        <td>
							<button onclick="DeleteContent()">刪除</button>
                        </td>
                        <td>
							<button onclick="UpdateContent()">更新</button>
                        </td>
                    </tr>
                    <tr><td></td><td></td><td></td><td></td><td></td></tr>
                </table>
                <table>
                    <tr> <td>
                             <div style="text-align:right; padding-top:75%; "> <input type="hidden" id="cloth_id" name="cloth_id" value="<?php  echo $cloth_id ?>"></div>
                    </td></tr>
                    <tr><td><div style="min-width:20px;">name</div><input type="text" id="cloth_name" name="cloth_name" value="<?php echo $cloth_detail[0]['cloth_name']?>" required="required"/></td></tr> 
					<tr><td><div style="min-width:20px;">style</div>
						<input type="radio" name="style" value="cute"  <?php echo ($style_id==0 && $style) ?  "checked" : "" ;  ?>> 可愛
						<input type="radio" name="style" value="simple" <?php echo ($style_id==1 && $style) ?  "checked" : "" ;  ?>> 簡約
						<input type="radio" name="style" value="grace" <?php echo ($style_id==2 && $style) ?  "checked" : "" ;  ?>> 優雅
					</td></tr> 
					<tr><td><div style="min-width:20px;">category</div>
						<input type="radio" name="category" value="top" <?php echo ($cate_id==0 && $cate) ?  "checked" : "" ;  ?>> 上衣
						<input type="radio" name="category" value="down" <?php echo ($cate_id==1 && $cate) ?  "checked" : "" ;  ?>> 下著
						<input type="radio" name="category" value="overall" <?php echo ($cate_id==2 && $cate) ?  "checked" : "" ;  ?>> 連身衣
					</td></tr> 
                    <tr><td><div style="min-width:20px;">store</div><input type="text"  id="store" name="store" value="<?php echo $cloth_detail[0]['store_name'];?>"/></td></tr> 
                    <tr><td><div style="min-width:20px;">info</div><!--<input type="textarea" rows="6"
                        cols="40"/>--><textarea id="text_info" name="text_info" rows="10" cols="30" ><?php echo $cloth_detail[0]["cloth_info"];?></textarea>
                    </td></tr> 
                </table>
                </div>
            </div>
        </form>
    
    </body>
    </html>


