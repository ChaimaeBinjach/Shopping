let userBox = document.querySelector('.header .header2 .user-box');

document.querySelector('#userbtn').onclick = () =>{
   userBox.classList.toggle('active');
   navbar.classList.remove('active');
}

let navbar = document.querySelector('.header .header2 .navbar');

document.querySelector('#menubtn').onclick = () =>{
   navbar.classList.toggle('active');
   userBox.classList.remove('active');
}

window.onscroll = () =>{
   userBox.classList.remove('active');
   navbar.classList.remove('active');

   if(window.scrollY > 60){
      document.querySelector('.header .header2').classList.add('active');
   }else{
      document.querySelector('.header .header2').classList.remove('active');
   }
}