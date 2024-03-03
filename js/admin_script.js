let profile = document.querySelector('.header .flex .profile');
let user = document.querySelector('#user-btn');

user.addEventListener('click', function(){
    profile.classList.toggle('active')
})


let navbar = document.querySelector('.header .flex .navbar');
let menu = document.querySelector('#menu-btn');


menu.addEventListener('click', function(){
    navbar.classList.toggle('active');
})

window.addEventListener('scroll', function(){
    profile.classList.remove('active');
    navbar.classList.remove('active');
})

subImages = document.querySelectorAll('.update-product .image-container .sub-images img');
mainImage = document.querySelector('.update-product .image-container .main-image img');


subImages.forEach(images =>{
    images.addEventListener('click', function(){
        let src = images.getAttribute('src');
        mainImage.src = src;
    })

});
