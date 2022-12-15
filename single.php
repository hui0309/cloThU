<?php
	include("con_db.php");
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
    <body>
    
    <div class="menu">
        <table class="menu_css">
            <tr>
                <td>
                    <a href="index.php"></a>我的衣櫃</a>
                </td>
                <td>
                    <a href="content/toy.php">個人資訊</a>
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
        -->      	<a href="single_update.html"> <input type="image" src="plus.png"   heigt=20% width=20%  onClick="document.formname.submit();"></a>
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
            $query = ("select * from cloth_detail ");
            $stmt =$db->prepare($query);
            $error=$stmt->execute();
            $result=$stmt->fetchALL();
            $cloth_tot=count($result)+1;
            
                echo $cloth_tot;
        ?>
    </div>





    
</body>
</html>