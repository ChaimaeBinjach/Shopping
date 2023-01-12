
// let navbar = document.querySelector('.header .navbar');
// let accoutBox = document.querySelector('.header .account-box');

// document.querySelector('#menubtn').onclick =()=>{
//     navbar.classList.toggle('active');
//     accoutBox.classList.tremove('active');
// }
// document.querySelector('#userbtn').onclick =()=>{
//     accoutBox.classList.toggle('active');
//     navbar.classList.remove('active');
    
// }

// window.onscroll =()=>{
//     navbar.classList.remove('active');
//     accoutBox.classList.tremove('active');
// }

const navbar = document.querySelector('.header .navbar');
const accountBox = document.querySelector('.header .account-box');
const menuButton = document.querySelector('#menubtn');
const userButton = document.querySelector('#userbtn');

// toggleActive() function that takes an element as a parameter and toggles the "active" class on it.
function toggleActive(element) {
  element.classList.toggle('active');
}

//removeActive() function that takes an element as a parameter and removes the "active" class from it.
function removeActive(element) {
  element.classList.remove('active');
}

//onclick event listeners with addEventListener() and passed in the click event as the first argument.
menuButton.addEventListener('click', () => {
  toggleActive(navbar);
  removeActive(accountBox);
});

//onscroll event listener with addEventListener() and passed in the scroll event as the first argument.
userButton.addEventListener('click', () => {
  toggleActive(accountBox);
  removeActive(navbar);
});

window.addEventListener('scroll', () => {
  removeActive(navbar);
  removeActive(accountBox);
});
