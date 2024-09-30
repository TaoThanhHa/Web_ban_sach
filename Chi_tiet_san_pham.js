//Tăng giảm số lượng truyện
const countElement = document.getElementById('count');
    const decreaseButton = document.getElementById('decrease');
    const increaseButton = document.getElementById('increase');

    let count = 1;

    decreaseButton.addEventListener('click', () => {
        if (count > 1) {
            count--;
            countElement.textContent = count;
        }
    });

    increaseButton.addEventListener('click', () => {
        count++;
        countElement.textContent = count;
    });

//Đổi box tác phẩm
function changeContent(element, text) {
    const chapElement = document.querySelector('.mota');
    const cmtElement = document.querySelector('.cmt');

    if (text === 'Mô tả') {
        chapElement.style.display = 'flex';
        cmtElement.style.display = 'none';
    } else if (text === 'Bình luận') {
        chapElement.style.display = 'none';
        cmtElement.style.display = 'flex';
    }

    const words = document.getElementsByClassName('word');
    for (let i = 0; i < words.length; i++) {
        words[i].classList.remove('selected');
    }

    element.classList.add('selected');
}

document.addEventListener('DOMContentLoaded', () => {
    const menuToggle = document.getElementById('menu-toggle'); // Correctly select the icon
    const navMenu = document.getElementById('nav-menu'); // Select the nav menu

    menuToggle.addEventListener('click', () => {
        navMenu.classList.toggle('active'); // Toggle the 'active' class
    });
});


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
