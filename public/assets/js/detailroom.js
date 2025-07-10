
let zoom = document.querySelector('.main-image');
let zoomImg = zoom.querySelector('img:nth-child(2)');
zoom.addEventListener('mousemove', (e) => {
    let rect = zoom.getBoundingClientRect();
    let positionPX = e.clientX - rect.left;
    let positionPY = e.clientY - rect.top;
    let positionX = 100 * positionPX / zoom.offsetWidth;
    let positionY = 100 * positionPY / zoom.offsetHeight;
    zoom.style.setProperty('--zoom-x', positionX + '%');
    zoom.style.setProperty('--zoom-y', positionY + '%');
    zoomImg.style.display = 'block';
});
zoom.addEventListener('mouseleave', () => {
    zoomImg.style.display = 'none';
});
document.addEventListener("DOMContentLoaded", function() {
    // Lắng nghe click vào ảnh trong gallery
    document.querySelectorAll('.image-gallery img').forEach(img => {
        img.addEventListener('click', function() {
            // Tạo overlay
            const overlay = document.createElement('div');
            overlay.className = 'fullscreen-overlay';
            // Tạo ảnh lớn
            const bigImg = document.createElement('img');
            bigImg.src = img.src;
            bigImg.alt = img.alt || '';
            bigImg.className = 'fullscreen-img';
            overlay.appendChild(bigImg);
            // Thêm overlay vào body
            document.body.appendChild(overlay);
            // Khi click overlay thì tắt
            overlay.addEventListener('click', function() {
                overlay.remove();
            });
        });
    });
});