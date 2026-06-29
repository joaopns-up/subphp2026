// Função para reduzir o menu lateral
function toggleMenuLateral() {
    const sidebar = document.querySelector('.menuLateral');
    const main = document.querySelector('main');
    const footer = document.querySelector('footer');
    const span = document.querySelectorAll('span');

    sidebar.classList.toggle('colapsar');
    main.classList.toggle('expandir');
    footer.classList.toggle('expandir');
    
    span.forEach(s =>{
        s.classList.toggle('none');
    })
}
