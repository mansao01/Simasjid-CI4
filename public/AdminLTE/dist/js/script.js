document.addEventListener('DOMContentLoaded', function () {
  const container = document.querySelector('.container');
  const registerlnk = document.getElementById('registerText');
  const loginlnk = document.getElementById('loginText');
  const registerBtn = document.getElementById('register');
  const loginBtn = document.getElementById('login');
  const signInForm = document.querySelector('.form-container.sign-in');
  const signUpForm = document.querySelector('.form-container.sign-up');

  registerBtn.addEventListener('click', (event) => {
    event.preventDefault(); // Menghentikan perilaku bawaan dari tautan
    container.classList.add("active");
    signInForm.classList.remove("active");
    signUpForm.classList.add("active");
  });

  loginBtn.addEventListener('click', () => {
    container.classList.remove("active");
    signInForm.classList.add("active");
    signUpForm.classList.remove("active");
  });
  registerlnk.addEventListener('click', (event) => {
    event.preventDefault(); // Menghentikan perilaku bawaan dari tautan
    container.classList.add("active");
    signInForm.classList.remove("active");
    signUpForm.classList.add("active");
  });

  loginlnk.addEventListener('click', () => {
    container.classList.remove("active");
    signInForm.classList.add("active");
    signUpForm.classList.remove("active");
  });
});
