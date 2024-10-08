document.getElementById('cart').addEventListener('click', function() {
    window.location.href = 'Giỏ_hàng.php';
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
    const menuToggle = document.getElementById('menu-toggle'); 
    const navMenu = document.getElementById('nav-menu'); 

    menuToggle.addEventListener('click', () => {
        navMenu.classList.toggle('active'); 
    });
});


