let burger = document.querySelector('.burger');

if(burger){
    document.querySelector(".burger").addEventListener('click', (e) => {
        document.querySelector('header').classList.toggle('is-open');
    })
}