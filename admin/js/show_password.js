const showPassword = document.querySelector("#checkbox");

showPassword.addEventListener("click", () => {
  const password = document.querySelector("#floatingPassword");

  if (password.type === "password") {
    password.type = "text";
  } else {
    password.type = "password";
  }
});
