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
        #home {
			clip-path: url(#cache);
		}

		#red {
			fill: none;
			opacity: 0.15;
			stroke: #000000;
			stroke-width: 12;
			stroke-miterlimit: 10;
			animation: show 4s;
			animation-fill-mode: forwards;
			animation-iteration-count: infinite;
			animation-timing-function: ease-in-out;
		}

		#blue {
			fill: none;
			opacity: 0.15;
			stroke: rgb(220, 225, 200);
			stroke-width: 12;
			stroke-miterlimit: 10;
			animation: show 4s;
			animation-fill-mode: forwards;
			animation-iteration-count: infinite;
			animation-timing-function: ease-in-out;
		}

		#light-blue {
			fill: none;
			opacity: 0.15;
			stroke: #76410a;
			stroke-width: 6;
			stroke-miterlimit: 10;
			stroke-dasharray: 200;
			stroke-dashoffset: 800;
			animation: draw 4s;
			animation-fill-mode: forwards;
			animation-iteration-count: infinite;
			animation-timing-function: ease-in-out;
		}

		@keyframes draw {
			to {
				stroke-dashoffset: 0;
			}
		}

		@keyframes show {
			0% {
				opacity: 0.15;
			}

			50% {
				opacity: 0.2;
			}

			100% {
				opacity: 0.15;
			}
		}

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
        .infoCard{
            background-color: aqua;
            margin: 10px;
            padding: 10px;
            box-sizing: border-box;
            height: 115%;
            background-color: rgba(253, 253, 253, 1.0);
			justify-content: center;
			border-radius: 5%;
			box-shadow: 8px 8px 6px rgba(0, 0, 0, 0.7);
			border: 1px;
			/* border-style: solid; */
			border-color: rgba(0, 0, 0, 0.7);
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
<svg version="1.1" id="home-anim" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
			x="0px" y="0px" viewBox="0 0 1820 1080" style="enable-background:new 0 0 1820 1080;" xml:space="preserve">

			<g id="home">
				<defs>
					<rect id="masque" y="0.4" width="1820" height="1080" />
				</defs>
				<clipPath id="cache">
					<use xlink:href="#masque" style="overflow:visible;" />
				</clipPath>
				<g id="light-blue">
					<line x1="630.8" y1="894.3" x2="476.3" y2="1048.8" />
					<line x1="858.2" y1="823.9" x2="1012.7" y2="669.4" />
					<line x1="1066.9" y1="458.2" x2="912.4" y2="612.7" />
					<line x1="1294.3" y1="387.8" x2="1448.8" y2="233.3" />
					<line x1="1503" y1="22.1" x2="1348.5" y2="176.6" />
					<line x1="895.6" y1="1166.6" x2="1050.1" y2="1012.1" />
					<line x1="1104.3" y1="800.9" x2="949.8" y2="955.4" />
					<line x1="1331.7" y1="730.5" x2="1486.2" y2="576" />
					<line x1="1540.4" y1="364.8" x2="1385.9" y2="519.3" />
					<line x1="1767.8" y1="294.4" x2="1922.3" y2="139.9" />
					<line x1="1976.5" y1="-71.3" x2="1822" y2="83.2" />
					<line x1="1369.1" y1="1073.2" x2="1523.6" y2="918.7" />
					<line x1="1577.8" y1="707.5" x2="1423.3" y2="862" />
					<line x1="1805.2" y1="637.1" x2="1959.7" y2="482.6" />
					<line x1="1624" y1="1041.4" x2="1469.4" y2="1195.9" />
					<line x1="-134.7" y1="674.9" x2="19.8" y2="520.4" />
					<line x1="74" y1="309.2" x2="-80.5" y2="463.7" />
					<line x1="301.4" y1="238.8" x2="455.9" y2="84.3" />
					<line x1="510.1" y1="-126.9" x2="355.6" y2="27.6" />
					<line x1="-88.6" y1="1008.9" x2="65.9" y2="854.4" />
					<line x1="120.1" y1="643.1" x2="-34.4" y2="797.7" />
					<line x1="347.5" y1="572.8" x2="502" y2="418.3" />
					<line x1="556.2" y1="207.1" x2="401.7" y2="361.6" />
					<line x1="783.6" y1="136.7" x2="938.1" y2="-17.8" />
					<line x1="157.6" y1="985.8" x2="3" y2="1140.3" />
					<line x1="384.9" y1="915.5" x2="539.4" y2="760.9" />
					<line x1="593.6" y1="549.7" x2="439.1" y2="704.3" />
					<line x1="821" y1="479.4" x2="975.5" y2="324.9" />
					<line x1="1029.7" y1="113.6" x2="875.2" y2="268.2" />
					<line x1="1257.1" y1="43.3" x2="1411.6" y2="-111.2" />
				</g>
				<g id="red">
					<line x1="794.4" y1="883.4" x2="639.8" y2="1037.9" />
					<line x1="694.6" y1="834.8" x2="849.2" y2="680.3" />
					<line x1="1230.4" y1="447.3" x2="1075.9" y2="601.8" />
					<line x1="1130.7" y1="398.7" x2="1285.2" y2="244.2" />
					<line x1="1666.5" y1="11.2" x2="1512" y2="165.7" />
					<line x1="732" y1="1177.5" x2="886.6" y2="1023" />
					<line x1="1267.9" y1="790" x2="1113.3" y2="944.5" />
					<line x1="1168.1" y1="741.4" x2="1322.7" y2="586.9" />
					<line x1="1703.9" y1="353.9" x2="1549.4" y2="508.4" />
					<line x1="1604.2" y1="305.3" x2="1758.7" y2="150.8" />
					<line x1="1205.5" y1="1084.1" x2="1360.1" y2="929.6" />
					<line x1="1741.4" y1="696.5" x2="1586.8" y2="851.1" />
					<line x1="1641.6" y1="648" x2="1796.2" y2="493.5" />
					<line x1="1787.5" y1="1030.5" x2="1633" y2="1185" />
					<line x1="1687.8" y1="981.9" x2="1842.3" y2="827.4" />
					<line x1="200.1" y1="-44.4" x2="45.6" y2="110.1" />
					<line x1="237.5" y1="298.3" x2="83" y2="452.8" />
					<line x1="137.8" y1="249.7" x2="292.3" y2="95.2" />
					<line x1="673.6" y1="-137.8" x2="519.1" y2="16.7" />
					<line x1="283.7" y1="632.2" x2="129.2" y2="786.8" />
					<line x1="184" y1="583.7" x2="338.5" y2="429.2" />
					<line x1="719.8" y1="196.2" x2="565.2" y2="350.7" />
					<line x1="620" y1="147.6" x2="774.6" y2="-6.9" />
					<line x1="321.1" y1="974.9" x2="166.6" y2="1129.4" />
					<line x1="221.4" y1="926.4" x2="375.9" y2="771.8" />
					<line x1="757.2" y1="538.8" x2="602.7" y2="693.4" />
					<line x1="657.5" y1="490.3" x2="812" y2="335.8" />
					<line x1="1193.3" y1="102.7" x2="1038.7" y2="257.3" />
					<line x1="1093.5" y1="54.2" x2="1248.1" y2="-100.3" />
				</g>
				<g id="blue">
					<line x1="225.8" y1="1151" x2="534.9" y2="841.9" />
					<line x1="827.1" y1="1003.3" x2="518" y2="1312.3" />
					<line x1="661.9" y1="714.9" x2="971" y2="405.9" />
					<line x1="1263.1" y1="567.2" x2="954.1" y2="876.3" />
					<line x1="1098" y1="278.8" x2="1407.1" y2="-30.2" />
					<line x1="1699.2" y1="131.1" x2="1390.2" y2="440.2" />
					<line x1="699.3" y1="1057.6" x2="1008.4" y2="748.5" />
					<line x1="1300.6" y1="909.9" x2="991.5" y2="1218.9" />
					<line x1="1135.4" y1="621.5" x2="1444.5" y2="312.4" />
					<line x1="1736.6" y1="473.8" x2="1427.6" y2="782.8" />
					<line x1="1571.5" y1="185.4" x2="1880.6" y2="-123.6" />
					<line x1="1172.8" y1="964.2" x2="1481.9" y2="655.1" />
					<line x1="1774.1" y1="816.5" x2="1465" y2="1125.5" />
					<line x1="1608.9" y1="528.1" x2="1918" y2="219" />
					<line x1="1219" y1="1298.1" x2="1528" y2="989.1" />
					<line x1="1655.1" y1="862" x2="1964.1" y2="553" />
					<line x1="232.8" y1="75.5" x2="-76.2" y2="384.6" />
					<line x1="270.2" y1="418.2" x2="-38.8" y2="727.3" />
					<line x1="105.1" y1="129.8" x2="414.2" y2="-179.2" />
					<line x1="706.3" y1="-17.9" x2="397.3" y2="291.2" />
					<line x1="-284.8" y1="899.9" x2="24.2" y2="590.8" />
					<line x1="316.4" y1="752.2" x2="7.3" y2="1061.2" />
					<line x1="151.3" y1="463.8" x2="460.3" y2="154.7" />
					<line x1="752.5" y1="316.1" x2="443.4" y2="625.1" />
					<line x1="587.3" y1="27.7" x2="896.4" y2="-281.4" />
					<line x1="1188.6" y1="-120" x2="879.5" y2="189" />
					<line x1="-247.4" y1="1242.5" x2="61.6" y2="933.5" />
					<line x1="188.7" y1="806.4" x2="497.7" y2="497.4" />
					<line x1="789.9" y1="658.8" x2="480.8" y2="967.8" />
					<line x1="624.8" y1="370.4" x2="933.8" y2="61.3" />
					<line x1="1226" y1="222.7" x2="916.9" y2="531.7" />
					<line x1="1662.1" y1="-213.4" x2="1353" y2="95.6" />
				</g>
			</g>
			</svg>
    <div class="container-fluid m-1" style="position: absolute; top:0px;">
        <div class="row g-10">
            <div class="col"><br /><br><br /><br /></div>
        </div>
        <div class="row d-flex align-items-around justify-content-center">
            <div class="col-0 col-sm-1 col-md-2"></div>
            <div class="row col-12 col-sm-10 col-md-8 d-flex align-items-center justify-content-between infoCard">
                <form name="update" method="post" action="./people_update.php" onsubmit="return validateForm()" >
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
                                <td><input type="text" id="user_id" name='user_id' maxlength="16" readonly class="form-control me-2 align-items-center"/></td>
                            </tr>
                            <tr>
                                <th scope="row">名字 *</th>
                                <td><input type="text" id="user_name" name='user_name' maxlength="16"
                                        placeholder="介於6-16可英數混合" class="form-control me-2 align-items-center"/></td>
                            </tr>
                            <tr>
                                <th scope="row">舊密碼 *</th>
                                <td><input type="password" id="user_cur_pass" name='user_cur_pass' maxlength="16"
                                        placeholder="用於確認是否用戶本人" class="form-control me-2 align-items-center"/></td>
                                <td><input type="button" id="see1"
                                        class="far fa-eye-slash btn btn-outline-secondary text-nowrap" value='顯示密碼'>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">新密碼</th>
                                <td><input type="password" id="user_new_pass" name='user_new_pass' maxlength="16"
                                        placeholder="介於6-16需英數混合" class="form-control me-2 align-items-center"/>
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