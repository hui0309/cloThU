<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>person.html</title>
    </head>
    <script>
        function out(){
            <?php
                session_start();
                $_SESSION["login"] = false;
                $_SESSION["user_id"] = "";
                $_SESSION["user_name"] = "";
                $_SESSION["user_mail"] = "";
                //$_SESSION["user_img"] = $result[0]["user_img"];
            ?>
            console.log("123");
            window.location.href='index.php';       
        }
    </script>
    <body>
    <div class="menu">
        <table class="menu_css">
            <tr>
                <td>
                    <a href="./single.php"></a>我的衣櫃</a>
                </td>
                <td>
                    <a href="./person.php">個人資訊</a>
                </td>
            </tr>
        </table>
    </div>
    <div class = "contains">
    <form method="post" action="person.php">
        <input type="button" id = "logout" name = "logout" value="登出" onclick = out() />
    </form>
    </div>
    </body>
</html>
<html>
    <style>
        body {
            margin: 0px;
            width: 100%;
            height: 100%;
        }
        a {
            text-decoration: none;
            color: white;
            font-family: 微軟正黑體,新細明體,標楷體;
            font-weight: bold;
            font-size: 17px;
        }
        .contains{
            position:fixed;
            width: 100%;
            height: 100px;
            z-index: 9999999;
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
</html>