let slideIndex = 0;

function showSlide(index) {
    const slides = document.querySelectorAll('.slide');
    if (index >= slides.length) {
        slideIndex = 0;
    }else if (index < 0) {
        slideIndex = slides.length - 1;
    }else{
        slideIndex=index;
    }
    slides.forEach((slide, i) => {
        slide.style.display = (i === slideIndex) ? 'block' : 'none';
    });
}

function nextSlide() {
    slideIndex++;
    showSlide(slideIndex);
}

function prevSlide() {
    slideIndex--;
    showSlide(slideIndex);
}

// Mostrar la primera diapositiva
showSlide(slideIndex);
document.addEventListener('DOMContentLoaded', () => {
    showSlide(slideIndex);
});


const interval = 3000; // Intervalo en milisegundos

setInterval(nextSlide, interval);

//función para alternar visibilidad de la barra  con el botón:
document.addEventListener('DOMContentLoaded', () => {
    const toggleButton = document.getElementById('toggleButton');
    const toggleElement = document.getElementById('toggleElement');

    toggleButton.addEventListener('change', () => {
        // Alternar la clase 'mostrar'
        if (toggleElement.classList.contains('mostrar')) {
            toggleElement.classList.remove('mostrar');
        } else {
            toggleElement.classList.add('mostrar');
        }
    });
});