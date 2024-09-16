const slideShow = document.getElementById('slideShow');
let currentIndex = 0;
const slides = slideShow ? slideShow.children : [];
const totalSlides = slides.length;
const displayDuration = 6000; 



function showNextSlide() {
    if (totalSlides === 0) return; 

    slides[currentIndex].style.display = 'none'; 
    currentIndex = (currentIndex + 1) % totalSlides; 
    slides[currentIndex].style.display = 'block'; 
}

function showPrevSlide() {
    if (totalSlides === 0) return; 

    slides[currentIndex].style.display = 'none'; 
    currentIndex = (currentIndex - 1 + totalSlides) % totalSlides; 
    slides[currentIndex].style.display = 'block'; 
}

function autoRotation() {
    if (totalSlides > 0) {
        slides[currentIndex].style.display = 'block'; 
        setInterval(showNextSlide, displayDuration); 
    }
}

window.onload = autoRotation;
