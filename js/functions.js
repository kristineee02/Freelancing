
let subMenu = document.getElementById("subMenu");

function toggleMenu(){
    subMenu.classList.toggle("open");
}

function logout() {
alert("You have been logged out successfully."); 

}

const designCards = document.querySelectorAll('.card');

designCards.forEach(Card => {
Card.addEventListener('click', function() {
    const redirectPage = this.getAttribute('data-id');

    window.location.href = redirectPage;

});
});

let slideIndex = 0;
const slides = document.querySelectorAll('.slide');
const totalSlides = slides.length;
const visibleSlides = 4.2;

function moveSlide(direction) {
const maxIndex = totalSlides - visibleSlides;
if (direction === 1 && slideIndex < maxIndex) {
    slideIndex++;
} else if (direction === -1 && slideIndex > 0) {
    slideIndex--;
}
const offset = -slideIndex * (100 / visibleSlides);
document.getElementById('carouselSlide').style.transform = `translateX(${offset}%)`;
}

document.addEventListener('DOMContentLoaded', function () {
const notifBtn = document.getElementById('notifBtn');  
const notifPopup = document.getElementById('notifPopup');  


notifBtn.addEventListener('click', function (e) {
e.stopPropagation();
notifPopup.style.display = notifPopup.style.display === 'block' ? 'none' : 'block';
});


document.addEventListener('click', function (e) {
if (!notifPopup.contains(e.target) && e.target !== notifBtn) {
    notifPopup.style.display = 'none';
}
});
});

