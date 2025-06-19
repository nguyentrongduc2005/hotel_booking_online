document.addEventListener('DOMContentLoaded', () => {
    const roomsGrid = document.querySelector('.rooms-grid');
    const navArrowLeft = document.querySelector('.nav-arrow-left');
    const navArrowRight = document.querySelector('.nav-arrow-right');

    if (roomsGrid && navArrowLeft && navArrowRight) {
        const cardWidth = roomsGrid.querySelector('.room-card').offsetWidth;
        const gap = 30; // Defined in CSS as gap: 30px;
        const scrollAmount = cardWidth + gap;

        const updateCardElevation = () => {
            const cards = Array.from(roomsGrid.querySelectorAll('.room-card'));
            const currentScrollLeft = roomsGrid.scrollLeft;

            // Loại bỏ class 'elevated' từ tất cả các thẻ trước
            cards.forEach(card => card.classList.remove('elevated'));

            // Tính toán chỉ số của thẻ đầu tiên đang hiển thị (hoặc gần nhất với khung nhìn)
            const firstVisibleCardIndex = Math.round(currentScrollLeft / scrollAmount);

            // Giả sử có 4 thẻ hiển thị cùng lúc
            const visibleCardsCount = 4;

            // Áp dụng class 'elevated' cho thẻ đầu tiên và thẻ cuối cùng trong số các thẻ đang hiển thị
            if (cards[firstVisibleCardIndex]) {
                cards[firstVisibleCardIndex].classList.add('elevated');
            }
            if (cards[firstVisibleCardIndex + visibleCardsCount - 1]) {
                cards[firstVisibleCardIndex + visibleCardsCount - 1].classList.add('elevated');
            }
        };

        // Cập nhật trạng thái ban đầu và khi cuộn
        roomsGrid.addEventListener('scroll', updateCardElevation);
        updateCardElevation(); // Gọi khi tải trang để thiết lập trạng thái ban đầu

        navArrowRight.addEventListener('click', () => {
            roomsGrid.scrollBy({ left: scrollAmount, behavior: 'smooth' });
        });

        navArrowLeft.addEventListener('click', () => {
            roomsGrid.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
        });

        const roomCard = roomsGrid ? roomsGrid.querySelector('.room-card') : null;
        if (roomCard) {
            console.log('cardWidth:', roomCard.offsetWidth);
            console.log('scrollAmount:', roomCard.offsetWidth + 30);
        } else {
            console.log('roomCard not found or roomsGrid not found.');
        }
    }
});

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
