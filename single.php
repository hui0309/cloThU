<?php
    include("con_db.php");
    session_start();//include這個才能用session
$user_id=$_SESSION["user_id"];
echo $_SESSION["user_id"];
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
                    <form method="post" action="toy.php">
                    Search
                    <input type="text" id="keyword" name="keyword" value="" placeholder="輸入搜尋關鍵字" />
                    <input type="submit" value="送出">				
                    </form>
                </td>
            </tr>
    </form>
   
    </div>
    <div style="text-align: left;font-family: &quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;font-size: 15px;font-weight: bold;">
           總數量為: 
        
        <?php
           $query = ("select cloth_id from cloth_number where user_id = ?");
           $stmt =  $db -> prepare($query);
           $error= $stmt -> execute(array($user_id));
          // $result = $stmt -> fetchAll();
          $mycloth_id = $stmt->fetchAll();
          sort($mycloth_id);
            echo count($mycloth_id);
        ?>
            
            <table>
           <?php $query = ("select * from cloth_detail ");
            $stmt =  $db -> prepare($query);
            $error= $stmt -> execute();
            $cloth_detail = $stmt->fetchAll();
           /* $mycloth_id=array();
            for($count = 0, $i= 0; $count<count($mycloth_id)&&$i < count($all_cloth_detail); $i++)
            {if($all_cloth_detail[$i]['cloth_id']==$mycloth_id[$count])
                {$count++;
                    array_push($mycloth_id,$all_colth_detail[$i]);        
                }
            }*/

            for($my = 0, $count = 0; $my < count($mycloth_id)&&$count<count($cloth_detail); $count++)
            {
               if($mycloth_id[$my]['cloth_id']==$cloth_detail[$count])
               { // print($cloth_detail[$count]['cloth_name'] );
               ?>
                  
                <tr>
                 <th scope="row"><?php echo $count+1;?></th> 
                 <form id="mfrom" method="post" action="single_info.php">
                 <td><input type="hidden" id="cloth_id" name="cloth_id"  value="<?php echo $cloth_detail[$count]['cloth_id'] ;?>"/></td>
                 <td><input type="submit" id="cloth_name" name="cloth_name" readonly style="border-style:none" value="<?php echo $cloth_detail[$count]['cloth_name'] ;?>"/></td>
                 <td><img src="hamster.jpg"></td>
                 </form>
               </tr>

               <?php     $my+=1;

               }
            }?>
        

        </table>
            
				
                        
    </div>





    
    </body>
</html>