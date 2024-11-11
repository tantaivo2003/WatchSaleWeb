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

    if (isset($_POST['addToCartButton'])) {
        $productId = $_POST['productId'];
        $sql = "SELECT * FROM `giohangbaogomsp` WHERE cUsername = '" . $_SESSION['username'] . "' AND cProductId = '$productId';";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $sql = "UPDATE `giohangbaogomsp` SET totalProduct = totalProduct + 1 WHERE cUsername = '" . $_SESSION['username'] . "' AND cProductId = '$productId';";
            $conn->query($sql);
            echo "<script type='text/javascript'>alert('Sản phẩm đã được thêm vào giỏ hàng');</script>'";
        }
        else{
            $sql = "INSERT INTO `giohangbaogomsp` (`cUsername`, `cProductId`, `totalProduct`) VALUES ('" . $_SESSION['username'] . "', '$productId', '1');";
            echo "<script type='text/javascript'>alert('Sản phẩm đã được thêm vào giỏ hàng');</script>'";
            $conn->query($sql);
        }
    }

    if (isset($_POST['postComment'])) {
        $productId = $_POST['productId'];
        $username = $_POST['username'];
        $myComment = $_POST['myComment'];
        $date = date("Y-m-d");
        $sql = "INSERT INTO `nguoidungdanhgiasp` (`rUsername`, `rProductId`, `numberStar`, `comment`, `dateComment`) VALUES ('$username', '$productId', '5', '$myComment', '$date');";
        $conn->query($sql);
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Time Elite</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
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
            font-family: "Inter";
        }
        .nav-item {
            padding-left: 15px;
            padding-right: 15px;
        }
        .nav-item:hover .dropdown-menu {
            display: block;
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
        .date{font-size: 11px}
        .comment-text{font-size: 14px}
        .fs-12{font-size: 14px}
        .shadow-none{box-shadow: none}
        .name{color: #007bff}
        .cursor:hover{color: blue}
        .cursor{cursor: pointer}
        .textarea{resize: none}
    </style>
</head>

<body>
    <!-- Header -->
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
    <!-- Boby -->
    <div class="container-fluid">
        <nav style="--bs-breadcrumb-divider: '/';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="mainPage_Logged.php"
                        style="text-decoration:none;;">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    <?php
                    $sql = "SELECT * FROM `sanpham` WHERE productId = " . $_GET['id'] . ";";
                    $result = $conn->query($sql);
                    echo $result->fetch_assoc()["name"];
                    ?>
                </li>
            </ol>
        </nav>
        <div class="container mt-5 mb-5">
            <div class="row d-flex justify-content-center">
                <div class="col-md-10">
                    <div class="card">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="images p-3">
                                    <div class="text-center p-4"> <img id="main-image" src='<?php
                                    $sql = "SELECT * FROM `sanpham` WHERE productId = " . $_GET['id'] . ";";
                                    $result = $conn->query($sql);
                                    echo $result->fetch_assoc()["imageUrl"];
                                    ?>' width="365px" /> </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="product p-4">
                                    <div class="mt-4 mb-3">
                                        <h5 class="text-uppercase">Đồng hồ
                                            <?php
                                            $sql = "SELECT * FROM `sanpham` WHERE productId = " . $_GET['id'] . ";";
                                            $result = $conn->query($sql);
                                            echo $result->fetch_assoc()["name"];
                                            ?>
                                        </h5>
                                        <span class=" text-muted brand">Hãng sản xuất:
                                            <?php
                                            $sql = "SELECT * FROM `sanpham` WHERE productId = " . $_GET['id'] . ";";
                                            $result = $conn->query($sql);
                                            echo $result->fetch_assoc()["productType"];
                                            ?>
                                        </span>

                                    </div>
                                    <p class="about" style="text-align:justify;">
                                        <?php
                                        $sql = "SELECT * FROM `sanpham` WHERE productId = " . $_GET['id'] . ";";
                                        $result = $conn->query($sql);
                                        echo $result->fetch_assoc()["description"];
                                        ?>
                                    </p>
                                    <div class="price d-flex flex-row align-items-center">
                                        <span class="text-muted brand">Giá:
                                            <?php
                                            $sql = "SELECT * FROM `sanpham` WHERE productId = " . $_GET['id'] . ";";
                                            $result = $conn->query($sql);
                                            echo "$".$result->fetch_assoc()["price"];
                                            ?> - Giá có thể thay đổi
                                        </span>
                                    </div>
                                    <div class="cart mt-4 align-items-center"> 
                                    <form action = "" method = "POST">
                                        <input type = "hidden" name = "productId" value = "<?php echo $_GET['id']; ?>">
                                        <button type = "submit" name = "addToCartButton" class="btn btn-danger text-uppercase mr-2 px-4">Thêm vào giỏ hàng</button>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <h3 style = "margin-left: 130px; margin-top: 50px;">Bình luận</h3>
        <?php 
            //select data from nguoidungdanhgiasanpham, rUsername, rProductId, numberStar, comment, dateComment
            $sql = "SELECT * FROM `nguoidungdanhgiasp` WHERE rProductId = " . $_GET['id'] . ";";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $sql1 = "SELECT * FROM KhachHang WHERE username = '" . $row['rUsername'] . "'";
                    $result1 = $conn->query($sql1);
                    $row1 = $result1->fetch_assoc();
        ?>
        <div class="container mt-5" style = "margin-bottom: 20px;">
            <div class="d-flex justify-content-center row">
                <div class="col-md-8">
                    <div class="d-flex flex-column comment-section">
                        <div class="bg-white p-2">
                            <div class="d-flex flex-row user-info"><img class="rounded-circle" src="<?php if ($row1['avatar']) {echo $row1['avatar'];} else{echo "../images/userIconImage.png";}?>" width="40">
                                <div class="d-flex flex-column justify-content-start ml-2"><span class="d-block font-weight-bold name"><?php echo $row['rUsername']?>
                                </span><span class="date text-black-50"><?php echo $row['dateComment']?></span></div>
                            </div>
                            <div class="mt-2">
                                <p class="comment-text"><?php echo $row['comment']?></p>
                            </div>
                        </div>
                        <div class="bg-white">
                            <div class="d-flex flex-row fs-12">
                                <div class="like p-2 cursor"><i class="fa fa-thumbs-o-up"></i><span class="ml-1">Like</span></div>
                                <div class="like p-2 cursor"><i class="fa fa-commenting-o"></i><span class="ml-1">Comment</span></div>
                                <div class="like p-2 cursor"><i class="fa fa-share"></i><span class="ml-1">Share</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <?php }
            }
            ?>
            <form method = "POST" action = "">
                <div style = "width: 75%; margin: 0 auto;" class="bg-light p-2">
                    <input type = "hidden" name = "productId" value = "<?php echo $_GET['id']; ?>">
                    <input type = "hidden" name = "username" value = "<?php echo $_SESSION['username']; ?>">
                    <div class="d-flex flex-row align-items-start"><img class="rounded-circle" 
                    src="<?php 
                            $sql = "SELECT * FROM KhachHang WHERE username = '" . $_SESSION['username'] . "'";
                            $result = $conn->query($sql);
                            $row = $result->fetch_assoc();
                            if ($row['avatar']) {echo $row['avatar'];} else{echo "../images/userIconImage.png";}
                    ?>" 
                    width="40"><textarea name = "myComment" class="form-control ml-1 shadow-none textarea"></textarea></div>
                    <div class="mt-2 text-right"><button class="btn btn-primary btn-sm shadow-none" type="submit" name = "postComment">Gửi bình luận</button></div>
                </div>
            </form>
        </div>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>