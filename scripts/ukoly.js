var menuButton = document.querySelector(".menu-button");
var menu = document.querySelector(".menu");

menuButton.addEventListener("click", function () {
    menu.classList.toggle("menu--open")
});