<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $checkRemember = isset($_POST["rememberMe"]) ? $_POST["rememberMe"] : 0;

    if (empty($username) || empty($password)) {
        echo '<script>alert("Vui lòng nhập đầy đủ thông tin")</script>';
    } else {
        $conn = mysqli_connect("localhost", "root", "", "ltw_db");
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $sql = "SELECT * FROM KhachHang WHERE username = '$username'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) == 1 && $username) {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($password, $row["password"]) && $row["isbanned"] == 0) {
                session_start();
                $_SESSION["username"] = $username;
                if ($row["role"] == 'admin'){
                    header("Location: ../Admin/admin_page.php");
                    exit();
                }
                else{
                    header("Location: ../NguoiDung/mainPage_Logged.php");
                    exit();
                }
            } 
            else if (password_verify($password, $row["password"]) && $row["isbanned"] == 1) {
                echo '<script>alert("Tài khoản của bạn đã bị khóa.")</script>';
            }
            else {
                echo '<script>alert("Sai tên người dùng hoặc mật khẩu.")</script>';
            }
        } 
        else {
            echo '<script>alert("Sai tên người dùng hoặc mật khẩu.")</script>';
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
    <title>Login</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.17.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="shortcut icon" type="image/png" href="/applogo.png"/>
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
        .pageHeader{
            position: relative;
            width: 100%;
            padding: 0px;
        }
        .pageHeader .nav-item { 
            padding-left: 7px;
            padding-right: 7px;
        }

        .pageFooter{
            width: 100%;   
            padding: 0px;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="container-fluid bg-black">
        <nav class="navbar navbar-expand-lg navbar-black bg-black d-flex flex-lg-row flex-sm-column">
            <a class="navbar-brand" href="mainPage.php">
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
                        <a class="nav-link" href="login.php" style="color: yellow">
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
    <!-- Login form -->
    <div class="container bg-light mt-3" style="margin-top: 100px; margin-bottom: 100px">
        <div class="row">
            <h3 class="fw-bold text-center mt-2">Đăng nhập</h3>
        </div>
        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
            <input type="text" class="form-control mt-3" id="username" name="username" placeholder="Tên đăng nhập">
            <input type="password" class="form-control mt-3" id="password" name="password" placeholder="Mật khẩu">
            <div style = "margin: 15px 0px; " class="form-check">
                <input type="checkbox" class="form-check-input" name="rememberMe" id="rememberMe">
                <label class="form-check-label" for="remember">Ghi nhớ đăng nhập</label>
            </div>
            <div class="form-text" style="color: #FF8C00;">Chưa có tài khoản? <a href="register.php" style="color: #FF8C00;">Đăng ký</a></div>
            <div class="text-center">
                <input  style = "margin: 15px 0px; " type="submit" class="btn btn-outline-primary mt-3" name="submit" value="Đăng nhập">
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>