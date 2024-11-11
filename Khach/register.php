<?php
    if (isset($_POST["submitButton"])) {
        $error = "";
        $fullname = $_POST["fullname"];
        $username = $_POST["username"];
        $password = $_POST["password"];
        $retypePassword = $_POST["retypePassword"];

        if (strlen($fullname) < 2 || strlen($fullname) > 30) {
            $error .= "Họ và tên phải từ 2 đến 30 kí tự.\n";
        }
        if (strlen($username) < 2 || strlen($username) > 30) {
            $error .=  "Tên đăng nhập phải từ 2 đến 30 kí tự.\n";
        }
        if (strlen($password) < 6) {
            $error .= "Mật khẩu phải chứa ít nhất 6 kí tự.\n";
        }
        if ($password !== $retypePassword) {
            $error .= "Mật khẩu nhập lại không khớp.";
        }
    
        if ($error == ""){
            $conn = mysqli_connect("localhost", "root", "", "ltw_db");
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }
            $sql = "SELECT * FROM KhachHang WHERE username = '$username'";
            $res = mysqli_query($conn, $sql);
            if (mysqli_num_rows($res) > 0) {
                $error .= "Tên đăng nhập đã tồn tại.";
            } 
            else {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $sql = "INSERT INTO KhachHang (username, password, fullname, isbanned, role) VALUES ('$username', '$hashedPassword', '$fullname', 0, 'user')";
                $res = mysqli_query($conn, $sql);
                if ($res) {
                    echo "<script> alert('Đăng ký tài khoản thành công!')</script>";
                } 
                else {
                    $error .= "Đăng ký tài khoản thất bại!";
                }
            }
            mysqli_close($conn);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Đăng ký</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.17.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
            }

            .nav-item {
                padding: 10px;
            }
            .ft-address span,.footer_info span {
                font-size: 14px;
            }
        }
        *{
            box-sizing: border-box;
            font-family: "Inter";  
        }
        .nav-item { 
            padding-left: 15px;
            padding-right: 15px;
        }
        .nav-item:hover .dropdown-menu {
            display: block;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="container-fluid bg-black">
        <nav class="navbar navbar-expand-lg navbar-black bg-black d-flex flex-lg-row flex-sm-column">
            <a class="navbar-brand" href="#">
                <img src="../images/logo.png" alt="TimeElite" class="img-responsive" width="70" height="70">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="mainPage.php" style="color: #FF8C00">Trang chủ</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false" style="color: #FF8C00">
                            Hãng
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="search_by_brand.php?brand=Audemars Piguet" style="color: #FF8C00">Audemars Piguet</a></li>
                        <li><a class="dropdown-item" href="search_by_brand.php?brand=Patek Philippe" style="color: #FF8C00">Patek Philippe</a></li>
                        <li><a class="dropdown-item" href="search_by_brand.php?brand=Vacheron Constantin" style="color: #FF8C00">Vacheron Constantin</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false" style="color: #FF8C00">
                            Dịch vụ
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#" style="color: #FF8C00">Sửa chữa đồng hồ</a></li>
                            <li><a class="dropdown-item" href="#" style="color: #FF8C00">Bảo hành đồng hồ</a></li>
                            <li><a class="dropdown-item" href="#" style="color: #FF8C00">In logo lên đồng hồ</a></li>
                        </ul>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="#footer" style="color: #FF8C00">Liên hệ</a>
                    </li>
                </ul>

                <ul class="navbar-nav ms-auto">
                    <form class="d-flex" style="padding-left: 30px; padding-right: 30px">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit"
                            style="background-color: #FF8C00; color: white">Search</button>
                    </form>
                    <li class="nav-item">
                        <a class="nav-link" href="#" style="color: yellow">
                            <img src="../images/cart.jpg" alt="" width="30" height="30">
                            <i class="bi bi-cart"></i>Giỏ hàng
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php" style="color: yellowgreen">Đăng nhập</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="register.php" style="color: yellowgreen">Đăng kí</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    <hr size="5px" color="#FF8C00">
    <div class="container bg-light mt-3" style="margin-top: 100px; margin-bottom: 100px">
        <div class="row">
            <h3 class="fw-bold text-center mt-2">Đăng kí</h3>
        </div>
        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
            <div class="mb-3">
                <label for="floatingfullname" class="form-label">Họ và tên</label>
                <input type="text" class="form-control" id="floatingfullname" name="fullname" placeholder="Họ và tên">
            </div>
            <div class="mb-3">
                <label for="floatingusername" class="form-label">Tên đăng nhập</label>
                <input type="text" class="form-control" id="floatingusername" name="username" placeholder="Tên đăng nhập">
            </div>
            <div class="mb-3">
                <label for="floatingPassword" class="form-label">Mật khẩu</label>
                <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Mật khẩu">
            </div>
            <div class="mb-3">
                <label for="floatingretypePassword" class="form-label">Nhập lại mật khẩu</label>
                <input type="password" class="form-control" id="floatingretypePassword" name="retypePassword" placeholder="Nhập lại mật khẩu">
            </div>
            <div class="registerButton mb-3">
                <a style = "text-decoration: none;" href="login.php">Đã có tài khoản? Đăng nhập</a>
            </div>
            <button type="button" class="btn btn-dark" onclick="validateForm()">Kiểm tra</button>
            <div class="text-center">
                <input type="submit" class="btn btn-outline-primary mt-3" id="submitButton" name="submitButton" value="Đăng kí">
            </div>
        </form>
    </div>
    <!-- Footer -->
    <?php 
        $conn = mysqli_connect("localhost", "root", "", "ltw_db");
        if (!$conn){
            die("Connection failed: " . mysqli_connect_error());
        }
        $sql = "SELECT * FROM thongtin";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
    ?>
    <hr size=" 5px" color="#FF8C00">
    <div class="container-fluid bg-black" style="padding-left:150px; padding-bottom:30px;" id="footer">
        <div class="row">
            <div class="col-lg-6 col-sm-6 col-xs-12">
                <div class="ft-dm" style="color: gray">LIÊN HỆ</div>
                <div class="ft-address">
                    <span style="font-size: 20px">
                        <strong style="color: gray">TIME ELITE</strong>
                    </span>
                    <br>
                    <span style="font-size: 14px">
                        <span style="color: #696969">Địa chỉ:</span>
                        <span style="color: #FF8C00"><?php echo $row['address']; ?></span>
                    </span>
                    <br>
                    <span style="font-size: 14px">
                        <span style="color: #696969">Email:</span>
                        <span style="color: #FF8C00"><?php echo $row['email']; ?></span>
                        <br>
                        <span style="color: #696969">Hotline tư vấn bán hàng:</span>
                        <span style="color: #FF8C00"><?php echo $row['phone']; ?></span>
                        <br>
                        <span style="color: #696969">Facebook:</span>
                        <span style="color: #FF8C00"><?php echo $row['facebook']; ?></span>
                        <br>
                        <span style="color: #696969">Instagram:</span>
                        <span style="color: #FF8C00"><?php echo $row['instagram']; ?></span>
                        <br>
                    </span>
                </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-xs-12">
                <span style="font-size: 18px">
                    <strong style="color: gray">DÀNH CHO NGƯỜI DÙNG</strong>
                </span>
                <br>
                <span style="color: #FF8C00">Chính sách thanh toán</span>
                <br>
                <span style="color: #FF8C00">Chính sách vận chuyển</span>
                <br>
                <span style="color: #FF8C00">Chính sách đổi trả</span>
                <br>
                <span style="color: #FF8C00">Chính sách bảo hành sản phẩm</span>
                <br>
                <span style="color: #FF8C00">Chính sách kiểm hàng</span>
                <br>
                <span style="color: #FF8C00">Chính sách bảo mật thông tin</span>
                <br>
            </div>
        </div>
    </div>
    <div class="footer_info" style="padding-left:150px; background-color:#fdfefd;">
        <div class="row">
            <div class="col-md-4 col-sm-6">
                <img src="../images/thanhtoan.jpg" alt="TimeElite" width="60%">
            </div>
            <div class="col-md-4 col-sm-6">
                <img src="../images/connect.jpg" alt="TimeElite" width="60%">
            </div>
            <div class="col-md-4 col-sm-12">
                <img src="../images/dangky.jpg" alt="TimeElite" width="60%">
            </div>
        </div>
    </div>
    <?php   
        if (isset($_POST["submitButton"])) {
            if ($error != "") {
                echo "<script>alert('$error');</script>";
            }
        } 
    ?>
    <script>
        function validateForm() {
            var fullname = document.getElementById('floatingfullname').value;
            var username = document.getElementById('floatingusername').value;
            var password = document.getElementById('floatingPassword').value;
            var retypePassword = document.getElementById('floatingretypePassword').value;

            var errorMessage = '';

            if (fullname.length < 2 || fullname.length > 30) {
                errorMessage += 'Họ và tên phải từ 2 đến 30 kí tự.\n';
            }

            if (username.length < 2 || username.length > 30) {
                errorMessage += 'Tên đăng nhập phải từ 2 đến 30 kí tự.\n';
            }

            if (password.length < 6) {
                errorMessage += 'Mật khẩu phải chứa ít nhất 6 kí tự.\n';
            }

            if (password != retypePassword) {
                errorMessage += 'Mật khẩu nhập lại không khớp.\n';
            }

            if (errorMessage != '') {
                alert(errorMessage);
            } else {
                alert('Thông tin đăng kí hợp lệ!');
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>
