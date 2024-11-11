<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "ltw_db";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM thongtin";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

$address = $row['address'];
$phone = $row['phone'];
$email = $row['email'];
$facebook = $row['facebook'];
$instagram = $row['instagram'];

if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST["submit"] == "Xác nhận") {
        $address = $_POST["address"];
        $phone = $_POST["phone"];
        $email = $_POST["email"];
        $facebook = $_POST["facebook"];
        $instagram = $_POST["instagram"];
        if (empty($address) && $address != 0) {
            echo '<script>alert("Nhập Address")</script>';
        } 
        else if (empty($phone) && $phone != 0) {
            echo '<script>alert("Nhập Phone")</script>';
        }
        else if (empty($email) && $email != 0) {
            echo '<script>alert("Nhập email")</script>';
        }
        else if (empty($facebook) && $facebook != 0) {
            echo '<script>alert("Nhập Facebook")</script>';
        }
        else if (empty($instagram) && $instagram != 0) {
            echo '<script>alert("Nhập Instagram")</script>';
        }
        else {
            $newsql = "UPDATE thongtin SET address='$address',phone='$phone', email='$email', facebook='$facebook', instagram='$instagram'";
            if ($conn->query($newsql) === TRUE) {
                echo '<script>alert("Đã chỉnh sửa thành công!")</script>';
                echo '<script>location.href = "admin_page.php" </script>';
            }
        }
    }
    if ($_POST["submit"] == "Đặt lại") {
        $address = "";
        $phone = "";
    }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Time Elite</title>
</head>

<body style="background-color:#eee;">
    <div class="container mt-3" style="width: 600px; background-color:white;">
        <a class="btn mt-3" href="admin_page.php" style="background-color:#FF8C00; color:white; margin-left: 20px;">Quay
            lại</a>
        <hr size="5px" color="#FF8C00">
        <h1 class="mt-5" style="text-align: center;">THÔNG TIN LIÊN HỆ</h1>
        <hr>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>">
        
            <label for="address">Địa chỉ</label>
            <input type="text" class="form-control mt-2" name="address" value='<?php echo $address ?>'>

            <label class="mt-2" for="phone">Số điện thoại liên hệ</label>
            <input type="text" class="form-control mt-2" name="phone" value='<?php echo $phone ?>'>

            <label class="mt-2" for="email">Email</label>
            <input type="text" class="form-control mt-2" name="email" value='<?php echo $email ?>'>

            <label class="mt-2" for="facebook">Facebook</label>
            <input type="text" class="form-control mt-2" name="facebook" value='<?php echo $facebook ?>'>

            <label class="mt-2" for="instagram">Instagram</label>
            <input type="text" class="form-control mt-2" name="instagram" value='<?php echo $instagram ?>'>


            <div class="row">
                <div class="col">
                    <input type="submit" class="form-control btn mt-3" name="submit" value="Xác nhận"
                        style="background-color:#FF8C00; color:white;">
                </div>
                <div class="col">
                    <input type="submit" class="form-control btn btn-danger mt-3" name="submit" value="Đặt lại">
                </div>
            </div>
            <a class="form-control btn btn-secondary mt-3 mb-3" href="admin_page.php">Hủy</a><br>

        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>