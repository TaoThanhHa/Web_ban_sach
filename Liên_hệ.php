<?php
include_once('db/connect.php');
?>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shopping-cart</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/Liên_hệ.css" type="text/css">
    <script>
        document.getElementById('cart').addEventListener('click', function() {
        window.location.href = 'Giỏ_hàng.php';
        });
    </script>
</head>

<body>
        <?php
            // Truy vấn để lấy category
            $spl_category = mysqli_query($mysqli, 'SELECT * FROM tbl_category ORDER BY category_id DESC');
        ?>
   <!-- header -->
   <header>
        <nav>
            <div class="content-nav">
                <div class="img-nav">
                    <img src="images/book_haven.jpg" width="50px" height="50px" />
                </div>
                
                <ul>
                    <li><a href="index.php">Trang Chủ</a></li>
                    <li><a href="#">Sản Phẩm</a>
                        <ul>
                            <?php while($row_category = mysqli_fetch_array($spl_category)): ?>
                            <li><a href="./Phân_loại.html"><?php echo $row_category['category_name']; ?></a></li>
                            <?php endwhile; ?>
                        </ul>
                    </li>
                    <li><a href="">Liên Hệ</a></li>
                    <li><a href="Giới_thiệu.php">Giới Thiệu</a></li>
                </ul>
                <form method="post" action="">
                    <input type="text" name="search" placeholder="Tìm kiếm sản phẩm..." />
                    <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                </form>
            </div>
            <button id="cart">
                <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                Giỏ Hàng
            </button>
            <ul class="login">
                <li><a href="">Đăng nhập</a></li>
                <li><a href="">Đăng ký</a></li>
            </ul>
        </nav>
    </header>


    <!-- content -->
     
    <section class="wrapper">
        <div class="left-section">
            <h2>Liên hệ</h2>
            <p>Nếu bạn có thắc mắc gì, có thể gửi yêu cầu cho chúng tôi, và chúng tôi sẽ liên lạc lại với bạn sớm nhất có thể.</p>
            <form>
                <div class="form-group">
                    <input type="text" id="name" placeholder="Tên của bạn">
                </div>
                <div class="form-group">
                    
                    <input type="email" id="email" placeholder="Email của bạn">
                </div>
                <div class="form-group">
                    
                    <textarea id="comment" rows="4" placeholder="Viết bình luận"></textarea>
                </div>
                <button type="submit">Gửi liên hệ</button>
            </form>
        </div>
        <div class="right-section">
            <h2>Chúng tôi ở đây</h2>
            <p><strong>Book Haven</strong></p>
            <p>Công ty Cổ phần Xuất bản và Truyền thông Book Haven</p>
            <p>
                <i class="fas fa-map-marker-alt"></i> Here, Hà Nội<br>
                <i class="fas fa-envelope"></i> bookhaven@gmail.com<br>
                <i class="fas fa-phone"></i> 0666688889
            </p>
        </div>
    </section>
    

    <!-- footer -->
    <footer>
        <div>
            <ul class="end">
                <li>
                    <ul>
                        <img src="images/Book Haven (2).png" width="130px" height="130px">
                    </ul>
                </li>
                <li><ul>
                    <li class="tieu_de">Dịch vụ</li>
                    <li><a href="">Điều khoản sử dụng</a></li>
                    <li><a href="">Liên hệ</a></li>
                    <li><a href="">Hệ thống nhà sách</a></li>
                </ul></li>
    
                <li><ul>
                    <li class="tieu_de">Hỗ trợ</li>
                    <li><a href="">Chính sách đổi trả - hoàn tiền</a></li>
                    <li><a href="">Phương thức vận chuyển</a></li>
                    <li><a href="">Phương thức thanh toán</a></li>
                </ul></li>
    
                <li><ul>
                    <li class="tieu_de">Nhà sách bán lẻ</li>
                    <li>Giám đốc: Tào Thanh Hà | Mai Phương Anh</li>
                    <li>Địa chỉ: Đại học Phenikaa</li>
                    <li>Số điện thoại: </li>
                    <li>Email: </li>
                    <li>Facebook: </li>
                </ul></li>
            </ul>
        </div>
    </footer>
</body>

    

</html>
