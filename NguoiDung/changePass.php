<?php
    session_start();
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "ltw_db";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    if (isset($_SESSION['username'])) {
        $loggedInUser = $_SESSION['username'];

        // Fetch user details from the database
        $sql = "SELECT fullname FROM KhachHang WHERE username = '$loggedInUser'";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $fullName = $row['fullname'];
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $currentPassword = $_POST['currentPassword'];
        $newPassword = $_POST['newPassword'];
        $confirmPassword = $_POST['confirmPassword'];

        // Add your password validation logic here, similar to the registration form

        if ($newPassword !== $confirmPassword) {
            $error = "Mật khẩu mới và xác nhận mật khẩu không khớp.";
        } else {
            $username = $_SESSION['username'];
            
            $conn = mysqli_connect("localhost", "root", "", "ltw_db");
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            $sql = "SELECT * FROM khachhang WHERE username = '$username'";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    if (password_verify($currentPassword, $row['password'])) {
                        $hashPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                        $updateSql = "UPDATE khachhang SET password = '$hashPassword' WHERE username = '$username'";
                        $updateResult = mysqli_query($conn, $updateSql);

                        if ($updateResult) {
                            $success = "Đổi mật khẩu thành công!";
                        } else {
                            $error = "Có lỗi xảy ra, vui lòng thử lại sau.";
                        }
                    } else {
                        $error = "Mật khẩu hiện tại không đúng.";
                    }
                } else {
                    $error = "Người dùng không tồn tại.";
                }
            } else {
                $error = "Lỗi trong cơ sở dữ liệu.";
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
    <title>Đổi mật khẩu</title>
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
            padding-left: 7px;
            padding-right: 7px;
        }
        .nav-item:hover .dropdown-menu {
            display: block;
        }
        .navbar-nav .nav-link:hover .dropdown-menu {
            display: block;
        }
        .navbar-nav .nav-item.dropdown:hover .dropdown-menu {
            display: block;
            position: absolute;
            top: 100%;
        }
        body{background: #eee}
    </style>
</head>
<body>
    <!-- header -->
    <div class="container-fluid bg-black">
        <nav class="navbar navbar-expand-lg navbar-black bg-black d-flex flex-lg-row flex-sm-column">
            <a class="navbar-brand" href="mainPage_Logged.php">
                <img src="../images/logo.png" alt="TimeElite" class="img-responsive" width="70" height="70">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="mainPage_Logged.php" style="color: #FF8C00">Trang chủ</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: #FF8C00">
                          Hãng
                        </a>
                        <ul class="dropdown-menu bg-black" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="search_by_brand.php?brand=Audemars Piguet" style="color: #FF8C00">Audemars Piguet</a></li>
                            <li><a class="dropdown-item" href="search_by_brand.php?brand=Patek Philippe" style="color: #FF8C00">Patek Philippe</a></li>
                            <li><a class="dropdown-item" href="search_by_brand.php?brand=Vacheron Constantin" style="color: #FF8C00">Vacheron Constantin</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: #FF8C00">
                          Dịch vụ
                        </a>
                        <ul class="dropdown-menu bg-black" aria-labelledby="navbarDropdown">
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
                    <form action="search_by_name.php" method="POST" class="d-flex" style="padding-left: 30px; padding-right: 30px">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search">
                        <button class="btn btn-outline-success" type="submit" value="search"
                            style="background-color: #FF8C00; color: white">Search</button>
                    </form>
                    <li class="nav-item">
                        <a class="nav-link" href="cartPage.php" style="color: yellow">
                            <img src="../images/cart.jpg" alt="" width="30" height="30">
                            <i class="bi bi-cart"></i>Giỏ hàng
                        </a>
                    </li>
                    <?php if (isset($fullName)): ?>
                        <!-- If user is logged in, display personalized greeting and dropdown -->
                        <li class="nav-item dropdown" style="margin-right: 12px">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: yellowgreen">
                                Hello, <?php echo $fullName; ?>
                            </a>
                            <ul class="dropdown-menu bg-black" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item" href="profile.php" style="color: #FF8C00">Thông tin cá nhân</a></li>
                                <li><a class="dropdown-item" href="orderInformation.php" style="color: #FF8C00">Đơn hàng của bạn</a></li>
                                <li><a class="dropdown-item" href="changePass.php" style="color: #FF8C00">Đổi mật khẩu</a></li>
                                <li><a class="dropdown-item" href="logout.php" style="color: #FF8C00">Đăng xuất</a></li>
                            </ul>
                        </li>
                    <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php" style="color: yellowgreen">Đăng nhập</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="register.php" style="color: yellowgreen">Đăng kí</a>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>
    </div>
    <hr size="5px" color="#FF8C00">
    <!-- content -->
    <div class="container bg-light mt-3" style="margin-top: 100px; margin-bottom: 100px">
        <div class="row">
            <h3 class="fw-bold text-center mt-2">Đổi mật khẩu</h3>
        </div>
        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
            <div class="mb-3">
                <label for="currentPassword" class="form-label">Mật khẩu hiện tại</label>
                <input type="password" class="form-control" id="currentPassword" name="currentPassword" placeholder="Mật khẩu hiện tại" required>
            </div>
            <div class="mb-3">
                <label for="newPassword" class="form-label">Mật khẩu mới</label>
                <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="Mật khẩu mới" required>
            </div>
            <div class="mb-3">
                <label for="confirmPassword" class="form-label">Xác nhận mật khẩu mới</label>
                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Xác nhận mật khẩu mới" required>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-outline-primary mt-3" name="changePasswordButton">Đổi mật khẩu</button>
            </div>
        </form>
        <?php   
            if (isset($error)) {
                echo "<div class='alert alert-danger mt-3' role='alert'>$error</div>";
            } elseif (isset($success)) {
                echo "<div class='alert alert-success mt-3' role='alert'>$success</div>";
            }
        ?>
    </div>
    <!-- footer -->
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
