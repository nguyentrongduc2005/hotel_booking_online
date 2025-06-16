document.addEventListener('DOMContentLoaded', function() {
    const roomContainer = document.querySelector('.room-container');
    const prevBtn = document.querySelector('.prev-btn');
    const nextBtn = document.querySelector('.next-btn');
    const roomCards = document.querySelectorAll('.room-card');
    
    let currentPosition = 0;
    const cardWidth = roomCards[0].offsetWidth + 30; // card width + gap
    
    function updateCarousel() {
        roomContainer.scrollTo({
            left: currentPosition,
            behavior: 'smooth'
        });
        
        // Cập nhật trạng thái nút
        prevBtn.style.opacity = currentPosition <= 0 ? '0.3' : '0.6';
        nextBtn.style.opacity = currentPosition >= roomContainer.scrollWidth - roomContainer.clientWidth ? '0.3' : '0.6';
    }
    
    prevBtn.addEventListener('click', () => {
        if (currentPosition > 0) {
            currentPosition = Math.max(0, currentPosition - cardWidth * 4);
            updateCarousel();
        }
    });
    
    nextBtn.addEventListener('click', () => {
        const maxScroll = roomContainer.scrollWidth - roomContainer.clientWidth;
        if (currentPosition < maxScroll) {
            currentPosition = Math.min(maxScroll, currentPosition + cardWidth * 4);
            updateCarousel();
        }
    });
    
    // Khởi tạo carousel
    updateCarousel();
}); 