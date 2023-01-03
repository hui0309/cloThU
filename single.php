<?php
include("session_init.php");
if (!isset($_SESSION["user_id"])) {
    header('Location: ./index.php');
    exit;
}
//echo $id;
//echo "id".($_SESSION["user_id"]);
//if(isset($id))echo "存在";
//else echo "not exist";
//if(empty($id))echo "不存在";

/*$_SESSION["login"] = false;
if($_SESSION["login"] == false){
header('Location: ./index.php');
exit;  //記得要跳出來，不然會重複轉址過多次
}*/
?>

<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>single.html</title>
    <style type="text/css">
        body {
            text-align: center;
        }
        a {
			text-decoration: none;
			font-family: 微軟正黑體, 新細明體, 標楷體;
			font-weight: bold;
			font-size: 17px;
		}
        .menu {
            position: fixed;
            width: 100%;
            background-color: white;
            top: 0px;
        }

        .gototop {
            position: fixed;
            bottom: 10px;
            right: 10px;
            background-color: rgba(237, 231, 207, 0.703);
        }

        .result {
            top: 0px;
        }

        .count {
            font-weight: bold;
        }

        .choosed_total {
            font-weight: bold;
        }

        #cloth_name {
            background-color: white;
            font-weight: bold;
        }
    </style>
    <link href="jquery-ui.css" rel="stylesheet" />
    <script src="external/jquery/jquery.js"></script>
    <script src="jquery-ui.js"></script>
    <script>

        function EditContent() {
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
    <script>
        $(document).ready(() => {
            $("#gototop").click(function () {
                document.body.scrollTop = 0; // For Safari
                document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
            });
            $("#img").bind("change paste keyup", function () {
                $('#showimg').attr("src", $("#img").val());
            });
        });
    </script>
</head>

<body>
    <div class="container-fluid mt-3 m-1 justify-content-center">
        <header class="navbar navbar-expand-sm  bd-navbar sticky-top">
            <nav class="row navbar navbar-expand-sm navbar-light bg-light">
                <div class="container-fluid mt-3">
                    <div class="row menu">
                        <div>
                            <ul class="nav nav-tabs">
                                <!-- <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="#">Active</a>
        </li> -->
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle active" data-bs-toggle="dropdown"
                                        href="#" role="button" aria-expanded="false"
                                        style="color: blueviolet">我的衣櫃</a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#">單件</a></li>
                                        <li><a class="dropdown-item" href="#">套裝</a></li>
                                        <!-- <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item" href="#">Separated link</a></li> -->
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="person.php" style="color: gray">個人資訊</a>
                                </li>
                            </ul>
                        </div>
                        <div class="row justify-content-sm-center">
                            <div class="col-2 col-sm-1"></div>
                            <div class="col-3 col-sm-4">
                                <div class="row">
                                    <!-- 新增服裝 -->
                                    <!-- Button trigger modal -->
                                    <div class="col align-self-center">
                                        <!--<a onClick="document.formname.submit();" href="single_add.html"> -->
                                        <button type="button" class="align-items-center btn" data-bs-toggle="modal"
                                            data-bs-target="#newModal">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36"
                                                fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                                <path
                                                    d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                <path
                                                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                            </svg>
                                        </button>
                                        <!--</a> -->
                                    </div>
                                    <div class="col align-self-center">
                                        <button class="align-items-center btn" id="category" data-bs-toggle="collapse"
                                            data-bs-target=".multi-collapse" aria-expanded="false"
                                            aria-controls="choose">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36"
                                                fill="currentColor" class="bi bi-filter-circle" viewBox="0 0 16 16">
                                                <path
                                                    d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                <path
                                                    d="M7 11.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5z" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-5 col-sm-6 align-items-center align-self-center">
                                <form class="d-flex align-self-center" role="search" method="post" action="single.php">
                                    <input class="form-control me-2 align-items-center" type="search"
                                        placeholder="請輸入衣服關鍵字" aria-label="Search" id="keyword" name="keyword"
                                        value="" />
                                    <button class="btn btn-outline-success text-nowrap" type="submit">
                                        搜尋
                                    </button>
                                </form>
                            </div>
                            <div class="col-2 col-sm-1"></div>
                        </div>
                        <div class="row collapse multi-collapse mt-2 mb-2" id="choose">
                            <div class="col-2 col-sm-1"></div>

                            <div class="col-8 col-sm-10">
                                <form method="post" action="single.php">
                                    <div class="row choose row-cols-1 row-cols-sm-2 row-cols-md-4 row-cols-lg-6 m-2">
                                        <div class="col-sm-2 d-flex justify-content-start">分類：</div>
                                        <div class="form-check col">
                                            <input class="form-check-input" type="radio" value="top" id="上衣"
                                                name="category" />
                                            <label class="form-check-label text-nowrap" for="上衣">
                                                上衣
                                            </label>
                                        </div>
                                        <div class="form-check col">
                                            <input class="form-check-input" type="radio" value="down" id="下著"
                                                name="category" />
                                            <label class="form-check-label text-nowrap" for="下著">
                                                下著
                                            </label>
                                        </div>
                                        <div class="form-check col">
                                            <input class="form-check-input" type="radio" value="overall" id="連身衣"
                                                name="category" />
                                            <label class="form-check-label text-nowrap" for="連身衣">
                                                連身衣
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row choose row-cols-1 row-cols-sm-2 row-cols-md-4 row-cols-lg-6 m-2">
                                        <div class="col-sm-2 d-flex justify-content-start">風格：</div>
                                        <div class="form-check col">
                                            <input class="form-check-input" type="radio" value="cute" id="可愛"
                                                name="style" />
                                            <label class="form-check-label text-nowrap" for="可愛">
                                                可愛
                                            </label>
                                        </div>
                                        <div class="form-check col">
                                            <input class="form-check-input" type="radio" value="simple" id="簡約"
                                                name="style" />
                                            <label class="form-check-label text-nowrap" for="簡約">
                                                簡約
                                            </label>
                                        </div>
                                        <div class="form-check col">
                                            <input class="form-check-input" type="radio" value="grace" id="優雅"
                                                name="style" />
                                            <label class="form-check-label text-nowrap" for="優雅">
                                                優雅
                                            </label>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end align-self-end">
                                        <button type="submit" class="btn btn-outline-success justify-content-end">
                                            查詢
                                        </button>
                                    </div>
                                </form>
                            </div>

                            <div class="col-2 col-sm-1"></div>
                        </div>
                    </div>
                </div>
            </nav>
        </header>
        <div class="row g-10">
            <div class="col"><br /><br><br /><br /></div>
        </div>

        <div class="row align-items-center justify-content-center">
            <?php
            if (isset($_POST["category"]) || isset($_POST['style'])) {
                echo "<div class='d-flex justify-content-start'><span class='choosed_total'>已選&nbsp;</span>";
                $category_arr = array("top", "down", "overall");
                $style_arr = array("cute", "simple", "grace");
                //衣服種類的binary
                $style_name = array("可愛", "簡約", "優雅");
                $category_name = array("上衣", "下著", "連身衣");
                #category
                if (isset($_POST["category"])) {
                    //變數存在
                    $category = $_POST["category"];
                    $cate_id = 1; #在arr中第幾個 2^cate_id
                    $cate_num = 1; //實際的數值
                    for ($i = 0; $i < count($category_arr); $i++) {
                        if ($category_arr[$i] == $category) {
                            $cate_id = $i;
                        }
                    }
                    echo "種類: " . ($category_name[$cate_id]) . " ";
                    while ($cate_id > 0) {
                        $cate_num *= 2;
                        $cate_id -= 1;
                    }

                }
                #style
                if (isset($_POST["style"])) {

                    $style = $_POST["style"];
                    $style_id = 1; #在arr中第幾個 2^cate_id
                    $style_num = 1; //實際的數值
                    for ($i = 0; $i < count($style_arr); $i++) {
                        if ($style_arr[$i] == $style) {
                            $style_id = $i;
                        }
                    }

                    echo "風格:" . ($style_name[$style_id]);
                    while ($style_id > 0) {
                        $style_num *= 2;
                        $style_id -= 1;
                    }
                }
                echo "</div><div class='col-sm-10 count d-flex justify-content-end'>總數量為: ";
                if (isset($_POST["category"]) && isset($_POST['style'])) //choose two 
                {
                    $sql = "SELECT *
                        FROM cloth_detail t left join cloth_number ts on (t.cloth_id = ts.cloth_id) 
                        where (ts.user_id=? )and (t.cloth_style=?) and t.cloth_category=?";
                    $stmt = $db->prepare($sql);
                    $stmt->execute(array($id, $style_num, $cate_num));
                    $cloth_detail = $stmt->fetchAll();
                } elseif (isset($_POST["category"])) {
                    $sql = "SELECT *
                        FROM cloth_detail t left join cloth_number ts on (t.cloth_id = ts.cloth_id) 
                        where (ts.user_id=? ) and t.cloth_category=?";
                    $stmt = $db->prepare($sql);
                    $stmt->execute(array($id, $cate_num));
                    $cloth_detail = $stmt->fetchAll();
                } else {
                    $sql = "SELECT *
                        FROM cloth_detail t left join cloth_number ts on (t.cloth_id = ts.cloth_id) 
                        where (ts.user_id=? )and (t.cloth_style=?)";
                    $stmt = $db->prepare($sql);
                    $stmt->execute(array($id, $style_num));
                    $cloth_detail = $stmt->fetchAll();
                }
                echo count($cloth_detail);
                echo "</div>";
                ?>
                <div class="card-group row row-cols-1 row-cols-sm-2 row-cols-md-4 row-cols-lg-6 g-10 justify-self-center">
                    <?php
                    for ($count = 0; $count < count($cloth_detail); $count++) {
                        ?>
                        <div class="col d-flex justify-content-center mb-3">
                            <div class="card h-100" style="max-width: 18rem ;max-height: 18rem">
                                <form id="mfrom" method="post" action="single_info.php">
                                    <input type="hidden" id="cloth_id" name="cloth_id"
                                        value="<?php echo $cloth_detail[$count]['cloth_id']; ?>" />

                                    <input type="hidden" id="cloth_img" name="cloth_img"
                                        value="<?php echo $cloth_detail[$count]['cloth_img']; ?>" />
                                    <img src="<?php echo $cloth_detail[$count]['cloth_img']; ?>" class="card-img-top"
                                        alt="..." />
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <input type="submit" id="cloth_name" name="cloth_name" readonly
                                                style="border-style:none"
                                                value="<?php echo $cloth_detail[$count]['cloth_name']; ?>" />
                                        </h5>
                                    </div>

                                </form>
                            </div>
                        </div>
                        <?php
                    }
            } elseif (isset($_POST["keyword"])) {
                $keyword = $_POST["keyword"];

                if ($keyword == '') {
                    $keyword = '%';
                } else {
                    $keyword = '%' . $keyword . '%';
                }
                ?>
                </div>
                <div class='col-sm-10 count d-flex justify-content-end'>總數量為:
                    <?php
        //agg
                     $sql = "SELECT count(*)
                     FROM cloth_detail t left join cloth_number ts on (t.cloth_id = ts.cloth_id) 
                     where (ts.user_id=? )and (t.cloth_name like  ?)";
                     $stmt = $db->prepare($sql);
                    $error = $stmt->execute(array($id,$keyword));
                    $rowcount = $stmt->fetchColumn();
                        echo ($rowcount);

                    $sql = "SELECT  *
                    FROM cloth_detail t left join cloth_number ts on (t.cloth_id = ts.cloth_id) 
                    where (ts.user_id=? )and (t.cloth_name like  ?)";
                    if ($stmt = $db->prepare($sql)) {
                        //$stmt->execute(array($keyword,$keyword));
                        $stmt->execute(array($id, $keyword));
                        $cloth_detail = $stmt->fetchAll();
                       // echo count($cloth_detail);

                        //$stmt->execute(array($id));?>
                        <div
                            class="card-group row row-cols-1 row-cols-sm-2 row-cols-md-4 row-cols-lg-6 g-10 justify-self-center">
                            <?php
                            for ($count = 0; $count < count($cloth_detail); $count++) {
                                ?>
                            </div>
                            <div class="col d-flex justify-content-center mb-3">
                                <div class="card h-100" style="max-width: 18rem ;max-height: 18rem">
                                    <form id="mfrom" method="post" action="single_info.php">
                                        <input type="hidden" id="cloth_id" name="cloth_id"
                                            value="<?php echo $cloth_detail[$count]['cloth_id']; ?>" />

                                        <input type="hidden" id="cloth_img" name="cloth_img"
                                            value="<?php echo $cloth_detail[$count]['cloth_img']; ?>" />
                                        <img src="<?php echo $cloth_detail[$count]['cloth_img']; ?>" class="card-img-top"
                                            alt="..." />
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                <input type="submit" id="cloth_name" name="cloth_name" readonly
                                                    style="border-style:none"
                                                    value="<?php echo $cloth_detail[$count]['cloth_name']; ?>" />
                                            </h5>
                                        </div>

                                    </form>
                                </div>
                            </div>
                            <?php
                            }
                    }
            } else { ?>
                </div>
                <div class='col-sm-10 count d-flex justify-content-end'>總數量為:
                    <?php

//function
                      $sql = ("select countcloth(?) ");
                      $stmt = $db->prepare($sql);
                      $error = $stmt->execute(array($id));
  
                      if ($rowcount = $stmt->fetchColumn()) {
                          echo ($rowcount);
                          echo ("</div>");
                      }

//subquery
                    $sql = "SELECT *
           FROM cloth_detail 
           where cloth_id IN (select cloth_id from cloth_number where cloth_number.user_id=?)";
                    $stmt = $db->prepare($sql);
                    $stmt->execute(array($id));
                    $cloth_detail = $stmt->fetchAll();
                    ?>

                    <div
                        class="card-group row row-cols-1 row-cols-sm-2 row-cols-md-4 row-cols-lg-6 g-10 justify-self-center">
                        <?php
                        for ($i = 0, $count = 0; $count < count($cloth_detail); $count++) {
                            // print($cloth_detail[$count]['cloth_name'] );
                            ?>

                            <div class="col d-flex justify-content-center mb-3">
                                <div class="card h-100" style="max-width: 18rem ;max-height: 18rem">
                                    <form id="mfrom" method="post" action="single_info.php">
                                        <input type="hidden" id="cloth_id" name="cloth_id"
                                            value="<?php echo $cloth_detail[$count]['cloth_id']; ?>" />

                                        <input type="hidden" id="cloth_img" name="cloth_img"
                                            value="<?php echo $cloth_detail[$count]['cloth_img']; ?>" />
                                        <img src="<?php echo $cloth_detail[$count]['cloth_img']; ?>" class="card-img-top"
                                            alt="..." />
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                <input type="submit" id="cloth_name" name="cloth_name" readonly
                                                    style="border-style:none"
                                                    value="<?php echo $cloth_detail[$count]['cloth_name']; ?>" />
                                            </h5>
                                        </div>

                                    </form>
                                </div>
                            </div>
                            <?php
                        }
            } ?>

                    <div>

                    </div>
                </div>


                <!-- Modal -->
                <div class="modal fade" id="newModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="newModalLabel">新增服裝</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <form id="mfrom" method="post" action="single_add.php">
                                    <div class="row d-flex align-items-center mb-2">
                                        <img id="showimg" src="https://caree-pro.com/wp/wp-content/themes/careepro/images/no-image.png">
                                    </div>
                                    <div class="row d-flex align-items-center mb-2">
                                        <div class="col-sm-3 col-4 ">
                                            衣服圖片
                                        </div>
                                        <div class="col-sm-9 col-8">
                                            <input class="form-control me-2 align-items-center" type="text"
                                                placeholder="請輸入圖片連結" aria-label="Search" id="img" name="img"/>
                                        </div>
                                    </div>
                                    <div class="row d-flex align-items-center mb-2">
                                        <div class="col-sm-3 col-4">
                                            衣服名稱
                                        </div>
                                        <div class="col-sm-9 col-8">
                                            <input class="form-control me-2 align-items-center" type="text"
                                                placeholder="請為衣服命名" aria-label="Search" id="cloth_name"
                                                name="cloth_name" required="required" />
                                        </div>
                                    </div>
                                    <div class="row d-flex align-items-center mb-2 ">
                                        <div class="col-sm-3 col-4">分類</div>
                                        <div class="col-sm-9 col-8">
                                            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 m-2">
                                                <div class="form-check col">
                                                    <input class="form-check-input" type="radio" value="top" id="上衣"
                                                        name="category" />
                                                    <label class="form-check-label text-nowrap" for="上衣">
                                                        上衣
                                                    </label>
                                                </div>
                                                <div class="form-check col">
                                                    <input class="form-check-input" type="radio" value="down" id="下著"
                                                        name="category" />
                                                    <label class="form-check-label text-nowrap" for="下著">
                                                        下著
                                                    </label>
                                                </div>
                                                <div class="form-check col">
                                                    <input class="form-check-input" type="radio" value="overall"
                                                        id="連身衣" name="category" />
                                                    <label class="form-check-label text-nowrap" for="連身衣">
                                                        連身衣
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row d-flex align-items-center mb-2 ">
                                        <div class="col-sm-3 col-4">風格</div>
                                        <div class="col-sm-9 col-8">
                                            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 m-2">
                                                <div class="form-check col">
                                                    <input class="form-check-input" type="radio" value="cute" id="可愛"
                                                        name="style" />
                                                    <label class="form-check-label text-nowrap" for="可愛">
                                                        可愛
                                                    </label>
                                                </div>
                                                <div class="form-check col">
                                                    <input class="form-check-input" type="radio" value="simple" id="簡約"
                                                        name="style" />
                                                    <label class="form-check-label text-nowrap" for="簡約">
                                                        簡約
                                                    </label>
                                                </div>
                                                <div class="form-check col">
                                                    <input class="form-check-input" type="radio" value="grace" id="優雅"
                                                        name="style" />
                                                    <label class="form-check-label text-nowrap" for="優雅">
                                                        優雅
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row d-flex align-items-center mb-2">
                                        <div class="col-sm-3 col-4">
                                            商店
                                        </div>
                                        <div class="col-sm-9 col-8">
                                            <input class="form-control me-2 align-items-center" type="text"
                                                placeholder="請輸入購買衣服的商店" aria-label="Search" name="store" />
                                        </div>
                                    </div>
                                    <div class="row d-flex align-items-center mb-2">
                                        <div class="col-sm-3 col-4">
                                            Info
                                        </div>
                                        <div class="col-sm-9 col-8  d-flex align-items-start">
                                            <textarea name="text_info" rows="5" cols="30" placeholder="請輸入衣服簡介(選填)..">
                                    </textarea>
                                        </div>
                                    </div>
                                    <button class="btn btn-outline-success text-nowrap" type="submit">
                                        新增
                                    </button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="gototop rounded-circle">
            <button class="align-items-center btn" id="gototop">
                <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor"
                    class="bi bi-arrow-up-circle" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-7.5 3.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V11.5z" />
                </svg>
            </button>
        </div>
    </div>
</body>

</html>