<?php
    include('header.php');
?>
<a class="btn mt-3" href="admin_page.php" style="background-color:#FF8C00; color:white; margin-left: 20px;">Quay lại</a>
<hr size="5px" color="#FF8C00">
<h1 class="mt-1" style="text-align: center;">DANH SÁCH ĐƠN HÀNG</h1>
<hr>
<?php
    include("database.php");

    // Fetch all orders
    $stmt = $conn->prepare("SELECT * FROM donhang");
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        echo '<table class="table table-bordered mt-3 table table-striped table-hover align-middle table-responsive w-auto mx-auto">
                <thead>
                    <tr>
                        <th>ID sản phẩm</th>
                        <th>Tên đặng nhập</th>
                        <th>Tổng</th>
                        <th>Ngày đặt hàng</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>';

        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['orderId'] . '</td>';
            echo '<td>' . $row['orderUsername'] . '</td>';
            echo '<td>$ ' . $row['orderTotalPrice'] . '</td>';
            echo '<td>' . $row['orderDate'] . '</td>';
            echo '<td>' . $row['status'] . '</td>';
            echo '<td>';
            echo '<a href="order_info.php?orderId=' . $row['orderId'] . '" class="btn btn-primary btn-sm">Chi tiết</a>';
            echo ' ';
            echo '<button class="btn btn-danger btn-sm" onclick="confirmDelete(\'' . $row['orderId'] . '\')">Xóa</button>';
            echo '</td>';
            echo '</tr>';
        }

        echo '</tbody></table>';
    } else {
        echo '<p class="fw-bold">No orders found!</p>';
    }
    ?>

    <script>
        function confirmDelete(orderId) {
            var result = confirm("Are you sure you want to delete this order?");
            if (result) {
                window.location.href = 'delete_order.php?orderId=' + orderId;
            }
        }
    </script>

    <?php
    include('footer.php');
?>