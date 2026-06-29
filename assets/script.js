    
const menu = document.querySelectorAll('nav a li');
const btnLogin = document.getElementById('btnLogin');
const btnFechar = document.getElementById('btnFechar');
const login = document.getElementById('login');

document.addEventListener("DOMContentLoaded", function() {
    const slides = document.querySelectorAll('.slide');
    const totalSlides = slides.length;
    let currentIndex = 0;

    function showSlide(index) {
        const slidesContainer = document.querySelector('.slides');
        const offset = -index * 100;
        slidesContainer.style.transform = `translateX(${offset}%)`;
    }

    function nextSlide() {
        currentIndex = (currentIndex + 1) % totalSlides;
        showSlide(currentIndex);
    }

    setInterval(nextSlide, 5000); // Muda de Slide a cada 5 segundos

    showSlide(currentIndex); //Retorna para o primeiro Slide
});

document.querySelectorAll('nav ul a').forEach(link => {
    
    link.addEventListener('click', evento => {
        evento.preventDefault();
        const href = link.getAttribute('href');
        const alvo = document.querySelector(href);

        if (alvo) {
            window.scroll({
                top: alvo.offsetTop -40,
                behavior: 'smooth'
            });
        }
   })
});

window.addEventListener('scroll', () => {
    if (window.scrollY > 100) {
        menu.forEach( m =>{
            m.classList.add('shrink');
        });
    } else {
        menu.forEach( m =>{
            m.classList.remove('shrink');
        });
    }
});

btnLogin.onclick = function(){
    login.showModal();
}

btnFechar.onclick = function(){
    login.close();
}

