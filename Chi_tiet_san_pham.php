<?php
include_once('db/connect.php');

// Lấy book_id từ URL
$book_id = isset($_GET['book_id']) ? (int)$_GET['book_id'] : 0;

// Truy vấn để lấy thông tin chi tiết sách
$query = "SELECT * FROM tbl_book WHERE book_id = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("i", $book_id);
$stmt->execute();
$result = $stmt->get_result();

// Kiểm tra xem có sách nào không
if ($result->num_rows > 0) {
    $book = $result->fetch_assoc();
} else {
    echo "<p>Không tìm thấy sách.</p>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="css/Chi_tiet_san_pham.css" type="text/css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title><?php echo isset($book['book_title']) ? htmlspecialchars($book['book_title']) : 'Chi tiết sách'; ?></title>
</head>
<body>
        <?php
            // Truy vấn để lấy category
            $spl_category = mysqli_query($mysqli, 'SELECT * FROM tbl_category ORDER BY category_id DESC');
            // Truy vấn để lấy sách
            $query = "SELECT * FROM tbl_book ORDER BY RAND() LIMIT 12";
            $result = $mysqli->query($query);
        ?>
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
                                <li><a href="./Phân_loại.php"><?php echo htmlspecialchars($row_category['category_name']); ?></a></li>
                            <?php endwhile; ?>
                        </ul>
                    </li>
                    <li><a href="#">Liên Hệ</a></li>
                    <li><a href="./Giới_thiệu.php">Giới Thiệu</a></li>
                </ul>
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

    <div class="story"> 
        <div class="story-bg">     
            <div class="box-avata">   
                <div class="avata">
                    <div class="image"><img src="images/<?php echo isset($book['book_image']) ? htmlspecialchars($book['book_image']) : 'default.jpg'; ?>" alt="<?php echo isset($book['book_title']) ? htmlspecialchars($book['book_title']) : 'Sách'; ?>"></div>
                    <div class="discount-badge"><?php echo isset($book['book_discount']) ? htmlspecialchars($book['book_discount']) : '0'; ?>%</div> 
                </div>   
            </div>    
            <div class="story-infor">
                <div class="story-name"><?php echo isset($book['book_title']) ? htmlspecialchars($book['book_title']) : 'Chưa có tiêu đề'; ?></div>
                <div class="view">
                    <li>Tác giả: <span><?php echo isset($book['book_author']) ? htmlspecialchars($book['book_author']) : 'Không xác định'; ?></span></li>
                    <li>Nhà xuất bản: <span><?php echo isset($book['book_publisher']) ? htmlspecialchars($book['book_publisher']) : 'Không xác định'; ?></span></li>
                    <li>Kích thước: <span><?php echo isset($book['book_size']) ? htmlspecialchars($book['book_size']) : 'Không xác định'; ?></span></li>
                    <li>Thể loại: <span><?php echo isset($book['book_category']) ? htmlspecialchars($book['book_category']) : 'Không xác định'; ?></span></li>
                    
                    <?php
                    $original_price = isset($book['book_original_price']) ? $book['book_original_price'] : 0;
                    $discount = isset($book['book_discount']) ? $book['book_discount'] : 0;
                    $price = $original_price * (1 - $discount / 100);
                    ?>
                    
                    <li><div class="price"><?php echo number_format($price, 0, ',', '.'); ?>đ</div></li>
                    <li><div class="original-price"><?php echo number_format($original_price, 0, ',', '.'); ?>đ</div></li>
                </div>

                <div class="box-counter">
                    <form action="Them_gio_hang.php" method="POST">
                        <input type="hidden" name="book_id" value="<?php echo $book['book_id']; ?>">
                        <input type="hidden" name="book_title" value="<?php echo htmlspecialchars($book['book_title']); ?>">
                        <input type="hidden" name="book_image" value="<?php echo htmlspecialchars($book['book_image']); ?>">
                        <input type="hidden" name="book_price" value="<?php echo number_format($price, 0, ',', '.'); ?>">
                        <div class="counter">
                            <button type="button" id="decrease">-</button>
                            <div class="number" id="count">1</div>
                            <button type="button" id="increase">+</button>
                        </div>
                        <input type="hidden" name="quantity" id="quantity" value="1">
                        <button type="submit" class="btn btn-cart">Thêm Vào Giỏ</button>
                    </form>
                </div>
            </div>
        </div> 
    </div> 

    <div class="box-box">
        <div class="tong">
            <div class="words">
                <span class="word selected" onclick="changeContent(this, 'Mô tả')">Mô tả</span>
                <span class="word" onclick="changeContent(this, 'Bình luận')">Bình luận</span>
            </div>
        </div>

        <div class="box" id="box">
            <div class="mota">
                <div class="box-mota">
                    <div class="story-content"><?php echo isset($book['book_describe']) ? htmlspecialchars($book['book_describe']) : 'Chưa có mô tả'; ?></div>
                </div>
            </div>

            <div class="cmt" style="display: none;">
                <div class="box-cmt">
                    <!-- Phần bình luận sẽ được thêm vào sau -->
                </div>
            </div>
        </div>
    </div>
    
    <h2>Xem thêm các sản phẩm khác</h2>
    <section class="wrapper">
    <div class="box">
        <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $original_price = $row['book_original_price'];
                    $discount = $row['book_discount'];
                    $price = $original_price * (1 - $discount / 100);
                    echo '<div class="card">';
                    echo '<a href="Chi_tiet_san_pham.php?book_id=' . $row['book_id'] . '">';
                    echo '<img src="images/' . htmlspecialchars($row['book_image']) . '" alt="' . htmlspecialchars($row['book_title']) . '">';
                    echo '<div class="discount">' . htmlspecialchars($row['book_discount']) . '%</div>';
                    echo '<div class="title">' . htmlspecialchars($row['book_title']) . '</div>';
                    echo '<div class="price">' . number_format($price, 0, ',', '.') . 'đ</div>';
                    echo '<div class="original-price">' . number_format($row['book_original_price'], 0, ',', '.') . 'đ</div>';
                    echo '</a>'; // Kết thúc thẻ <a>
                    echo '</div>'; // Kết thúc thẻ div.card
                }
            } else {
                echo "<p>Không có sách nào trong cơ sở dữ liệu.</p>";
            }
        ?>
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
    <script src="javascript/Chi_tiet_san_pham.js"></script>
</body>
</html>
