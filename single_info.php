<?php
    include("con_db.php");
    $cloth_id = $_POST["cloth_id"];
    
    $query = ("select * from cloth_detail where cloth_id=?");
    $stmt =  $db -> prepare($query);
    $error= $stmt -> execute(array($cloth_id));
    $cloth_detail = $stmt->fetchAll();
      // echo count($cloth_detail);
    $style_arr = array("可愛", "簡約", "優雅");
    $style = $cloth_detail[0]['cloth_style'];
    $style_id=0;#在arr中第幾個 2^style_id
    while($style>1)
    {   $style=floor($style/2);
        $style_id+=1;
    }
    $style_val=$style_arr[$style_id];


    $category_arr = array("上衣", "下著", "連身衣");
    $cate = $cloth_detail[0]['cloth_category'];
//print("ddd $cate");
    $cate_id=0;#在arr中第幾個 2^style_id
    while($cate>1)
    {   $cate=floor($cate/2);
        $cate_id+=1;
    }
    $cate_val=$category_arr[$cate_id];

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
        
    
    
      </style>
      

    </head>
    <body>
    
    
            <div class="menu">
                <a href="single.php"> <div style="text-align:right;padding-top:10px; color:black; ">離開</div></a>
                
            </div>
            <div class="content">
                <table style="height:50%;width:80%;">
                    <tr>
                        <td colspan="3"><div  style="height:100%;width:100%;background:gray;">
                            圖片
                            </div>
                        </td>
                        <form id="mfrom" method="post" action="single_update.php">
                           <td>
                             <div style="text-align:right; padding-top:75%; "> <input type="submit" class="button" onclick="" value="修改"></div>
                           </td>
                           <td>
                             <div style="text-align:right; padding-top:75%; "> <input type="hidden" id="cloth_id" name="cloth_id" value="<?php  echo $cloth_id ?>"></div>
                           </td>
                        </form>

                    </tr>
                    <tr><td></td><td></td><td></td><td></td><td></td></tr>
                </table>
                <table>
                <tr><td><div style="min-width:20px;"><strong>name: </strong> <?php echo $cloth_detail[0]['cloth_name'] ;?></div></td></tr> 
                    <tr><td><div style="min-width:20px;"><strong>style: </strong> <?php echo ($style==null)?null:  $style_val;?></div></td></tr> 
                    <tr><td><div style="min-width:20px;"><strong>category: </strong> <?php echo ($cate==null)?null: $cate_val;?></div></td></tr> 
                    <tr><td><div style="min-width:20px;"><strong>store: </strong> <?php echo $cloth_detail[0]['store_id'] ;?></div></td></tr> 
                    <tr><td><div style="min-width:20px;"><strong>info: </strong> <?php echo $cloth_detail[0]['cloth_info'] ;?></div></td></tr> 
                    </tr> 
                </table>
                </div>
            </div>
    
    
    
    
        
    </body>
    </html>