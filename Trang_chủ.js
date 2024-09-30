//Slider
let currentIndex = 0;
  const slides = document.querySelectorAll('.slide');

  function showSlide(index) {
      slides.forEach((slide, i) => {
          slide.classList.remove('active', 'next', 'prev');
          if (i === index) {
              slide.classList.add('active');
          } else if (i === (index + 1) % slides.length) {
              slide.classList.add('next');
          } else if (i === (index - 1 + slides.length) % slides.length) {
              slide.classList.add('prev');
          }
      });
  }

  function nextSlide() {
      currentIndex = (currentIndex + 1) % slides.length;
      showSlide(currentIndex);
  }

  setInterval(nextSlide, 3000); // Chuyển đổi mỗi 3 giây
  showSlide(currentIndex);

//Lấy dữ từ tạo sản phẩm
function addProduct(name, description, publisher, size, price, discount, quantity, category, image) {
  const productContainer = document.getElementById('productContainer');
  const productCard = document.createElement('div');
  productCard.className = 'product-card';
  productCard.innerHTML = `
      <div class="product-image">
          <img src="${image}" alt="Hình ảnh sản phẩm" style="width: 100%; height: auto;">
      </div>
      <div class="product-details">
          <h2 class="product-title">${name}</h2>
          <p class="product-price">Giá: ${price}đ</p>
          <p class="product-discount">Giảm giá: ${discount}%</p>
      </div>
  `;
  productContainer.appendChild(productCard);
}

// Lấy dữ liệu từ localStorage và hiển thị
window.onload = function() {
  const products = JSON.parse(localStorage.getItem('products')) || [];
  products.forEach(product => {
      addProduct(product.name, product.description, product.publisher, product.size, product.price, product.discount, product.quantity, product.category, product.image);
  });
};

// Lấy dữ liệu từ localStorage và hiển thị
window.onload = function() {
  const products = JSON.parse(localStorage.getItem('products')) || [];
  products.forEach(product => {
      addProduct(product.name, product.price, product.discount);
  });
};

document.addEventListener('DOMContentLoaded', () => {
    const menuToggle = document.getElementById('menu-toggle'); // Correctly select the icon
    const navMenu = document.getElementById('nav-menu'); // Select the nav menu

    menuToggle.addEventListener('click', () => {
        navMenu.classList.toggle('active'); // Toggle the 'active' class
    });
});

//Xóa sản phẩm
/*function deleteProduct(index) {
  let products = JSON.parse(localStorage.getItem('products')) || [];
  products.splice(index, 1); // Xóa sản phẩm tại vị trí index
  localStorage.setItem('products', JSON.stringify(products));
  window.location.reload(); // Tải lại trang để cập nhật danh sách
}*/


var modal = document.getElementById("myModal");
var btn = document.getElementById("cart");
var close = document.getElementsByClassName("close")[0];


var close_footer = document.getElementsByClassName("close-footer")[0];
var order = document.getElementsByClassName("order")[0];
btn.onclick = function () {
modal.style.display = "block";
}
close.onclick = function () {
 modal.style.display = "none";
}
close_footer.onclick = function () {
modal.style.display = "none";
}
order.onclick = function () {
alert("Cảm ơn bạn đã thanh toán đơn hàng")
}
window.onclick = function (event) {
if (event.target == modal) {
modal.style.display = "none";
}
}

// xóa cart
var remove_cart = document.getElementsByClassName("btn-danger");
for (var i = 0; i < remove_cart.length; i++) {
var button = remove_cart[i];
button.addEventListener("click", function(event) {
  var button_remove = event.target;
  button_remove.parentElement.parentElement.remove();
  
  // Gọi hàm updatecart() để cập nhật lại tổng giá
  updatecart();
});
}


// Update cart 
function updatecart() {
var cart_items_container = document.getElementsByClassName("cart-items")[0]; // Chỉ lấy phần tử đúng
var cart_rows = cart_items_container.getElementsByClassName("cart-row");
var total = 0;

for (var i = 0; i < cart_rows.length; i++) {
var cart_row = cart_rows[i];
var price_item = cart_row.getElementsByClassName("cart-price")[0];
var quantity_item = cart_row.getElementsByClassName("cart-quantity-input")[0];

if (price_item && quantity_item) {
var price = parseFloat(price_item.innerText.replace('đ', '').replace(/\D/g, '')); // Chỉ lấy số từ giá
var quantity = quantity_item.value; // Lấy giá trị trong input
total += price * quantity;
}
}

document.getElementsByClassName("cart-total-price")[0].innerText = total + ' VNĐ'; // Cập nhật tổng tiền
}



// thay đổi số lượng sản phẩm
var quantity_input = document.getElementsByClassName("cart-quantity-input");
for (var i = 0; i < quantity_input.length; i++) {
var input = quantity_input[i];
input.addEventListener("change", function (event) {
var input = event.target
if (isNaN(input.value) || input.value <= 0) {
input.value = 1;
}
updatecart()
})
}
