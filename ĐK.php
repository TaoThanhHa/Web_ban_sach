<?php
// Kết nối đến cơ sở dữ liệu
include_once('db/connect.php');

if (isset($_POST['register'])) {
    $name = $_POST['name']; // Tên người dùng
    $email = $_POST['email']; // Email người dùng
    $phone = $_POST['phone']; // Số điện thoại
    $password = $_POST['password']; // Mật khẩu
    $confirmPassword = $_POST['confirmPassword']; // Nhập lại mật khẩu

    // Kiểm tra xem mật khẩu có khớp không
    if ($password === $confirmPassword) {
        // Băm mật khẩu trước khi lưu vào cơ sở dữ liệu
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Thêm người dùng vào bảng tbl_user, lưu tên vào trường user
        $stmt = $mysqli->prepare("INSERT INTO tbl_user (name, email, user, phone, pass) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $name, $email, $name, $phone, $hashedPassword);
        
        if ($stmt->execute()) {
            // Đăng ký thành công, có thể chuyển hướng đến trang đăng nhập
            header("Location: ĐN.php");
            exit();
        } else {
            // Thông báo lỗi
            echo "Có lỗi xảy ra: " . $stmt->error;
        }
    } else {
        echo "<script>alert('Mật khẩu và nhập lại mật khẩu không khớp!');</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng Kí</title>
    <link rel="stylesheet" href="css/Đk.css" type="text/css">
</head>
<body>
    <div class="gdđn">
        <div class="khunglon">
            <div class="x"><a href="ĐN.html">X</a></div>
            <div class="khungnho">
                <div class="khungbe">
                    <div class="thamgiagt">
                        <div class="dnvao">
                            <span class="chu">Tham gia với chúng tôi</span>
                        </div>
                        <div class="dnvao">
                            <span class="quyenloi">Là một phần của cộng đồng tác giả và độc giả toàn cầu, mọi người đều được kết nối bằng sức mạnh của trí tưởng tượng.</span>
                        </div>
                    </div>
                    
                    <form id="registerForm" method="post" onsubmit="return validateForm()">
                        <input type="text" id="name" name="name" placeholder="Tên" required>
                        <input type="email" id="email" name="email" placeholder="Email" required>
                        <input type="tel" id="phone" name="phone" placeholder="Số điện thoại" required>
                        <input type="password" id="password" name="password" placeholder="Mật khẩu" required>
                        <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Nhập lại mật khẩu" required>
                        <button type="submit" name="register" class="buttondn">Đăng ký</button>
                    </form>
                </div>
                <footer class="khungdk">
                    <span>Nếu bạn đã có tài khoản <button class="dangki"><a class="dangki" href="ĐN.html">Đăng nhập</a></button></span>
                </footer>
                <div class="quenMK">
                    By continuing, you agree to Website's <a class="blue" href="">Điều khoản Dịch vụ</a> and <a class="blue" href="">Chính Sách Bảo Mật.</a>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        function validateForm() {
            var password = document.getElementById('password').value;
            var confirmPassword = document.getElementById('confirmPassword').value;
            
            if (password !== confirmPassword) {
                alert("Mật khẩu và nhập lại mật khẩu không khớp!");
                return false;
            }
            
            return true;
        }
    </script>
</body>
</html>
