<?php
include("session_init.php");
if (!isset($_SESSION['user_id'])) {
    header('Location: ./index.php');
    exit;
}
?>
<html>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>person.php</title>
    <style>
        body {
            margin: 0px;
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
            height: 40px;
            /* background-color: dimgrey; */
            z-index: 9999999;
        }

        .menu a {
            text-decoration: none;
            color: white;
            font-family: 微軟正黑體, 新細明體, 標楷體;
            font-weight: bold;
            font-size: 17px;
        }

        .content {
            position: relative;
            word-wrap: break-word;
            width: 100%;
            top: 40px;
            /* background-color: #f1f1f1; */
        }

        .inner_content {
            padding: 50px 130px 220px 130px;
            background-color: white;
            flex-direction: column;
        }

        .inner_content left {
            position: relative;
            width: 40%;
            flex-direction: row;
        }

        .inner_content table {
            position: relative;
            width: 60%;
            flex-direction: row;
        }

        form {
            margin-bottom: 0em;
        }
    </style>
    <link href="jquery-ui.css" rel="stylesheet" />
    <script src="external/jquery/jquery.js"></script>
    <script src="jquery-ui.js"></script>
    <script>
        window.onload = function () {
        <?php
        $query = ("select * from user where user_id = ?");
        $stmt = $db->prepare($query);
        $error = $stmt->execute(array($id));
        $result = $stmt->fetchAll();
        $name = $result[0]["user_name"];
        $img = $result[0]["user_img"];
        ?>
        var user_id = "<?php echo $id; ?>";
            document.getElementById("user_id").value = user_id;
            var user_name = "<?php echo $name; ?>";
            document.getElementById("user_name").value = user_name;
            var user_img = "<?php echo $img; ?>";
            if (!user_img) user_img = "./userimg_normal.png";
            document.getElementById("user_img").src = user_img;
            document.getElementById("img_location").value = user_img;
        }
        function save_data(blob, fileName) {
            const a = document.createElement('a');
            document.body.appendChild(a);
            a.style = 'display: none';
            // 將 blob 放到 URL 上
            url = window.URL.createObjectURL(blob);
            alert(url);
            a.href = url;
            a.download = fileName;
            a.click();
            // 釋放記憶體
            a.href = '';
            window.URL.revokeObjectURL(url);
        }
        function resize(image) {
            let canvas = document.createElement('canvas');
            // 畫布大小為圖片的 0.9 倍
            canvas.width = image.width * 0.9;
            canvas.height = image.height * 0.9;
            let ctx = canvas.getContext("2d");
            ctx.drawImage(image, 0, 0, canvas.width, canvas.height); // 把圖片畫在畫布上(0,0)作標到(canvas.width,canvas.height)
            let newImg = canvas.toDataURL(imageType, 0.8); // 0.8是圖片壓縮比
            return newImg;
        }
        // let img_file = document.getElementById('img_file');
        // img_file.onchange = function (e) {
        //     var file = e.target.files[0];
        //     var name = e.target.files[0].name;
        //     //save_data(file,name)
        //     var form = new FormData();
        //     //form.append("product[photos][]", e.target.files[0], optional<time+name>);
        //     var reader = new FileReader();
        //     reader.addEventListener("load", function () {
        //         document.getElementById("user_img").src = reader.result;
        //         document.getElementById("img_location").value = reader.result;

        //     }, false);
        //     if (file) {
        //         reader.readAsDataURL(file);
        //     }
        // }
        // var img_clear = document.getElementById('img_clear');
        // img_clear.onclick = function () {
        //     document.getElementById('img_file').value = "";
        //     document.getElementById("user_img").src = "./userimg_normal.png";
        //     document.getElementById("img_location").value = "./userimg_normal.png";
        //     console.log("clear");
        // }
        function toback() {
            var check = window.confirm('放棄修改並離開?');
            if (check == true) {
                window.location.href = './person.php';
            }
        }

    </script>
    <script>
        // function seepass(see, pass) {
        //     var but = document.getElementById(see).className;
        //     var pass = (see == "see1" ? "user_cur_pass" : "user_new_pass");
        //     var value = document.getElementById(pass).value;
        //     if (but == "far fa-eye btn btn-outline-secondary text-nowrap") {
        //         document.getElementById(see).classList.remove("fa-eye");
        //         document.getElementById(see).classList.add("fa-eye-slash");
        //         document.getElementById(pass).type = "password";
        //         document.getElementById(pass).value = value;
        //         console.log("1");
        //     }
        //     else {
        //         document.getElementById(see).classList.remove("fa-eye-slash");
        //         document.getElementById(see).classList.add("fa-eye");
        //         document.getElementById(pass).type = "text";
        //         document.getElementById(pass).value = value;
        //         console.log("2");
        //     }
        // }
        function validateForm() {
            var user_pass = document.getElementById("user_new_pass").value.toString();
            var cha = /[a-zA-Z]+/, chn = /[0-9]+/, chstr = /[a-zA-Z0-9]{6,16}/;
            if (user_pass != '') {
                if (!chstr.test(user_pass)) {
                    alert("密碼只能包含數字及英文符號，且長度為6-16位");
                    document.getElementById("user_new_pass").value = "";
                    return false;
                }
                if (!cha.test(user_pass) || !chn.test(user_pass)) {
                    alert("密碼至少要包含一個英文字母及數字");
                    document.getElementById("user_pass").value = "";
                    return false;
                }
            }
        }
    </script>
    <script>
        $(document).ready(() => {
            let see1_ = false;
            let see2_ = false;
            $("#see1").click(function () {
                if (see1_) {
                    $("#user_cur_pass").attr("type", "password");
                    $("#see1").attr("value", "顯示密碼");
                }
                else {
                    $("#user_cur_pass").attr("type", "text");
                    $("#see1").attr("value", "隱藏密碼");
                }
                see1_ = !see1_;
            });
            $("#see2").click(function () {
                if (see2_) {
                    $("#user_new_pass").attr("type", "password");
                    $("#see2").attr("value", "顯示密碼");
                }
                else {
                    $("#user_new_pass").attr("type", "text");
                    $("#see2").attr("value", "隱藏密碼");
                }
                see2_ = !see2_;
            });
            $("#img_file").change(function (e) {
                var file = e.target.files[0];
                var name = e.target.files[0].name;
                //save_data(file,name)
                var form = new FormData();
                //form.append("product[photos][]", e.target.files[0], optional<time+name>);
                var reader = new FileReader();
                reader.addEventListener("load", function () {
                    document.getElementById("user_img").src = reader.result;
                    document.getElementById("img_location").value = reader.result;

                }, false);
                if (file) {
                    reader.readAsDataURL(file);
                }
            })
            $("#img_clear").click(function (e) {
                document.getElementById('img_file').value = "";
                document.getElementById("user_img").src = "./userimg_normal.png";
                document.getElementById("img_location").value = "./userimg_normal.png";
                console.log("clear");
            })
        });
    </script>
</head>

<body>
    <div class="container-fluid m-1">
        <div class="row g-10">
            <div class="col"><br /><br><br /><br /></div>
        </div>
        <div class="row d-flex align-items-around justify-content-center">
            <div class="col-0 col-sm-1 col-md-2"></div>
            <div class="row col-12 col-sm-8 col-md-6 d-flex align-items-center justify-content-between">
                <form name="update" method="post" action="./people_update.php" onsubmit="return validateForm()">
                    <table class="table">
                        <tbody>
                            <tr class='img'>
                                <td><input type="image" id="user_img" name="user_img" /></td>
                                <input type="hidden" name="img_location" id="img_location" />
                                <td style="align-items:flex-end;">
                                    <div class="d-flex align-items-end">
                                        <input type="file" id="img_file" accept="image/gif, image/jpeg, image/png" 
                                        value='上傳檔案' />
                                    </div>
                                </td>
                                <td><input class="btn btn-outline-danger text-nowrap " type="button" id="img_clear"
                                        value='還原預設' /></td>
                            </tr>
                            <tr>
                                <th scope="row">帳號(不可修改)</th>
                                <td><input type="text" id="user_id" name='user_id' maxlength="16" readonly /></td>
                            </tr>
                            <tr>
                                <th scope="row">名字 *</th>
                                <td><input type="text" id="user_name" name='user_name' maxlength="16"
                                        placeholder="介於6-16可英數混合" /></td>
                            </tr>
                            <tr>
                                <th scope="row">舊密碼 *</th>
                                <td><input type="password" id="user_cur_pass" name='user_cur_pass' maxlength="16"
                                        placeholder="用於確認是否用戶本人" /></td>
                                <td><input type="button" id="see1"
                                        class="far fa-eye-slash btn btn-outline-secondary text-nowrap" value='顯示密碼'>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">新密碼</th>
                                <td><input type="password" id="user_new_pass" name='user_new_pass' maxlength="16"
                                        placeholder="介於6-16需英數混合" />
                                <td><input type="button" id="see2"
                                        class="far fa-eye-slash btn btn-outline-secondary text-nowrap" value='顯示密碼'>
                                </td>
                            </tr>
                            <tr>
                                <td><input type="submit" id="target" name='target' class="btn btn-success text-nowrap"
                                        value='更新' /></td>
                                <td><input type="button" id="back" value='返回'
                                        class="btn btn-outline-secondary text-nowrap" onclick="toback()" /></td>
                            <tr>
                        </tbody>
                    </table>
                </form>
            </div>
            <div class="col-0 col-sm-1 col-md-2"></div>
        </div>
    </div>
</body>

</html>