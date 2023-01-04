<?php
include("session_init.php");
if (!isset($_SESSION["user_id"])) {
    header('Location: ./index.php');
    exit;
}
$cloth_id = $_POST["cloth_id"];
$query = ("select * from cloth_detail t left join store ts on (t.store_id=ts.store_id) where cloth_id=?");
$stmt = $db->prepare($query);
$error = $stmt->execute(array($cloth_id));
$cloth_detail = $stmt->fetchAll();
// echo count($cloth_detail);
$style_arr = array("可愛", "簡約", "優雅");
$style = $cloth_detail[0]['cloth_style'];
$style_id = 0; #在arr中第幾個 2^style_id
while ($style > 1) {
    $style = floor($style / 2);
    $style_id += 1;
}
$style_val = $style_arr[$style_id];


$category_arr = array("上衣", "下著", "連身衣");
$cate = $cloth_detail[0]['cloth_category'];
//print("ddd $cate");
$cate_id = 0; #在arr中第幾個 2^style_id
while ($cate > 1) {
    $cate = floor($cate / 2);
    $cate_id += 1;
}
$cate_val = $category_arr[$cate_id];
?>


<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>single_update</title>
    <style>
        body {
            background-color: white;
        }

        a {
            text-decoration: none;
            font-family: 微軟正黑體, 新細明體, 標楷體;
            font-weight: bold;
            font-size: 17px;
        }

        @import url('https://fonts.googleapis.com/css?family=Exo:400,700');

        * {
            margin: 0px;
            padding: 0px;
        }

        body {
            font-family: 'Exo', sans-serif;
        }


        .context {
            width: 100%;
            position: absolute;
            top: 50vh;

        }

        .context h1 {
            text-align: center;
            color: #fff;
            font-size: 50px;
        }


        .area {
            /* background: #4e54c8;
            background: -webkit-linear-gradient(to left, #8f94fb, #4e54c8); */
            width: 100%;
            height: 100%;
        }

        .circles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        .circles li {
            position: absolute;
            display: block;
            list-style: none;
            width: 20px;
            height: 20px;
            background: rgba(118, 65, 10, 0.3);
            animation: animate 25s linear infinite;
            bottom: -150px;

        }

        .circles li:nth-child(1) {
            left: 25%;
            width: 80px;
            height: 80px;
            animation-delay: 0s;
        }


        .circles li:nth-child(2) {
            left: 10%;
            width: 20px;
            height: 20px;
            animation-delay: 2s;
            animation-duration: 12s;
        }

        .circles li:nth-child(3) {
            left: 70%;
            width: 20px;
            height: 20px;
            animation-delay: 4s;
        }

        .circles li:nth-child(4) {
            left: 40%;
            width: 60px;
            height: 60px;
            animation-delay: 0s;
            animation-duration: 18s;
        }

        .circles li:nth-child(5) {
            left: 65%;
            width: 20px;
            height: 20px;
            animation-delay: 0s;
        }

        .circles li:nth-child(6) {
            left: 75%;
            width: 110px;
            height: 110px;
            animation-delay: 3s;
        }

        .circles li:nth-child(7) {
            left: 35%;
            width: 150px;
            height: 150px;
            animation-delay: 7s;
        }

        .circles li:nth-child(8) {
            left: 50%;
            width: 25px;
            height: 25px;
            animation-delay: 15s;
            animation-duration: 45s;
        }

        .circles li:nth-child(9) {
            left: 20%;
            width: 15px;
            height: 15px;
            animation-delay: 2s;
            animation-duration: 35s;
        }

        .circles li:nth-child(10) {
            left: 85%;
            width: 150px;
            height: 150px;
            animation-delay: 0s;
            animation-duration: 11s;
        }



        @keyframes animate {

            0% {
                transform: translateY(0) rotate(0deg);
                opacity: 1;
                border-radius: 0;
            }

            100% {
                transform: translateY(-1000px) rotate(720deg);
                opacity: 0;
                border-radius: 50%;
            }

        }
    </style>
    <link href="jquery-ui.css" rel="stylesheet" />
    <script src="external/jquery/jquery.js"></script>
    <script src="jquery-ui.js"></script>

    <script>
        function DeleteContent() {
            document.getElementById("cloth_id").value = document.getElementById("cloth_id").value;
            document.getElementById("mfrom").action = "single_delsave.php";
            document.getElementById("mfrom").submit();
        }


        // function UpdateContent() {
        //     //name style category store info
        //     document.getElementById("cloth_id").value = document.getElementById("cloth_id").value;
        //     document.getElementById("cloth_name").value = document.getElementById("cloth_name").value;
        //     document.getElementById("cloth_img").value = document.getElementById("cloth_img").value;
        //     //		document.getElementByName("style").value = document.getElementById("style").value;
        //     //		document.getElementByName("category").value = document.getElementById("category").value;
        //     document.getElementById("store").value = document.getElementById("store").value;
        //     document.getElementById("text_info").value = document.getElementById("text_info").value;
        //     //window.location = "single_updasave.php";
        //     document.getElementById("mfrom").action = "single_updasave.php";
        //     document.getElementById("mfrom").submit();

        // }
    </script>
    <script>
        $(document).ready(() => {
            $("#cloth_img").bind("change paste keyup", function () {
                $('#showimg').attr("src", $("#cloth_img").val());
            });
            let sty_val;
            let cat_val;
            $("#updateBtn").click(function () {
                if ($("#上衣").is(":checked")) {
                    cat_val = "top";
                }
                else if ($("#下著").is(":checked")) {
                    cat_val = "down";
                }
                else if ($("#連身裙").is(":checked")) {
                    cat_val = "overall";
                }
                if ($("#可愛").is(":checked")) {
                    sty_val = "cute";
                }
                else if ($("#簡約").is(":checked")) {
                    sty_val = "simple";
                }
                else if ($("#優雅").is(":checked")) {
                    sty_val = "grace";
                }
                console.log(sty_val);
                $.ajax({
                    url: "single_updasave.php",
                    type: "POST",
                    data: "cloth_id=" + $('#cloth_id').val() +
                        "&cloth_name=" + $('#cloth_name').val() +
                        "&cloth_img=" + $('#cloth_img').val() +
                        "&style=" + sty_val +
                        "&category=" + cat_val +
                        "&store=" + $('#store').val() +
                        "&text_info=" + $('#text_info').val(),
                    // 若成功，執行以下...
                    success: function (response) {
                        console.log('yes');
                    },
                    error: function () {
                        console.log('read 失敗');
                    }
                });
            })
        });

    </script>
</head>

<body>
    <div class="container-fluid m-1" style="z-index: 100;">
        <header class="navbar navbar-expand-sm bd-navbar sticky-top " width="100%" style="background-color: white;">
            <nav class="row navbar navbar-expand-sm navbar-light d-flex align-items-start"
                style="background-color: white;">
                <div class="container-fluid d-flex align-items-start">
                    <div class="row menu ">
                        <div>
                            <ul class="nav nav-tabs">
                                <!-- <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="#">Active</a>
        </li> -->
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle active" data-bs-toggle="dropdown"
                                        href="single.php" role="button" aria-expanded="false"
                                        style="color: blueviolet">我的衣櫃</a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="single.php">單件</a></li>
                                        <li><a class="dropdown-item" href="single.php">套裝</a></li>
                                        <!-- <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item" href="#">Separated link</a></li> -->
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="person.php" style="color: gray">個人資訊</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
        </header>

        <div class="row g-10">
            <div class="col"><br /><br><br /><br /></div>
        </div>
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-0 col-sm-1 col-md-2"></div>
            <div class="col-6 col-sm-6 col-md-5">
                <img src="<?php echo $cloth_detail[0]['cloth_img']; ?>" class="img-fluid">
            </div>
            <div class="row col-6 col-sm-4 col-md-3 d-flex align-items-center justify-content-between">
                <div class=" d-flex align-self-start justify-content-center">
                    <h1><strong>
                            <?php echo $cloth_detail[0]['cloth_name']; ?>
                        </strong></h1>
                </div>
                <div class=" d-flex align-self-start justify-content-center">
                    <br>
                </div>
                <div class="row  d-flex align-items-center m-1 justify-content-between">
                    <div class="row ">
                        <div class="col-4 col-sm-5 d-flex align-items-center justify-content-between">
                            <h5 class="text-nowrap"><strong>分類 </strong></h4>
                        </div>
                        <div class="col-8 col-sm-7 d-flex align-items-center justify-content-between">
                            <h5 class="text-nowrap">
                                <?php echo ($cate == null) ? null : $cate_val; ?>
                            </h5>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-4 col-sm-5 d-flex align-items-center justify-content-between">
                            <h5 class="text-nowrap"><strong>風格 </strong></h4>
                        </div>
                        <div class="col-8 col-sm-7 d-flex align-items-center justify-content-between">
                            <h5 class="text-nowrap"><?php echo ($style == null) ? null : $style_val; ?></h5>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-4 col-sm-5 d-flex align-items-center justify-content-between">
                            <h5 class="text-nowrap"><strong>商店 </strong></h4>
                        </div>
                        <div class="col-8 col-sm-7 d-flex align-items-center justify-content-between">
                            <h5 class="text-nowrap">
                                <?php echo $cloth_detail[0]['store_name']; ?>
                            </h5>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-4 col-sm-5 d-flex align-items-center justify-content-between">
                            <h5 class="text-nowrap"><strong>Info </strong></h4>
                        </div>
                        <div class="col-8 col-sm-7 d-flex align-items-center">
                            <h5 class="overflow-auto">
                                <?php echo $cloth_detail[0]['cloth_info']; ?>
                            </h5>
                        </div>
                    </div>
                </div>
                <div class="row  d-flex align-items-center m-1 " style="z-index: 1000;">
                    <div class="row ">
                        <div class="col-6 col-sm-6 d-flex align-items-center">
                            <a href="single.php"><button type="button" class="btn btn-secondary">離開</button></a>
                        </div>
                        <div class="col6 col-sm-6 d-flex align-items-center align-self-center">
                            <!-- <form id="mfrom" method="post" action="single_update.php"
                                class="d-flex align-items-center align-self-center">
                                <input type="hidden" id="cloth_id" name="cloth_id" value="<?php echo $cloth_id ?>">
                                <button type="submit"
                                    class="btn btn-outline-dark d-flex align-self-center  align-items-center"
                                    value="修改">修改</button>
                            </form> -->
                            <button type="button"
                                class="btn btn-outline-dark d-flex align-self-center  align-items-center" value="修改"
                                data-bs-toggle="modal" data-bs-target="#modifyModal">修改</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-0 col-sm-1 col-md-2"></div>
        </div>


        <!-- Modal -->
        <?php
        $cloth_id = $_POST["cloth_id"];
        $query = ("select * from cloth_detail t left join store ts on (t.store_id=ts.store_id) where cloth_id=?");
        $stmt = $db->prepare($query);
        $error = $stmt->execute(array($cloth_id));
        $cloth_detail = $stmt->fetchAll();
        //    echo $cloth_detail[0]['cloth_name'];
        //   $style_arr = array("可愛", "簡約", "優雅");
        $style = $cloth_detail[0]['cloth_style'];
        $style_id = 0; #在arr中第幾個 2^style_id
        while ($style > 1) {
            $style = floor($style / 2);
            $style_id += 1;
        }
        //    $style_val=$style_arr[$style_id];
        

        //    $category_arr = array("上衣", "下著", "連身衣");
        $cate = $cloth_detail[0]['cloth_category'];
        //print("ddd $cate");
        $cate_id = 0; #在arr中第幾個 2^style_id
        while ($cate > 1) {
            $cate = floor($cate / 2);
            $cate_id += 1;
        }
        //    $cate_val=$category_arr[$cate_id];
        
        ?>
        <div class="modal fade" id="modifyModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modifyModalLabel">修改服裝資訊</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="mfrom" method="post" action="">
                            <input type="hidden" id="cloth_id" name="cloth_id"
                                value="<?php echo $cloth_detail[0]['cloth_id']; ?>" />
                            <div class="row d-flex align-items-center mb-2">
                                <img id="showimg" src="<?php echo $cloth_detail[0]['cloth_img']; ?>">
                            </div>
                            <div class="row d-flex align-items-center mb-2">
                                <div class="col-sm-3 col-4 ">
                                    衣服圖片
                                </div>
                                <div class="col-sm-9 col-8">
                                    <input class="form-control me-2 align-items-center" type="text"
                                        value="<?php echo $cloth_detail[0]['cloth_img']; ?>" aria-label="Search"
                                        id="cloth_img" name="cloth_img" />
                                </div>
                            </div>
                            <div class="row d-flex align-items-center mb-2">
                                <div class="col-sm-3 col-4">
                                    衣服名稱
                                </div>
                                <div class="col-sm-9 col-8">
                                    <input class="form-control me-2 align-items-center" type="text"
                                        value="<?php echo $cloth_detail[0]['cloth_name'] ?>" aria-label="Search"
                                        id="cloth_name" name="cloth_name" required="required" />
                                </div>
                            </div>
                            <div class="row d-flex align-items-center mb-2 ">
                                <div class="col-sm-3 col-4">分類</div>
                                <div class="col-sm-9 col-8">
                                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 m-2">
                                        <div class="form-check col">
                                            <input class="form-check-input" type="radio" value="top" id="上衣"
                                                name="category" <?php echo ($cate_id == 0 && $cate) ? "checked" : ""; ?> />
                                            <label class="form-check-label text-nowrap" for="上衣">
                                                上衣
                                            </label>
                                        </div>
                                        <div class="form-check col">
                                            <input class="form-check-input" type="radio" value="down" id="下著"
                                                name="category" <?php echo ($cate_id == 1 && $cate) ? "checked" : ""; ?> />
                                            <label class="form-check-label text-nowrap" for="下著">
                                                下著
                                            </label>
                                        </div>
                                        <div class="form-check col">
                                            <input class="form-check-input" type="radio" value="overall" id="連身衣"
                                                name="category" <?php echo ($cate_id == 2 && $cate) ? "checked" : ""; ?> />
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
                                                name="style" <?php echo ($style_id == 0 && $style) ? "checked" : ""; ?> />
                                            <label class="form-check-label text-nowrap" for="可愛">
                                                可愛
                                            </label>
                                        </div>
                                        <div class="form-check col">
                                            <input class="form-check-input" type="radio" value="simple" id="簡約"
                                                name="style" <?php echo ($style_id == 1 && $style) ? "checked" : ""; ?> />
                                            <label class="form-check-label text-nowrap" for="簡約">
                                                簡約
                                            </label>
                                        </div>
                                        <div class="form-check col">
                                            <input class="form-check-input" type="radio" value="grace" id="優雅"
                                                name="style" <?php echo ($style_id == 2 && $style) ? "checked" : ""; ?> />
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
                                        value="<?php echo $cloth_detail[0]['store_name']; ?>" aria-label="Search"
                                        name="store" id="store" />
                                </div>
                            </div>
                            <div class="row d-flex align-items-center mb-2">
                                <div class="col-sm-3 col-4">
                                    Info
                                </div>
                                <div class="col-sm-9 col-8  d-flex align-items-start">
                                    <textarea id="text_info" name="text_info" rows="5" cols="30">
                                    <?php echo $cloth_detail[0]["cloth_info"]; ?>
                                    </textarea>
                                </div>
                            </div>
                            <div class="row d-flex align-items-center mb-2">
                                <div class="col-6 d-flex align-items-center align-self-center justify-content-center">
                                    <!-- <button class="btn btn-outline-success text-nowrap" type="submit"
                                        onclick="UpdateContent()"
                                        >
                                        更新
                                    </button> -->
                                    <button class="btn btn-outline-success text-nowrap" id="updateBtn">
                                        更新
                                    </button>
                                </div>
                                <div class="col-6 d-flex align-items-center align-self-center justify-content-center">
                                    <div class=" d-flex align-items-center ">
                                        <button class="btn btn-outline-danger text-nowrap " type="submit"
                                            onclick="DeleteContent()">
                                            刪除
                                        </button>
                                    </div>
                                </div>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="area" style="position: absolute; top:0px;">
            <ul class="circles">
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
            </ul>
        </div>
</body>

</html>