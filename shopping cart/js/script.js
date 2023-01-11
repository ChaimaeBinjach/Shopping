const navbar = document.querySelector('.header .flex .navbar');

document.querySelector('#menu-btn').addEventListener('click', () => {
  navbar.classList.toggle('active');
});

window.addEventListener('scroll', () => {
  navbar.classList.remove('active');
});

document.querySelectorAll('input[type="number"]').forEach(inputNumber => {
  inputNumber.addEventListener('input', () => {
    if (inputNumber.value.length > inputNumber.maxLength) {
      inputNumber.value = inputNumber.value.slice(0, inputNumber.maxLength);
    }
  });
});
