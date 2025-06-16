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
