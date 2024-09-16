let currentIndex = 0;
const displayDuration = 9000; 
const opacityDuration = 700;
let slideShow = 0;
let slides = 0;
let totalSlides = 0;


function initialize()
{
    slideShow = document.getElementById('slideShow');
    slides = slideShow ? slideShow.children : [];
    totalSlides = slides.length;
    slides[currentIndex].style.opacity = 1;
}

function showNextSlide() {
    if (totalSlides === 0) return; 
    slides[currentIndex].style.opacity = 0;
    
    setTimeout(() => {
        slides[currentIndex].style.display = 'none'; 
        currentIndex = (currentIndex + 1 + totalSlides) % totalSlides; 
        slides[currentIndex].style.display = 'block'; 
        setTimeout(()=> {slides[currentIndex].style.opacity = 1;},opacityDuration);
    }, opacityDuration);
}

function showPrevSlide() {
    if (totalSlides === 0) return; 
    slides[currentIndex].style.opacity = 0;
    
    setTimeout(() => {
        slides[currentIndex].style.display = 'none'; 
        currentIndex = (currentIndex - 1 + totalSlides) % totalSlides; 
        slides[currentIndex].style.display = 'block'; 
        setTimeout(()=> {slides[currentIndex].style.opacity = 1;},opacityDuration);
    }, opacityDuration);
}

function autoRotation() {
    if (totalSlides > 0) {
        slides[currentIndex].style.display = 'block'; 
        setInterval(showNextSlide, displayDuration); 
    }
}

window.onload = function() {
    initialize();
    autoRotation();
};

