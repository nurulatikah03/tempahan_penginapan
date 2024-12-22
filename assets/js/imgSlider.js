let currentIndex = 0;

const slides = document.querySelectorAll('.slider-slide');
const totalSlides = slides.length;
const dots = document.querySelectorAll('.dot');

document.getElementById('next').addEventListener('click', function () {
    if (currentIndex < totalSlides - 1) {
        currentIndex++;
    } else {
        currentIndex = 0;
    }
    updateSlider();
});

document.getElementById('prev').addEventListener('click', function () {
    if (currentIndex > 0) {
        currentIndex--;
    } else {
        currentIndex = totalSlides - 1;
    }
    updateSlider();
});

function updateSlider() {
    const sliderWrapper = document.querySelector('.slider-wrapper');
    const newTranslateValue = -currentIndex * 100 + '%';
    sliderWrapper.style.transform = 'translateX(' + newTranslateValue + ')';

    dots.forEach(dot => dot.style.backgroundColor = '#bbb');

    dots[currentIndex].style.backgroundColor = '#717171';
}

dots.forEach((dot, index) => {
    dot.addEventListener('click', function () {
        currentIndex = index;
        updateSlider();
    });
});

updateSlider();